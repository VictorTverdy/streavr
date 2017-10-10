<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
use App\Models\Backend\Attendee;
use phpDocumentor\Reflection\Types\Object_;

class EventController extends Controller
{
    /**
     * Show all videos
     */
    public function showEvents()
    {

       return view('backend.event.index');
    }

    /**
     * Get events list
     */
    public function getEvents() {
        $data = [];

        $rows = Event::orderBy('created_at', 'desc')->get();
        for ($i = 0; $i < count($rows); $i++) {
            $row = &$rows[$i];
            $row->DT_RowId = 'row_' . $row->id;
            $row->no = $i + 1;
            $row->DT_RowData = ['id' => $row->id];
            if ($row->thumbnail_url) {
                $row->thumbnail = '<img class="thumbnail" src="'. $row->thumbnail_url .'" />';
            }

        }
        $data['data'] = $rows;

        return response()->json($data);
    }

    /**
     * New event
     */
    public function newEvent() {
        return view('backend.event.new');
    }

    /**
     * Edit event
     */
    public function editEvent($id) {

        // Get event
        $event = Event::find($id);

        return view('backend.event.edit', ['event' => $event]);
    }

    /**
     * Delete event
     */
    public function deleteEvent(Request $request, $id) {
        // Remove data in database
        Event::destroy($id);

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * Save event
     */
    public function saveEvent(Request $request) {

        $id = Input::get('id', 0);
        if( $id ) {  // Update
            $eventClass = Event::find($id);
            $eventClass->updated_at = time();
        } else {    // New
            $eventClass = new Event();

        }

        $eventClass->name = Input::get('name');
        $eventClass->description = Input::get('description');
        $eventClass->time_start = Input::get('time_start');
        $eventClass->time_length = Input::get('time_length');
        $eventClass->price = Input::get('price');
        // Save thumbnail
        if ($request->file('thumbnail')) {

            $img = new Image();
            $img->make($request->file('thumbnail')->path());
            $img = $img->make($request->file('thumbnail')->path());
            $maxLength = 1000;
            $imageWidth = $img->width();
            $imageHeight = $img->height();
            $ext = $request->file('thumbnail')->extension();

            if (($imageHeight>$maxLength) || ($imageWidth>$maxLength)) {
                if ($imageWidth >= $imageHeight) {
                    $koef = $imageWidth / $maxLength;
                    $newHeight = ceil($imageHeight / $koef);
                    $newWidth = $maxLength;
                } else {
                    $koef = $imageHeight / $maxLength;
                    $newWidth = ceil($imageWidth / $koef);
                    $newHeight = $maxLength;
                }
                $img = $img->resize($newWidth, $newHeight)->encode($ext);
                $img = $img->__toString();
                $fileName = md5($request->file('thumbnail')->getClientOriginalName()).'.'.$ext;
                Storage::disk('s3')->put('event_thumbnails/'.$fileName, $img);
                $path = 'event_thumbnails/'.$fileName;
            } else {
                $path = Storage::disk('s3')->putFile('event_thumbnails', $request->file('thumbnail'), 'public');
            }

            $eventClass->thumbnail = $path;
            $url = Storage::disk('s3')->url($path);
            $eventClass->thumbnail_url = $url;
        }
        $eventClass->save();

        return redirect('events');
    }

    /**
     * Attendees of event
     */
    public function attendeesEvent($id) {

        // Get event
        $event = Event::find($id);

        return view('backend.event.attendees', ['event' => $event]);
    }

    /**
     * Get events list
     */
    public function getAttendees($id) {
        $data = [];

        $rows = Attendee::with('paymentStatus','paymentSource', 'paymentMethod','registrationStatus','user')
            ->where(['event_id' => $id])
            ->orderBy('created_at', 'desc')
            ->get();

        for ($i = 0; $i < count($rows); $i++) {
            $rowData = &$rows[$i];
            $row = new Object_();
            $row->id = $rowData->id;
            $row->DT_RowId = 'row_' . $rowData->id;
            $row->no = $i + 1;
            $row->DT_RowData = ['id' => $rowData->id];

            $row->payment_status_name = $rowData["paymentStatus"]->name;
            $row->payment_source_name = $rowData["paymentSource"]->name;
            $row->payment_method_name = $rowData["paymentMethod"]->name;
            $row->registration_status_name = $rowData["registrationStatus"]->name;
            $row->user_name = $rowData["user"]->first_name. ' ' .$rowData["user"]->last_name;
            $row->user_email = $rowData["user"]->email;
            $row->created_at = date($rowData->created_at);
            $row->allowed = ($rowData->allowed==1)?'<i class="icon-check">':'';
            $data['data'][] = $row;
       }


        return response()->json($data);
    }

}