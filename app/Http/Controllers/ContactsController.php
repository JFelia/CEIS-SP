<?php

namespace App\Http\Controllers;

use App\Contact;
use App\User;
use App\Log;
use App\MessageClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ContactsController extends Controller
{
   
    public function store(Request $request)
    {
        //
        //start of preparation to redirect again to the parent client
        $client_id = $request->input('client_id');
        $name = $request->input('name');

        if(Auth::check()){
            $number = $request->input('contact');
            $check = Contact::where('contact_no', $number)->get()->count(); //check if contact number is exist
            
            $parent = $request->input('client_id');
            $get = User::where('id',$parent)->get()->first();
            if($check < 1){

            $contact=Contact::create([
                    'name'=> $request->input('name'),
                    'contact_no'=> $request->input('contact'),
                    'client_id'=> $request->input('client_id'),
                    'client_code'=>$request->input('client_code')
                ]);

            if($contact){

                $log = 'Contact '. $name . ' has successfully added to '. $get->name .' by '. session()->get('name');
                $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

                return redirect('/clients/client-profile/'.$client_id)->with('flash_message_success','Successfully added new contact');
                }
            }else{
                return redirect('/clients/client-profile/'.$client_id)->with('flash_message_error','Contact number is already exist');
            }
        }

        return back()->withInput()->with('flash_message_error','Error creating new contact');
    }

    public function edit(Request $request, $id = null){
        $contacts = Contact::find($id);
        return view('admin.contacts.edit',['contacts' => $contacts]);
    }

   
    public function update(Request $request, Contact $contact)
    {

        $client_id = $request->input('client_id');
        $get = User::where('id',$client_id)->get()->first();
        $name = $request->input('name');
        $contactUpdate = Contact::where('id',$contact->id)
        ->update([
                    'name'=> $request->input('name'),
                    'contact_no'=> $request->input('contact')
            ]);

        if($contactUpdate){

            $log = 'Contact '. $name .' of '. $get->name .' has successfully updated by '. session()->get('name');
            $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            return redirect('/clients/client-profile/'.$client_id)->with('flash_message_success','Successfully updated the contact');
        }
        //redirect
        return back()->withInput()->with('flash_message_error','Contact could not be updated');
    }

   
    public function destroy(Request $request)
    {
        $findContact = Contact::find($request->id);
        $get = User::where('id',$findContact->client_id)->get()->first();
        $checkchild = MessageClient::where('contact_id',$request->id)->count();

        $log = 'Contact '. $findContact->name .' of '. $get->name .' has successfully deleted by '. session()->get('name');
        $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

        if($checkchild > 0){
            return back()->with('flash_message_error','Contact can\'t deleted for security purposes');
        }else{
            $findContact->delete();
            return back()->with('flash_message_success','Contact successfully deleted');
        }
       
    }
}
