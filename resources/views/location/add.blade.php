@extends('layouts.empty')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        Add location
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="/new/location/insert" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-4 control-label">Title</label>

                <div class="col-md-6">
                    <input id="Name" type="text" class="form-control" name="Name" required autofocus value="{{old('Name')}}">

                    @if ($errors->has('Name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('Name') }}</strong>
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
