@extends('storages.show')
@section('storages-right-css')
    
@endsection
@section('storages-right')
    <form action="{{route('recover.delete.all')}}" method="POST">
        @csrf
        @method("DELETE")
        <input type="submit" value="Delete All">
    </form>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if (isset($trashedData))
        @foreach ($trashedData as $data)
        <div style="padding-left: 50px">
            {{$data->name}} <br>
            {{$data->size}} <br>
            <form action="{{route('recover.one',$data->id)}}" method="POST">
                @csrf
                <input type="submit" value="Recover">
            </form>
            <form action="{{route('recover.delete',$data->id)}}" method="POST">
                @csrf
                @method("DELETE")
                <input type="submit" value="Delete">
            </form>
        </div>
        @endforeach
    @elseif(!isset($trashedData))
        <div>NO FILES TO RECOVER</div>
    @endif
    
@endsection