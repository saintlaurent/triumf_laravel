@extends('layouts.main')
@section('maincontent')


<h1>Main Categories.</h1>


@forelse($categoryHeadings as $c)
    <li>{{$c->id}}: <a href="{{ URL::to('daqinv/lists/'. $c->id) }}">{{$c->name}}</a></li>
@empty
    <h5>Currently no Items.</h5>
@endforelse











@stop
