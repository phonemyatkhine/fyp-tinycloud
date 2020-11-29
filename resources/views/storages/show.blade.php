@extends('layouts.app')

@section('css')
    @yield('storages-right-css')
    <style>
         @media only screen and (min-width: 600px) {
            .storage-container {
                padding-top: 20px;
            }
            .storages-left{
                padding:20px 0px 0px 20px;
                margin-left: 80px;
                border: 1px solid #E0E0E0;
                border-radius: 10px;
                height: 95%;
            }
            .storages-right {
                margin-left: 10px;
                margin-right:20px;
                border: 1px solid #E0E0E0;
                border-radius: 10px;
                height: 95%;
            }  
            
            .folder-header {
                padding-top:20px;
                color: #212121;
                }
            .col-left{
                margin-left: 10px;
                border-right: 1px solid #E0E0E0;
                color: #707070;
                height: inherit;
            }
            .col-right {
                margin-left: 10px;
                margin-right: -40px;
            }
            .menus {
                list-style-type: none;
                margin-left : -50px;
            }
            .menus>li{
                padding: 10px;
                margin-top : 10px;
            }
            .menus>li>a{
                text-decoration: none;
                color: inherit;
            }
            .material-icons{
                display: inline-flex;
                vertical-align: top;
                color: #707070;
            }
            .active-menu{
                color : #2172FF;
                border-left: 3px solid #2172FF;
                margin-left:-30px;
            }
            .active-menu>a>.material-icons{
                color : #2172FF;
            }
            .active-menu>a{
                padding-left:15px;
                text-decoration: none;
            }
            .buy-button {
                all:unset;
                position: absolute; 
                bottom: 0; 
                width: 100%; 
                height: 50px; 
                margin-left:-40px;
                color: #2172FF;
                background: #F5F5F5;
                text-align: center;
            }
        }
        @media only screen and (max-width:600px) {
            .storage-container {
                padding-top: 20px;
            }
            .storages-left{
                padding-top : 10px;
                margin-left: 30px;
                border: 1px solid #E0E0E0;
                border-radius: 10px;
            }
            .storages-right {
                padding-top:10px;
                margin: 20px 0px 0px 30px;
                /* margin-right:10px; */
                border: 1px solid #E0E0E0;
                border-radius: 10px;
            }
            .folder-header {
                padding-top:20px;
                color: #212121;
            }
            .col-left{
                border: 1px solid #E0E0E0;
                border-radius: 10px;
                color: #707070;
                padding-left: 40px;
                margin: 10px 0px 10px 10px;
            }
            .col-right {
                margin-left: 10px;
                height: inherit;
            }
            .menus {
                list-style-type: none;
                margin-left : -50px;
            }
            .menus>li{
                padding: 10px;
                margin-top : 10px;
            }
            .menus>li>a{
                text-decoration: none;
                color: inherit;
            }
            .material-icons{
                display: inline-flex;
                vertical-align: top;
            }
            .active-menu{
                color : #2172FF;
                border-left: 3px solid #2172FF;
                margin-left:-30px;
            }
            .active-menu>a{
                padding-left:15px;
                text-decoration: none;
            }
            .buy-button {
                all:unset;
                position: absolute; 
                bottom: 0; 
                width: 100%; 
                height: 50px; 
                margin-left:-35px;
                color: #2172FF;
                background: #F5F5F5;
                text-align: center;
            }
            
        }
        .chart-data {
                padding-left: 20px;
        }
       
    </style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @if(isset($chart_data))
    <script type="text/javascript">
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        var data = new google.visualization.arrayToDataTable(<?php echo $chart_data?>);
        // Set chart options
        var options = {'width':334,
                       'height':200,
                       'chartArea': {'width': '80%', 'height': '80%'},
                        'legend' : {
                            'position':'right',
                            'alignment' : 'start',
                            'fontName' : 'Poppins',
                            'maxLines' : 3},
                        pieStartAngle: 100,

                    };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    @endif
@endsection

@section('content')

    <div class="row container-fluid storage-container">
            @if(empty($storage))
                <script>window.location = "{{ route('welcome') }}";</script>
            @endif
        @php 
            $total_space = round($storage->total_space/1048576,2);
            $used_space = round($storage->used_space/1048576,2);
        @endphp
        <div class="storages-left col-lg-3">
            <h4>Storage</h4>
            <div id="chart_div" style=""></div>
            <div class="chart-data">
                <p>Storage Total Space : {{$total_space}} MB</p>
                <p>Storage Used Space :  {{$used_space}} MB</p>
                <p>Storage Free Space : {{$total_space-$used_space}} MB</p>
                <button class="buy-button"> 
                    <a href="{{route('home')}}">Buy More Storage</a>
                </button>
            </div>
        </div>
        <div class="col-lg-8 storages-right">
            <h4 class="folder-header">Folders Directory</h4>
            <div class="container-fluid row" style="height: inherit;">
                <div class="col-lg-3 col-left">
                    <ul class="menus">
                        <li class="{{ request()->is('storages*') ? 'active-menu' :  ' ' }}">
                            <a href="{{route('storage.dashboard')}}">
                                <i class="material-icons">
                                    dashboard
                                </i>
                                Dashboard
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('folders.index') || request()->routeIs('folders.show') ? 'active-menu' :  ' ' }}">
                            <a href="{{route('folders.index')}}">
                                <i class="material-icons">
                                    folder_open
                                </i>
                                Your Folders
                            </a>
                        </li>
                        <li class="{{ request()->is('folders/shared') ? 'active-menu' :  ' ' }}">
                            <a href="{{route('folders.shared')}}">
                                <i class="material-icons">
                                    folder_shared
                                </i>
                                Shared Folders
                            </a>
                        </li>
                        <li class="{{ request()->is('teams') ? 'active-menu' :  ' ' }}">
                            <a href="{{route('teams.index')}}">
                                <i class="material-icons">
                                    people
                                </i>
                                Your Teams
                            </a>
                        </li>
                        <li class="{{ request()->is('recover*') ? 'active-menu' :  ' ' }}">
                            <a href="{{route('recover.index')}}">
                                <i class="material-icons">
                                    restore_from_trash
                                </i>
                                Recover Files
                            </a>
                        </li>
                    </ul>            
                </div>
                <div class="col-lg-9 col-right">
                    @yield('storages-right')
                </div>
            </div>
        </div>
    </div>

@endsection