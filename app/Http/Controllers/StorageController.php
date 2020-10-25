<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class StorageController extends Controller
{
    public function index()
    {   
        if(Auth::check()){
            return redirect('storages/'.Auth::id());
        } else {
            return redirect('dashboard');
        }
    }
    
    /**Something here
     * 
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show($u_id)
    {
        $user = User::findOrFail($u_id);
        if($this->oneOrMoreStorage($user)){
            $storage = $this->getStorages($user);
            return view('storages.show',compact('storage'));
            // return Inertia::render('Storage/Show.vue',['storage' => $storage] );
        }else {
            $storages = $this->getStorages($user);
            return view('storages.index',compact('storages'));
            // return Inertia::render('Storage/Index.vue', ['storages' => $storages]);
        }
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function edit(Storage $storage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Storage $storage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storage $storage)
    {
        //
    }

    public function storageCount(User $user) {
        static $count;
        foreach($user->storages as $storage) {
            if(strpos($storage->storage_type,"backup"))
            {$count--;}
            $count++;
        }
        // dd($count);
        return $count;
    }

    public function oneOrMoreStorage(User $user) {
        $count = $this->storageCount($user);
        if($count == 1 ) {
            return true;
        }
        else return false;
    }

    public function getStorages(User $user) {
        static $storages;
        foreach($user->storages as $storage) {
            $storages[] = $storage;
        }
        return $storages;
    }
}
