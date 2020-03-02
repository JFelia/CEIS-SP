<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="{{{asset('LTE/dist/img/gm.png')}}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- <meta http-equiv="refresh" content="30"/> -->
  
  <title>GreymousePortal | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('LTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('LTE/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('LTE/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('LTE/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/dist/css/skins/_all-skins.min.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('LTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('LTE/dist/emoji/emojionearea.css')}}">
  
  <link rel="stylesheet" href="{{asset('LTE/angular.min.js')}}">
  
  <style type="text/css">
    
    .in{
      color:green;
    }
    .out{
     color:red; 
    }
    .user-thumb {
      background: none repeat scroll 0 0 #FFFFFF;
      float: left;
      height: 40px;
      margin-right: 10px;
      padding: 2px;
      width: 40px;
      margin-left:0;
    }
    .recent-posts li, .recent-comments li, .article-post li, .recent-users li {
      list-style: none outside none;
      padding: 10px;
    }
    




    .main-header{
      position: fixed;
      width: 100%;
    }
    .main-sidebar{
      position: fixed;
    }

    .side-b{
      font-size: 12px;
    }

    .sidebar-menu{
      line-height: 15px;
      font-size: 15px;
    }

    #buttons{
      float:left;
      margin-right: 10px;
    }

   
    .main-footer{
        position: relative;
        bottom: 0px;
        height: 40px;
        width: 100%;
    }
    #myBtn {
      display: none; /* Hidden by default */
      position: fixed; /* Fixed/sticky position */
      bottom: 40px; /* Place the button at the bottom of the page */
      right: 30px; /* Place the button 30px from the right */
      z-index: 99; /* Make sure it does not overlap */
      border: none; /* Remove borders */
      outline: none; /* Remove outline */
      background-color: #00ccff; /* Set a background color */
      color: white; /* Text color */
      cursor: pointer; /* Add a mouse pointer on hover */
      padding: 15px; /* Some padding */
      border-radius: 10px; /* Rounded corners */
      font-size: 18px; /* Increase font size */
    }

    #myBtn:hover {
      background-color: #555; /* Add a dark-grey background on hover */
    }
    
   

  </style>

  <script src="{{asset('LTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
  
  
