<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Messages;
use App\Events\ConnectionCheckVerificaton;
use App\Events\ConnectionCheckValidation;
use App\Events\SetMessagesState;
use App\Models\TemporyMessageImageVideoLink;
use App\Models\User;
use App\Events\Private_test;
use App\Events\Presence_global;
use App\Events\Private_message;

class MessageController extends Controller
{
    // send message to specific user

    public function sendMessage(Request $request)
    {
        // Messages::dispatch(
        //     $request->message,
        //     $request->id,
        //     $request->senderID,
        //     $request->senderName,
        //     $request->senderImage,
        //     $request->messageType,
        //     $request->status,
        //     $request->date,
        //     $request->state,
        //     $request->messageUniqueId,
        // );
        Private_message::dispatch(
            $request->message,
            $request->sender_id,
            $request->receipient_id,
            $request->is_me,
            $request->message_type,
            $request->opened,
            $request->message_state,
            $request->unique_message_id,
            $request->deleted,
        );
        return "Event has been sent!";
        // . $request->receipient_id;
    }


    public function test(Request $request)
    {
        Private_test::dispatch($request->test, $request->id);
    }


    public function presence(Request $request)
    {
        Presence_global::dispatch($request->test, $request->room_id);
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
        SetMessagesState::dispatch($request->id, $request->who_sending, $request->message_id, $request->state);
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
