<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tiny Cloud</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js">
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <style>
           @media only screen and (min-width: 600px) {
                .nav-item{
                    margin: 1em 2em 1em 2em;
                }
                .cover {
                    width: 600px;
                    height: 600px;
                    /* margin-top: -50px; */
                    margin-left: -60px;
                    /* padding: -100px; */
                }
                .cover-left{
                    padding: 200px;
                    padding-left : 120px;
                }
                .navbar {
                    padding-left:80px;
                }
                .navbar-nav>a>span {
                    display:inline-block;
                    border-bottom:2px solid #1577FF;
                    padding-bottom:2px; 
                    width: 90%;
                }
                .dropdown {
                    margin-left: 30%;
                }
               
           } 
           @media only screen and (max-width: 600px) {
                .cover {
                    width: 300px;
                    height: 300px;
                    /* margin-top: -100px; */
                    margin-left: 60px;
                    /* padding: -100px; */
                }
                .cover-left{
                    padding: 50px;
                }
                .footer {
                    margin-left:-50px;
                    color: #757575;
                    
                }
                .footer>p{
                    font-size: 10px;
                }
                .navbar-nav>a>span {
                    display:inline-block;
                    border-bottom:2px solid #1577FF;
                    padding-bottom:2px; 
                    width: 8%;
                }
                .dropdown {
                    margin-left: -15px;
                }
           }
           /* .active {
                text-decoration: underline;
                text-decoration-color: red;
           } */
           .font {
               font-family: poppins;
           }
           .navbar-brand {
               font-size: 1.5em;
           }
           
           .start-btn {
               padding: 20px 50px 20px 50px;
               border-radius: 0;
               background-color: #1577FF;
           }
           .navbar-toggler {
              border: 0px;
           }
           .footer {
            /* width: 100%; 
            height: 50px;  */
            padding-left:80px;
            color: #757575;
           }
           .footer>p{
               padding: 10px 20px 10px 20px;
           }
            html, body {
                height: 100%;
                width: 100%;
                overflow-x: hidden;
                margin-right: 0px;
            }
            body {
                display: flex;
                flex-direction: column;
            }
            .content {
                height: 100%;
            }
            .footer {
                flex-shrink: 0;
            }
            .dropdown>a{
                color:black;
            }
        </style>
        @yield('css')
    </head>
    <body class="font">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="{{ route('welcome') }}">Tiny Cloud</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @if (Auth::user())
                        <a class="nav-item nav-link {{ request()->is('/') ? 'active' :  ' ' }}" href="{{route('welcome')}}">
                            @if(request()->is('/'))
                                <span class="nav-underline">  Home </span><span class="sr-only">(current)</span>
                            @else Home
                            @endif
                        </a>
                        <a class="nav-item nav-link {{ request()->is('storages*') ? ' active' :  ' ' }}" href="{{route('storages.index')}}">
                            @if(request()->is('storages*')) 
                                <span class="nav-underline"> Storages </span> 
                            @else Storages
                            @endif
                        </a>
                        <a class="nav-item nav-link {{ request()->is('packages*') ? ' active' :  ' ' }}" href="{{route('packages.index')}}">
                            @if(request()->is('packages')) 
                                <span class="nav-underline"> Packages </span> 
                            @else Packages
                            @endif
                        </a>
                        <a class="nav-item nav-link" href="#">Help</a>
                    @elseif(!Auth::user())
                        <a class="nav-item nav-link {{ request()->is('/') ? 'active' :  ' ' }}" href="{{route('welcome')}}">
                            @if(request()->is('/'))
                                <span class="nav-underline">  Home </span><span class="sr-only">(current)</span>
                            @else Home
                            @endif
                        </a>
                        <a class="nav-item nav-link" href="#">Features</a>
                        <a class="nav-item nav-link {{ request()->is('packages*') ? ' active' :  ' ' }}" href="{{route('packages.index')}}">
                            @if(request()->is('packages')) 
                                <span class="nav-underline"> Packages </span> 
                            @else Packages
                            @endif
                        </a>
                        <a class="nav-item nav-link" href="#">About</a> 
                        <a href="{{route('login')}}" class="nav-item nav-link">Login</a>
                    @endif 
                </div>
                @if (Auth::user())
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{Auth::user()->email}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('profile')}}">Profile</a>
                        <a class="dropdown-item" href="{{route('payment.index')}}">Payment Records</a>
                        <form action="{{route('logout')}}" class="dropdown-item" method="POST">
                            @csrf
                            <input type="submit" name="" id="" value="Logout" style="all: unset">
                        </form>
                    </div>
                </div>
                @endif
               
                <div>
                    
                </div>
            </div>
        </nav>
        {{-- content --}}
        <div class="row content">
            @yield('content')
        </div>
        {{-- content --}}
        <footer class="container-fluid row footer">
            <p class="footer-item"><a href="{{route('terms-and-conditions')}}">Terms and Conditions</a></p>
            <p class="footer-item"><a href="{{route('privacy-policy')}}">Privacy Policy</a></p>
        </footer>
    </body>
</html>