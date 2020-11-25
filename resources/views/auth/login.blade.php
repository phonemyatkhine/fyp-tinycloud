@extends('layouts.app')
@section('css')
    <style>
        @media only screen and (min-width: 600px) {
            .main-left {
                text-align: center;
                padding : 250px 0px 100px 0px;
                padding-left: 20%;
            }
            .main-left>h1 {
                font-size: 50px;
                color: white;
            }
            .main-left>h1>span {
                display:inline-block;
                border-bottom:4px solid white;
                margin-left: 20%;
                width: 25%;
            }
            .main-left>h1>p {
                margin-bottom: -15px;
            }
            .form {
                margin: 50px 250px 100px 20px;
            }
            .input-box {
                border-radius: 0;
                padding: 25px;
                margin: 15px;
                width: 68%;
            }
            .input-btn {
                all :unset;
                border: 1px solid white;
                background-color: white;
                color :#1577FF;
                border-radius: 0;
                padding: 15px;
                margin: 10px;
                width: 61%;
                text-align: center;
            }
        }
        @media only screen and (max-width:600px) {
            .main-left {
                /* text-align: left; */
                padding : 20px 0px 20px 50px;
                /* padding-left: 20%; */
            }
            .main-left>h1 {
                font-size: 25px;
                color: white;
            }
            .main-left>h1>span {
                display:inline-block;
                border-bottom:4px solid white;
                /* margin-left: 20%; */
                width: 25%;
            }
            .main-left>h1>p {
                margin-bottom: -15px;
            }
            .form {
                margin: 0px 0px 0px 50px;
            }
            .input-box {
                border-radius: 0;
                padding: 25px;
                margin: 15px;
                width: 85%;
            }
            .input-btn {
                all :unset;
                border: 1px solid white;
                background-color: white;
                color :#1577FF;
                border-radius: 0;
                padding: 15px;
                margin: 10px;
                width: 78%;
                text-align: center;
            }
        }
        .main {
            background-color: #1577FF;
            width: 100%;
            margin-right: 0px;
        }
        form>p {
            padding-left: 15px;
            color: white;
        }
        .google-img {
            width: 30px;
            height: 30px;
        }
    </style>
@endsection

@section('content')
<div class="main row">
    <div class="col-lg-6 col-xs-12 main-left">
        <h1> 
            <p style="padding-left: 60px">Login</p>
            <span></span>
        </h1>
    </div>
    <div class="col-lg-6 col-xs-12">
        <div class="form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="text" placeholder="Email" class="form-control input-box @error('email') is-invalid @enderror" name="email" required>
                <input type="password" placeholder="Password" class="form-control input-box @error('password') is-invalid @enderror" name="password" required>
                <p>This page is protected by reCAPTCHA, and subject to the
                    Google Privacy Policy and Terms of service.</p>
                <input type="submit" name="" id="" value="Login" class="input-btn">
            </form>
            <a href="{{route('register')}}">
                <button name="" id="" class="input-btn"> Register </button>
            </a>
            <a href="{{route('login.with.google')}}">
                <button name="" id="" class="input-btn"> 
                    <img src="{{asset('img/googleicon.png')}}" alt="" class="google-img">
                    Login with Google
                </button>
            </a>
        </div>
    </div>
</div>
@endsection