</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    <?php 
      use App\Log;
      use App\Reply;
      use App\Email;
      use App\User;
      use App\Contact;
      use App\Message;
      use App\MessageClient;
      use App\Timedoctor;
      use App\Holiday;
      use App\LeaveRequest;
      use App\Page;
      use App\Getintouch;
      use App\Sched;

      

      $checkifhaspage = Page::count();

      if($checkifhaspage == 0){
        Page::create([
            'logo' => 'default_user.png'
          ]);
      }


      $user_id = session()->get('user_id');

      $logs = Log::orderBy('created_at','desc')->get()->all();
      // $replies = Reply::where('status','Mark as Read')->orWhere('user_id',$user_id)->count();

      $replies = Reply::where(function($query){
          $query->where('status', 'Mark as Read')
                ->where('user_id','!=',session()->get('user_id'))
                ->where('client_id', session()->get('user_id'));
      })->count();

      $clientreplies = Reply::where(function($query){
          $query->where('status', 'Mark as Read')->where('user_id','!=', session()->get('user_id'));
      })->count();


      $getintouch = Getintouch::all()->count();
      $emailscount = Email::where('status','unread')->count(); //emails count notication
      $requestscount = LeaveRequest::where('remarks','0')->where('user_id','!=', Auth::user()->id)->count(); //leave request count notication

      $bdayscount = User::where('birthday', date('m-d',strtotime(NOW())))->count(); //bdays count notification
      $celebrants = User::where('birthday', date('m-d',strtotime(NOW())))->get()->all();

      $annivcount = User::where('anniversary', date('m-d',strtotime(NOW())))->where('anniv_year', '!=' , date('Y',strtotime(NOW())))->count();
      $annivcelebrant = User::where('anniversary', date('m-d',strtotime(NOW())))->where('anniv_year', '!=' , date('Y',strtotime(NOW())))->get()->all();

      $emails = Email::where('status','unread')->get()->all();
      foreach($emails as $key => $val){
                $client = User::where(['id'=>$val->client_id])->first();
                $emails[$key]->client = $client->name;
                $emails[$key]->avatar = $client->avatar;
            }

      //getting the messages to be sent
      $sms = MessageClient::where('type','1')->get()->all();
      foreach($sms as $key => $val){
                $contact = Contact::where(['id'=>$val->contact_id])->first();
                $sms[$key]->num = $contact->contact_no;
                $message = Message::where(['id'=>$val->message_id])->first();
                $sms[$key]->mess = $message->message;
            }
      foreach($sms as $object){
        // Authorisation details.
        $username = "greymousesmsportal3@gmail.com";
        $hash = "f7fd040dd7933e36916d10d2d448c9a2d207f22e54347f1e3f41d6a0672240f8";

        // Config variables. Consult http://api.txtlocal.com/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "GMSMS"; // This is who the message appears to be from.
        $numbers = $object->num;// A single number or a comma-seperated list of numbers
        $message = $object->mess;
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
        $ch = curl_init('http://api.txtlocal.com/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);

          if($result){            
              MessageClient::where('id',$object->id)->update([
                        'type' => '2'
                    ]);
          }

        }

        $data = User::where('sched_start','!=',0)->get()->all();

        foreach($data as $objects){
          $today = date('l',strtotime(NOW()));
          $sched = Sched::where(['id' => $objects->sched_cat, $today => 1])->get()->first(); //normal scheds
          $special = Sched::where(['id' => $objects->sched_cat, 'type' => 'Special'])->get()->first(); //special scheds
          //check if data has already created
          if($sched){
            if($sched->type == 'Normal'){
              $check = Timedoctor::where(['user_id' => $objects->id, 'date' => date('Y-m-d ',strtotime(NOW()))])->get()->first();
              if($check){
                // if has data already then, do not do anything
              }else{
                if(date('d',strtotime(NOW())) < 16){
                  Timedoctor::create([
                    'sched_start' => $objects->sched_start.':00:00',
                    'sched_end' => $objects->sched_end.':00:00',
                    'user_id' => $objects->id,
                    'date' => NOW(),
                    'month_year' => date('Y-m',strtotime(NOW())),
                    'day' => date('d',strtotime(NOW())),
                    'remarks' => 'Absent',
                    'identifier' => $objects->id.' '.date('Y-m',strtotime(NOW())).' 1'
                  ]);
                }else{
                  Timedoctor::create([
                    'sched_start' => $objects->sched_start.':00:00',
                    'sched_end' => $objects->sched_end.':00:00',
                    'user_id' => $objects->id,
                    'date' => NOW(),
                    'month_year' => date('Y-m',strtotime(NOW())),
                    'day' => date('d',strtotime(NOW())),
                    'remarks' => 'Absent',
                    'identifier' => $objects->id.' '.date('Y-m',strtotime(NOW())).' 2'
                  ]);
                }
              }
            }
          }
          if($special){ //if special
              $daysin = $special->working_days;
              $daysout = $special->day_off;
              if($objects->Four_D != $daysin && $objects->Four_D_status == 'In'){
              //check if data has already created
              $check = Timedoctor::where(['user_id' => $objects->id, 'date' => date('Y-m-d ',strtotime(NOW()))])->get()->first();
              if($check){
                  // if has data already then, do not do anything
              }else{
                if(date('d',strtotime(NOW())) < 16){
                  Timedoctor::create([
                    'sched_start' => $objects->sched_start.':00:00',
                    'sched_end' => $objects->sched_end.':00:00',
                    'user_id' => $objects->id,
                    'date' => NOW(),
                    'month_year' => date('Y-m',strtotime(NOW())),
                    'day' => date('d',strtotime(NOW())),
                    'remarks' => 'Absent',
                    'identifier' => $objects->id.' '.date('Y-m',strtotime(NOW())) . ' 1'
                  ]);
                }else{
                  Timedoctor::create([
                    'sched_start' => $objects->sched_start.':00:00',
                    'sched_end' => $objects->sched_end.':00:00',
                    'user_id' => $objects->id,
                    'date' => NOW(),
                    'month_year' => date('Y-m',strtotime(NOW())), 
                    'day' => date('d',strtotime(NOW())),
                    'remarks' => 'Absent',
                    'identifier' => $objects->id.' '.date('Y-m',strtotime(NOW())) . ' 2'
                  ]);
                }
                $working_days = $special->working_days-1;
                if($objects->Four_D == $working_days){
                  User::where('id',$objects->id)->update([ //update status to 1, means currently logged in
                        'Four_D'=> 0,
                        'Four_D_status'=>'Out'
                    ]);  
                }else{
                  User::where('id',$objects->id)->update([ //update status to 1, means currently logged in
                        'Four_D'=> $objects->Four_D+1
                    ]);
                }
              }
            }elseif($objects->Four_D != $daysout && $objects->Four_D_status == 'Out'){ 
              //check if data has already created
              $check = Timedoctor::where(['user_id' => $objects->id, 'date' => date('Y-m-d ',strtotime(NOW()))])->get()->first();
              if($check){
                  // if has data already then, do not do anything
              }else{
                if(date('d',strtotime(NOW())) < 16){
                  Timedoctor::create([
                    'sched_start' => $objects->sched_start.':00:00',
                    'sched_end' => $objects->sched_end.':00:00',
                    'user_id' => $objects->id,
                    'date' => NOW(),
                    'month_year' => date('Y-m',strtotime(NOW())),
                    'day' => date('d',strtotime(NOW())),
                    'remarks' => 'Dayoff',
                    'identifier' => $objects->id.' '.date('Y-m',strtotime(NOW())).' 1'
                  ]);
                }else{
                  Timedoctor::create([
                    'sched_start' => $objects->sched_start.':00:00',
                    'sched_end' => $objects->sched_end.':00:00',
                    'user_id' => $objects->id,
                    'date' => NOW(),
                    'month_year' => date('Y-m',strtotime(NOW())),
                    'day' => date('d',strtotime(NOW())),
                    'remarks' => 'Dayoff',
                    'identifier' => $objects->id.' '.date('Y-m',strtotime(NOW())).' 2'
                  ]);
                }
                $off_days;
                $off_days = $special->day_off-1;

                if($objects->Four_D == $off_days){
                  User::where('id',$objects->id)->update([
                        'Four_D'=> 0,
                        'Four_D_status'=>'In'
                    ]);
                }else{
                  User::where('id',$objects->id)->update([
                        'Four_D'=> $objects->Four_D+1
                    ]);  
                }
              }
            }
          }
        
      }
    
     ?>
    @include('layouts.adminLayout.admin_header')
    @include('layouts.adminLayout.admin_sidebar')

    <div class="content-wrapper">
      <br><br><br>
        

        @if(Session::has('flash_message_error'))
            <div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong><i class="icon fa fa-ban"></i>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif
        @if(Session::has('flash_message_success'))
            <div class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    <strong><i class="icon fa fa-check"></i>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
    @yield('content')
    </div>
    @include('layouts.adminLayout.admin_modals')
    @include('layouts.adminLayout.admin_footer')

</div>

<!-- <script src="{{asset('LTE/sweetalert.min.js')}}"></script> -->



<script type="text/javascript">
    // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("myBtn").style.display = "block";
    } else {
      document.getElementById("myBtn").style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  }
