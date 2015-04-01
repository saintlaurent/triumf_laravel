@extends('layouts.main')
@section('maincontent')


@forelse($allItems['categoryItems'] as $cItems)
    <?php $firstItem = true ?>
    <li>
        @forelse($cItems as $cPath)
            @if ($firstItem == true)
                <a href="{{ URL::to('daqinv/lists/'. $cPath->id) }}">{{$cPath->name}}</a>
                <?php $firstItem = false ?>
            @else
                >> <a href="{{ URL::to('daqinv/lists/'. $cPath->id) }}">{{$cPath->name}}</a>
            @endif
        @empty
        @endforelse
    </li>
@empty
    <h5>Currently no Items.</h5>
@endforelse









@stop
