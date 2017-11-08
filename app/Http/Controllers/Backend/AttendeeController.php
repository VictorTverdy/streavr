<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Attendee;

class AttendeeController extends Controller
{
    /**
     * Print QR code
     */
    public function attendeeTicket($id) {

        $attendee = Attendee::where([
            'id' => $id,
            'payment_status_id' => 3
        ])->first();

        if (!is_null($attendee)) {
            return view('backend.attendee.ticket', ['attendee' => $attendee]);
        } else {
            abort(404, 'Ticket not found');
        }
    }
}