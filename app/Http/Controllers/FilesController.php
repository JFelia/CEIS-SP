<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class FilesController extends Controller
{
    
    public function index()
    {
        if(Auth::user()->user_level == 'Admin' || Auth::user()->user_level == 'Human Resource'){
            $files = File::orderBy('created_at','DESC')->get()->all();
            return view('admin.file.index', ['files' => $files]);
        }else{
            return redirect('/admin/dashboard')->with('flash_message_error','The Page you are accessing is Restricted');
        }
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $files = $request->file('resume');
        
            if($files){
                $avatar = Input::file('resume');
                $extension = $avatar->getClientOriginalExtension();
                if($extension == "docx" || $extension == "pdf"){
                    $validator=Validator::make($request->all(),[
                        'name' => 'required',
                        'job' => 'required',
                        'resume' => 'required|max:2048' 
                    ]);

                    if($validator->fails()){
                        \Session::flash('flash_message_error','Please enter the required details');
                        return Redirect::to('/greymouse')->withInput()->withErrors($validator);
                    }

                    File::create([
                            'name' => $request->input('name'),
                            'job' => $request->input('job'),
                            'filename' => $files->getClientOriginalName(),
                            'filepath' => $files->store('upload')
                        ]);

                    return redirect('/greymouse')->with('flash_message_success','Successfully submitted your resume');
                }else{
                    return redirect('/greymouse')->with('flash_message_error','Sorry, only docx file is allowed');
                }
            }else{
                return redirect('/greymouse')->with('flash_message_error','Please select file to be uploaded');
            }
    }

    
    public function show($id)
    {
        $dl = File::find($id);
        return Storage::download($dl->filepath, $dl->filename);

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
        $file = File::find($id);
        if(Storage::delete($file->filepath)){
            $file->delete();

            return back()->with('flash_message_success','Successfully deleted the file');
        }
    }
}
