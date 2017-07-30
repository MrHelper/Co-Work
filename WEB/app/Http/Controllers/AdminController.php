<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    public function AddEvent(Request $request){
    	$InputFile ="";
    	if ($request->hasFile('Images')) {
    		$upfile = $request->file('Images');
    		$fName = date("Ymdhis")."_".$upfile->getClientOriginalName();
			$path = Storage::putFileAs('public/images', $upfile, $fName);
			$url = Storage::url($path);
			$link = asset($path);
			$lPath = asset($url);
		    $InputFile = $path;
		}
    	$id = Event::create([
    		'Title'=>$request->input('Title'), 
	    	'Description'=>$request->input('Description'), 
	    	'Image'=>$InputFile, 
	    	'Link'=>$request->input('Facebook'),
    		])->id;
    	return response()->json(['mess'=>'Success','id'=>$id,200]);
    }

    public function EditEvent(Request $request){
    	$ID = $request->input('id');
    	$InputFile ="";
    	if ($request->hasFile('Images')) {
    		$upfile = $request->file('Images');
    		$fName = date("Ymdhis")."_".$upfile->getClientOriginalName();
			$path = Storage::putFileAs('public/images', $upfile, $fName);
			$url = Storage::url($path);
			$link = asset($path);
			$lPath = asset($url);
		    $InputFile = $path;
    		Event::find($ID)->update([
	    		'Title'=>$request->input('Title'), 
		    	'Description'=>$request->input('Description'), 
		    	'Image'=>$InputFile, 
		    	'Link'=>$request->input('Facebook'),
    		]);
    	}else{
    		Event::find($ID)->update([
	    		'Title'=>$request->input('Title'), 
		    	'Description'=>$request->input('Description'), 
		    	'Link'=>$request->input('Facebook'),
    		]);
    	}
    	return response()->json(['mess'=>'Success',200]);
    }

    public function DeleteEvent(Request $request){
    	$ID = $request->input('id');
    	Event::find($ID)->delete();
    	return response()->json(['mess'=>'successful',200]);
    }

    public function ListEvent(){
    	$LEvent = Event::get();
        return view('adminevent')->with(['LEvent'=>$LEvent]);
    }
}
