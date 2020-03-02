<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\Contact;
use App\MessageClient;
use App\Log;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
   
    public function index(Request $request){
        
            $value=$request->session()->get('adminSession');
            if($value){
                $outbox = MessageClient::orderBy('created_at','desc')->get()->all();
                foreach($outbox as $key => $val){
                    $client_name = User::where(['id'=>$val->client_id])->first();
                    $outbox[$key]->client_name = $client_name->name;
                    $contact_no = Contact::where(['id'=>$val->contact_id])->first();
                    $outbox[$key]->contact_no = $contact_no->contact_no;
                    $sender = User::where(['id'=>$val->user_id])->first();
                    $outbox[$key]->sender = $sender->username;
                    $message = Message::where(['id'=>$val->message_id])->first();
                    $outbox[$key]->message = $message->message;
                }
                return view('admin.messages.index')->with(compact('outbox'));
            }else{
                return redirect('/admin')->with('flash_message_error','Please login to access');
            }
       
    }

    
    public function create(Request $request)
    {
        
            $admin = $request->session()->get('adminSession'); //getting the admin session
            $user = User::where('username',$admin)->get()->first(); //retrieving record of the admin session
            $clients = User::where('user_level','client')->where('type','win')->get()->all();
            $contacts = Contact::all();
            return view('admin.messages.create',['data'=>$user,'clients'=>$clients,'contacts'=>$contacts]);
       
    }

    public function store(Request $request)
    {
        if(Auth::user()->user_level != 'Client'){
            $validator=Validator::make($request->all(),[
                    'client' => 'required',
                    'contact' => 'required',
                    'message' => 'required'
                ]);
            $client_id = $request->input('client');
        }else{
            $validator=Validator::make($request->all(),[
                    'contact' => 'required',
                    'message' => 'required'
                ]);
            $client_id = Auth::user()->id;
        }

        if($validator->fails()){
            \Session::flash('flash_message_error','Please enter the required details');
            return Redirect::to('/messages/create')->withInput()->withErrors($validator);
        }

        $array = $_POST['contact'];
        $counter = 0;

        if(Auth::check()){
            foreach($array as $value){
                $message=Message::create([
                    'message' => $request->input('message')
                ]);

            
                //start of storing the message to database
                $data = $request->input('message');
                $find = Message::where('message',$data)->get()->last();
                $messageclient=MessageClient::create([
                        'client_id' => $client_id,
                        'contact_id' => $value,
                        'message_id' => $find->id,
                        'user_id' => $request->input('user_id'),
                        'type' => 1,
                        'month_year' => date('Y-m',strtotime(NOW())),
                        'identifier' => $client_id.' '.date('Y-m',strtotime(NOW()))
                    ]);
                //get the client name
                // $client_id = $request->input('client');
                $client = User::where('id',$client_id)->get()->first();
                //get the number of recipient
                $contact_id = $value;
                $recipient = Contact::where('id',$contact_id)->get()->first();
                //create logs
                $log = session()->get('name') . ' has successfully sent a message to ' . $recipient->contact_no . ' from ' . $client->name;
                $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

                $counter++;         
            }
            if($message){
                return redirect()->route('messages.create')->with('flash_message_success','Message successfully sent');
             }else{
                return back()->withInput()->with('flash_message_error','Message not sent');
                }
        }
    }

    public function anonymous(Request $request)
    {
        
        if(Auth::user()->user_level != 'Client'){
            $validator=Validator::make($request->all(),[
                    'client' => 'required',
                    'contact' => 'required',
                    'message' => 'required'
                ]);
            $client_id = $request->input('client');
        }else{
            $validator=Validator::make($request->all(),[
                    'contact' => 'required',
                    'message' => 'required'
                ]);
            $client_id = Auth::user()->id;
        }

        if($validator->fails()){
            \Session::flash('flash_message_error','Please enter the required details');
            return Redirect::to('/messages/create')->withInput()->withErrors($validator);
        }
        
        $number = $request->input('contact');
        $separator = explode(" ", $number);
        
        if(Auth::check()){
            $data = $request->input('message');
            // $client_id = $request->input('client');
            foreach($separator as $value){
            $contact = Contact::where('contact_no', $value)->get()->count();
            if($contact > 0){
                
            }else{
                //initialization
                
                //save the message first
                $message = Message::create([
                    'message' => $data
                ]);
                //get the data of the recently added message
                $findsms = Message::where('message',$data)->get()->last();
                //get the client code of the parent id
                $findclientcode = User::where('id',$client_id)->get()->all();
                //save the contact
                foreach($findclientcode as $newobj){
                    $contact = Contact::create([
                        'contact_no' => $value,
                        'client_id' => $client_id,
                        'client_code' => $newobj->client_code
                    ]);
                }
                //get the data of the recently added contact
                $findcontact = Contact::where('contact_no',$value)->get()->all();

                foreach($findcontact as $newobj2){
                $messageclient=MessageClient::create([

                        'client_id' => $client_id,
                        'contact_id' => $newobj2->id,
                        'message_id' => $findsms->id,
                        'user_id' => $request->input('user_id'),
                        'type' => 1,
                        'month_year' => date('Y-m',strtotime(NOW())),
                        'identifier' => $client_id.' '.date('Y-m',strtotime(NOW()))
                        ]);
                    }
                }

                     //get the number of recipient
                $contact_id = $value;
                $recipient = Contact::where('id',$contact_id)->get()->first();
                //create logs
                foreach($findclientcode as $newobj){
                    $log = session()->get('name') . ' has successfully sent a message to ' . $value . ' from ' . $newobj->name;
                    $user_id = session()->get('user_id');
                    Log::create([
                        'user_id' => $user_id,
                        'log' => $log
                    ]);
                }

               }
        }

            if($message){
                return redirect()->route('messages.create')->with('flash_message_success','Message successfully sent');
             }else{
                return back()->withInput()->with('flash_message_error','Message not sent');
                }
        }

    public function forward(Request $request)
    {
        //
        $messages = Message::where('id', $request->id)->get()->first();//getting the message to be forwarded

        $admin = $request->session()->get('adminSession'); //getting the admin session
        $user = User::where('username',$admin)->get()->first(); //retrieving record of the admin session
        $clients = User::where('user_level','client')->get()->all();
        $contacts = Contact::all();
        return view('admin.messages.forward',['data'=>$user,'clients'=>$clients,'contacts'=>$contacts,'text'=>$messages]);

    }

    
    public function email(Request $request)
    {
        //
        $value=$request->session()->get('adminSession');
        if($value){
            $outbox = MessageClient::orderBy('created_at','desc')->get()->all();
            foreach($outbox as $key => $val){
                $client_name = User::where(['id'=>$val->client_id])->first();
                $outbox[$key]->client_name = $client_name->name;
                $contact_no = Contact::where(['id'=>$val->contact_id])->first();
                $outbox[$key]->contact_no = $contact_no->contact_no;
                $sender = User::where(['id'=>$val->user_id])->first();
                $outbox[$key]->sender = $sender->username;
                $message = Message::where(['id'=>$val->message_id])->first();
                $outbox[$key]->message = $message->message;
            }
            return view('admin.messages.email')->with(compact('outbox'));
        }else{
            return redirect('/admin')->with('flash_message_error','Please login to access');
        }
    }
}
