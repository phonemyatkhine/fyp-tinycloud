@extends('layouts.app')
@section('content')
        Folder Name : {{$folder->name}} <br>
        Folder Items : {{$folder->stored_data}} <br>
        Folder Privacy : {{$folder->privacy}}  <br>
        Delete Folder : 
        <form action="{{route('folders.destroy',$folder->id)}}" method="POST">
            @csrf
            @method("DELETE")
            {{-- <input type="hidden" name="folder_id" value="{{$folder->id}}" id=""> --}}
            <input type="submit" value="Delete" id="">
        </form>
        Add Data : 
        <form action="{{route('data.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="uploaded_file"> <br>
            <input type="hidden" name="folder_id" value="{{$folder->id}}">
            <input type="submit" name="" value="upload">
        </form>
@endsection