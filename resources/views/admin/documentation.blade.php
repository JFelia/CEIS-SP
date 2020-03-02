@extends('layouts.adminLayout.admin_design')
@section('content')

  <section class="content-header">
      <h1>Documentation <small>User Manual</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Documentation</li>
      </ol>
    </section>
    
  <section class="content">

  <div class="row">
         <div class="col-md-3">
           <div class="box box-primary">
            <div class="box-body" style="font-size: 12px">
              <h4>Table of Contents</h4>
              @if(session()->get('user_level') == 'super admin')
                <h5><b>For Admin</b></h5>
                  <p>1) View Profile </p>
                  <p>2) Upload Profile Picture</p>
                  <p>3) Update Personal Information</p>
                  <p>4) Change Password</p>
                  <p>5) Create Staff</p>
                  <p>6) View Staffs</p>
                  <p>7) View Staffs Profile</p>
                  <p>8) Create Client</p>
                  <p>9) View Clients</p>
                  <p>10) View Clients Profile</p>
                  <p>11) View Clients Contacts</p>
                  <p>12) Create Clients Contacts</p>
                  <p>13) Update Staffs Information</p>
                  <p>14) Update Clients Information</p>
                  <p>15) Update Clients Contacts Information</p>
                  <p>16) Delete Staffs Information</p>
                  <p>17) Delete Clients Information</p>
                  <p>18) Delete Clients Contacts Information</p>
                  <p>19) Compose SMS</p>
                  <p>20) Inbox</p>
                  <p>21) Sent Items</p>
                  <p>22) Forward SMS</p>
                  <p>23) View Emails</p>
                  <p>24) View Emails Conversation</p>
                  <p>25) Reply to Emails</p>
                  <p>26) View User Status</p>
                  <p>27) Post Something</p>
                  <p>28) View Post</p>
                  <p>29) Delete Post</p>
                  <p>30) Comment to a Post</p>
                <h5><b>For Staff</b></h5>
                  <p>1) View Profile </p>
                  <p>2) Upload Profile Picture</p>
                  <p>3) Update Personal Information</p>
                  <p>4) Change Password</p>
                  <p>5) Create Staff</p>
                  <p>6) View Staffs</p>
                  <p>7) View Staffs Profile</p>
                  <p>8) Create Client</p>
                  <p>9) View Clients</p>
                  <p>10) View Clients Profile</p>
                  <p>11) View Clients Contacts</p>
                  <p>12) Create Clients Contacts</p>
                  <p>13) Update Staffs Information</p>
                  <p>14) Update Clients Information</p>
                  <p>15) Update Clients Contacts Information</p>
                  <p>16) Compose SMS</p>
                  <p>17) Inbox</p>
                  <p>18) Sent Items</p>
                  <p>19) Forward SMS</p>
                  <p>20) View Emails</p>
                  <p>21) View Emails Conversation</p>
                  <p>22) Reply to Emails</p>
                  <p>23) View User Status</p>
                  <p>24) Post Something</p>
                  <p>25) View Post</p>
                  <p>26) Delete Post</p>
                  <p>26) Comment to a Post</p>
                <h5><b>For Client</b></h5>
                  <p>1) View Profile </p>
                  <p>2) Upload Profile Picture</p>
                  <p>3) Update Personal Information</p>
                  <p>4) Change Password</p>
                  <p>5) View Contacts</p>
                  <p>6) Create Contacts</p>
                  <p>7) Update Contacts Information</p>
                  <p>8) Delete Contacts Information</p>
                  <p>9) Compose Email</p>
                  <p>10) View Emails</p>
                  <p>11) View Email Conversation</p>
                  <p>12) Reply to Email</p>
                  <p>13) View Users Status</p>
                  <p>14) Post Something</p>
                  <p>15) View Post</p>
                  <p>16) Delete Post</p>
                  <p>17) Comment to a Post</p>
              @elseif(session()->get('user_level') == 'Admin')
                  <p>1) View Profile </p>
                  <p>2) Upload Profile Picture</p>
                  <p>3) Update Personal Information</p>
                  <p>4) Change Password</p>
                  <p>5) Create Staff</p>
                  <p>6) View Staffs</p>
                  <p>7) View Staffs Profile</p>
                  <p>8) Create Client</p>
                  <p>9) View Clients</p>
                  <p>10) View Clients Profile</p>
                  <p>11) View Clients Contacts</p>
                  <p>12) Create Clients Contacts</p>
                  <p>13) Update Staffs Information</p>
                  <p>14) Update Clients Information</p>
                  <p>15) Update Clients Contacts Information</p>
                  <p>16) Delete Staffs Information</p>
                  <p>17) Delete Clients Information</p>
                  <p>18) Delete Clients Contacts Information</p>
                  <p>19) Compose SMS</p>
                  <p>20) Inbox</p>
                  <p>21) Sent Items</p>
                  <p>22) Forward SMS</p>
                  <p>23) View Emails</p>
                  <p>24) View Emails Conversation</p>
                  <p>25) Reply to Emails</p>
                  <p>26) View User Status</p>
                  <p>27) Post Something</p>
                  <p>28) View Post</p>
                  <p>29) Delete Post</p>
                  <p>30) Comment to a Post</p>
              @elseif(session()->get('user_level') == 'Staff')
                  <p>1) View Profile </p>
                  <p>2) Upload Profile Picture</p>
                  <p>3) Update Personal Information</p>
                  <p>4) Change Password</p>
                  <p>5) Create Staff</p>
                  <p>6) View Staffs</p>
                  <p>7) View Staffs Profile</p>
                  <p>8) Create Client</p>
                  <p>9) View Clients</p>
                  <p>10) View Clients Profile</p>
                  <p>11) View Clients Contacts</p>
                  <p>12) Create Clients Contacts</p>
                  <p>13) Update Staffs Information</p>
                  <p>14) Update Clients Information</p>
                  <p>15) Update Clients Contacts Information</p>
                  <p>16) Compose SMS</p>
                  <p>17) Inbox</p>
                  <p>18) Sent Items</p>
                  <p>19) Forward SMS</p>
                  <p>20) View Emails</p>
                  <p>21) View Emails Conversation</p>
                  <p>22) Reply to Emails</p>
                  <p>23) View User Status</p>
                  <p>24) Post Something</p>
                  <p>25) View Post</p>
                  <p>26) Delete Post</p>
                  <p>26) Comment to a Post</p>
              @elseif(session()->get('user_level') == 'Client')
                  <p>1) View Profile </p>
                  <p>2) Upload Profile Picture</p>
                  <p>3) Update Personal Information</p>
                  <p>4) Change Password</p>
                  <p>5) View Contacts</p>
                  <p>6) Create Contacts</p>
                  <p>7) Update Contacts Information</p>
                  <p>8) Delete Contacts Information</p>
                  <p>9) Compose Email</p>
                  <p>10) View Emails</p>
                  <p>11) View Email Conversation</p>
                  <p>12) Reply to Email</p>
                  <p>13) View Users Status</p>
                  <p>14) Post Something</p>
                  <p>15) View Post</p>
                  <p>16) Delete Post</p>
                  <p>17) Comment to a Post</p>
              @endif
                
            </div>
           </div>
         </div>
         <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              @if(session()->get('user_level') == 'Admin')
              <li class="active"><a href="#admin" data-toggle="tab">Admin</a></li>
              @elseif(session()->get('user_level') == 'Staff')
              <li class="active"><a href="#staff" data-toggle="tab">Staff</a></li>
              @elseif(session()->get('user_level') == 'Client')
              <li class="active"><a href="#client" data-toggle="tab">Client</a></li>
              @else
              <li class="active"><a href="#admin" data-toggle="tab">Admin</a></li>
              <li><a href="#staff" data-toggle="tab">Staff</a></li>
              <li><a href="#client" data-toggle="tab">Client</a></li>
              @endif
            </ul>
            <div class="tab-content">
            @if(session()->get('user_level') == 'Admin')
              <div class="active tab-pane" id="admin">
                <h5>1. View Profile</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                  </ul>
                <h5>2. Upload Profile Picture</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Profile</b> button</li>
                    <li>Fill in the <b>Caption Field</b> <small>(Optional)</small></li>
                    <li>Click the emoticon/press tab to add some emoji's to caption</li>
                    <li>Choose File <b>Image</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>3 Update Personal Information</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Personal Information</b> tab</li>
                    <li>Update your Personal Information</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>4. Change Password</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Password</b> tab</li>
                    <li>Type your <b>Current Password</b></li>
                    <li>Type your <b>New Password</b></li>
                    <li>Confirm your <b>New Password</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>5. Create Staff</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>Add Staff</b></li>
                    <li>Fill in the fields</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>6. View Staffs</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>View Staff</b></li>
                  </ul>
                <h5>7. View Staffs Profile</h5>
                  <ul>
                    <li>Perform <b>#6</b></li>
                    <li>Click on the <b>Name</b> of staff</li>
                  </ul>
                <h5>8. Create Client</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>Add Client</b></li>
                    <li>Fill in the fields</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>9. View Clients</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>View Client</b></li>
                  </ul>
                <h5>10. View Clients Profile</h5>
                  <ul>
                    <li>Perform <b>#9</b></li>
                    <li>Click on the <b>Name</b> of client</li>
                  </ul>  
                <h5>11. View Client's Contacts</h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click on the <b>Contacts</b> tab</li>
                  </ul>
                <h5>12. Create Client's Contacts</h5>
                  <ul>
                    <li>Perform <b>#11</b></li>
                    <li>Click the <b>+</b> sign button</li>
                    <li>Fill in the fields <b>Name & Number w/ Country Code</b> w/o the <b>+</b> sign</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>13. Update Staff's Information <small>(Do not update staff that is currently logged in)</small></h5>
                  <ul>
                    <li>Perform <b>#6</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Staff Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>14. Update Client's Information <small>(Do not update client that is currently logged in)</small></h5>
                  <ul>
                    <li>Perform <b>#9</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Client Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>15. Update Client's Contacts Information</h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Client Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>16. Delete Staff's Information <small>(Staff that already created something within the system cannot be deleted)</small></h5>
                  <ul>
                    <li>Perform <b>#6</b></li>
                    <li>Click the <b>trash</b> sign button</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>17. Delete Client's Information <small>(Client that already created something within the system cannot be deleted)</small></h5>
                  <ul>
                    <li>Perform <b>#9</b></li>
                    <li>Click the <b>trash</b> sign button</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>18. Delete Client's Contacts Information <small>(Contacts that already used as an recipient to such message cannot be deleted)</small></h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click the <b>trash</b> sign button</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>19. Compose SMS</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Compose</b></li>
                    <li>Select <b>Category</b> <i>Existing</i> or <i>Anonymous</i> <small style="font-size: 11px;color:gray">(<b>Existing</b> if the recipient is already saved as a Contacts to its dedicated Client and <b>Anonymous</b> if not yet)</small></li>
                    <li>For <b><i>Existing</i></b></li>
                    <li>1. Select the <b>Client</b> where the SMS should come from</li>
                    <li>2. Look for <b>Client code</b> like <i>(C-001)</i></li>
                    <li>3. Type it in the <b>Recipient</b> field</li>
                    <li>4. Select one or more <b>Contact/s</b> and Proceed to <b>#5</b></li>

                    <li>For <b><i>Anonymous</i></b></li>
                    <li>1. Select the <b>Client</b> where the SMS should come from</li>
                    <li>2. Type the number in the <b>Recipient</b> field <small style="font-size: 11px;color:gray">(The number format should be Country Code + Mobile number, and remove the + sign in the Country Code)</small></li>
                    <li>3. Type one or more <b>Contact/s</b></li>
                    <li>4. Proceed to <b>#5</b></li>
                    <li>---------------------------------------------------------------------------------------------</li>
                    <li>5. Type your <b>Message</b> <small style="font-size: 11px;color:gray">(<b>0 - 160</b> Characters is equivalent to <b>1 SMS</b>)</small></li>
                    <li>6 .Click <b>Send</b></li>
                  </ul> 
                <h5>20. Inbox <small>(Not yet working)</small></h5>
                <h5>21. Sent Items</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Sent</b></li>
                  </ul>
                <h5>22. Forward SMS</h5>
                  <ul>
                    <li>Perform <b>#21</b></li>
                    <li>Click on the <b>Share</b> sign button</li>
                    <li>Follow steps in <b>#18</b></li>
                  </ul>
                <h5>23. View Emails <small>(The Email simply means request from Client to <b>Send an SMS</b>)</small></h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Emails</b></li>
                  </ul>
                <h5>24. View Emails Conversation</h5>
                  <ul>
                    <li>Perform <b>#23</b></li>
                    <li>Click on the <b>Eye</b> sign button</li>
                  </ul>
                <h5>25. Reply to Emails</h5>
                  <ul>
                    <li>Perform <b>#24</b></li>
                    <li>Type your replies in the <b>Input Field</b> below the email</li>
                    <li>Click <b>Submit</b></li>
                    <li><b>Mark As Read</b> <small style="font-size: 11px;color:gray">(Every replies from client)</small></li>
                  </ul>
                <h5>26. View Users Status</h5>
                  <ul>
                    <li>Click <b>Users Status</b> tab in sidebar</li>
                    <li>You will see <b>Statuses</b> like <b>IN & OUT</b></li>
                    <li>Click on the <b>Name</b> to load into its Profile Page</li>
                  </ul>    
                <h5>27. Post Something <small>(If you change your profile picture, it will also appear to home page & profile page)</small></h5>
                  <ul>
                    <li>Go to <b>Home</b> tab in sidebar</li>
                    <li>Type your status/post in the <b>Input Field</b> at the most top</li>
                    <li>Click <b>Post</b></li>
                  </ul>
                <h5>28. View Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                  </ul>
                <h5>29. Delete Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>30. Comment to a Post</h5>
                  <ul>
                    <li>Perform <b>#28</b></li>
                    <li><b>Scroll Down</b> and look for posts you wish to comment</li>
                    <li>Type in the <b>Comment Input Field</b></li>
                    <li>Hit <b>Enter</b></li>
                  </ul>
              </div>
              @endif
              @if(session()->get('user_level') == 'Staff')
              <div class="active tab-pane" id="staff">
                <h5>1. View Profile</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                  </ul>
                <h5>2. Upload Profile Picture</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Profile</b> button</li>
                    <li>Fill in the <b>Caption Field</b> <small>(Optional)</small></li>
                    <li>Click the emoticon/press tab to add some emoji's to caption</li>
                    <li>Choose File <b>Image</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>3 Update Personal Information</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Personal Information</b> tab</li>
                    <li>Update your Personal Information</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>4. Change Password</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Password</b> tab</li>
                    <li>Type your <b>Current Password</b></li>
                    <li>Type your <b>New Password</b></li>
                    <li>Confirm your <b>New Password</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>5. Create Staff</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>Add Staff</b></li>
                    <li>Fill in the fields</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>6. View Staffs</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>View Staff</b></li>
                  </ul>
                <h5>7. View Staffs Profile</h5>
                  <ul>
                    <li>Perform <b>#6</b></li>
                    <li>Click on the <b>Name</b> of staff</li>
                  </ul>
                <h5>8. Create Client</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>Add Client</b></li>
                    <li>Fill in the fields</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>9. View Clients</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>View Client</b></li>
                  </ul>
                <h5>10. View Clients Profile</h5>
                  <ul>
                    <li>Perform <b>#9</b></li>
                    <li>Click on the <b>Name</b> of client</li>
                  </ul>  
                <h5>11. View Client's Contacts</h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click on the <b>Contacts</b> tab</li>
                  </ul>
                <h5>12. Create Client's Contacts</h5>
                  <ul>
                    <li>Perform <b>#11</b></li>
                    <li>Click the <b>+</b> sign button</li>
                    <li>Fill in the fields <b>Name & Number w/ Country Code</b> w/o the <b>+</b> sign</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>13. Update Staff's Information <small>(Do not update staff that is currently logged in)</small></h5>
                  <ul>
                    <li>Perform <b>#6</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Staff Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>14. Update Client's Information <small>(Do not update client that is currently logged in)</small></h5>
                  <ul>
                    <li>Perform <b>#9</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Client Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>15. Update Client's Contacts Information</h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Client Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>16. Compose SMS</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Compose</b></li>
                    <li>Select <b>Category</b> <i>Existing</i> or <i>Anonymous</i> <small style="font-size: 11px;color:gray">(<b>Existing</b> if the recipient is already saved as a Contacts to its dedicated Client and <b>Anonymous</b> if not yet)</small></li>
                    <li>For <b><i>Existing</i></b></li>
                    <li>1. Select the <b>Client</b> where the SMS should come from</li>
                    <li>2. Look for <b>Client code</b> like <i>(C-001)</i></li>
                    <li>3. Type it in the <b>Recipient</b> field</li>
                    <li>4. Select one or more <b>Contact/s</b> and Proceed to <b>#5</b></li>

                    <li>For <b><i>Anonymous</i></b></li>
                    <li>1. Select the <b>Client</b> where the SMS should come from</li>
                    <li>2. Type the number in the <b>Recipient</b> field <small style="font-size: 11px;color:gray">(The number format should be Country Code + Mobile number, and remove the + sign in the Country Code)</small></li>
                    <li>3. Type one or more <b>Contact/s</b></li>
                    <li>4. Proceed to <b>#5</b></li>
                    <li>---------------------------------------------------------------------------------------------</li>
                    <li>5. Type your <b>Message</b> <small style="font-size: 11px;color:gray">(<b>0 - 160</b> Characters is equivalent to <b>1 SMS</b>)</small></li>
                    <li>6 .Click <b>Send</b></li>
                  </ul> 
                <h5>17. Inbox <small>(Not yet working)</small></h5>
                <h5>18. Sent Items</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Sent</b></li>
                  </ul>
                <h5>19. Forward SMS</h5>
                  <ul>
                    <li>Perform <b>#18</b></li>
                    <li>Click on the <b>Share</b> sign button</li>
                    <li>Follow steps in <b>#18</b></li>
                  </ul>
                <h5>20. View Emails <small>(The Email simply means request from Client to <b>Send an SMS</b>)</small></h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Emails</b></li>
                  </ul>
                <h5>21. View Emails Conversation</h5>
                  <ul>
                    <li>Perform <b>#20</b></li>
                    <li>Click on the <b>Eye</b> sign button</li>
                  </ul>
                <h5>22. Reply to Emails</h5>
                  <ul>
                    <li>Perform <b>#21</b></li>
                    <li>Type your replies in the <b>Input Field</b> below the email</li>
                    <li>Click <b>Submit</b></li>
                    <li><b>Mark As Read</b> <small style="font-size: 11px;color:gray">(Every replies from client)</small></li>
                  </ul>
                <h5>23. View Users Status</h5>
                  <ul>
                    <li>Click <b>Users Status</b> tab in sidebar</li>
                    <li>You will see <b>Statuses</b> like <b>IN & OUT</b></li>
                    <li>Click on the <b>Name</b> to load into its Profile Page</li>
                  </ul>
                <h5>24. Post Something <small>(If you change your profile picture, it will also appear to home page & profile page)</small></h5>
                  <ul>
                    <li>Go to <b>Home</b> tab in sidebar</li>
                    <li>Type your status/post in the <b>Input Field</b> at the most top</li>
                    <li>Click <b>Post</b></li>
                  </ul>
                <h5>25. View Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                  </ul>
                <h5>26. Delete Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>27. Comment to a Post</h5>
                  <ul>
                    <li>Perform <b>#25</b></li>
                    <li><b>Scroll Down</b> and look for posts you wish to comment</li>
                    <li>Type in the <b>Comment Input Field</b></li>
                    <li>Hit <b>Enter</b></li>
                  </ul>
              </div>
              @endif
              @if(session()->get('user_level') == 'Client')
              <div class="active tab-pane" id="client">
                <h5>1. View Profile</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                  </ul>
                <h5>2. Upload Profile Picture</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Profile</b> button</li>
                    <li>Fill in the <b>Caption Field</b> <small>(Optional)</small></li>
                    <li>Click the emoticon/press tab to add some emoji's to caption</li>
                    <li>Choose File <b>Image</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>3 Update Personal Information</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Personal Information</b> tab</li>
                    <li>Update your Personal Information</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>4. Change Password</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Password</b> tab</li>
                    <li>Type your <b>Current Password</b></li>
                    <li>Type your <b>New Password</b></li>
                    <li>Confirm your <b>New Password</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>5. View Contacts</h5>
                  <ul>
                    <li>Perform <b>#1</b></li>
                    <li>Click on the <b>Contacts</b> tab</li>
                  </ul>
                <h5>6. Create Contacts</h5>
                  <ul>
                    <li>Perform <b>#5</b></li>
                    <li>Click the <b>+</b> sign button</li>
                    <li>Fill in the fields <b>Name & Number w/ Country Code</b> w/o the <b>+</b> sign</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>7. Update Contacts Information</h5>
                  <ul>
                    <li>Perform <b>#5</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Client Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>8. Delete Contacts Information <small>(Contacts that already used as an recipient to such message cannot be deleted)</small></h5>
                  <ul>
                    <li>Perform <b>#5</b></li>
                    <li>Click the <b>trash</b> sign button</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>

                <h5>9. Compose Email</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in sidebar</li>
                    <li>Click <b>Compose</b></li>
                    <li>Type the <b>Recipients Number w/ Country Code</b></li>
                    <li>Put <b>One Space</b> for each recipients</li>
                    <li>Type your <b>Message</b></li>
                    <li>Click <b>Send</b></li>
                  </ul>
                <h5>10. View Emails</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in sidebar</li>
                    <li>Click <b>Emails</b></li>
                  </ul>
                <h5>11. View Email Conversation</h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click on the <b>Eye</b> sign button</li>
                  </ul>
                <h5>12. Reply to Email</h5>
                  <ul>
                    <li>Perform <b>#11</b></li>
                    <li>Type your message in the <b>Input Field</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>13. View Users Status</h5>
                  <ul>
                    <li>Click <b>Users Status</b> tab in sidebar</li>
                    <li>You will see <b>Statuses</b> like <b>IN & OUT</b></li>
                    <li>Click on the <b>Name</b> to load into its Profile Page</li>
                  </ul>
                <h5>14. Post Something <small>(If you change your profile picture, it will also appear to home page & profile page)</small></h5>
                  <ul>
                    <li>Go to <b>Home</b> tab in sidebar</li>
                    <li>Type your status/post in the <b>Input Field</b> at the most top</li>
                    <li>Click <b>Post</b></li>
                  </ul>
                <h5>15. View Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                  </ul>
                <h5>16. Delete Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>17. Comment to a Post</h5>
                  <ul>
                    <li>Perform <b>#15</b></li>
                    <li><b>Scroll Down</b> and look for posts you wish to comment</li>
                    <li>Type in the <b>Comment Input Field</b></li>
                    <li>Hit <b>Enter</b></li>
                  </ul>
              </div>
              @endif
              @if(session()->get('user_level') == 'super admin')
              <div class="active tab-pane" id="admin">
                <h5>1. View Profile</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                  </ul>
                <h5>2. Upload Profile Picture</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Profile</b> button</li>
                    <li>Fill in the <b>Caption Field</b> <small>(Optional)</small></li>
                    <li>Click the emoticon/press tab to add some emoji's to caption</li>
                    <li>Choose File <b>Image</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>3 Update Personal Information</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Personal Information</b> tab</li>
                    <li>Update your Personal Information</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>4. Change Password</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Password</b> tab</li>
                    <li>Type your <b>Current Password</b></li>
                    <li>Type your <b>New Password</b></li>
                    <li>Confirm your <b>New Password</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>5. Create Staff</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>Add Staff</b></li>
                    <li>Fill in the fields</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>6. View Staffs</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>View Staff</b></li>
                  </ul>
                <h5>7. View Staffs Profile</h5>
                  <ul>
                    <li>Perform <b>#6</b></li>
                    <li>Click on the <b>Name</b> of staff</li>
                  </ul>
                <h5>8. Create Client</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>Add Client</b></li>
                    <li>Fill in the fields</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>9. View Clients</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>View Client</b></li>
                  </ul>
                <h5>10. View Clients Profile</h5>
                  <ul>
                    <li>Perform <b>#9</b></li>
                    <li>Click on the <b>Name</b> of client</li>
                  </ul>  
                <h5>11. View Client's Contacts</h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click on the <b>Contacts</b> tab</li>
                  </ul>
                <h5>12. Create Client's Contacts</h5>
                  <ul>
                    <li>Perform <b>#11</b></li>
                    <li>Click the <b>+</b> sign button</li>
                    <li>Fill in the fields <b>Name & Number w/ Country Code</b> w/o the <b>+</b> sign</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>13. Update Staff's Information <small>(Do not update staff that is currently logged in)</small></h5>
                  <ul>
                    <li>Perform <b>#6</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Staff Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>14. Update Client's Information <small>(Do not update client that is currently logged in)</small></h5>
                  <ul>
                    <li>Perform <b>#9</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Client Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>15. Update Client's Contacts Information</h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Client Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>16. Delete Staff's Information <small>(Staff that already created something within the system cannot be deleted)</small></h5>
                  <ul>
                    <li>Perform <b>#6</b></li>
                    <li>Click the <b>trash</b> sign button</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>17. Delete Client's Information <small>(Client that already created something within the system cannot be deleted)</small></h5>
                  <ul>
                    <li>Perform <b>#9</b></li>
                    <li>Click the <b>trash</b> sign button</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>18. Delete Client's Contacts Information <small>(Contacts that already used as an recipient to such message cannot be deleted)</small></h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click the <b>trash</b> sign button</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>19. Compose SMS</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Compose</b></li>
                    <li>Select <b>Category</b> <i>Existing</i> or <i>Anonymous</i> <small style="font-size: 11px;color:gray">(<b>Existing</b> if the recipient is already saved as a Contacts to its dedicated Client and <b>Anonymous</b> if not yet)</small></li>
                    <li>For <b><i>Existing</i></b></li>
                    <li>1. Select the <b>Client</b> where the SMS should come from</li>
                    <li>2. Look for <b>Client code</b> like <i>(C-001)</i></li>
                    <li>3. Type it in the <b>Recipient</b> field</li>
                    <li>4. Select one or more <b>Contact/s</b> and Proceed to <b>#5</b></li>

                    <li>For <b><i>Anonymous</i></b></li>
                    <li>1. Select the <b>Client</b> where the SMS should come from</li>
                    <li>2. Type the number in the <b>Recipient</b> field <small style="font-size: 11px;color:gray">(The number format should be Country Code + Mobile number, and remove the + sign in the Country Code)</small></li>
                    <li>3. Type one or more <b>Contact/s</b></li>
                    <li>4. Proceed to <b>#5</b></li>
                    <li>---------------------------------------------------------------------------------------------</li>
                    <li>5. Type your <b>Message</b> <small style="font-size: 11px;color:gray">(<b>0 - 160</b> Characters is equivalent to <b>1 SMS</b>)</small></li>
                    <li>6 .Click <b>Send</b></li>
                  </ul> 
                <h5>20. Inbox <small>(Not yet working)</small></h5>
                <h5>21. Sent Items</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Sent</b></li>
                  </ul>
                <h5>22. Forward SMS</h5>
                  <ul>
                    <li>Perform <b>#21</b></li>
                    <li>Click on the <b>Share</b> sign button</li>
                    <li>Follow steps in <b>#18</b></li>
                  </ul>
                <h5>23. View Emails <small>(The Email simply means request from Client to <b>Send an SMS</b>)</small></h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Emails</b></li>
                  </ul>
                <h5>24. View Emails Conversation</h5>
                  <ul>
                    <li>Perform <b>#23</b></li>
                    <li>Click on the <b>Eye</b> sign button</li>
                  </ul>
                <h5>25. Reply to Emails</h5>
                  <ul>
                    <li>Perform <b>#24</b></li>
                    <li>Type your replies in the <b>Input Field</b> below the email</li>
                    <li>Click <b>Submit</b></li>
                    <li><b>Mark As Read</b> <small style="font-size: 11px;color:gray">(Every replies from client)</small></li>
                  </ul>
                <h5>26. View Users Status</h5>
                  <ul>
                    <li>Click <b>Users Status</b> tab in sidebar</li>
                    <li>You will see <b>Statuses</b> like <b>IN & OUT</b></li>
                    <li>Click on the <b>Name</b> to load into its Profile Page</li>
                  </ul>
                <h5>27. Post Something <small>(If you change your profile picture, it will also appear to home page & profile page)</small></h5>
                  <ul>
                    <li>Go to <b>Home</b> tab in sidebar</li>
                    <li>Type your status/post in the <b>Input Field</b> at the most top</li>
                    <li>Click <b>Post</b></li>
                  </ul>
                <h5>28. View Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                  </ul>
                <h5>29. Delete Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>30. Comment to a Post</h5>
                  <ul>
                    <li>Perform <b>#28</b></li>
                    <li><b>Scroll Down</b> and look for posts you wish to comment</li>
                    <li>Type in the <b>Comment Input Field</b></li>
                    <li>Hit <b>Enter</b></li>
                  </ul>  
              </div>
              <div class="tab-pane" id="staff">
                <h5>1. View Profile</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                  </ul>
                <h5>2. Upload Profile Picture</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Profile</b> button</li>
                    <li>Fill in the <b>Caption Field</b> <small>(Optional)</small></li>
                    <li>Click the emoticon/press tab to add some emoji's to caption</li>
                    <li>Choose File <b>Image</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>3 Update Personal Information</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Personal Information</b> tab</li>
                    <li>Update your Personal Information</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>4. Change Password</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Password</b> tab</li>
                    <li>Type your <b>Current Password</b></li>
                    <li>Type your <b>New Password</b></li>
                    <li>Confirm your <b>New Password</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>5. Create Staff</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>Add Staff</b></li>
                    <li>Fill in the fields</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>6. View Staffs</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>View Staff</b></li>
                  </ul>
                <h5>7. View Staffs Profile</h5>
                  <ul>
                    <li>Perform <b>#6</b></li>
                    <li>Click on the <b>Name</b> of staff</li>
                  </ul>
                <h5>8. Create Client</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>Add Client</b></li>
                    <li>Fill in the fields</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>9. View Clients</h5>
                  <ul>
                    <li>Click <b>Users</b> tab in sidebar</li>
                    <li>Click <b>View Client</b></li>
                  </ul>
                <h5>10. View Clients Profile</h5>
                  <ul>
                    <li>Perform <b>#9</b></li>
                    <li>Click on the <b>Name</b> of client</li>
                  </ul>  
                <h5>11. View Client's Contacts</h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click on the <b>Contacts</b> tab</li>
                  </ul>
                <h5>12. Create Client's Contacts</h5>
                  <ul>
                    <li>Perform <b>#11</b></li>
                    <li>Click the <b>+</b> sign button</li>
                    <li>Fill in the fields <b>Name & Number w/ Country Code</b> w/o the <b>+</b> sign</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>13. Update Staff's Information <small>(Do not update staff that is currently logged in)</small></h5>
                  <ul>
                    <li>Perform <b>#6</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Staff Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>14. Update Client's Information <small>(Do not update client that is currently logged in)</small></h5>
                  <ul>
                    <li>Perform <b>#9</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Client Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>15. Update Client's Contacts Information</h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Client Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>16. Compose SMS</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Compose</b></li>
                    <li>Select <b>Category</b> <i>Existing</i> or <i>Anonymous</i> <small style="font-size: 11px;color:gray">(<b>Existing</b> if the recipient is already saved as a Contacts to its dedicated Client and <b>Anonymous</b> if not yet)</small></li>
                    <li>For <b><i>Existing</i></b></li>
                    <li>1. Select the <b>Client</b> where the SMS should come from</li>
                    <li>2. Look for <b>Client code</b> like <i>(C-001)</i></li>
                    <li>3. Type it in the <b>Recipient</b> field</li>
                    <li>4. Select one or more <b>Contact/s</b> and Proceed to <b>#5</b></li>

                    <li>For <b><i>Anonymous</i></b></li>
                    <li>1. Select the <b>Client</b> where the SMS should come from</li>
                    <li>2. Type the number in the <b>Recipient</b> field <small style="font-size: 11px;color:gray">(The number format should be Country Code + Mobile number, and remove the + sign in the Country Code)</small></li>
                    <li>3. Type one or more <b>Contact/s</b></li>
                    <li>4. Proceed to <b>#5</b></li>
                    <li>---------------------------------------------------------------------------------------------</li>
                    <li>5. Type your <b>Message</b> <small style="font-size: 11px;color:gray">(<b>0 - 160</b> Characters is equivalent to <b>1 SMS</b>)</small></li>
                    <li>6 .Click <b>Send</b></li>
                  </ul> 
                <h5>17. Inbox <small>(Not yet working)</small></h5>
                <h5>18. Sent Items</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Sent</b></li>
                  </ul>
                <h5>19. Forward SMS</h5>
                  <ul>
                    <li>Perform <b>#18</b></li>
                    <li>Click on the <b>Share</b> sign button</li>
                    <li>Follow steps in <b>#18</b></li>
                  </ul>
                <h5>20. View Emails <small>(The Email simply means request from Client to <b>Send an SMS</b>)</small></h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in the sidebar</li>
                    <li>Click <b>Emails</b></li>
                  </ul>
                <h5>21. View Emails Conversation</h5>
                  <ul>
                    <li>Perform <b>#20</b></li>
                    <li>Click on the <b>Eye</b> sign button</li>
                  </ul>
                <h5>22. Reply to Emails</h5>
                  <ul>
                    <li>Perform <b>#21</b></li>
                    <li>Type your replies in the <b>Input Field</b> below the email</li>
                    <li>Click <b>Submit</b></li>
                    <li><b>Mark As Read</b> <small style="font-size: 11px;color:gray">(Every replies from client)</small></li>
                  </ul>
                <h5>23. View Users Status</h5>
                  <ul>
                    <li>Click <b>Users Status</b> tab in sidebar</li>
                    <li>You will see <b>Statuses</b> like <b>IN & OUT</b></li>
                    <li>Click on the <b>Name</b> to load into its Profile Page</li>
                  </ul>
                <h5>24. Post Something</h5>
                  <ul>
                    <li>Go to <b>Home</b> tab in sidebar</li>
                    <li>Type your status/post in the <b>Input Field</b> at the most top</li>
                    <li>Click <b>Post</b></li>
                  </ul>
                <h5>25. View Post <small>(If you change your profile picture, it will also appear to home page & profile page)</small></h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                  </ul>
                <h5>26. Delete Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>27. Comment to a Post</h5>
                  <ul>
                    <li>Perform <b>#25</b></li>
                    <li><b>Scroll Down</b> and look for posts you wish to comment</li>
                    <li>Type in the <b>Comment Input Field</b></li>
                    <li>Hit <b>Enter</b></li>
                  </ul>
              </div>
              <div class="tab-pane" id="client">
                <h5>1. View Profile</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                  </ul>
                <h5>2. Upload Profile Picture</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Profile</b> button</li>
                    <li>Fill in the <b>Caption Field</b> <small>(Optional)</small></li>
                    <li>Click the emoticon/press tab to add some emoji's to caption</li>
                    <li>Choose File <b>Image</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>3 Update Personal Information</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Personal Information</b> tab</li>
                    <li>Update your Personal Information</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>4. Change Password</h5>
                  <ul>
                    <li>Click <b>Profile</b> tab in sidebar</li>
                    <li>Click <b>Change Password</b> tab</li>
                    <li>Type your <b>Current Password</b></li>
                    <li>Type your <b>New Password</b></li>
                    <li>Confirm your <b>New Password</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>5. View Contacts</h5>
                  <ul>
                    <li>Perform <b>#1</b></li>
                    <li>Click on the <b>Contacts</b> tab</li>
                  </ul>
                <h5>6. Create Contacts</h5>
                  <ul>
                    <li>Perform <b>#5</b></li>
                    <li>Click the <b>+</b> sign button</li>
                    <li>Fill in the fields <b>Name & Number w/ Country Code</b> w/o the <b>+</b> sign</li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>7. Update Contacts Information</h5>
                  <ul>
                    <li>Perform <b>#5</b></li>
                    <li>Click the <b>pencil</b> sign button</li>
                    <li>Update the <b>Client Information</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>8. Delete Contacts Information <small>(Contacts that already used as an recipient to such message cannot be deleted)</small></h5>
                  <ul>
                    <li>Perform <b>#5</b></li>
                    <li>Click the <b>trash</b> sign button</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>

                <h5>9. Compose Email</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in sidebar</li>
                    <li>Click <b>Compose</b></li>
                    <li>Type the <b>Recipients Number w/ Country Code</b></li>
                    <li>Put <b>One Space</b> for each recipients</li>
                    <li>Type your <b>Message</b></li>
                    <li>Click <b>Send</b></li>
                  </ul>
                <h5>10. View Emails</h5>
                  <ul>
                    <li>Click <b>Messages</b> tab in sidebar</li>
                    <li>Click <b>Emails</b></li>
                  </ul>
                <h5>11. View Email Conversation</h5>
                  <ul>
                    <li>Perform <b>#10</b></li>
                    <li>Click on the <b>Eye</b> sign button</li>
                  </ul>
                <h5>12. Reply to Email</h5>
                  <ul>
                    <li>Perform <b>#11</b></li>
                    <li>Type your message in the <b>Input Field</b></li>
                    <li>Click <b>Submit</b></li>
                  </ul>
                <h5>13. View Users Status</h5>
                  <ul>
                    <li>Click <b>Users Status</b> tab in sidebar</li>
                    <li>You will see <b>Statuses</b> like <b>IN & OUT</b></li>
                    <li>Click on the <b>Name</b> to load into its Profile Page</li>
                  </ul>
                <h5>14. Post Something <small>(If you change your profile picture, it will also appear to home page & profile page)</small></h5>
                  <ul>
                    <li>Go to <b>Home</b> tab in sidebar</li>
                    <li>Type your status/post in the <b>Input Field</b> at the most top</li>
                    <li>Click <b>Post</b></li>
                  </ul>
                <h5>15. View Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                  </ul>
                <h5>16. Delete Post</h5>
                  <ul>
                    <li><i>Go to <b>Home</b> tab in sidebar</i></li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion or</li>
                    <li><i>Go to <b>Profile</b> tab in sidebar</i></li>
                    <li>You will see all your post in the <b>Activity</b> tab</li>
                    <li><b>Scroll Down</b> and</li>
                    <li>Select which post you wish to delete</li>
                    <li>Then click on the <b>x</b> button at the top right corner</li>
                    <li>Click <b>Ok</b> to confirm the deletion</li>
                  </ul>
                <h5>17. Comment to a Post</h5>
                  <ul>
                    <li>Perform <b>#15</b></li>
                    <li><b>Scroll Down</b> and look for posts you wish to comment</li>
                    <li>Type in the <b>Comment Input Field</b></li>
                    <li>Hit <b>Enter</b></li>
                  </ul>
              </div>
              @endif
            </div>
          </div>
         </div>
        </div>
  </section>
@endsection