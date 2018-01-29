@extends('layouts.empty')

@section('pagescript')
    <script src="/js/laravel-ckeditor/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/js/add.blade.js"></script>
@stop

@section('content')

@yield('pagescript')
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create new advertisment</div>
                <div>
                    <img src="" id="image-preview"/>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/addnew" enctype="multipart/form-data">
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

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input id="price" class="form-control" name="price" required value="{{ old('price') }}">
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="location">Location</label>
                          <div class="col-md-6">
                              <select class="form-control" name="location" value="{{ old('location')}}">
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}" @if(old('location') == $location->id) selected="selected" @endif>{{$location->Name}}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>

                         <div class="form-group">
                           <label class="col-md-4 control-label"for="category">Category</label>
                           <div class="col-md-6">
                               <select class="form-control" name="category">
                                   @foreach($categories as $category)
                                       <option value="{{$category->id}}"  @if(old('category') == $category->id) selected="selected" @endif>{{$category->name}}</option>
                                   @endforeach
                               </select>
                           </div>
                         </div>

                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Main picture:</label>
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
                            <label for="image" class="col-md-4 control-label">Other pictures (select multiple):</label>
                            <div class="col-md-6">
	                              <input type="file" multiple name="images[]" id="images" value="{{ old('images')}}">
                                  @if ($errors->has('images[]'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('images') }}</strong>
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
