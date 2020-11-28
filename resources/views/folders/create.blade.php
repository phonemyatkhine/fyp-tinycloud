@extends('layouts.app')
@section('content')

        <form action="{{route('folders.store')}}" method="POST">
            @csrf
            Name : <input type="text" name="name"> <br>
            Privacy : 
            <select name="privacy" id="">
                <option value="Private">Private</option>
                <option value="Public">Public</option>
            </select> <br>
            <input type="submit" name="submit" value="Create Folder" id="">
        </form>

@endsection