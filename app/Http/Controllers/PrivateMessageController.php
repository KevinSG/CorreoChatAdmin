<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\PrivateMessage;
use App\User;

class PrivateMessageController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function getUserList()
    {
        return response(['data' => User::all()], 200);
    }

    public function getUserNotifications(Request $request)
    {
    	$notifications = PrivateMessage::where('read', 0)
    	->where('receiver_id', $request->user()->id)
    	->orderBy('created_at','desc')
    	->get();

    	return response(['data' => $notifications], 200);
    }

    public function getPrimateMessages(Request $request)
    {
        $pms = PrivateMessage::where('receiver_id', $request->id)
    			->orderBy('created_at', 'desc')
    			->get();

    	return response(['data' => $pms], 200);
        //return $request;
    }

    public function getPrivateMessageById(Request $request)
    {
    	$pm = PrivateMessage::where('id', $request->input('id'))->first();

    	//si el mesaje no se lee pasa esto
    	
    	if($pm->read == 0){
    		$pm->read = 1;
    		$pm->save();
    	}

    	return response(['data' => $pm], 200);	
    }

    public function getPrivateMessageSent(Request $request)
    {
    	$pms = PrivateMessage::where('sender_id', $request->id)
    			->orderBy('created_at', 'desc')
    			->get();

    	return response(['data' => $pms], 200);
       //return $request->user()->id;	
    }

    public function sendPrivateMessage(Request $request)
    {
    	$attributes = [
    		'sender_id' => $request->input('sender_id'),
    		'receiver_id' => $request->input('receiver_id'),
    		'subject' => $request->input('subject'),
    		'message' => $request->input('message'),
    		'read' => 0
    	];


    	$pm = PrivateMessage::create($attributes);
    	$data = PrivateMessage::where('id', $pm->id)->first();

        return response(['data' => $data], 201);

         Redis::connection();
         Redis::publish('message', json_encode($data));
    }

}
