<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Contact;
use App\Message;
use App\MessageClient;
use App\Reply;
use App\Post;
use App\Log;
use App\Comment;
use App\Timedoctor;
use App\Holiday;
use App\LeaveRequest;
use App\Getintouch;
use App\Role;
use App\Leave;
use App\Sched;
use Image;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Rules\NoSpace;

class AdminController extends Controller
{
    public function login(Request $request){
        $checkadmin = User::where('user_level', 'Admin')->get()->count();
        if($checkadmin == null){
            return redirect('/register');
        }elseif(session()->get('user_id')){
            return redirect('/admin/dashboard');
        }else{

            if($request->isMethod('post')){
                $data = $request->input();
                
                if(Auth::attempt(['username'=>$data['email'],'password'=>$data['password']])){
                    $request->session()->put('adminSession',$data['email']); 

                    $information = User::where('username', $data['email'])->get()->first();//get the info of user
                    $id = $information->id;
                    //this is for updating status into 0 if detected 1;
                    if($information->status == 1 || $information->status == 2 || $information->status == 3){
                        User::where('id',$id)->update([ //update status to 1, means currently logged in
                                    'status'=> 0
                                    ]);
                    }
                    //end

                    $info1 = User::where('username', $data['email'])->get()->first();//get the info of updated user

                    if($info1->user_level == 'Client'){
                        if($info1->type == 'win'){
                            if($info1->status == 0){
                                User::where('id',$id)->update([ //update status to 1, means currently logged in
                                'status'=> 1
                                ]);

                                $info = User::where('username', $data['email'])->get()->first();//get the info of updated user

                                session()->put('user_level',$info->user_level);//create a session to identify the user level
                                session()->put('user_id',$info->id);//create a session to identify the user id
                                session()->put('name',$info->name);//create a session to identify the user name
                                session()->put('address',$info->address);//create a session to identify the user address
                                session()->put('city',$info->city);//create a session to identify the user city
                                session()->put('state',$info->state);//create a session to identify the user state
                                session()->put('country',$info->country);//create a session to identify the user country
                                session()->put('status',$info->status);//create a session to identify the user status
                                session()->put('username',$info->username);//create a session to identify the user status
                                session()->put('educ',$info->educ);//create a session to identify the user status
                                session()->put('avatar',$info->avatar);//create a session to identify the user status
                                session()->put('sched_start',$info->sched_start);//create a session to identify the user status
                                session()->put('sched_end',$info->sched_end);//create a session to identify the user status

                                

                                //create log
                                $log = session()->get('name') . ' has logged in';
                                $user_id = session()->get('user_id');
                                Log::create([
                                    'user_id' => $user_id,
                                    'log' => $log
                                ]);         

                                if($info->resetquestion == null && $info->resetanswer == null){
                                    return redirect("/admin/security");
                                }else{
                                    return redirect("/admin/dashboard");    
                                }
                            }else{
                                return redirect('/admin')->with('flash_message_error','Your account status is IN, ask the Admin or Developer to fix the problem');
                            }
                        }else{
                             return redirect('/admin')->with('flash_message_error','Your account is already disabled');
                        }
                    }else{
                        if($info1->status == 0 || $info1->status == 2 || $info1->status == 3){ //check if the user is not yet login or on break or on snack
                            if($info1->remarks == 'Employed'){
                                User::where('id',$id)->update([ //update status to 1, means currently logged in
                                    'status'=> 1
                                ]);

                                $info = User::where('username', $data['email'])->get()->first();//get the info of updated user
                                $sched = Sched::where('id', $info->sched_cat)->get()->first();
                                if($sched){
                                    if($sched->type == "Normal"){
                                        $today = date('l',strtotime(NOW()));
                                        if($sched->$today == 1){
                                            session()->put('priviledge','Allowed');
                                        }else{
                                            session()->put('priviledge','NoWork');
                                        }
                                    }else{//if special schedule
                                        if($info->Four_D != $sched->working_days && $info->Four_D_status == 'In'){
                                            session()->put('priviledge','Allowed');
                                        }elseif($info->Four_D != $sched->day_off && $info->Four_D_status == 'Out'){
                                            session()->put('priviledge','DayOff');
                                        }
                                    }
                                }

                                session()->put('user_level',$info->user_level);//create a session to identify the user level
                                session()->put('user_id',$info->id);//create a session to identify the user id
                                session()->put('name',$info->name);//create a session to identify the user name
                                session()->put('address',$info->address);//create a session to identify the user address
                                session()->put('city',$info->city);//create a session to identify the user city
                                session()->put('state',$info->state);//create a session to identify the user state
                                session()->put('country',$info->country);//create a session to identify the user country
                                session()->put('status',$info->status);//create a session to identify the user status
                                session()->put('username',$info->username);//create a session to identify the user status
                                session()->put('educ',$info->educ);//create a session to identify the user status
                                session()->put('avatar',$info->avatar);//create a session to identify the user status
                                session()->put('sched_start',$info->sched_start);//create a session to identify the user status
                                session()->put('sched_end',$info->sched_end);//create a session to identify the user status
                                // session()->put('cat_type',$sched->type);//create a session to identify the user status

                                //create log
                                $log = session()->get('name') . ' has logged in';
                                $user_id = session()->get('user_id');
                                Log::create([
                                    'user_id' => $user_id,
                                    'log' => $log
                                ]);         

                                if($info->resetquestion == null && $info->resetanswer == null){
                                    return redirect("/admin/security");
                                }else{
                                    return redirect("/admin/dashboard");    
                                }
                            }else{
                                return redirect('/admin')->with('flash_message_error','Sorry! You are no longer employee of Greymouse');
                            }
                        }else{
                            return redirect('/admin')->with('flash_message_error','Your account status is IN, ask the Admin or Developer to fix the problem');
                        }
                    }
                    
                }else{
                    return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
                }
            }
            
                //now check if there are registered 'admin'
                $newcheck = User::where('user_level', 'Admin')->count();
                // and return the count to login page
                return view('admin.admin_login',['admin'=>$newcheck]);
                // return view('admin.admin_login');
        }        
    }

