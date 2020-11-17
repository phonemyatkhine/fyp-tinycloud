@extends('layouts.app')
@section('content')
    <div class="col-lg-6 column cover-left">
        <h3>Secure Cloud Storage for your data.</h3>
        <p>File storage and sharing made easy.</p>
        <a href="{{url('looco')}}">
            <button type="button" class="btn btn-primary start-btn">Get Started</button>
        </a>
    </div>
    <div class="col-lg-6">
        <img src="{{asset('img/maincover.png')}}" alt="" class="cover">
    </div>
@endsection