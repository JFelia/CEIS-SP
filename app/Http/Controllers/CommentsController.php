<?php

namespace App\Http\Controllers;
use Session;
use App\Comment;
use App\Log;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        
        $validator=Validator::make($request->all(),[
                'comment' => 'required'
            ]);

        if($validator->fails()){
            \Session::flash('flash_message_error','Please put message to comment before pressing enter');
            return Redirect::to('/admin/dashboard')->withInput()->withErrors($validator);
        }

        $user_name = Auth::user()->name;
        $poser = $request->input('posername');
        if(session()->get('user_level') == 'Client'){
            $client = 1;
        }else{
            $client = 0;
        }

        if(Auth::check()){
            $message=Comment::create([
                    'post_id' => $request->input('post_id'),
                    'user_id' => Auth::user()->id,
                    'commentor' => $user_name,
                    'avatar' => Auth::user()->avatar,
                    'message' => $request->input('comment'),
                    'client' => $client
                ]);

            if($message){

                $log = session()->get('name') . ' commented on ' . $poser . '\'s post';
                $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);         

                return back();
             }else{
                return back()->withInput();
                }
        }
    }

    
    public function destroy(Comment $comment)
    {
        //
    }
}