    public function adminRegister(Request $request){
        $checkadmin = User::where('user_level', 'Admin')->get()->count();
        if($checkadmin > 0){
            return redirect('/admin');
        }else{

            if($request->isMethod('post')){
                $check = User::where('user_level', 'admin')->count();
                $date = NOW();
                    if($check == 0){
                        $pass = $request->input('password');
                        $cpass = $request->input('cpassword');
                        $bday = $request->input('birthday');

                    $validator=Validator::make($request->all(),[

                                'name' => 'required',
                                'username' => 'required',
                                'birthday' => 'required',
                                'email' => 'required',
                                'password' => 'required',
                                'cpassword' => 'required',
                                'address' => 'required',
                                'city' => 'required',
                                'state' => 'required',
                                'country' => 'required',
                                'zip' => 'required'
                                
                            ]);
                    if($validator->fails()){
                        \Session::flash('flash_message_error','Please enter the required details');
                        return Redirect::to('/register')->withInput()->withErrors($validator);
                    }    
                        
                        if($pass == $cpass){
                        
                            
                            User::create([
                                    'name' => $request->input('name'),
                                    'extension1' => $request->input('ext1'),
                                    'extension2' => $request->input('ext2'),
                                    'extension3' => $request->input('ext3'),
                                    'username' => $request->input('username'),
                                    'password' => $request->input('password'),
                                    'birthday' => date('m-d',strtotime($bday)),
                                    'bday_year' => date('Y',strtotime($bday)),
                                    'anniversary' => date('m-d',strtotime($date)),
                                    'anniv_year' => date('Y',strtotime($date)),
                                    'email' => $request->input('email'),
                                    'telephone' => $request->input('telephone'),
                                    'skype' => $request->input('skype'),
                                    'address' => $request->input('address'),
                                    'state' => $request->input('state'),
                                    'city' => $request->input('city'),
                                    'zip' => $request->input('zip'),
                                    'country' => $request->input('country'),
                                    'user_level' => $request->input('user_level'),
                                    'educ' => $request->input('educ'),
                                    'status' => 0
                                    
                                ]);


                                Role::create([
                                    'role_name' => 'Human Resource'
                                ]);

                                // Role::create([
                                //     'role_name' => 'Virtual Assistant'
                                // ]);

                                $name = $request->input('name');
                                $log = $name . ' has successfully registered as admin';
                                $user_id = session()->get('user_id');
                                    Log::create([
                                        'log' => $log
                                    ]);  

                                    return redirect('/admin')->withInput()->with('flash_message_success','Admin Successfully Registered, You can now   login');
                                
                            }else{
                                return redirect('/register')->withInput()->with('flash_message_error','Password and Confirm Password should match');
                            }
                    }else{
                            return back()->withInput()->with('flash_message_error','Admin is already exist! This system is only allowing one admin to be registered.');
                    }   
            }else{
                return view('admin.admin_register');    
            }
        }
    }

    public function security(Request $request){
        if($request->isMethod('post')){
            $question = $request->input('resetquestion');
            $answer = $request->input('resetanswer');

            $validator=Validator::make($request->all(),[

                    'resetquestion' => 'required',
                    'resetanswer' => 'required'
                ]);

            if($validator->fails()){
                \Session::flash('flash_message_error','Please enter the required details');
                return Redirect::to('/admin/security')->withInput()->withErrors($validator);
            }

                $userid = Auth::user()->id;
                User::where('id',$userid)->update([
                    'resetquestion'=>$question,
                    'resetanswer'=>$answer,
                 ]);

                $name = Auth::user()->name;
                $log =  $name . ' has successfully secured his/her profile';
                $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]); 

