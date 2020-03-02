<?php

namespace App\Http\Controllers;

use App\User;
use App\Contact;
use App\Log;
use App\MessageClient;
use App\Message;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ClientsController extends Controller
{
    
    public function index()
    {
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $clients = User::where(['user_level' => 'Client', 'type' => 'prospect'])->get()->all();
            return view('admin.clients.index',['clients'=>$clients]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    
    public function create()
    {
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            return view('admin.clients.create');
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    
    public function store(Request $request)
    {
   
        $validator=Validator::make($request->all(),[
                'name' => 'required',
                'contact_person' => 'required',
                'contact_number' => 'required',
                'email_or_call' => 'required',
                'email' => 'required',
                'sales' => 'required'
            ]);
        if($validator->fails()){
            // \Session::flash('flash_message_error','Please enter the required details');
            return Redirect::to('/clients/create')->withInput()->withErrors($validator);
        }

        $pass = $request->input('password');
        $cpass = $request->input('cpassword');
        $name = $request->input('name');
        $type = $request->input('type');
        $code = $request->input('client_code');
        $followup = $request->input('FollowedUpOn');
        $countrycode = $request->input('countrycode'); 
        $contact_number = $request->input('contact_number');
        $number = $countrycode.$contact_number;

        if($followup){
            $follow = date('Y-m-d',strtotime($followup));
        }else{
            $follow = $followup;
        }

        if($pass == $cpass){
        if(Auth::check()){
            $client=User::create([

                    'name' => $request->input('name'),
                    'contact_person' => $request->input('contact_person'),
                    'contact_number' => $number,
                    'email_or_call' => $request->input('email_or_call'),
                    'sales' => $request->input('sales'),
                    'IfNotSalesWhy' => $request->input('IfNotSalesWhy'),
                    'updates' => $request->input('updates'),
                    'FollowedUpOn' => $follow,
                    'type' => $type,
                    'client_code' => $code,
                    'email' => $request->input('email'),
                    'user_level' => 'Client'
                ]);

            if($client){

                $log = 'Client ' . $name . ' has successfully added by '. session()->get('name');
                $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

                return redirect()->route('clients.create')->with('flash_message_success','Client created successfully');
                }
            }
        }else{
            return redirect('/clients/create')->with('flash_message_error','Password and Re-type Password should be equal');
        }

        return back()->withInput()->with('flash_message_error','Error creating new client');
    }


    
    public function show()
    {
        //
    }

    
    public function edit($id = null)
    {
        //
        $clients = User::find($id);
        return view('admin.clients.edit',['clients' => $clients]);
    }

    
    public function update(Request $request, $id = null)
    {
        //
        $name = $request->input('name');
        $type = $request->input('type');
        $username = $request->input('username');
        $pass = $request->input('password');
        $followup = $request->input('FollowedUpOn');

        
            if($followup){
                $follow = date('Y-m-d',strtotime($followup));
            }else{
                $follow = $followup;
            }

           
            if($pass){
                $password = bcrypt($pass);
            }else{
                $password = null;
            }
            
            if($username){
                $checkusername = User::where('username',$username)->get()->first();

                if($checkusername){
                    return back()->with('flash_message_error','Username Already Exists');
                }else{
                    $clientUpdate = User::where('id',$id)
                    ->update([
                        'name' => $request->input('name'),
                        'contact_person' => $request->input('contact_person'),
                        'contact_number' => $request->input('contact_number'),
                        'email_or_call' => $request->input('email_or_call'),
                        'sales' => $request->input('sales'),
                        'IfNotSalesWhy' => $request->input('IfNotSalesWhy'),
                        'updates' => $request->input('updates'),
                        'FollowedUpOn' => $follow,
                        'email' => $request->input('email'),
                        'service' => $request->input('service'),
                        'rateperhour' => $request->input('rateperhour'),
                        'username' => $request->input('username'),
                        'password' => $password,
                        'address' => $request->input('address'),
                        'state' => $request->input('state'),
                        'city' => $request->input('city'),
                        'zip' => $request->input('zip'),
                        'country' => $request->input('country'),
                        'user_level' => 'Client'
                        ]);
                }
            }else{
                $clientUpdate = User::where('id',$id)
                ->update([
                            'name' => $request->input('name'),
                            'contact_person' => $request->input('contact_person'),
                            'contact_number' => $request->input('contact_number'),
                            'email' => $request->input('email'),
                            'address' => $request->input('address'),
                            'state' => $request->input('state'),
                            'city' => $request->input('city'),
                            'zip' => $request->input('zip'),
                            'country' => $request->input('country'),
                            'user_level' => 'Client'
                    ]);
            }

            if($clientUpdate){
                $log = 'Client ' . $name . ' has successfully updated by '. session()->get('name');
                $user_id = session()->get('user_id');
                    Log::create([
                        'user_id' => $user_id,
                        'log' => $log
                    ]);

                $clients = User::where('user_level','client')->get()->all();
                if($id == Auth::user()->id){
                    return back()->with('flash_message_success','Successfully updated personal information');
                }elseif($type == 'win'){
                    return redirect('/won_index')->with('flash_message_success','Client updated successfully')->with(compact($clients));
                }else{
                    return redirect()->route('clients.index',['clients'=>$clients])->with('flash_message_success','Client updated successfully');    
                }
            }
            //redirect
            return back()->withInput()->with('flash_message_error','Client could not be updated');
        
    }

    

    public function win(Request $request, $id = null)
    {
        //
        $name = $request->input('name');
        $clientUpdate = User::where('id',$id)
        ->update([
                    'type' => 'win',
                    'service' => 'SMS Support'
                    
            ]);

        if($clientUpdate){
            $log = 'Client ' . $name . ' has successfully won. Updated by '. session()->get('name');
            $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            $clients = User::where(['user_level' => 'Client', 'type' => 'prospect'])->get()->all();
            if($id == Auth::user()->id){
                return back()->with('flash_message_success','Successfully updated personal information');
            }else{
            return redirect()->route('clients.index',['clients'=>$clients])->with('flash_message_success','Client successfully won');
            }
        }
        //redirect
        return back()->withInput()->with('flash_message_error','Client could not be updated');
    }

    public function viewwon(Request $request)
    {
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $clients = User::where(['user_level' => 'Client', 'type' => 'win'])->get()->all();
            return view('admin.clients.won_index',['clients'=>$clients]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }


    public function viewlost(Request $request)
    {
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $clients = User::where(['user_level' => 'Client', 'type' => 'lost'])->get()->all();
            return view('admin.clients.lost_index',['clients'=>$clients]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    public function lost(Request $request, $id = null)
    {
        //
        $name = $request->input('name');
        $clientUpdate = User::where('id',$id)
        ->update([
                    'type' => 'lost'
                    
            ]);

        if($clientUpdate){
            $log = 'Client ' . $name . ' had been lost. Updated by '. session()->get('name');
            $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            $clients = User::where(['user_level' => 'Client', 'type' => 'win'])->get()->all();
            if($id == Auth::user()->id){
                return back()->with('flash_message_success','Successfully updated personal information');
            }else{
            return back()->with('flash_message_success','Client updated successfully')->with(compact('clients'));
            }
        }
        //redirect
        return back()->withInput()->with('flash_message_error','Client could not be updated');
    }








    public function invoice($id = null){
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource' || Auth::user()->user_level == 'Client'){
            session()->put('invoice_id',$id);
             $messages = MessageClient::where('identifier',$id)->get()->all();
                foreach($messages as $key => $val){
                //getting the client name and avatar
                $client = User::where(['id'=>$val->client_id])->first();
                $messages[$key]->client = $client->name;
                $messages[$key]->contact_person = $client->contact_person;
                $messages[$key]->email = $client->email;
                $messages[$key]->contact_no = $client->contact_number;
                $messages[$key]->rateperhour = $client->rateperhour;
                //getting the number of recipient
                $contact = Contact::where(['id'=>$val->contact_id])->first();
                $messages[$key]->number = $contact->contact_no;
                //getting the message itself
                $message = Message::where(['id'=>$val->message_id])->first();
                $messages[$key]->message = $message->message;
                //getting the of staff who send the message
                $staff = User::where(['id'=>$val->user_id])->first();
                $messages[$key]->staff = $staff->name;
            }

            return view('admin/clients/invoice',['messages'=>$messages]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }    

    }

    public function invoices(Request $request){ //this function is for retrieving all the invoices of all the clients
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource' || Auth::user()->user_level == 'Client'){
            if(Auth::user()->user_level == 'Client'){
                $client_id = Auth::user()->id;
                $invoices = MessageClient::where('client_id',$client_id)->orderBy('created_at','desc')->get()->unique('identifier');
            }else{
                $invoices = MessageClient::orderBy('created_at','desc')->get()->unique('identifier');
            }

                foreach($invoices as $key => $val){
                    $client_name = User::where(['id'=>$val->client_id])->first();
                    $invoices[$key]->client_name = $client_name->name;
                }
            return view('admin.clients.invoices',['clients'=>$invoices]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }    
    }
    
    public function destroy($id = null)
    {
        //
         
         $findClient = User::find($id);
         $messages = MessageClient::where('client_id', $id)->get()->all();
         foreach($messages as $objects){
            MessageClient::where('id', $objects->id)->delete();
            Message::where('id', $objects->message_id)->delete();
         }
         $findClient_contacts = Contact::where('client_id',$id)->get()->all();
         foreach($findClient_contacts as $object){
            Contact::where('id',$object->id)->delete();
         }

         $log = 'Client ' . $findClient->name . ' has successfully deleted by '. session()->get('name');
            $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

         if($findClient->delete()){
            return back()->with('flash_message_success','Client deleted successfully');
         }
       
    }

    public function massremove(Request $request){
        $client_id_array=$request->input('id');
        $client = User::whereIn('id',$client_id_array);
        $child = Contact::whereIn('client_id',$client_id_array);
        if($child->delete()){
            $client->delete();
            echo 'Client Deleted';
        }else{
            echo 'Client cannot be deleted';
        }
    }

}
