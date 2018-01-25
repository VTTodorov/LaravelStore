@extends('layouts.app')

@section('pagescript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/js/add.blade.js"></script>
@stop

@section('content')

@yield('pagescript')
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Create new advertisment</div>
                <div>
                    <img src="" id="image-preview" width="200px" />
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/addnew" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required autofocus>

                                <!-- @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="body" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="body" class="form-control" name="body" required></textarea>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input id="body" class="form-control" name="price" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="location">Location</label>
                          <div class="col-md-6">
                              <select class="form-control" name="location">
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{$location->Name}}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>

                         <div class="form-group">
                           <label class="col-md-4 control-label"for="category">Category</label>
                           <div class="col-md-6">
                               <select class="form-control" name="category">
                                   @foreach($categories as $category)
                                       <option value="{{$category->id}}">{{$category->name}}</option>
                                   @endforeach
                               </select>
                           </div>
                         </div>

                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Main picture:</label>
                            <div class="col-md-6">
	                              <input type="file"  name="image" id="image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Other pictures (select multiple):</label>
                            <div class="col-md-6">
	                              <input type="file" multiple name="images[]" id="image">
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
