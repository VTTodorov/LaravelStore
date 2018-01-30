@extends('layouts.app')


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>{{$news->title}}</h2>
    </div>
    <div class="panel-body">
        {{$news->body}}
    </div>
</div>
@endsection
