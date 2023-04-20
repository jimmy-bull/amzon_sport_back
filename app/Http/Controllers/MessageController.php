<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Messages;
use App\Events\ConnectionCheckVerificaton;
use App\Events\ConnectionCheckValidation;

class MessageController extends Controller
{
    // send message to specific user

    public function sendMessage(Request $request)
    {
        Messages::dispatch(
            $request->message,
            $request->id,
            $request->senderID,
            $request->senderName,
            $request->senderImage,
            $request->messageType,
            $request->status,
            $request->date
        );
        return 'Event has been sent!';
    }
    //  , $senderImage, $messageType, $status, $date


    public function ConnectionCheckVerificaton(Request $request)
    {
        ConnectionCheckVerificaton::dispatch($request->id, $request->name, $request->connectionState, $request->date, $request->userImage, $request->frappeurId);
        return $request->frappeurId;
        return 'Event has been sent!';
    }


    public function ConnectionCheckValidation(Request $request)
    {
        ConnectionCheckValidation::dispatch($request->id, $request->name, $request->connectionState, $request->date, $request->userImage, $request->frappeurId);
        return 'Event has been sent!';
    }
}
