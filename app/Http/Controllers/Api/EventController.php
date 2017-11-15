<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\AttendeePayment;
use App\Models\Backend\Event;
use App\Models\Backend\Attendee;
use Illuminate\Support\Facades\Input;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Error as StripeError;
use Stripe\Charge;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EventController extends Controller
{
    /**
     * Show events
     */
    public function getEvents()
    {
        $data = [];

        $events = Event::where('is_active', '=', 1)->get();
        $data['data'] = $events;

        return response()->json($events);
    }

    /**
     * Add  attendee
     */
    public function addAttendee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|numeric|min:1',
            'user_id' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $event_id = Input::get('event_id');
        $user_id = Input::get('user_id');

        $attendee = Attendee::where('event_id', $event_id)
            ->where('user_id', $user_id)
            ->first();
        if ($attendee) {
            $data = ['result' => 'already_exist'];
        } else {
            $attendee = new Attendee();
            $attendee->event_id = $event_id;
            $attendee->user_id = $user_id;
            $attendee->allowed = 0;
            $attendee->payment_status_id = 1;
            $attendee->payment_method_id = 1;
            $attendee->payment_source_id = 1;
            $attendee->registration_status_id = 3;
            $attendee->qr_code = Crypt::encryptString($event_id. '_'.$user_id);

            if ($attendee->save()) {
                $data = ['success' => 'yes'];
            } else {
                $data = ['error' => 'Can\'t create attendee'];
            }
        }

        return response()->json($data);
    }

    /**
     * Show events
     */
    public function getEventUserAttendee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_id' => 'required|numeric|min:1',
            'user_id' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $event_id = Input::get('event_id');
        $user_id = Input::get('user_id');
        $attendee = Attendee::where('event_id', $event_id)
            ->where('user_id', $user_id)
            ->first();

        return response()->json($attendee);
    }

    public function addStripePayment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvc' => 'required',
            'attendee_id' => 'required|numeric|min:1',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $attendee_id = Input::get('attendee_id');
        $number = Input::get('number');
        $amount = Input::get('amount');
        $exp_month = Input::get('exp_month');
        $exp_year = Input::get('exp_year');
        $cvc = Input::get('cvc');

        $request = [
            "card" => [
                "number" => $number,
                "exp_month" => $exp_month,
                "exp_year" => $exp_year,
                "cvc" => $cvc
            ]
        ];

        $attendee = Attendee::where('id', $attendee_id)->first();
        if (!$attendee) {
            $data = ['error' => 'Can\'t find attendee'];

            return response()->json($data);
        }

        if ($attendee->payment_status_id == 3) {
            $data = ['error' => 'Attendee already has payment'];

            return response()->json($data);
        }

        try {
            Stripe::setApiKey('sk_test_eU41TDGLPMRiqRHkQWtVVxPV');
            $token = new Token();
            $token = $token::create($request);
            $token = $token->id;

            $charge = Charge::create([
                "amount" => $amount * 100, // amount in cents, again
                "currency" => "usd",
                "source" => $token,
                "description" => "Event charge"
            ]);
        } catch (\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            $body = $e->getJsonBody();
            $err = $body['error']['message'];
            $data = ['error' => $err];

            return response()->json($data);
        } catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
            $body = $e->getJsonBody();
            $err = $body['error']['message'];
            $data = ['error' => $err];

            return response()->json($data);
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $body = $e->getJsonBody();
            $err = $body['error']['message'];
            $data = ['error' => $err];

            return response()->json($data);
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $body = $e->getJsonBody();
            $err = $body['error']['message'];
            $data = ['error' => $err];

            return response()->json($data);
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            $body = $e->getJsonBody();
            $err = $body['error']['message'];
            $data = ['error' => $err];

            return response()->json($data);
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $body = $e->getJsonBody();
            $err = $body['error']['message'];
            $data = ['error' => $err];

            return response()->json($data);
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
        }

        $attendeePayment = new AttendeePayment();
        $attendeePayment->amount = $amount;
        $attendeePayment->payment_id = $charge->id;
        $attendeePayment->attendee_id = $attendee_id;
        if (!$attendeePayment->save()) {
            $data = ['error' => 'Can\'t  save payment data.'];

            return response()->json($data);
        }

        $attendee = Attendee::where('id', $attendee_id)->first();
        $attendee->payment_status_id = 3;
        $attendee->payment_method_id = 2;
        $attendee->payment_source_id = 2;
        $attendee->registration_status_id = 2;
        if (!$attendee->save()) {
            $data = ['error' => 'Can\'t change attendee status.'];

            return response()->json($data);
        }

        $data = ['success' => 'yes'];

        return response()->json($data);
    }

    public function delStripePayment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'attendee_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $attendee_id = Input::get('attendee_id');

        $attendee = Attendee::where('id', $attendee_id)->first();
        if (!$attendee) {
            $data = ['error' => 'Can\'t find attendee'];

            return response()->json($data);
        }
        $attendee->allowed = 0;
        $attendee->payment_status_id = 1;
        $attendee->payment_method_id = 1;
        $attendee->payment_source_id = 1;
        $attendee->registration_status_id = 3;
        if ($attendee->save()) {
            $data = ['success' => 'yes'];
        } else {
            $data = ['error' => 'Can\'t delete attendee payment'];
        }

        return response()->json($data);
    }

    public function checkCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $code = Input::get('code');
        try {
            $code = Crypt::decryptString($code);
        } catch (DecryptException $e) {
            $data = ['error' => 'Can\'t decrypt code'];
        }
        if ($pos = strpos($code,"_")) {
            $event_id = substr($code,0, $pos);
            $user_id= substr($code,$pos+1, strlen($code)-$pos -1);

            $attendee = Attendee::where('event_id', $event_id)
                ->where('user_id', $user_id)
                ->where('payment_status_id', 3)
                ->first();

            if (!$attendee) {
                $data = ['error' => 'Can\'t find code or payment status invalid'];

                return response()->json($data);
            }

            $data = ['success' => 'yes'];
        }

        return response()->json($data);

    }
}
