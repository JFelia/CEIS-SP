<?php

namespace App\Http\Controllers;
use Session;
use App\User;
use App\Contact;
use App\Post;
use App\MessageClient;
use App\Comment;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    //this is for user profile
	public function show(Request $request){
		$id = $request->session()->get('user_id');
		$data = User::where('id', $id)->get();
 		$smssent = MessageClient::where('user_id',$id)->count();

		$posts = Post::where('user_id',$id)->orderBy('created_at','desc')->paginate(10);
        foreach($posts as $key => $val){
                $poser = User::where(['id'=>$val->user_id])->first();
                $posts[$key]->poser = $poser->name;
                $posts[$key]->poserAvatar = $poser->avatar;
                $created_at = Post::where(['id'=>$val->id])->first();
                $posts[$key]->poserCreated_at = $created_at->created_at;
                $comments = Comment::where(['post_id'=>$val->id])->count();
                $posts[$key]->comments_count = $comments;
            }
		// return view('admin.profiles.show',['data'=>$data]);

		return view('admin.profiles.show',['data'=>$data,'smssent'=>$smssent])->with(compact('posts'));
	}

	//this is for staff profile
	public function staffProfile(Request $request, $id = null){
		$staffDetails = User::where(['id'=>$id])->first();
		$smssent = MessageClient::where('user_id',$id)->count();

		$posts = Post::where('user_id',$id)->orderBy('created_at','desc')->paginate(10);
        foreach($posts as $key => $val){
                $poser = User::where(['id'=>$val->user_id])->first();
                $posts[$key]->poser = $poser->name;
                $posts[$key]->poserAvatar = $poser->avatar;
                $created_at = Post::where(['id'=>$val->id])->first();
                $posts[$key]->poserCreated_at = $created_at->created_at;
                $comments = Comment::where(['post_id'=>$val->id])->count();
                $posts[$key]->comments_count = $comments;
            }

        return view('admin.profiles.show_other',['smssent'=>$smssent])->with(compact('staffDetails','posts'));
	}

	//this is for the client profile
	public function clientProfile(Request $request, $id = null){
		$count = Contact::where('client_id',$id)->get()->count();
		session()->put('contact_count',$count);
		$contacts = Contact::where('client_id',$id)->get()->all();
		$clientDetails = User::where(['id'=>$id])->first();
		$posts = Post::where('user_id',$id)->orderBy('created_at','desc')->paginate(10);
        foreach($posts as $key => $val){
                $poser = User::where(['id'=>$val->user_id])->first();
                $posts[$key]->poser = $poser->name;
                $posts[$key]->poserAvatar = $poser->avatar;
                $created_at = Post::where(['id'=>$val->id])->first();
                $posts[$key]->poserCreated_at = $created_at->created_at;
                $comments = Comment::where(['post_id'=>$val->id])->count();
                $posts[$key]->comments_count = $comments;
            }
        return view('admin.clients.show',['contacts' => $contacts])->with(compact('clientDetails','posts'));
	}
}
