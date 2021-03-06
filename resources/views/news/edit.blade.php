@extends('layouts.empty')
@section('pagescript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/js/laravel-ckeditor/ckeditor.js"></script>
    <script src="/js/news.blade.js"></script>
@stop

@section('content')
@yield('pagescript')

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>{{$news->title}}</h2>
    </div>
    <form class="form-horizontal" method="POST" action="/news/{{$news->id}}/update" enctype="multipart/form-data" style="text-align: center">
    {{ csrf_field() }}
    <div class="panel-body">
            <img src="{{URL::to('/').'/'.$news->image}}" id="image-preview">
            <div class="form-group">
                <label class="col-md-4 control-label">Title</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" id="title"  value="{{$news->title}}">
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Description</label>
                <div class="col-md-6">
                    <textarea name="description" id="description">{{$news->body}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="col-md-4 control-label">Image:</label>
                <div class="col-md-6">
                      <input type="file" name="image" id="image">
                      @if ($errors->has('image'))
                          <span class="help-block">
                              <strong>{{ $errors->first('image') }}</strong>
                          </span>
                      @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
