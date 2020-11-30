@extends('storages.show')
@section('storages-right-css')
    
@endsection
@section('storages-right')
   
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if (isset($trashedData))
        @foreach ($trashedData as $data)
        <div class="row">
            <p style="width:60%;">
                {{$data->name}}
            </p>
            <p style="width: 15%; background-color:white; padding-left:10px;">
                {{round($data->size/1048576,2)}} MB
            </p>
            <form action="{{route('recover.one',$data->id)}}" method="POST">
                @csrf
                <input type="submit" value="Recover" class="btn btn-primary">
            </form>
            <form action="{{route('recover.delete',$data->id)}}" method="POST">
                @csrf
                @method("DELETE")
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
        @endforeach
        <form action="{{route('recover.delete.all')}}" method="POST">
            @csrf
            @method("DELETE")
            <input type="submit" value="Delete All" class="btn btn-danger">
        </form>
    @elseif(!isset($trashedData))
        <div>NO FILES TO RECOVER</div>
    @endif
    
@endsection