@extends('layouts.empty')

@section('content')
<script src="/js/laravel-ckeditor/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/js/view.blade.js"></script>

<script type="text/javascript">
</script>
<div class="col-md-10 col-md-offset-1 col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="adv-header">{{$adv->title}}</h3> <span class="pull-right">{{$adv->created_at}}</span></div>
        <div class="panel-body">
            <div class="panel-image">
                <img src="{{URL::to('/').'/'.$adv->image}}" id="image-preview" width="200px" />
            </div>
            <span class='pull-right'><h3>{{$adv->price}}лв.</h3></span>
            <div class="adv-description">
                <h4>Description:</h4>
                <p>{{$adv->body}}</p>
            </div>
        </div>
        <div class="panel-footer">
            @if(Auth::user() && Auth::user()->isAdmin())
                <button type="button" class="btn btn-primary" id="edit-description">Edit</button>
            @else
                <button type="button" class="btn btn-primary" name="button">Add to cart</button>
            @endif
        </div>
    </div>
</div>
@endsection
