<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
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
                    padding-left : 90px;
                }
                .navbar {
                    padding-left:80px;
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
           .nav-underline {
            display:inline-block;
            border-bottom:2px solid #1577FF;
            padding-bottom:2px;
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
            padding-left:80px;
            color: #757575;
           }
           .footer>p{
               padding: 10px 20px 10px 20px;
           }
            html, body {
                height: 100%;
            }
            body {
                display: flex;
                flex-direction: column;
            }
            .content {
                flex: 1 0 auto;
            }
            .footer {
                flex-shrink: 0;
            }
        </style>
    </head>
    <body class="antialiased font">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">Tiny Cloud</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#"><span class="nav-underline">  Home </span><span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#">Features</a>
                    <a class="nav-item nav-link" href="#">Pricing</a>
                    <a class="nav-item nav-link" href="#">About</a>
                </div>
            </div>
        </nav>
        {{-- content --}}
        <div class="container-fluid row content">
            @yield('content')
        </div>
        {{-- content --}}
        <footer class="container-fluid row footer">
            <p class="footer-item">Terms and Conditions</p>
            <p class="footer-item">Privacy Policy</p>
        </footer>
    </body>
</html>