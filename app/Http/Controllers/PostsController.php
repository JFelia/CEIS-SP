<?php

namespace App\Http\Controllers;
use Session;
use App\Post;
use App\User;
use App\Log;
use App\Comment;
use File;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    
    
    public function store(Request $request)
    {
        
        $validator=Validator::make($request->all(),[
                'message' => 'required'
            ]);

        if($validator->fails()){
            \Session::flash('flash_message_error','Please enter the required details');
            return Redirect::to('/admin/dashboard')->withInput()->withErrors($validator);
        }

        $user_id = session()->get('user_id');
        if(Auth::check()){
            $message=Post::create([
                    'user_id' => $user_id,
                    'message' => $request->input('message'),
                    'remarks' => 'Posted'
                ]);

            if($message){

                $log = session()->get('name') . ' post something';
                $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);         

                return redirect("/admin/dashboard");
             }else{
                return back()->withInput();
                }
        }
    }

    public function destroy($id = null)
    {
        //
        $findPost_Child = Comment::where('post_id',$id);
         $findPost = Post::find($id);
         if($findPost->avatar != Null){
            //if the post has image
            $checkIfPP = User::where('avatar', $findPost->avatar)->get()->first(); //check if that image is profile pic of one of the users
            if($checkIfPP){
                File::delete('LTE/dist/img/small/'.$findPost->avatar);
                File::delete('LTE/dist/img/medium/'.$findPost->avatar);
                User::where('avatar', $findPost->avatar)->update([
                        'avatar' => 'default_user.png'
                    ]);
                Comment::where('avatar', $findPost->avatar)->update([
                        'avatar' => 'default_user.png'
                    ]);
            }
         }

       $findPost_Child->delete();
            $findPost->delete();
            //redirect
            return back();
            
    }
}
