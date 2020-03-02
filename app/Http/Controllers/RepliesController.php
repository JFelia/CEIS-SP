<?php

namespace App\Http\Controllers;

use App\Email;
use App\Reply;
use App\User;
use App\Log;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
   
    public function store(Request $request)
    {
        //
        
         $user_id = session()->get('user_id');
        if(Auth::check()){
            $message=Reply::create([
                    'user_id' => $user_id,
                    'email_id' => $request->input('email_id'),
                    'client_id' => $request->input('client_id'),
                    'message' => $request->input('message')
                ]);

            if($message){
                //find the client name
                $email_id = $request->input('email_id');
                $find = Email::where('id', $email_id)->get()->first();
                $getclient = User::where('id', $find->client_id)->get()->first();
                //create log
                $log = session()->get('name') . ' has successfully replied on ' . $getclient->name . '\'s email' ;
                $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);         
                return back();
             }else{
                
                }
        }
    }

    
    public function show($id = null)
    {
        $name = session()->get('username');
        //getting the email infos
        $email = Email::where('id',$id)->get();
        //update the status if still unread
        if($email->status = "unread"){
             $emailUpdate = Email::where('id',$id)
            ->update([
                        'status' => 'read by '.$name
                ]);
        }
        foreach($email as $key => $val){
                $client_name = User::where(['id'=>$val->client_id])->first();
                $email[$key]->client_name = $client_name->name;
                $email[$key]->client_avatar = $client_name->avatar;
            }

        //getting the email replies
        $replies = Reply::where('email_id',$id)->get()->all();
            foreach($replies as $key => $val){
                $user_name = User::where(['id'=>$val->user_id])->first();
                $replies[$key]->user_name = $user_name->name;
                $replies[$key]->user_avatar = $user_name->avatar;
            }            
            return view('admin.emails.show')->with(compact('email','replies'));
    }

    public function mark($id = null)
    {

        $user_id = session()->get('user_id');//create a session to identify the user id
            $name = session()->get('username');
             $emailUpdate = Reply::where('id',$id)
                ->update([
                        'status' => 'read by '.$name
                ]);

                return back();
     
    }

    public function destroy(Reply $reply)
    {
        //
    }
}
