<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RallySearch</title>
    <meta name="title" content="RallySearch"/>
    <meta name="description" content="An alternative way of browsing Reddit"/>
    <link rel="image_src" href="/images/logo.jpg"/>
    <meta property="og:url" content="http://www.rallysearch.xyz"/>
    <meta property="og:title" content="RallySearch"/>
    <meta property="og:description" content="An alternative way of browsing Reddit"/>
    <meta property="og:image" content="http://www.rallysearch.xyz/images/logo.jpg"/>

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

    @yield('head')

    {{--Google Analytics--}}
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-76466330-1', 'auto');
        ga('send', 'pageview');
    </script>
</head>
<body>

@include('navbar')

<div class="pusher">
    <div class="ui black huge launch right attached button" style="width: 70px;">
        <i class="icon list layout"></i>
        <span class="text" style="display: none;">Menu</span>
    </div>
    <div class="ui container" style="padding-top: 100px;">
        @yield('content')
    </div>
</div>

{{--<div class="ui container" style="padding-top: 100px;">--}}
{{--@yield('content')--}}
{{--</div>--}}

{{--Semantic JS--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.js"></script>

@yield('footer')

<script>
    // Sidebar toggle
    $('.sidebar').first().sidebar('attach events', '.launch.button');
    $('.launch.button').removeClass('disabled')
            .mouseenter(function () {
                $(this).stop().animate({width: '140px'}, 300,
                        function () {
                            $(this).find('.text').show();
                        });
            }).mouseleave(function (event) {
        $(this).find('.text').hide();
        $(this).stop().animate({width: '70px'}, 300);
    });
</script>

</body>
</html>