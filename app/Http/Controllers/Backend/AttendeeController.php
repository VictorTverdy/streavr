<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\QrCode;

class AttendeeController extends Controller
{
    /**
     * Print QR code
     */
    public function attendeeTicket($id) {

        $qrCode = QrCode::where(['id' => $id])->first();

        if (!is_null($qrCode)) {
            return view('backend.attendee.ticket', ['qrCode' => $qrCode]);
        } else {
            abort(404, 'Ticket not found');
        }
    }
}