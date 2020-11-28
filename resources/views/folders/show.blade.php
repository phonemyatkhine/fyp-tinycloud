@extends('storages.show')
@section('storages-right-css')
    <style>
        .top-button {
            border: 0.5px solid #F5F5F5;
            border-radius: 50%;
            height:40px;
            width:40px;
            margin:10px 0px 10px 10px; 
        }
        .top-button-div {
            padding-left : 400px;
        }
    </style>
@endsection
@section('storages-right')
<div style="float: right;">
    <div class="top-button-div">
        <a href="{{route('folders.create')}}" >
            <button class="top-button material-icons">
                edit
            </button>
        </a>
        <a href="">
            <button  class="top-button material-icons">
                delete_forever
            </button>
        </a>
        <a href="">
            <button  class="top-button material-icons">
                group_add
            </button>
        </a>
        <a href="">
            <button  class="top-button material-icons">
                info
            </button>
        </a>
    </div>
    @php
        static $size;
        foreach($folder->stored_data as $data){
            $size = $data->size + $size;
        }
        $size = round($size/1048576,2);
    @endphp

    <div class="folder">
        <h5>Folder Name : {{$folder->name}} </h5>
        <p>Items : {{count($folder->stored_data)}}</p>
        <p>Folder size : {{$size}} MB</p>
        Items : <br> <br>
        @foreach ($folder->stored_data as $key => $data)
            {{$key+1}}. {{$data->name}} , {{round($data->size/1048576,2)}} MB <br> <br>
        @endforeach
    </div>
</div>

<br><br><br><br><br>
        Folder Name : {{$folder->name}} <br>
        Folder Items : 
        @foreach ($folder->stored_data as $stored_data)
        {{-- {{$stored_data->id}} --}}
        <div>
            <a href="{{route('download',$stored_data->id)}}">{{$stored_data->name}}</a> <br>
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