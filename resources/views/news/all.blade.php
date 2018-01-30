@extends('layouts.app')


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>News</h2>
    </div>
    <div class="panel-body">
        <ul style="list-style:none">
            @foreach($news as $n)
                <a href="/news/{{$n->id}}"> <li>{{$n->title}}</li></a>
            @endforeach
        </ul>
    </div>
</div>
@endsection
