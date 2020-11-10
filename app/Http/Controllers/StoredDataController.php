<?php

namespace App\Http\Controllers;

use App\Models\StoredData;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\File;

class StoredDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$mainFolderName = md5((Str::of(Auth::user()->name)->replace(' ','')->lower()).Auth::id());
        $file = $request->uploaded_file;
        $folder = Folder::find($request->folder_id);
        $name = $request->uploaded_file->getClientOriginalName();
        $storageName = session('storage')->path;
        //dd($storageName);
        
        $data = new StoredData;
        $data->folder_id = $folder->id;
        $data->name = $name;
        if ($request->hasFile('uploaded_file')) {
            $extension = $request->uploaded_file->extension();
            $data->type = $extension;
            $data->size = \File::size($file);
            $data->save();
            Storage::disk('ftp')->put('tinycloud/'.$storageName, $file);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoredData  $storedData
     * @return \Illuminate\Http\Response
     */
    public function show(StoredData $storedData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoredData  $storedData
     * @return \Illuminate\Http\Response
     */
    public function edit(StoredData $storedData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoredData  $storedData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoredData $storedData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoredData  $storedData
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoredData $storedData)
    {
        //
    }
}
