@extends('storages.show')
@section('css-right')
    <style>
       
    </style>
@endsection
@section('storages-right')
    @foreach ($storage->folders as $folder)
        Folder Name : <a href="{{route('folders.show',$folder->id)}}"> {{$folder->name}}  </a><br>
    @endforeach
    <br>
    @php
        $total_space_mb = $storage->total_space/1048576;
        $used_space_mb = $storage->used_space/1048576;
    @endphp
    Storage Space = {{round($total_space_mb,2)}} MB<br>
    Storage Used Space = {{round($used_space_mb,2)}} MB <br>
    <button><a href="{{route('folders.create',$storage->id)}}">Create Folder</a></button>
    <button><a href="{{route('recover.index',$storage->id)}}">Recover Files</a></button>
@endsection