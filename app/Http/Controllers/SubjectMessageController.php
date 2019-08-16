<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LRedis;
use App\SubjectMessage;
use App\User;

class SubjectMessageController extends Controller
{

    public function getUserList(Request $request)
    {
        $user = SubjectMessage::where('receiver_id', $request->email)
                ->groupBy('sender_id')
                ->get('sender_id');
        return response(['data' => $user], 200);
        //return $request;
    }

    public function getSubjectMessages(Request $request)
    {
        $pms = SubjectMessage::where('receiver_id', $request->email)
                ->orderBy('created_at', 'desc')
                ->get();

        return response(['data' => $pms], 200);
        //return $request;
    }

    public function getSubjectMessagesCount(Request $request)
    {
        $pms = SubjectMessage::where('read', 0)
                ->where('receiver_id', $request->email)
                ->count();

        return response(['data' => $pms], 200);
        //return $request;
    }

    public function getSubjectMessageSent(Request $request)
    {
        $pms = SubjectMessage::where('sender_id', $request->email)
                ->orderBy('created_at', 'desc')
                ->get();

        return response(['data' => $pms], 200);
       //return $request->user()->id;   
    }

    public function sendSubjectMessage(Request $request)
    {
    	$attributes = [
    		'sender_id' => $request->input('sender'),
    		'receiver_id' => $request->input('receiver'),
    		'subject' => $request->input('subject'),
            'read' => 0
    	];


    	$pm = SubjectMessage::create($attributes);
    	$data = SubjectMessage::where('id', $pm->id)->first();

        $redis = LRedis::connection();
        $redis->publish('message', $data);

        return response(['data' => $data], 201);
         
    }
    public function getSubjectMessageById(Request $request)
    {
        $pm = SubjectMessage::where('id', $request->input('id'))->first();

        if($pm->read == 0){
            $pm->read = 1;
            $pm->save();
        }

        return response(['data' => $pm], 200);  
    }
}
