<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600,700,900" rel="stylesheet">

        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url(/theme/img/virusvirus.svg);
                background-attachment: fixed;
                background-position: center center;
                background-size: cover; 
                color: #e7ecf7;
                font-family: 'Nunito', sans-serif;
                background-size: 100%;
                margin: 0;
                vertical-align: middle;
                overflow: hidden;
            }
            .centered {
                height: 100vh;
                vertical-align : middle;
                position:absolute;
                top:10%;
            }
            .content {
                font-size: 2em;
                letter-spacing: 2px;
                font-weight: 600;
                vertical-align: middle;
                max-width: 65em;
                width: calc(100% - 6em);
                margin: 0 auto;
                position: relative;
                z-index: 10000;
                line-height: 1;
            }
            h4{
                left: 5%;
                font-style: normal;
                font-weight: normal;
                font-size: 54px;
                line-height: 66px;

                /* identical to box height */
                letter-spacing: 0.02em;
                text-transform: uppercase;

                color: #E8EFF9;
            }
            h3{           
                left: 5%;
                font-style: normal;
                font-weight: bold;
                font-size: 54px;
                line-height: 66px;
                letter-spacing: 0.02em;
                text-transform: uppercase;

                color: #FFFFFF;
            }
            .content > a {
                color : #fff;
            }
        </style>
    </head>
    <body>
        <div class="centered">
            <div class="content">
                <h4>WELCOME TO</h4>
                <h3>COVID-19<br>HEALTH INFORMATION</h3>
                <a href="{{ route('home') }}"><h6>click here to redirect to Reporting covid-19 data</h6></a>
            </div>
        </div>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    </body>
</html>
