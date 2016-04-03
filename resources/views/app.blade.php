<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>rally</title>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    {{---Required Scripts------------------------------------------------------}}
    {{--jQuery--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    {{--Semantic CSS--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.css">
    {{--Application CSS--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-------------------------------------------------------------------------}}

    {{---Fonts-----------------------------------------------------------------}}
    {{--<link href='http://fonts.googleapis.com/css?family=Crimson+Text:600,400' rel='stylesheet' type='text/css'>--}}
    {{--<link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>--}}
    {{-------------------------------------------------------------------------}}

    @yield('head')

</head>
<body>

@include('navbar')

<div class="ui container" style="padding-top: 100px;">
    @yield('content')
</div>

{{--Semantic JS--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.js"></script>

@yield('footer')

</body>
</html>