                return redirect('/admin/dashboard')->with('flash_message_success','Your account is secured now');

        }
           return view('admin.security');
    }

    public function requestreset(Request $request){
        if($request->isMethod('post')){
            $email = $request->input('email');

            $validator=Validator::make($request->all(),[
                    'email' => 'required'
                ]);

            if($validator->fails()){
                \Session::flash('flash_message_error','Please enter the required details');
                return Redirect::to('/requestreset')->withInput()->withErrors($validator);
            }

                $user = User::where('email',$email)->get()->all();
                if($user){
                    foreach($user as $obj){
                        session()->put('resetemail',$obj->email);
                        session()->put('resetquestion',$obj->resetquestion);
                    }
                    return redirect('/resetpassword')->with('flash_message_success','Answer your security question correctly to proceed with the last step');
                }else{
                    return back()->with('flash_message_error','Email does not exist');
                }

        }
           return view('admin.requestreset');
    }

    public function resetpassword(Request $request){
        if($request->isMethod('post')){
            $answer = $request->input('answer');

            $validator=Validator::make($request->all(),[
                    'answer' => 'required'
                ]);

            if($validator->fails()){
                \Session::flash('flash_message_error','Please enter the required details');
                return Redirect::to('/resetpassword')->withInput()->withErrors($validator);
            }
                $email=session()->get('resetemail');
                $user = User::where(['email'=>$email,'resetanswer'=>$answer])->get()->all();
                if($user){
                    return redirect('/resetpassword2')->with('flash_message_success','You can now reset your password');
                }else{
                    return back()->with('flash_message_error','Your answer is incorrect, Please try another answer');
                }

        }
           return view('admin.resetpassword');
    }

    public function resetpassword2(Request $request){
        if($request->isMethod('post')){
            $newpass = $request->input('newpassword');
            $confirm = $request->input('confirmpassword');

            $validator=Validator::make($request->all(),[
                    'newpassword' => 'required',
                    'confirmpassword' => 'required'
                ]);

            if($validator->fails()){
                \Session::flash('flash_message_error','Please enter the required details');
                return Redirect::to('/resetpassword2')->withInput()->withErrors($validator);
            }
                if($newpass == $confirm){
                    
                    $email = session()->get('resetemail');
                    $data = $request->all();
                    $check_password = User::where(['email'=>$email])->first();
                    
                        $password = bcrypt($newpass);
                        User::where('id',$check_password->id)->update(['password'=>$password]);

                        //create log
                        $log = session()->get('resetemail') . ' change his/her password';
                        $user_id = $check_password->id;
                            Log::create([
                                'user_id' => $user_id,
                                'log' => $log
                            ]);

                        return redirect('/admin')->with('flash_message_success','Password Reset Successfully');
                }else{
                    return back()->with('flash_message_error','New Password and Confirm Password is not Equal');
                }

            }
               return view('admin.resetpassword2');
    }


    public function dashboard(Request $request){
        $users = User::where('user_level','!=','super admin')->orderBy('created_at','desc')->get()->all();
        $userscount = User::where('user_level','!=','super admin')->where('user_level', '!=', 'Client')->count();
        $count = User::where(['user_level' => 'Client','type' => 'win'])->count();
        $sent = MessageClient::where('status','out')->count();
        $inbox = MessageClient::where('status','in')->count();
        $total = $sent + $inbox;
        $top_outbox = MessageClient::orderBy('created_at','desc')->get();
        foreach($top_outbox as $key => $val){
                $client_name = User::where(['id'=>$val->client_id])->first();
                $top_outbox[$key]->client_name = $client_name->name;
                $contact_no = Contact::where(['id'=>$val->contact_id])->first();
                $top_outbox[$key]->contact_no = $contact_no->contact_no;
                $sender = User::where(['id'=>$val->user_id])->first();
                $top_outbox[$key]->sender = $sender->username;
                $message = Message::where(['id'=>$val->message_id])->first();
                $top_outbox[$key]->message = $message->message;
            }
        
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        // $posts = Post::paginate(10); 
        foreach($posts as $key => $val){
                $poser = User::where(['id'=>$val->user_id])->first();
                $posts[$key]->poser = $poser->name;
                $posts[$key]->poserAvatar = $poser->avatar;
                $posts[$key]->poserLevel = $poser->user_level;
                $posts[$key]->poserID = $poser->id;
                $created_at = Post::where(['id'=>$val->id])->first();
                $posts[$key]->poserCreated_at = $created_at->created_at;
                $comments = Comment::where(['post_id'=>$val->id])->count();
                $posts[$key]->comments_count = $comments;
            }

        //for newsfeeds of client, to be notified if the requested message has been sent to the recipient
        $client_id = Auth::user()->id;
        $sents = MessageClient::where('client_id', $client_id)->where('type','2')->orderBy('created_at','desc')->get()->all();
        foreach($sents as $key => $val){
                $message = Message::where(['id'=>$val->message_id])->first();
                $sents[$key]->message = $message->message;
                $recipient = Contact::where(['id'=>$val->contact_id])->first();
                $sents[$key]->recipient = $recipient->contact_no;
            }

        //for getting the type of leaves
        $leaves = Leave::all();
        $leave_requests = LeaveRequest::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get()->all();

            return view('admin.dashboard',['clients'=>$count, 'sent_items'=>$sent, 'received'=>$inbox,'total'=>$total,'outbox'=>$top_outbox,'users'=>$users,'userscount'=>$userscount,'posts'=>$posts,'sents'=>$sents,'leaves'=>$leaves,'leave_requests'=>$leave_requests])->with(compact('outbox','posts'));
        // return view('admin.dashboard');
    }

    public function addstaffs(Request $request){
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $date = NOW();
            if($request->isMethod('post')){
                $pass = $request->input('password');
                $cpass = $request->input('cpassword');
                $email = $request->input('email');   
                $username = $request->input('username');   
                $bday = $request->input('birthday');
                $countrycode = $request->input('countrycode'); 
                $telephone = $request->input('telephone');
                $number = $countrycode.$telephone;
               

                if($pass == $cpass){
                $validator=Validator::make($request->all(),[

                        'name' => 'required',
                        'username' => ['required',new NoSpace],
                        'birthday' => 'required',
                        'email' => 'required|email',
                        'password' => ['required',new NoSpace],
                        'cpassword' => ['required',new NoSpace],
                        'telephone' => 'required',
                        'address' => 'required',
                        'city' => 'required',
                        'state' => 'required',
                        'country' => 'required',
                        'zip' => 'required',
                        'user_level' => 'required'
                    ]);

                if($validator->fails()){
                    // \Session::flash('flash_message_error','Please enter the required details');
                    return Redirect::to('/admin/addstaff')->withInput()->withErrors($validator);
                }

                $check = User::where('email',$email)->get()->first();
                $check2 = User::where('username',$username)->get()->first();
                    if($check){
                        \Session::flash('flash_message_error','Email is already exist! Please use another email');
                        return Redirect::to('/admin/addstaff');
                    }elseif($check2){
                        \Session::flash('flash_message_error','Username is already exist! Please use another username');
                        return Redirect::to('/admin/addstaff');
                    }else{
                    $user = User::create([
                            'name' => $request->input('name'),
                            'extension1' => $request->input('ext1'),
                            'extension2' => $request->input('ext2'),
                            'extension3' => $request->input('ext3'),
                            'username' => $request->input('username'),
                            'password' => $request->input('password'),
                            'birthday' => date('m-d',strtotime($bday)),
                            'bday_year' => date('Y',strtotime($bday)),
                            'anniversary' => date('m-d',strtotime($date)),
                            'anniv_year' => date('Y',strtotime($date)),
                            'email' => $request->input('email'),
                            'telephone' => $number,
                            'skype' => $request->input('skype'),
                            'address' => $request->input('address'),
                            'state' => $request->input('state'),
                            'city' => $request->input('city'),
                            'zip' => $request->input('zip'),
                            'country' => $request->input('country'),
                            'user_level' => $request->input('user_level'),
                            'educ' => $request->input('educ'),
                            'status' => 0
                        ]); 
                    $name = $request->input('name');
                    $log =  'Staff ' . $name . ' has successfully added by '. session()->get('name');
                    $user_id = session()->get('user_id');
                    Log::create([
                        'user_id' => $user_id,
                        'log' => $log
                    ]); 

                    return redirect('/admin/addstaff')->with('flash_message_success','Staff Successfully Added');
                    }
                }else{
                    return redirect('/admin/addstaff')->with('flash_message_error','Password and Re-type Password should be equal');
                }
            }else{
                // if(Auth::user()->user_level == 'Admin'){
                //     $roles = Role::where('role_name','Human Resource')->get()->all();
                // }else{
                    $roles = Role::all();    
                // }
                return view('admin.addstaff',['roles'=>$roles]);
            }
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    public function staffs(Request $request){
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $data = session()->get('user_level');
                $request = User::where('user_level','!=', 'Admin')->where('id','!=', Auth::user()->id)->where('user_level','!=', 'Client')->get()->all();
                return view('/admin/viewstaff',['data'=>$request]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }      
    }

    public function editStaff(Request $request, $id = null){
                
        if($request->isMethod('post')){
            // $data = $request->all();
            $validator=Validator::make($request->all(),[
                        'telephone' => 'required|max:12'
                    ]);

                if($validator->fails()){
                    \Session::flash('flash_message_error','Phone should not be more than 11 digits');
                    return Redirect::to('/admin/dashboard')->withInput()->withErrors($validator);
                }

            $name = $request->input('name');
            User::where('id',$id)->update([
                    'name'=>$request->input('name'),
                    'extension1'=>$request->input('ext1'),
                    'extension2'=>$request->input('ext2'),
                    'extension3'=>$request->input('ext3'),
                    'password'=>$request->input('password'),
                    'birthday'=>$request->input('birthday'),
                    'bday_year'=>$request->input('bday_year'),
                    'anniversary'=>$request->input('anniversary'),
                    'anniv_year'=>$request->input('anniv_year'),
                    'telephone'=>$request->input('telephone'),
                    'skype'=>$request->input('skype'),
                    'address'=>$request->input('address'),
                    'state'=>$request->input('state'),
                    'city'=>$request->input('city'),
                    'zip'=>$request->input('zip'),                  
                    'country'=>$request->input('country'),
                    'user_level'=>$request->input('user_level'),
                    'educ'=>$request->input('educ')
                ]);

            // $user = Auth::user();

             $log = session()->get('name') . ' has updated informations of ' . $name;
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            if(Auth::user()->id == $id){
                return redirect('/profile')->with('flash_message_success','User Information updated successfully');
            }else{
                return redirect('/admin/staffs')->with('flash_message_success','User Information updated successfully');
            }
        }
        $staffDetails = User::where(['id'=>$id])->first();
        return view('admin.edit_staff')->with(compact('staffDetails'));
    }

    public function resignStaff(Request $request, $id = null){
        
        User::where('id',$id)->update([
                'remarks'=>'Resigned'
            ]);

         $log = session()->get('name') . ' has updated the remarks of the employee to resigned';
         $user_id = session()->get('user_id');
            Log::create([
                'user_id' => $user_id,
                'log' => $log
            ]);

        return redirect('/admin/staffs')->with('flash_message_success','User has been successfully resigned');
        
    }


    public function retireStaff(Request $request, $id = null){
        
        User::where('id',$id)->update([
                'remarks'=>'Retired'
            ]);

         $log = session()->get('name') . ' has updated the remarks of the employee to retired';
         $user_id = session()->get('user_id');
            Log::create([
                'user_id' => $user_id,
                'log' => $log
            ]);
     
        return redirect('/admin/staffs')->with('flash_message_success','User has been successfully retired');
        
    }

    public function activeUsers(Request $request){
            
                $request = User::where('user_level', '!=','super admin')->get()->all();
                return view('admin.viewactive',['data'=>$request]);    
           
              
    }

    public function update_avatar(Request $request){
        $user_id = session()->get('user_id');
        //Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = Input::file('avatar');
            
            $extension = $avatar->getClientOriginalExtension();
            list($width, $height) = getimagesize($avatar);

            $filename = '['.$user_id.']'.rand(111,99999). '.' . $extension;
            // $large_image_path = 'LTE/dist/img/default/' . $filename;
            $medium_image_path = 'LTE/dist/img/medium/' . $filename;
            $small_image_path = 'LTE/dist/img/small/' . $filename;

            //Resize image
            if($height > $width){
                // Image::make($avatar)->save($large_image_path);
                Image::make($avatar)->resize(300,400)->save($medium_image_path);

            }else{
                Image::make($avatar)->resize(400,300)->save($medium_image_path);
            }
                Image::make($avatar)->resize(128,128)->save($small_image_path);
                
            //Store
            
            $emailUpdate = User::where('id',$user_id)
            ->update([
                        'avatar' => $filename
                ]);

            $commentUpdate = Comment::where('user_id',$user_id)
            ->update([
                        'avatar' => $filename
                ]);
            //for saving to post so that the uploaded image will appear to the post's
            $message=Post::create([
                    'user_id' => $user_id,
                    'message' => $request->input('caption'),
                    'avatar' => $filename,
                    'remarks' => 'Updated Profile Picture'
                ]);

             $log = session()->get('name') . ' updated his/her profile picture';
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);
            return back()->with('flash_message_success','Successfully updated your profile picture');
        }else{
            return back()->with('flash_message_error','Please select an image to be uploaded by clicking "Choose File"');
        }
    }

    public function apply(Request $request){
        //storing the file inside the storage > public > upload folder
        $path = $request->file('resume')->store('upload');
        echo $path;
    }

    public function logs(){

        $logs = Log::orderBy('created_at','desc')->get()->all();

        return view('admin/logs',['logs'=>$logs]);
    }

    public function documentation(){

        return view('admin/documentation');
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){

            $validator=Validator::make($request->all(),[
                    'current_pwd' => 'required',
                    'new_pwd' => ['required',new NoSpace],
                    'confirm_pwd' => ['required',new NoSpace]
                ]);

            if($validator->fails()){
                \Session::flash('flash_message_error','Please enter the required details');
                return back()->withInput()->withErrors($validator);
            }

            $data = $request->all();
            $check_password = User::where(['id'=>Auth::user()->id])->first();
            $current_password = $data['current_pwd'];
            $new_pwd = $data['new_pwd'];
            $confirm_pwd = $data['confirm_pwd'];
            if($new_pwd == $confirm_pwd){
                if(Hash::check($current_password,$check_password->password)){
                    $password = bcrypt($data['new_pwd']);
                    User::where('id',$check_password->id)->update(['password'=>$password]);

                    //create log
                    $log = session()->get('name') . ' change his/her password';
                     $user_id = session()->get('user_id');
                        Log::create([
                            'user_id' => $user_id,
                            'log' => $log
                        ]);

                    return back()->with('flash_message_success','Password updated Successfully');
                }else{
                    return back()->with('flash_message_error','Incorrect Current Password');
                }
            }else{
                return back()->with('flash_message_error','New Password and Retype New Password should be the same');
            }
        }
    }

    public function sched(Request $request){
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $users = User::where('user_level','!=','Client')->where('remarks','Employed')->get()->all();
            $categories = Sched::all();
            
            return view('admin.sched',['users'=>$users,'categories'=>$categories]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    public function edit_Sched(Request $request){
            
            $count = $request->input('count');

            // echo $count;
            
            for($i=0; $i<$count-1; $i++){
                $id[$i] = $request->input('id_'.$i);
                $in[$i] = $request->input('in_'.$i);
                $out[$i] = $request->input('out_'.$i);
                $cat[$i] = $request->input('cat_'.$i);
                // $type[$i] = $request->input('type_'.$i);

                $schedule = Sched::where(['id'=>$cat[$i]])->get();

                foreach($schedule as $obj){
                    if($obj->type == 'Special'){ //special scheds

                        $check = User::where([ //validation for special scheds to avoid updating the four_d_status if the changes were just the same as of before
                            'id' => $id[$i],
                            'sched_start' => $in[$i],
                            'sched_end' => $out[$i], 
                            'sched_cat' => $cat[$i] 
                        ])->get()->first();

                        if($check){
                            //if true, then do nothing
                        }else{ //if false then do the following scripts
                            User::where('id',$id[$i])->update([ 
                            'sched_start'=>$in[$i],
                            'sched_end'=>$out[$i],
                            'sched_cat'=>$cat[$i],
                            'Four_D_status'=>'In'
                        ]);    
                        }
                        
                    }else{ //normal scheds
                        User::where('id',$id[$i])->update([
                            'sched_start'=>$in[$i],
                            'sched_end'=>$out[$i],
                            'sched_cat'=>$cat[$i]        
                        ]);    
                    }
                }
                

             $log = session()->get('name') . ' has updated the schedule of the employees with id = '.$id[$i];
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);
                }
            
                return back()->with('flash_message_success','Users Schedule updated successfully');
        
    }

    public function holiday(Request $request){

        

        if($request->isMethod('post')){
            
            $validator=Validator::make($request->all(),[
                'description' => 'required',
                'date' => 'required'
            ]);

            if($validator->fails()){
                \Session::flash('flash_message_error','Please enter the required details');
                return Redirect::to('/holiday')->withInput()->withErrors($validator);
            }

            Holiday::create([
                'description' => $request->input('description'),
                'date' => $request->input('date')
            ]);

            return back()->with('flash_message_success','Holiday Successfully Created');

        }else{

            $holiday = Holiday::all();
            return view('admin.holiday')->with(compact('holiday'));

        }

    }

    public function editHoliday(Request $request, $id = null){
        if($request->isMethod('post')){
            
            Holiday::where('id',$id)->update([
                    'description'=>$request->input('description'),
                    'date'=>$request->input('date')
                ]);

             $log = session()->get('name') . ' has updated informations of holiday';
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            
            return redirect('/holiday')->with('flash_message_success','Holiday Information updated successfully');
            
        }
        $holidayDetails = Holiday::where(['id'=>$id])->first();
        return view('admin.edit_holiday')->with(compact('holidayDetails'));
    }

    public function deleteHoliday(Request $request,$id = null){
        $findHoliday = Holiday::where('id',$id)->get()->first();

        $log = 'Holiday has been deleted by '.  session()->get('name');
            $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);
       if($findHoliday->delete()){
            
            //redirect
            return redirect('/holiday')->with('flash_message_success','Holiday deleted successfully');

       }
            return redirect('/holiday')->with('flash_message_error','HOliday could not be deleted');
    }

    public function bdayboard(Request $request){
        $users = User::where('user_level','!=','Client')->orderBy('birthday', 'asc')->get()->all();
        return view('admin.bdayboard')->with(compact('users'));
    }

    public function annivboard(Request $request){
        $users = User::where('user_level','!=','Client')->orderBy('anniversary', 'asc')->get()->all();
        return view('admin.annivboard')->with(compact('users'));
    }

    public function request_leave(Request $request){
        $user_id = session()->get('user_id');
        $typeofleave = $request->input('type');

         $validator=Validator::make($request->all(),[

                'type' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            if($validator->fails()){
                \Session::flash('flash_message_error','Please enter the required details');
                return Redirect::to('/dtr')->withInput()->withErrors($validator);
            }

            $start = date('Y-m-d',strtotime($request->input('start_date')));
            $end =  date('Y-m-d',strtotime($request->input('end_date')));
            $now =  date('Y-m-d',strtotime(NOW()));

            if($start >= date('Y-m-d',strtotime($now.' +2 day'))){
                if($start <= $end){
                    LeaveRequest::create([
                            'user_id' => $user_id,
                            'request' => $request->input('type'),
                            'start_date' => $request->input('start_date'),
                            'end_date' => $request->input('end_date'),
                            'remarks' => 0
                        ]);

                     $log = session()->get('name') . ' request '.$typeofleave.' Leave';
                     $user_id = session()->get('user_id');
                        Log::create([
                            'user_id' => $user_id,
                            'log' => $log
                        ]);
                
                    return back()->with('flash_message_success','Request Successfully Sent');  
                }else{
                    return back()->with('flash_message_error','Your request is invalid');  
                }
            }else{
                return back()->with('flash_message_error','Your request should be submitted 2 days before the target date');  
            }
            
    }

    public function requests(Request $request, $id = null){
        
            $data = LeaveRequest::where('id',$id)->get()->first();
            $user = User::where('id',$data->user_id)->get()->first();
            
            $start = date('Y-m-d',strtotime($data->start_date.' -1 day'));
            $end =  date('Y-m-d',strtotime($data->end_date.' +1 day'));
            $c = 1;

            for($a = $start; $a < $end; $a = date('Y-m-d',strtotime($start.' +'.$c.' day'))){
                $day = date('d',strtotime($start.' +'.$c.' day'));
                if($day < 16){
                    Timedoctor::create([
                            'user_id' => $data->user_id,
                            'sched_start' => $user->sched_start.':00:00',
                            'sched_end' => $user->sched_end.':00:00',
                            'date' => date('Y-m-d',strtotime($start.' +'.$c.' day')),
                            'month_year' => date('Y-m',strtotime($start.' +'.$c.' day')),
                            'remarks' => 'Leave',
                            'day' => date('d',strtotime($start.' +'.$c.' day')),
                            'identifier' => $data->user_id.' '.date('Y-m',strtotime($start.' +'.$c.' day')).' 1'
                                ]);
                    }else{
                    Timedoctor::create([
                            'user_id' => $data->user_id,
                            'sched_start' => $user->sched_start.':00:00',
                            'sched_end' => $user->sched_end.':00:00',
                            'date' => date('Y-m-d',strtotime($start.' +'.$c.' day')),
                            'month_year' => date('Y-m',strtotime($start.' +'.$c.' day')),
                            'remarks' => 'Leave',
                            'day' => date('d',strtotime($start.' +'.$c.' day')),
                            'identifier' => $data->user_id.' '.date('Y-m',strtotime($start.' +'.$c.' day')).' 2'
                                ]);
                    }   

                $c++;
            }

            LeaveRequest::where('id',$id)->update([
                    'remarks' => '1' // 1 means that the request was approved
                ]);

            return redirect('/list_request')->with('flash_message_success','Leave successfully approved');
    }

    public function requests_disapproved(Request $request, $id = null){
        
            
            LeaveRequest::where('id',$id)->update([
                    'remarks' => '2' // 1 means that the request was approved
                ]);

            return redirect('/list_request')->with('flash_message_success','Leave successfully disapproved');
    }

    public function list_request(Request $request){
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $LeaveDetails = LeaveRequest::where('remarks',0)->where('user_id','!=', Auth::user()->id)->get()->all();
            foreach($LeaveDetails as $key => $val){
                        $name = User::where(['id'=>$val->user_id])->get()->first();
                        $LeaveDetails[$key]->name = $name->name;
                    }
            return view('admin.leave_requests')->with(compact('LeaveDetails'));
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }      
    }

    public function getintouch(Request $request){
            $validator=Validator::make($request->all(),[
                    'fullname' => 'required',
                    'email' => 'required|email',
                    'message' => 'required'
                ]);

            if($validator->fails()){
                \Session::flash('flash_message_error','Please enter the required details');
                return Redirect::to('/greymouse')->withInput()->withErrors($validator);
            }

            Getintouch::create([
                    'fullname' => $request->input('fullname'),
                    'email' => $request->input('email'),
                    'message' => $request->input('message')
                ]);

                return back()->with('flash_message_success','Message was sent successfully');
    }

    public function viewgetintouch(Request $request){
        if(Auth::user()->user_level != 'Client'){
            $getintouches = Getintouch::orderBy('created_at','desc')->get()->all();
           
            return view('admin.getintouches')->with(compact('getintouches'));
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }    
    }

    public function user_roles(Request $request){
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $roles = Role::all();
            return view('admin.user_roles',['roles'=>$roles]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }    
    }

    public function create_roles(Request $request){

        $validator=Validator::make($request->all(),[
                'name' => 'required'
            ]);

        if($validator->fails()){
            // \Session::flash('flash_message_error','Please enter the required details');
            return Redirect::to('/user_roles')->withInput()->withErrors($validator);
        }

        $check = Role::where('role_name',$request->input('name'))->get()->first();
        if($check){
            return back()->with('flash_message_error','Role Name is already exist');
        }else{
            Role::create([
                'role_name' => $request->input('name')
            ]);

            $log = session()->get('name') . ' has created a '.$request->input('name').' role';
                 $user_id = session()->get('user_id');
                    Log::create([
                        'user_id' => $user_id,
                        'log' => $log
                    ]);
            return back()->with('flash_message_success','Role was added successfully');
        }
    }

    public function editRole(Request $request, $id = null){
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            if($request->isMethod('post')){
                $check = Role::where('role_name',$request->input('name'))->get()->first();
                if($check){
                    return back()->with('flash_message_error','Role Name is already exist');
                }else{
                Role::where('id',$id)->update([
                        'role_name'=>$request->input('name')
                    ]);

                // $user = Auth::user();

                 $log = session()->get('name') . ' has updated informations of a role';
                 $user_id = session()->get('user_id');
                    Log::create([
                        'user_id' => $user_id,
                        'log' => $log
                    ]);

                return redirect('/user_roles')->with('flash_message_success','Role Information updated successfully');
                }
            }
            $roleDetails = Role::where(['id'=>$id])->first();
            return view('admin.edit_role')->with(compact('roleDetails'));
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    public function editLeave(Request $request, $id = null){
        if($request->isMethod('post')){
            $check = Leave::where('name',$request->input('name'))->get()->first();
            if($check){
                return back()->with('flash_message_error','Name of Leave is already exist');
            }else{
            Leave::where('id',$id)->update([
                    'name'=>$request->input('name')
                ]);

            // $user = Auth::user();

             $log = session()->get('name') . ' has updated informations of a leave';
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            return redirect('/type_of_leave')->with('flash_message_success','Role Information updated successfully');
            }
        }
        $leaveDetails = Leave::where(['id'=>$id])->first();
        return view('admin.edit_leave')->with(compact('leaveDetails'));
    }

    public function type_of_leave(Request $request){
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $leaves = Leave::all();
            return view('admin.typeofleave',['leaves'=>$leaves]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    public function create_type_of_leave(Request $request){

        $validator=Validator::make($request->all(),[
                'name' => 'required'
            ]);

        if($validator->fails()){
            // \Session::flash('flash_message_error','Please enter the required details');
            return Redirect::to('/type_of_leave')->withInput()->withErrors($validator);
        }
        $check = Leave::where('name',$request->input('name'))->get()->first();
        if($check){
            return back()->with('flash_message_error','Type of Leave is already exist');
        }else{
        Leave::create([
                'name' => $request->input('name')
            ]);

            return back()->with('flash_message_success','Type of Leave was added successfully');
        }
    }

    public function status(Request $request, $id = null){
        $data = session()->get('user_id');
        User::where('id',$data)->update([
                    'status' => $id
                ]);
        return back(); 
    }

    public function add_category(Request $request){
        $user_id = session()->get('user_id');
        $category_name = $request->input('category_name');
        $type = $request->input('type');
           $this->validate(request(),[

                 'category_name' => 'required',
                 'type' => 'required'
                
            ]);

            $check = Sched::where('category_name',$category_name)->get()->first();
            if($check){
                return back()->with('flash_message_error','Category Name is already exist');
            }elseif($type == '0'){
                return back()->with('flash_message_error','Please Select Category Type');
            }else{
           
            Sched::create([
                    'category_name' => $category_name,
                    'type' => $type
                ]);

            

             $log = session()->get('name') . ' added schedule category named '.$category_name;
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);
        
            return back()->with('flash_message_success','Schedule successfully created');  
            }
    }

    public function update_normal(Request $request, $id = null){
        if($request->isMethod('post')){

            $category = Sched::where('id',$id)->get()->first();

            $array = $_POST['days'];

            foreach($array as $value){
                Sched::where('id',$category->id)->update([
                    $value => '1'
                ]);
            }
                Sched::where('id',$category->id)->update([
                    'status' => '1'
                ]);


             $log = session()->get('name') . ' has updated informations of schedule';
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            
            return redirect('/sched')->with('flash_message_success','Schedule Information updated successfully');
            
        }
        $schedDetails = Sched::where(['id'=>$id])->first();
        return view('admin.edit_normal')->with(compact('schedDetails'));
    }

    public function update_special(Request $request, $id = null){
        if($request->isMethod('post')){
            $category = Sched::where('id',$id)->get()->first();

            
            Sched::where('id',$category->id)->update([
                'working_days' => $request->input('in'),
                'day_off' => $request->input('out')
            ]);
            
            Sched::where('id',$category->id)->update([
                    'status' => '1'
                ]);

             $log = session()->get('name') . ' has updated informations of schedule';
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            return redirect('/sched')->with('flash_message_success','Schedule Information updated successfully');
            
        }
        $schedDetails = Sched::where(['id'=>$id])->first();
        return view('admin.edit_special')->with(compact('schedDetails'));
    }



    public function logout(){
        $data = session()->get('user_id');
        User::where('id',$data)->update([ //update status to 1, means currently logged in
                    'status'=> 0
                ]);

         $log = session()->get('name') . ' has logged out';
         $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

        Session::flush();
        return redirect('/admin')->with('flash_message_success','Logged out Successfully');
    }

    public function destroy(Request $request){
        $findUser = User::find($request->id);

         $log = 'Staff ' . $findUser->name .' has been deleted by '.  session()->get('name');
         $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

       if($findUser->delete()){
            //redirect
            return redirect('/admin/staffs')->with('flash_message_success','Staff deleted successfully');
       }else{
            return back()->withInput()->with('flash_message_error','Staff could not be deleted for security purposes');
       }
       
    }
}
