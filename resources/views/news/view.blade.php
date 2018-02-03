@extends('layouts.app')


@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/js/view.blade.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>{{$news->title}}</h2>
    </div>
    <div class="panel-body">
        <img src="{{URL::to('/').'/'.$news->image}}" class="news-image img-thumbnail">
        <div id="adv-body" data-adv-body="{{$news->body}}">
        </div>
    </div>
    @if(Auth::user() && Auth::user()->isAdmin())
    <div class="panel-footer">
        <a href="{{URL::to('/').'/news/'.$news->id.'/edit'}}">Edit</a>
    </div>
    @endif
</div>
@endsection