</script>

<!-- <script type="text/javascript">
document.querySelector('.sweet-12').onclick = function(){
        var id = $(this).attr('rel');
        swal({
          title: "Attendance",
          // text: "You will not be able to recover this record!",
          type: "success",
          // showCancelButton: true,
          confirmButtonClass: 'btn-success',
          confirmButtonText: 'Okay!',
          closeOnConfirm: false
        },
        function(isConfirm){
          if (isConfirm){
            window.location.href="/time"+"/"+id;
            swal("Success!", "You have attendance successfully!", "success");
          } else {
            swal("Cancelled", "You have cancelled", "error");
          }
        });
      };
document.querySelector('.sweet-11').onclick = function(){
        var id = $(this).attr('rel');
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this record!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes!',
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm){
            window.location.href="/admin/"+"delete-client"+"/"+id;
            swal("Success!", "You have deleted the record successfully!", "success");
          } else {
            swal("Cancelled", "You have cancelled", "error");
          }
        });
      };      
</script> -->


<!-- for emoji-picker -->
<!-- <script src="{{asset('LTE/bower_components/jquery/dist/jquery.min.js')}}"></script> -->
<!-- <script src="{{asset('LTE/dist/emoji-picker/lib/js/config.js')}}"></script>
<script src="{{asset('LTE/dist/emoji-picker/lib/js/util.js')}}"></script>
<script src="{{asset('LTE/dist/emoji-picker/lib/js/jquery.emojiarea.js')}}"></script>
<script src="{{asset('LTE/dist/emoji-picker/lib/js/emoji-picker.js')}}"></script> -->

<script src="{{asset('LTE/dist/emoji/emojionearea.min.js')}}" ></script>

<!-- emoji will only work if you are connected to the internet -->
<script type="text/javascript">
  $('#myemoji').emojioneArea({
    pickerPosition: "right",
  });
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('LTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('LTE/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('LTE/dist/js/demo.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('LTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

<script src="{{asset('LTE/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('LTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('LTE/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('LTE/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

@include('layouts.adminLayout.admin_scripts')

</body>
</html>
