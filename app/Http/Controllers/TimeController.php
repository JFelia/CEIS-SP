<?php

namespace App\Http\Controllers;

use App\Timedoctor;
use App\User;
use App\Log;
use App\Sched;
use App\Leave;
use App\LeaveRequest;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeController extends Controller
{
    
    public function index(){
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $td = Timedoctor::orderBy('date','desc')->get()->unique('identifier');

            foreach($td as $key => $val){
                    $name = User::where(['id'=>$val->user_id])->get()->first();
                    $td[$key]->name = $name->name;
                    $td[$key]->in = $name->sched_start;
                    $td[$key]->out = $name->sched_end;
                    $td[$key]->user_level = $name->user_level;
                }
            return view('admin.timedoctor')->with(compact('td'));
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    public function dtr(Request $request){
        if(Auth::user()->user_level != 'Client'){
            $data = session()->get('user_id');
            $check = Timedoctor::where('user_id',$data)->where('date',date('Y-m-d ',strtotime(NOW())))->count();
            $checkifleave = Timedoctor::where('user_id',$data)->where('date',date('Y-m-d ',strtotime(NOW())))->where('remarks','Leave')->count();
            $td = Timedoctor::where('user_id',$data)->orderBy('date','desc')->get();
                foreach($td as $key => $val){
                        $name = User::where(['id'=>$val->user_id])->get()->first();
                        $td[$key]->name = $name->name;
                    }
            $leaves = Leave::all();
            $leave_requests = LeaveRequest::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get()->all();
            
                return view('admin.dtr2',['check'=>$check,'checkifleave'=>$checkifleave,'leaves'=>$leaves,'leave_requests'=>$leave_requests])->with(compact('td'));
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    public function view_dtr(Request $request, $id = null){
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            session()->put('dtr_id',$id);
            $data = Timedoctor::where('id',$id)->get()->first();
            $user = User::where('id',$data->user_id)->get();
            $day = date('d',strtotime($data->date));
            foreach($user as $obj){
                $sched = Sched::where('id', $obj->sched_cat)->get()->first();
            }
            
            if($day <= 15){
                $dtr = Timedoctor::where(['user_id' => $data->user_id, 'month_year' => $data->month_year])->where('day','<=',15)->orderBy('date','asc')->get()->all();
                    foreach($dtr as $key => $val){
                            $name = User::where(['id'=>$val->user_id])->get()->first();
                            $dtr[$key]->name = $name->name;
                            $dtr[$key]->in = $name->sched_start;
                            $dtr[$key]->out = $name->sched_end;
                        }
            }else{
                $dtr = Timedoctor::where(['user_id' => $data->user_id, 'month_year' => $data->month_year])->where('day','>=',16)->orderBy('date','asc')->get()->all();
                    foreach($dtr as $key => $val){
                            $name = User::where(['id'=>$val->user_id])->get()->first();
                            $dtr[$key]->name = $name->name;
                            $dtr[$key]->in = $name->sched_start;
                            $dtr[$key]->out = $name->sched_end;
                        }
            }
            
                return view('admin.view_dtr')->with(compact('dtr','user','sched'));
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    public function time(Request $request, $id = null){
        if(Auth::user()->user_level != 'Client'){
            $time;
            //getting the value of $id
            if($id == 1){
                $time = 'am_time_in';
            }elseif($id == 2){
                $time = 'am_time_out';
            }elseif($id == 3){
                $time = 'pm_time_in';
            }else{
                $time = 'pm_time_out';
            }

            //getting the user_id
            $data = session()->get('user_id');
            //check if there's an exist dtr within this day with user_id = $data and count it
            $check = Timedoctor::where('user_id',$data)->where('date',date('Y-m-d ',strtotime(NOW())))->count();
            //if 0 then create data
            if($check == 0){
                Timedoctor::create([
                        'user_id' => $data,
                        $time => NOW(),
                        'date' => NOW(),
                        'month_year' => date('Y-m',strtotime(NOW())),
                        'remarks' => 'Present'
                    ]);
            }else{ //if not then just update data
                if(session()->get('priviledge') == 'DayOff'){
                    Timedoctor::where('user_id',$data)->where('date',date('Y-m-d ',strtotime(NOW())))->update([
                        $time => NOW()
                    ]);    
                }else{
                    Timedoctor::where('user_id',$data)->where('date',date('Y-m-d ',strtotime(NOW())))->update([
                        $time => NOW(),
                        'remarks' => 'Present'
                    ]);    
                }
                
            }

            $log = session()->get('name') .' '.$time . ' - ' . date("h:i:sa",strtotime(NOW()));
            $user_id = session()->get('user_id');
            Log::create([
                'user_id' => $user_id,
                'log' => $log
            ]);       

            //retrieving your timedoctor records
            $td = Timedoctor::where('user_id',$data)->orderBy('date','desc')->get()->all();
            // return view('admin.dtr2',['td'=>$td,'check'=>$check]);
            return redirect('/dtr')->with(compact('td','check'));
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    

}
