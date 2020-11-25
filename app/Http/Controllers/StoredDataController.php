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
        //prepare require attributes
        $file = $request->uploaded_file;
        $folder = Folder::find($request->folder_id);
        $name = $request->uploaded_file->getClientOriginalName();
        // dd(session('storage'));
        $storageName = session('storage')->path;
        $storage = session('storage');
        //eloquent model for data
        $data = new StoredData;
        $data->folder_id = $folder->id;
        $data->name = $name;
        
        $conn_id = $this->ftpConnect();
        
        if ($request->hasFile('uploaded_file')) {

            $extension = $request->uploaded_file->extension();
            $data->type = $extension;
            $data->size = \File::size($file);
            $storage->used_space = $storage->used_space + $data->size;
            $storage->save();
            $storage_folder = $storageName.'/'.$folder->name; //where file will be stored. used for creating folders with ftp
            $data->path = '/'.$storage_folder.'/'.$file->getClientOriginalName();
            // try to login
            if ($this->ftpLogin($conn_id)) {
                //  echo( "Connected as $ftp_user@$ftp_server\n");
                if(!@ftp_chdir($conn_id,$storage_folder)) {
                    $parts = explode('/',$storage_folder);
                    foreach($parts as $part) {
                        if(!@ftp_chdir($conn_id,$part)) {   
                            @ftp_mkdir($conn_id,$part);
                            @ftp_chdir($conn_id,$part);
                        }
                    }  
                } 
                //ftp change dir to root and put the file in the desired directory
                if(@ftp_chdir($conn_id,'/')){
                    // ftp_put($conn_id,'/'.$storage_folder.'/'.$file->getClientOriginalName(),$file->path());
                    ftp_put($conn_id,'/'.$storage_folder.'/'.$file->getClientOriginalName(),$file->path());

                }    
            } else {
                dd("Couldn't connect as $ftp_user\n");
            }
            $data->save();
            return redirect()->route('folders.show',$folder->id);
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
    public function destroy(StoredData $data)
    {  
        $data->delete();
        return redirect()->route('folders.show',$data->folder_id)->with('success','Data Deleted');
    }

    public function ftpConnect() 
    {
        $ftp_server =  env('FTP_HOST_2');
        $ftp_port = env('FTP_PORT');
        // set up a connection or die
        ftp_connect($ftp_server,$ftp_port) or die("Couldn't connect to $ftp_server"); 
        return ftp_connect($ftp_server,$ftp_port);
    }
    public function ftpLogin($conn_id)
    {
        $ftp_user = env('FTP_USERNAME');
        $ftp_pass = env('FTP_PASSWORD');
        return ftp_login($conn_id, $ftp_user, $ftp_pass);

    }

    public function recoverIndex()
    {
        static $trashedData;
        $storage = session('storage');
        $chart_data = session('chart_data');
        $allTrashedData = StoredData::onlyTrashed()->get();
        foreach ($allTrashedData as $key => $data) {
            if(Auth::user()->can('view',$data)) {
                $trashedData[] = $data;
            }
        }
        return view('recover.index',compact('trashedData','storage','chart_data'));
    }
    
    public function recoverOne($id) 
    {   
        $storage = session('storage');
        $chart_data = session('chart_data');
       $data = StoredData::withTrashed()->find($id);
       $data->restore();
       return back()->with('success','Data Fully Recover');
    }

    public function recoverDelete($id)
    {
        $storage = session('storage');
        $chart_data = session('chart_data');
        $data = StoredData::withTrashed()->find($id);
        $conn_id = $this->ftpConnect();
        if($this->ftpLogin($conn_id)){
            \ftp_delete($conn_id,$data->path);
            $storage = $data->storage;
            $storage->used_space = $storage->used_space - $data->size;
            $storage->save();
            $data->forceDelete();
        }
        return back()->with('success','Data Deleted');

    }

    public function deleteAll()
    {
        $storage = session('storage');
        $chart_data = session('chart_data');
        $allTrashedData = StoredData::onlyTrashed()->get();
        foreach ($allTrashedData as $key => $data) {
            if(Auth::user()->can('view',$data)) {
                $conn_id = $this->ftpConnect();
                if($this->ftpLogin($conn_id)){
                    \ftp_delete($conn_id,$data->path);
                    $storage = $data->storage;
                    $storage->used_space = $storage->used_space - $data->size;
                    $storage->save();
                    $data->forceDelete();
                }
            }
        }
        return back()->with('success','All Data Deleted');
    }
    public function raid10Store($request,$storageName,$folder) {
        $file = $request->uploaded_file;
        $ftp_server =  env('FTP_HOST_2');
        $ftp_user = env('FTP_USERNAME');
        $ftp_pass = env('FTP_PASSWORD');
        $ftp_port = env('FTP_PORT');


        $conn_id = ftp_connect($ftp_server,$ftp_port) or die("Couldn't connect to $ftp_server"); 
        ftp_pasv($conn_id, true);
        
        if ($request->hasFile('uploaded_file')) {

            $extension = $request->uploaded_file->extension();

            $storage_folder = $storageName.'/'.$folder->name; //where file will be stored. used for creating folders with ftp
            // try to login
            if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
                 echo( "Connected as $ftp_user@$ftp_server\n");
                if(!@ftp_chdir($conn_id,$storage_folder)) {
                    $parts = explode('/',$storage_folder);
                    foreach($parts as $part) {
                        if(!@ftp_chdir($conn_id,$part)) {   
                            @ftp_mkdir($conn_id,$part);
                            @ftp_chdir($conn_id,$part);
                        }
                    }  
                } 
                //ftp change dir to root and put the file in the desired directory
                if(@ftp_chdir($conn_id,'/')){
                    // ftp_put($conn_id,'/'.$storage_folder.'/'.$file->getClientOriginalName(),$file->path());
                    ftp_put($conn_id,'/'.$storage_folder.'/'.$file->getClientOriginalName(),$file->path());

                }    
            } else {
                dd("Couldn't connect as $ftp_user\n");
            }
            return redirect()->route('folders.show',$folder->id);
        }
    }

}
