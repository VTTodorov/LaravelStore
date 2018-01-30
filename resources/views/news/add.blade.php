@extends('layouts.empty')


@section('content')
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">Add news</div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="/new/news/insert" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-4 control-label">Title</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" required autofocus value="{{old('title')}}">

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="body" class="col-md-4 control-label">Description</label>

                    <div class="col-md-6">
                        <textarea id="ckbody" class="form-control" name="ckbody" required>{{ old('ckbody') }}</textarea>
                        @if ($errors->has('ckbody'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ckbody') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="image" class="col-md-4 control-label">Picture: </label>
                    <div class="col-md-6">
                          <input type="file"  name="image" id="image">
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

</div>
@endsection
