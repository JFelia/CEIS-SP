<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Content;
use App\Log;
use App\Page;
use Image;
use App\File;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    
    public function index()
    {
        $page = Page::all();

       
        
        $parents = Menu::where('type', 'parent')->get()->all();
        $childs = Menu::where('type', 'child')->get()->all();
        foreach($parents as $key => $val){
                    //check if has child
                    $checkchild = Menu::where(['parent'=>$val->id])->get()->first();
                    if($checkchild){
                        $parents[$key]->haschild = 'true';    
                    }else{
                        $parents[$key]->haschild = 'false';    
                    }                    
                }
        session()->put('content','false');
        return view('front.home',['parents'=>$parents,'childs'=>$childs,'page'=>$page]);
    }

    
    public function createmenus(Request $request)
    {
        if(Auth::user()->user_level == 'Admin'){
            $menus = Menu::all();
            $parents = Menu::where('type','parent')->get()->all();
            return view('admin.frontend.menus',['menus'=>$menus,'parents'=>$parents]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    
    public function store(Request $request)
    {

        $validator=Validator::make($request->all(),[
                'name' => 'required',
                'type' => 'required'
            ]);

        if($validator->fails()){
            // \Session::flash('flash_message_error','Please enter the required details');
            return Redirect::to('/menus')->withInput()->withErrors($validator);
        }

        $type = $request->input('type');

        if($type == '0'){
            return back()->with('flash_message_error','Please input the required details');
        }

        if($type == 'Parent'){
            $menucount = Menu::where('type','Parent')->count();
            if($menucount != 5){
                if($request->isMethod('post')){
                    Menu::create([
                        'name' => $request->input('name'),
                        'type' => $request->input('type'),
                        'parent' => $request->input('parent')
                    ]);

                    return back()->with('flash_message_success','Menu Successfully Created');

                }
            }else{
                    return back()->with('flash_message_error','The Parent Menus reached it limit');
            }
        }else{
            if($request->isMethod('post')){
                Menu::create([
                    'name' => $request->input('name'),
                    'type' => $request->input('type'),
                    'parent' => $request->input('parent')
                ]);

                return back()->with('flash_message_success','Menu Successfully Created');

            }
        }
        
    }

    public function createcontents(Request $request)
    {
        if(Auth::user()->user_level == 'Admin'){
            $contents = Content::all();
            $menus = Menu::all();
            return view('admin.frontend.contents',['contents'=>$contents,'menus'=>$menus]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    public function storecontents(Request $request)
    {
        if($request->isMethod('post')){
            

            $validator=Validator::make($request->all(),[
                'title' => 'required',
                'content' => 'required',
                // 'target' => 'required'
            ]);

            if($validator->fails()){
                \Session::flash('flash_message_error','Please enter the required details');
                return Redirect::to('/contents')->withInput()->withErrors($validator);
            }

            Content::create([
                'title' => $request->input('title'),
                'content' => $request->input('content')
                // 'target' => $request->input('target')
            ]);

            return back()->with('flash_message_success','Content Successfully Created');

        }
    }

    public function save_menus(Request $request){
            
            $count = $request->input('count');
            $check;
            // echo $count;
            $i;
            for($i=0; $i<$count+1; $i++){
                $id[$i] = $request->input('id_'.$i);
                $parent[$i] = $request->input('parent_'.$i);
                Menu::where('id',$id[$i])->update([ 
                'parent'=>$parent[$i]
                ]);
                

             $log = Auth::user()->name . ' has updated the Menus with id = '.$id[$i];
             $user_id = Auth::user()->id;
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);
                $check = $i;
            }

            
                return redirect('/menus')->with('flash_message_success',' Menus updated successfully');
        
    }

    public function save_content(Request $request){
            
            $count = $request->input('count');
            $check;
            // echo $count;
            $i;
            for($i=0; $i<$count+1; $i++){
                $id[$i] = $request->input('id_'.$i);
                $target[$i] = $request->input('target_'.$i);
                Content::where('id',$id[$i])->update([ 
                'target'=>$target[$i]
                ]);
                

             $log = Auth::user()->name . ' has updated the Content with id = '.$id[$i];
             $user_id = Auth::user()->id;
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);
                $check = $i;
            }

                $check--;
                return redirect('/contents')->with('flash_message_success',' Content updated successfully');
        
    }

    public function contentmanager(Request $request, $id = null){
        //for header
        $page = Page::all();
        $parents = Menu::where('type', 'parent')->get()->all();
        $childs = Menu::where('type', 'child')->get()->all();
        foreach($parents as $key => $val){
                    //check if has child
                    $checkchild = Menu::where(['parent'=>$val->id])->get()->first();
                    if($checkchild){
                        $parents[$key]->haschild = 'true';    
                    }else{
                        $parents[$key]->haschild = 'false';    
                    }                    
                }
        //end of header
        session()->put('content','true');
        $content = Content::where('target',$id)->get();
        return view('front.home',['content'=>$content,'parents'=>$parents,'childs'=>$childs,'page'=>$page]);
    }

    public function editMenu(Request $request, $id = null){
        if($request->isMethod('post')){
            
            Menu::where('id',$id)->update([
                    'name'=>$request->input('name')
                ]);

             $log = session()->get('name') . ' has updated informations of menu';
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            
            return redirect('/menus')->with('flash_message_success','Menu Information updated successfully');
            
        }
        
        $MenuDetails = Menu::where(['id'=>$id])->first();
        return view('admin.edit_menu')->with(compact('MenuDetails'));
    }

    public function deleteMenu(Request $request,$id = null){
        $findMenu = Menu::where('id',$id)->get()->first();
        if($findMenu->type == 'Parent'){
            //if the menu type is parent, look for the child menus and contents and delete it also
            $findchild = Menu::where('parent',$id)->get()->all();
            foreach($findchild as $object){
               
                Menu::where('parent',$id)->update([
                    'parent'=> 0
                ]);
            }
            //delete the content of the parent menu
            $findcontent = Content::where('target', $findMenu->id)->update([
                    'target' => 0
                ]);
        }else{
            //if the menu type is child
            

            Content::where('target',$findMenu->id)->update([
                    'target'=> 0
                ]);
        }

        $log = 'Menu has been deleted by '.  Auth::user()->name;
            $user_id = Auth::user()->id;
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);
       if($findMenu->delete()){
            
            //redirect
            return redirect('/menus')->with('flash_message_success','Menu deleted successfully');

       }
            return redirect('/menus')->with('flash_message_error','Menu could not be deleted');
    }

    public function editContent(Request $request, $id = null){
        if($request->isMethod('post')){
            
            Content::where('id',$id)->update([
                    'title'=>$request->input('title'),
                    'content'=>$request->input('content')
                ]);

             $log = session()->get('name') . ' has updated informations of content';
             $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

            
            return redirect('/contents')->with('flash_message_success','Content Information updated successfully');
            
        }
        
        $ContentDetails = Content::where(['id'=>$id])->first();
        return view('admin.edit_content')->with(compact('ContentDetails'));
    }

    public function deleteContent(Request $request,$id = null){
        $findContent = Content::where('id',$id)->get()->first();
        

        $log = 'Content has been deleted by '.  session()->get('name');
            $user_id = session()->get('user_id');
                Log::create([
                    'user_id' => $user_id,
                    'log' => $log
                ]);

       if($findContent->delete()){
            //redirect
            return back()->with('flash_message_success','Content deleted successfully');
       }else{
            return back()->with('flash_message_failed','Content cannot be deleted');
       }
    }

    public function page(Request $request, $id = null)
    {
        if(Auth::user()->user_level == 'Admin'){
            if($request->isMethod('post')){
                if($request->hasFile('logo')){
                    // $logo = $request->file('logo');

                    $logo = Input::file('logo');
                
                        $extension = $logo->getClientOriginalExtension();
                        $logoname = rand(111,99999). '.' . $extension;
                        $logo_path = 'LTE/dist/img/page/' . $logoname;
                        Image::make($logo)->save($logo_path);
                    Page::where('id',$id)->update([
                        'logo'=> $logoname
                    ]); 

                }

                if($request->hasFile('bg1')){
                    $bg1 = Input::file('bg1');
                
                        $extension = $bg1->getClientOriginalExtension();
                        $bg1name = rand(111,99999). '.' . $extension;
                        $bg1_path = 'LTE/dist/img/page/' . $bg1name;
                        Image::make($bg1)->save($bg1_path);

                    Page::where('id',$id)->update([
                        'background1'=> $bg1name
                    ]);
                }

                if($request->hasFile('bg2')){
                    $bg2 = Input::file('bg2');
                
                        $extension = $bg2->getClientOriginalExtension();
                        $bg2name = rand(111,99999). '.' . $extension;
                        $bg2_path = 'LTE/dist/img/page/' . $bg2name;
                        Image::make($bg2)->save($bg2_path);

                    Page::where('id',$id)->update([
                        'background2'=> $bg2name
                    ]);
                }

                if($request->hasFile('bg3')){
                    $bg3 = Input::file('bg3');
                
                        $extension = $bg3->getClientOriginalExtension();
                        $bg3name = rand(111,99999). '.' . $extension;
                        $bg3_path = 'LTE/dist/img/page/' . $bg3name;
                        Image::make($bg3)->save($bg3_path);

                    Page::where('id',$id)->update([
                        'background3'=> $bg3name
                    ]);
                }


                Page::where('id',$id)->update([
                        'header'=>$request->input('header'),
                        'content1' => $request->input('content1'),
                        'content2' => $request->input('content2'),
                        'content3' => $request->input('content3'),
                        'title1' => $request->input('title1'),
                        'title2' => $request->input('title2'),
                        'title3' => $request->input('title3'),
                        'subject1' => $request->input('subject1'),
                        'subject2' => $request->input('subject2'),
                        'subject3' => $request->input('subject3'),
                        'footer'=> $request->input('footer')
                    ]); 

                 $log = session()->get('name') . ' has updated the frontend page';
                 $user_id = session()->get('user_id');
                    Log::create([
                        'user_id' => $user_id,
                        'log' => $log
                    ]);
                return redirect('/page')->with('flash_message_success','Frontend Page updated successfully');   
            }

            $page = Page::all();
            return view('admin.frontend.page')->with(compact('page'));
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
        
    }

    public function newsfeeds(Request $request, $id = null)
    {
        if(Auth::user()->user_level == 'Human Resource'){
            if($request->isMethod('post')){
               
                    Page::where('id',$id)->update([
                        'newsfeeds'=>$request->input('newsfeeds')
                    ]); 

                 $log = session()->get('name') . ' has updated the newsfeeds of the frontend page';
                 $user_id = session()->get('user_id');
                    Log::create([
                        'user_id' => $user_id,
                        'log' => $log
                    ]);
                return redirect('/newsfeeds')->with('flash_message_success','Newsfeeds updated successfully');   
            }

            $page = Page::all();
            return view('admin.frontend.newsfeeds')->with(compact('page'));
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
        
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
