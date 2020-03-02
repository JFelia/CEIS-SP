<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('login','AdminController@login')->name('login');

// Auth::routes();
Route::get('/home', 'HomeController@index')->name('home'); 
Route::match(['get','post'],'/greymouse','FrontendController@index');
Route::get('/','FrontendController@index');
Route::match(['get','post'],'/admin','AdminController@login');
Route::match(['get','post'],'/register','AdminController@adminRegister');
Route::post('/apply', 'FilesController@store');
Route::get('contentmanager/{id?}','FrontendController@contentmanager');
Route::post('/getintouch', 'AdminController@getintouch');
Route::post('/send-sms', [
   'uses'   =>  'TextlocalsmsController@send',
   'as'     =>  'sendSms'
]);
Route::match(['get','post'],'/requestreset','AdminController@requestreset');
Route::match(['get','post'],'/resetpassword','AdminController@resetpassword');
Route::match(['get','post'],'/resetpassword2','AdminController@resetpassword2');


Route::middleware(['auth'])->group(function(){ //resources routes
Route::resource('clients','ClientsController');
Route::resource('contacts','ContactsController');
Route::resource('messages','MessagesController');
Route::resource('emails','EmailsController');
Route::resource('replies','RepliesController');
Route::resource('posts','PostsController');
Route::resource('comments','CommentsController');
Route::resource('files','FilesController');



//create routes
Route::match(['get','post'],'/admin/addstaff','AdminController@addstaffs');
Route::get('messages/forward/{id?}','MessagesController@forward');
Route::match(['get','post'],'/messages/anonymous','MessagesController@anonymous');
Route::post('/profile', 'AdminController@update_avatar');
Route::match(['get','post'],'/holiday','AdminController@holiday');
Route::match(['get','post'],'/menus','FrontendController@createmenus');
Route::match(['get','post'],'/create_menu','FrontendController@store');
Route::match(['get','post'],'/save_menu','FrontendController@save_menus');
Route::match(['get','post'],'/save_content','FrontendController@save_content');
Route::match(['get','post'],'/contents','FrontendController@createcontents');
Route::match(['get','post'],'/create_content','FrontendController@storecontents');
Route::match(['get','post'],'/page','FrontendController@page');
Route::match(['get','post'],'/page/{id}','FrontendController@page');
Route::match(['get','post'],'/newsfeeds','FrontendController@newsfeeds');
Route::match(['get','post'],'/newsfeeds/{id}','FrontendController@newsfeeds');
Route::post('/request_leave', 'AdminController@request_leave');
Route::post('/create_roles', 'AdminController@create_roles');
Route::post('/create_type_of_leave', 'AdminController@create_type_of_leave');
Route::post('/emails/anonymous', 'EmailsController@anonymous');
Route::post('/add_category', 'AdminController@add_category');



//retrieve routes
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::match(['get','post'],'/admin/security','AdminController@security');
Route::get('/admin/staffs', 'AdminController@staffs');
Route::get('/profile', 'ProfilesController@show');
Route::match(['get','post'],'/admin/staff-profile/{id}','ProfilesController@staffProfile');
Route::match(['get','post'],'/clients/client-profile/{id}','ProfilesController@clientProfile');
Route::get('/admin/active-users', 'AdminController@activeUsers');
Route::get('client/emails','MessagesController@email');
Route::get('client/transaction','EmailsController@transaction');
Route::get('replies/mark/{id?}','RepliesController@mark');
Route::get('clients/invoice/{id?}','ClientsController@invoice');
Route::get('/logs', 'AdminController@logs');
Route::get('/documentation', 'AdminController@documentation');
Route::get('/won_index','ClientsController@viewwon');
Route::get('/lost_index','ClientsController@viewlost');
Route::get('/invoices', 'ClientsController@invoices');
//start of time
Route::get('/timedoctor', 'TimeController@index');
Route::get('/dtr', 'TimeController@dtr');
Route::match(['get','post'],'/time/{id}','TimeController@time');
Route::match(['get','post'],'/status/{id}','AdminController@status');
//end of time
Route::get('/create_cms', 'FrontendController@create_cms');
Route::get('file/download/{id}','FilesController@show')->name('downloadfile');
Route::get('file/delete/{id}','FilesController@destroy')->name('deletefile');
Route::get('/sched', 'AdminController@sched');
Route::get('view_dtr/{id?}','TimeController@view_dtr');
Route::get('/birthdayboard','AdminController@bdayboard');
Route::get('/anniversaryboard','AdminController@annivboard');
Route::match(['get','post'],'/requests/{id}','AdminController@requests');
Route::match(['get','post'],'/requests_disapproved/{id}','AdminController@requests_disapproved');
Route::get('/list_request','AdminController@list_request');
Route::get('/viewgetintouch','AdminController@viewgetintouch');
Route::get('/user_roles', 'AdminController@user_roles');
Route::get('/type_of_leave', 'AdminController@type_of_leave');		



//update routes
Route::match(['get','post'],'/admin/edit-staff/{id}','AdminController@editStaff');
Route::match(['get','post'],'/admin/resign-staff/{id}','AdminController@resignStaff');
Route::match(['get','post'],'/admin/retire-staff/{id}','AdminController@retireStaff');
Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
Route::match(['get','post'],'/clients/{id}/win','ClientsController@win');
Route::match(['get','post'],'/clients/{id}/lost','ClientsController@lost');
Route::match(['get','post'],'/contacts/{id}/edit','ContactsController@edit');
Route::post('/admin/editsched','AdminController@edit_Sched');
Route::match(['get','post'],'/admin/edit-holiday/{id}','AdminController@editHoliday');
Route::match(['get','post'],'/admin/edit-menu/{id}','FrontendController@editMenu');
Route::match(['get','post'],'/admin/edit-content/{id}','FrontendController@editContent');
Route::match(['get','post'],'/admin/edit-role/{id}','AdminController@editRole');
Route::match(['get','post'],'/admin/edit-leave/{id}','AdminController@editLeave');
Route::match(['get','post'],'/update_email/{id}','EmailsController@update_email');
Route::match(['get','post'],'/update_normal/{id}','AdminController@update_normal');
Route::match(['get','post'],'/update_special/{id}','AdminController@update_special');
Route::match(['get','post'],'/clients-update2/{id}','ClientsController@newupdate2');



//delete routes
Route::match(['get','post'],'/admin/delete-staff/{id}','AdminController@destroy');
Route::match(['get','post'],'/admin/delete-client/{id}','ClientsController@destroy');
Route::match(['get','post'],'/posts/delete-post/{id}','PostsController@destroy');
// Route::get('sms/massremove','MessagesController@massremove')->name('sms.massremove');
Route::get('/clients/massremove','ClientsController@massremove')->name('clients.massremove');
Route::match(['get','post'],'/client/delete-contacts/{id}','ContactsController@destroy');
Route::match(['get','post'],'/admin/delete-holiday/{id}','AdminController@deleteHoliday');
Route::match(['get','post'],'/admin/delete-menu/{id}','FrontendController@deleteMenu');
Route::match(['get','post'],'/admin/delete-content/{id}','FrontendController@deleteContent');

Route::get('/logout', 'AdminController@logout');
Route::get('dtrPDF','DynamicPDFController@dtr');
Route::get('invoicePDF','DynamicPDFController@invoice');


//if session has expired


});
