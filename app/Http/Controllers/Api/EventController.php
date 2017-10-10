<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Event;
use App\Models\Backend\Attendee;
use Illuminate\Support\Facades\Input;

class EventController extends Controller {
    /**
     * Show events
     */
    public function getEvents() {
        $data = [];

        $events = Event::get();
        $data['data'] = $events;

        return response()->json($events);
    }

    /**
     * Add  attendee
     */
    public function addAttendee() {
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
            if ($attendee->save())
                $data = ['result' => 'success'];
            else
                $data = ['result' => 'error'];
        }

        return response()->json($data);
    }

    /**
     * Show events
     */
    public function getEventUserAttendee() {
        $event_id = Input::get('event_id');
        $user_id = Input::get('user_id');
        $attendee = Attendee::where('event_id', $event_id)
            ->where('user_id', $user_id)
            ->first();

        return response()->json($attendee);
    }
}
