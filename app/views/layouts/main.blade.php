<!DOCTYPE html>
<html>
<head>
    <title></title>
    {{ HTML::style('css/styles.css'); }}
</head>
<body>

<div id="topleft">
    @if(Auth::check())
    @else
    <div id="topright">
        Username: <input type="text">
        Password: <input type="password">
        <input type="submit">
    </div>

    @endif
</div>
<br>
<div id="content">
@yield('maincontent')
</div>
<div id="leftbar">
@include('navigation.navbar')
</div>
</body>
</html>