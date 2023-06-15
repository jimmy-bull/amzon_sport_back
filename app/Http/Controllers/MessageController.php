<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Messages;
use App\Events\ConnectionCheckVerificaton;
use App\Events\ConnectionCheckValidation;
use App\Events\SetMessagesState;
use App\Models\TemporyMessageImageVideoLink;
use App\Models\User;

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
            $request->date,
            $request->state,
            $request->messageUniqueId,
        );
        return "Event has been sent!";
    }


    public function ConnectionCheckVerificaton(Request $request)
    {
        ConnectionCheckVerificaton::dispatch($request->id, $request->name, $request->connectionState, $request->date, $request->userImage, $request->frappeurId);
        // return $request->frappeurId;
        return 'Event has been sent!';
    }


    public function ConnectionCheckValidation(Request $request)
    {
        ConnectionCheckValidation::dispatch($request->id, $request->name, $request->connectionState, $request->date, $request->userImage, $request->frappeurId);
        return 'Event has been sent!';
    }

    public function  SetMessagesState(Request $request)
    {
        SetMessagesState::dispatch($request->id, $request->who_sending, $request->message, $request->state, $request->date);
        return 'Event has been sent!';
    }

    public function addtempory_message_image_video_links(Request $request)
    {
        $checkfirst =  User::where('remember_token', "=", $request->tokens)->count();
        if ($checkfirst > 0) {
            $temporyMessageImageVideoLink = new TemporyMessageImageVideoLink();
            $temporyMessageImageVideoLink->link = $request->link;
            $temporyMessageImageVideoLink->save();
            return TemporyMessageImageVideoLink::where('link', '=', $request->link)->select("id")->get();
        } else {
            return "not connected";
        }
    }
}
