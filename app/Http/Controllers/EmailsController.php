<?php

namespace App\Http\Controllers;

use App\Email;
use App\Reply;
use App\User;
use App\Log;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailsController extends Controller
{
    
    public function index(Request $request)
    {
        //
        $value=$request->session()->get('adminSession');
        if($value){
            $outbox = Email::orderBy('created_at','desc')->get()->all();
            foreach($outbox as $key => $val){
                $client_name = User::where(['id'=>$val->client_id])->first();
                $outbox[$key]->client_name = $client_name->name;
                $replystats = Reply::where(['email_id'=>$val->id,'status'=>'Mark as Read'])->count();
                $outbox[$key]->replystats = $replystats;
            }
            return view('admin.emails.email')->with(compact('outbox'));
        }else{
            return redirect('/admin')->with('flash_message_error','Please login to access');
        }

    }

    
    public function create()
    {
        //
        $id = Auth::user()->id;
        $contacts = Contact::where('client_id',$id)->get()->all();
        return view('admin.emails.create',['contacts'=>$contacts]);
    }

    public function transaction(Request $request)
    {
        //
        $user_id=$request->session()->get('user_id');
        
            $outbox = Email::where('client_id',$user_id)->orderBy('created_at','desc')->get()->all();
            foreach($outbox as $key => $val){
                $client_name = User::where(['id'=>$val->client_id])->first();
                $outbox[$key]->client_name = $client_name->name;
                $replystats = Reply::where(['email_id'=>$val->id,'status'=>'Mark as Read'])->count();
                $outbox[$key]->replystats = $replystats;
            }
            return view('admin.emails.transaction')->with(compact('outbox'));
    }

    
    public function store(Request $request)
    {
        //
        $array = $_POST['contact'];
        $number;
        $c=0;
        foreach($array as $value){
            if($c == 0){
                $number = $value;    
            }else{
                $number = $number . ' ' . $value;
            }
            $c++;
        }

        $client_id = session()->get('user_id');
       
        if(Auth::check()){
            $message=Email::create([
                    'client_id' => $client_id,
                    'recipients' => $number,
                    'message' => $request->input('message')
                ]);

            if($message){

                $log = session()->get('name') . ' has successfully sent an email to the smsportal';
                $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);         

                return redirect()->route('emails.create')->with('flash_message_success','Request has been successfully sent');
             }else{
                return back()->withInput()->with('flash_message_error','Request not sent');
                }
        }
    }

    public function anonymous(Request $request){
        $client_id = session()->get('user_id');
        $countrycode = $request->input('countrycode'); 
        $recipient = $request->input('recipients');
        $number = $countrycode.$recipient;
        if(Auth::check()){
            $message=Email::create([
                    'client_id' => $client_id,
                    'recipients' => $number,
                    'message' => $request->input('message')
                ]);

            if($message){

                $log = session()->get('name') . ' has successfully sent an email to the smsportal';
                $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);         

                return redirect()->route('emails.create')->with('flash_message_success','Request has been successfully sent');
             }else{
                return back()->withInput()->with('flash_message_error','Request not sent');
                }
        }
    }

    public function update_email(Request $request, $id = null){
        if($request->isMethod('post')){
            Email::where('id',$id)->update([
                    'recipients'=>$request->input('recipients'),
                    'message'=>$request->input('message')
                ]);


             $log = session()->get('name') . ' has updated his email';
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            return back()->with('flash_message_success','User Information updated successfully');
            
        }
    }

    
    public function edit(Email $email)
    {
        //
    }

    public function update(Request $request, Email $email)
    {
        //
    }

    public function destroy(Email $email)
    {
        //
    }
}
