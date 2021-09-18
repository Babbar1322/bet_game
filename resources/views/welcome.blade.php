<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content= "width=device-width, user-scalable=no">     
        <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="css/landscape.css" media="screen and (orientation: landscape)">
        <link rel="stylesheet" type="text/css" href="css/portrait.css" media="screen and (orientation: portrait)">

        <title>Bet</title>
        <link rel="stylesheet" type="text/css" href="http://unpkg.com/view-design/dist/styles/iview.css">
        <script type="text/javascript" src="http://vuejs.org/js/vue.min.js"></script>
        <script type="text/javascript" src="http://unpkg.com/view-design/dist/iview.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script>
        (function(){
            window.Laravel = {
                csrfToken :'{{csrf_token()}}'
            };
        })();
    </script>
   
  
    </head>
    <body>
        <div id="app">
            <mainapp></mainapp>
        </div>
    </body>
    <script src="{{asset('/js/app.js')}}"></script>

</html>
