<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class StorageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index()
    {   
        if(Auth::check()){
            $user = Auth::user();
            $storages = $this->getPrimaryStorages($user);
            if($this->oneOrMoreStorage($user)){
                return redirect('storages/'.$storages[0]->id);
            } else {
                $storages = $this->getPrimaryStorages($user);
                return view('storages.index',compact('storages'));
            }
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show(Storage $storage)
    {
        static $stored_data;
        $user = Auth::user();
        if($this->authorize('view',$storage)) {
            session(['storage'=>$storage]);
            // dd(session('storage'));
            $folders = $storage->folders;
            foreach($folders as $folder ) {
                $stored_data[] = $folder->stored_data;
            }
            $free_space = $storage->total_space - $storage->used_space;
            $chart_data =[
                ['Space','Number'],
                ['Free Space in MB' , round($free_space/1048576,2)],
                ['Used Space in MB' , round($storage->used_space/1048576,2)]
            ];
            $chart_data = json_encode($chart_data);
            session(['chart_data'=>$chart_data]);
            // return($chart_data);
            // dd($stored_data);
            return view('storages.show',compact('storage','chart_data'));
        } else {
            dd("dont view");
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
            if($storage->type == "backup"){
                $count--;
            }
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

    public function getAllStorages(User $user) {
        static $storages;
        foreach($user->storages as $storage) {
            $storages[] = $storage;
        }
        return $storages;
    }
    public function getPrimaryStorages(User $user) {
        static $storages;
        foreach($user->storages as $storage) {
            if($storage->type == "primary") {
                $storages[] = $storage;
            }
        }
        return $storages;
    }
    public function storageDashboard(){
        $storage = session('storage');
        $chart_data = session('chart_data');
        return view('storages.dashboard',compact('storage','chart_data'));
    }
}
