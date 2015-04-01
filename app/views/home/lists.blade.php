@extends('layouts.main')
@section('maincontent')


<h1>{{$allItems['categoryPath'][0]->name}}.</h1>


@forelse($allItems['categoryItems'] as $cItems)
    <li>
        @forelse($allItems['categoryPath'] as $cPath)
            <a href="{{ URL::to('daqinv/lists/'. $cPath->id) }}">{{$cPath->name}}</a>->
        @empty
        @endforelse
        {{$cItems->id}}: <a href="{{ URL::to('daqinv/lists/'. $cItems->id) }}">{{$cItems->name}}</a>
    </li>
@empty
    <h5>Currently no Items.</h5>
@endforelse











@stop
