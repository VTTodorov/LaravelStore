@extends('layouts.app')


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>{{$news->title}}</h2>
    </div>
    <div class="panel-body">
        <img src="{{URL::to('/').'/'.$news->image}}" class="news-image img-thumbnail">
        <p>{{$news->body}}</p>
    </div>
</div>
@endsection
