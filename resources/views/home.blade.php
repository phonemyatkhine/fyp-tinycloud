@extends('layouts.app')

@section('content')
<div class="container">
    @if (isset($storages))
        @foreach ($storages as $key => $storage)
            No.{{$key+1}} <br>
            Storage type = {{$storage->type}} <br>
            Storage folders = <br>
            @foreach ($storage->folders as $folder)
                Folder Name : <a href="{{route('folders.show',$folder->id)}}"> {{$folder->name}}  </a><br>
            @endforeach
            <br>
            Storage Space = {{$storage->total_space}} <br>
            Storage Used Space = {{$storage->used_space}} <br>
            <form action="{{route('folders.create',$storage->id)}}" method="GET">
                <input type="submit" value="Create New Folder">
            </form>
        @endforeach
    @endif
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
