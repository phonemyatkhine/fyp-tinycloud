@extends('layouts.app')
@section('css')
<style> 
    .public-folder{
        padding:50px;
        padding-left: 200px;
        width: 100%;
        border: 1px solid #E0E0E0;
        border-radius: 20px;
        margin:30px 80px 80px 80px;
        overflow-y:scroll;
    }
</style>
@endsection

@section('content')
<div class="public-folder">
    @php
        static $size;
        foreach($folder->stored_data as $data){
            $size = $data->size + $size;
        }
        $size = round($size/1048576,2);
    @endphp
    <h5 style="color: #2172FF;">Folder Name : {{$folder->name}} </h5>
    <div class="folder-contents">
        <p>Items : {{count($folder->stored_data)}}</p>
        <input type="hidden" name="" id="folder-privacy" value="{{$folder->privacy}}">
        <p>Privacy : {{$folder->privacy}}</p>
        <p>Folder size : {{$size}} MB</p>
        <p>Owner : {{$folder->user->name}}</p>
        <p>Owner Email : {{$folder->user->email}}</p>
        Items :
        <div class="items">
            @foreach ($folder->stored_data as $key => $data)
            <div class="row item">
                <p style="width: 70%">
                    <a href="{{route('download',$data->id)}}">{{$data->name}}</a>
                </p>
                <p style="width : 20%;background-color:white;">
                    {{round($data->size/1048576,2)}} MB
                </p>
            </div>
            @endforeach
        </div>
    </div> 
</div>
@endsection