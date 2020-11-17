<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $folders = Folder::all();
        return $folder;   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Storage $storage)
    {
        session(['storage' => $storage]);
        return view('folders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storage = session('storage');
        $attributes = $request->validate([
            'name'   =>  ['required','string'],
            'privacy'   => ['required']
        ]);
        $attributes['storage_id'] = $storage->id;
        $path = md5($request->name.'_u'.Auth::id().'_t'.time().'_d'.date('dmyy'));
        $attributes['path'] = $storage->path.'/'.$path;
        $folder = Folder::create($attributes);
        return \redirect()->route('storages.index')->with('success','Folder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        return view('folders.show',compact('folder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        return view('folders.edit',compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        $attributes = $request()->validate([
            'storage_id' =>  ['required','integer'],
            'name'   =>  ['required','string'],
            'path'  =>  ['required','string'],
            'privacy'   => ['required']
        ]);
        $folder->storage_id = $attributes['storage_id'];
        $folder->name = $attributes['name'];
        $folder->path = $attributes['path'];
        $folder->privacy = $attributes['privacy'];
        return \redirect()->route('folders.index')->with('success','Folder created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        $folder->delete();
    }
    public function indexFoldersOfStorage(Storage $storage)
    {
        dd($storage->folders);
    }
    public function createFolderOfStorage(Storage $storage) 
    {

    }
}
