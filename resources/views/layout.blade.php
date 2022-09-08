<!DOCTYPE HTML>
<html>
<head>
    <title>
        @hasSection('page-title')
            User Card -@yield('page-title')
        @else
            Pictureworks
        @endif
    </title>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="/assets/css/main.css" />
    <noscript><link rel="stylesheet" href="/assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
    <div id="wrapper">
        @yield('page-content')
    </div>
    
    <script src="/js/app.js"></script>
    <script>
        if ('addEventListener' in window) {
            window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-preload\b/, ''); });
            document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
        }
    </script>
</body>
</html>