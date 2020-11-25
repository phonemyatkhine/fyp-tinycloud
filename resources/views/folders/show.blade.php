@extends('layouts.app')
@section('content')
        Folder Name : {{$folder->name}} <br>
        Folder Items : 
        @foreach ($folder->stored_data as $stored_data)
        {{-- {{$stored_data->id}} --}}
        <div>
            <a href="ftp://192.168.100.8/{{$stored_data->path}}">{{$stored_data->name}}</a> 
            <form action="{{route('data.destroy',$stored_data->id)}}" method="POST">
                @method("DELETE")
                @csrf
                <input type="submit" name="" value="Delete" id="">
            </form>
        </div>
        @endforeach <br>
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