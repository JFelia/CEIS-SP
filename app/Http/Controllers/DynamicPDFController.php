<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\User;
use App\Timedoctor;
use App\MessageClient;
use App\Contact;
use App\Message;
use App\Sched;


class DynamicPDFController extends Controller
{
	
    function dtr(){
        $id = session()->get('dtr_id');
    	
        $data = Timedoctor::where('id',$id)->get()->first();
        $user = User::where('id', $data->user_id)->get()->first();
        $day = date('d',strtotime($data->date));
        $sched = Sched::where('id', $user->sched_cat)->get()->first();
        if($day <= 15){
            $dtr = Timedoctor::where(['user_id' => $data->user_id, 'month_year' => $data->month_year])->where('day','<=',15)->orderBy('date','asc')->get()->all();
                foreach($dtr as $key => $val){
                        $name = User::where(['id'=>$val->user_id])->get()->first();
                        $dtr[$key]->name = $name->name;
                        $dtr[$key]->in = $name->sched_start;
                        $dtr[$key]->out = $name->sched_end;
                        $dtr[$key]->user_level = $name->user_level;
                    }
        }else{
            $dtr = Timedoctor::where(['user_id' => $data->user_id, 'month_year' => $data->month_year])->where('day','>=',16)->orderBy('date','asc')->get()->all();
                foreach($dtr as $key => $val){
                        $name = User::where(['id'=>$val->user_id])->get()->first();
                        $dtr[$key]->name = $name->name;
                        $dtr[$key]->in = $name->sched_start;
                        $dtr[$key]->out = $name->sched_end;
                        $dtr[$key]->user_level = $name->user_level;
                    }
        }

        $pdf = PDF::loadView('admin.pdf.dtrPDF',['dtr'=>$dtr,'sched'=>$sched]);
        return $pdf->download($user->name.'.pdf');
    }

    function invoice(){

        $id = session()->get('invoice_id');
        $client = User::where('id', $id)->get()->first();
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
        $pdf = PDF::loadView('admin.pdf.invoicePDF',['messages'=>$messages]);
        return $pdf->download($client->name.'.pdf');   
    }

}
