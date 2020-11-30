<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Folder;

class PublicController extends Controller
{
    public function publicShare($stoarge,$folder) 
    {
        $folder = Folder::where('path',$stoarge.'/'.$folder)->first();
        if($folder->privacy == "Private") {
            return abort('403');
        } else {
            return view('folders.public',compact("folder"));
        }
    }
}
