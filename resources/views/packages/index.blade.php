@extends('layouts.app')
@section('css')
    <style>
        .package{
            width: 30%;
            height: 85%;
            border: 0.5px solid #E0E0E0;
            float: left;
            margin-left: 40px;
        }
        .package>h2{
            color: #2577FF;
            padding: 50px 0px 20px 50px;
        }
        .package>h3 {
            padding: 10px 0px 20px 50px;
        }
        .package>p {
            padding: 20px 50px 20px 50px;
            text-align: justify;
        }
        .package>ul>li{
            margin-left: 30px;
            padding-right: 40px;
        }
        .package>ul {
        list-style: none;
        }

        .package>ul  li::before {
        content: "\2022";
        color: #2577FF;
        font-weight: bold;
        display: inline-block; 
        width: 1em;
        margin-left: -1em;
        }
        .package-head{
            padding: 10px 20px 20px 60px;
        }
        .package>a>button{
            all: unset;
            width:100%;
            height: 14%;
            background-color: #E0E0E0;
            text-align: center;
            color: #2577FF;
        }
    </style>
@endsection
@section('content')
    <h2 class="package-head">Grab More Storage</h2>
    @if(session()->has('warning'))
            <div class="alert alert-warning">
                {{ session()->get('warning') }}
            </div>
        @endif
    <div class="row" style="width: 100%;padding-left:35px; height:100%;">
        @isset($packages)
            @foreach ($packages as $package)
                <div class="package">
                    <h2>{{$package->name}}</h2>
                    <h3>$ {{$package->price}} /month</h3>
                    <p>{{$package->details}}</p>
                    <ul> Includes
                        <li>{{round($package->additional_space/1073741274,2)}} GB of Addtional Space</li>
                        <li>More features to be added in later versions.</li>
                    </ul>
                    <a href="{{route('package.buy',$package->id)}}">
                        <button>
                            Buy Now
                        </button>
                    </a>
                </div>
            @endforeach
        @endisset
        
    </div>
@endsection