<?php

namespace App\Http\Controllers;

use App\Models\Collaborators;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollaboratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collaborators = Collaborators::all();
        return $collaborators;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Folder $folder)
    {   
        // dd($folder);
        $storage = session('storage');
        $chart_data = session('chart_data');
        return view('collaborators.create',compact('folder','storage','chart_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'folder_id' =>  ['required','integer'],
            'user_email'   =>  ['required','email'],
        ]);
        $user = User::where('email',$attributes['user_email'])->first();
        if(Auth::user()->email == $attributes['user_email']) {
            return \redirect()->route('folders.show.collaborators.index',$attributes['folder_id'])->with('warning','You cannot invite yourself to folder you own.');
        }
        if(empty($user)) {
            return \redirect()->route('folders.show.collaborators.index',$attributes['folder_id'])->with('error','There is no account on the system with '.$attributes['user_email']);
        } else {
            $collaborator = new Collaborators;
            $collaborator->folder_id = $attributes['folder_id'];
            // dd($user);
            $collaborator->user_id = $user->id;
            $collaborator->verified = false;
            $collaborator->save();
            return \redirect()->route('folders.show.collaborators.index',$attributes['folder_id'])->with('success','Collaborating asked for '.$attributes['user_email'].'. Wait for verification by them.');
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collaborators  $collaborators
     * @return \Illuminate\Http\Response
     */
    public function show(Collaborators $collaborators)
    {
        return view('collaborators.show',compact($collaborators));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collaborators  $collaborators
     * @return \Illuminate\Http\Response
     */
    public function edit(Collaborators $collaborators)
    {
        return view('collaborators.edit',compact($collaborators));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collaborators  $collaborators
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collaborators $collaborators)
    {
        $attributes = $request()->validate([
            'folder_id' =>  ['required','integer'],
            'user_id'   =>  ['required','integer'],
        ]);
        $collaborators->folder_id = $attributes['folder_id'];
        $collaborators->user_id = $attributes['user_id'];
    }

    public function folderCollaboratorsIndex(Folder $folder) 
    {
        $collaborators = $folder->collaborators;
        $storage = session('storage');
        $chart_data = session('chart_data');
        if(isset($storage)&& isset($chart_data)){
            return view('collaborators.index',compact("collaborators","storage","chart_data","folder"));
        } else {
            return redirect()->route('storages.index');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collaborators  $collaborators
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collaborators $collaborator)
    {
        // dd($collaborator);
        $collaborator->delete();
        return redirect()->route('folders.show.collaborators.index',$collaborator->folder_id);
    }
}
