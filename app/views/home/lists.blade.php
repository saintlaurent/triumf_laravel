@extends('layouts.main')
@section('maincontent')



<h1>{{$allItems['categoryPath'][0]->name}}</h1>

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
    {{--leaf nodes--}}
    {{--<h2>{{$allItems['numOfItems']}} items.</h2>--}}
    {{--<h2>{{$allItems['arrDisplayFields'][0]}}</h2>--}}
    <style>thead {color:green;}
        tbody {color:blue;}
        tfoot {color:red;}
        table,th,td
        {border:1px solid black;}
    </style>
    <table border="1" style="width:300px">
        <thead>
        <tr>
            @foreach ($allItems['arrDisplayFields'] as $field)
                <th> {{$field}}</th>
            @endforeach
        </tr>
        </thead>
    @foreach ($allItems['items'] as $item)
        <tbody>
            <tr>
                @foreach ($allItems['arrDisplayFields'] as $field)
                    <td>{{$item->$field}}</td>
                @endforeach
            </tr>
        </tbody>
        {{--<p>{{ $item->id }}</p>--}}
    @endforeach
    </table>
    {{--<h5>Currently no Items.</h5>--}}
@endforelse








<<<<<<< HEAD

=======
>>>>>>> 9f5057b4fe107c9cfad90ceae9f0eca31cec47b1
@stop
