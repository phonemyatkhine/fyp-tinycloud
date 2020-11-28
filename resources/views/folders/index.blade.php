@extends('storages.show')
@section('storages-right-css')
    <style>
       .folder-card{
        float: left;
        border: 0.5px solid #E0E0E0;
        border-radius: 10px;
        padding: 10px;
        margin: 0px 20px 10px -10px;
        width: 200px;
       }
       .folder-card-header {
        background: #F5F5F5;
        width: 200px;
        margin: -10px -11px -11px -11px;
        padding: 10px;
        border: 0.5px solid #E0E0E0;
        border-top: 0px;
        color: #707070;
        border-top-right-radius: 10px; 
        border-top-left-radius: 10px;
       }
       h5>.material-icons {
        color: #2172FF;
       }
       .folder-card-content {
        margin: 20px 20px 0px 20px;
        color: #707070;
       }
       .top-button {
        border: 0.5px solid #F5F5F5;
        border-radius: 50%;
        height:40px;
        width:40px;
        margin:10px 0px 10px 10px; 
       }
       .card-parent{
           padding-left: 10px;
           overflow-y:scroll;
           height: 600px;
       }
    </style>
@endsection
@section('storages-right')
    <div style="align-items: flex-end; float: right;">
        <a href="{{route('folders.create')}}" >
            <button class="top-button material-icons">
                create_new_folder
            </button>
        </a>
        <a href="">
            <button  class="top-button">
                <i class="material-icons">info</i>
            </button>
        </a>
    </div>
    <div class="card-parent">
        {{-- @dd($folders) --}}
        @foreach ($folders as $folder)
        <a href="{{route('folders.show',$folder->id)}}">
            <div class="folder-card card">
                <h5 class="folder-card-header">
                    <i class="material-icons">folder</i>  {{$folder->name}}
                </h5>
                <div class="folder-card-content">
                    Items : {{count($folder->stored_data)}} <br>
                    Privacy : {{$folder->privacy}}
                </div>   
            </div>
        </a>
        @endforeach
    </div>
{{--    
    <button><a href="{{route('folders.create',$storage->id)}}">Create Folder</a></button>
    <button><a href="{{route('recover.index',$storage->id)}}">Recover Files</a></button> --}}
@endsection