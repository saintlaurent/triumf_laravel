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
        <form method="post" action="{{URL::route('post-sign-in')}}">
        Username: <input name="username" type="text">
        Password: <input name="password" type="password">
        <input type="submit"></form>
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