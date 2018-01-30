@extends('layouts.empty') @section('content')
<script src="/js/laravel-ckeditor/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="/js/edit.blade.js"></script>
<script type="text/javascript">
</script>
<div class="col-md-10 col-md-offset-1 col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="adv-header">{{$adv->title}}</h3> <span class="pull-right">{{$adv->created_at}}</span>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="/adv/{{$adv->id}}/change" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div id="carousel-adv-images" class="carousel slide panel-image" data-ride="carousel" data-interval="false">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active big-image-container">
                        <img src="{{URL::to('/').'/'.$adv->image}}" id="image-preview">
                        <div class="image-controls">
                            <label for="image"><i class="fas fa-edit fa-2x"></i></label>
                        </div>
                    </div>
                    @foreach ($pictures as $picture)
                    <div class="item big-image-container">
                        <img src="{{URL::to('/').'/'.$picture->image}}">
                        <div class="image-controls delete-picture">
                            <i class="fas fa-trash fa-2x" id="{{$picture->id}}"></i>
                            <input type="text" name="images[]" id="images" value="" class="hidden">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="image-list">
                <div data-target="#carousel-adv-images" data-slide-to="0" class="image-list-item">
                    <img href="#" src="{{URL::to('/').'/'.$adv->image}}" class="image-thumbnail" alt="..." style="width:100%" id="image-preview">
                </div>
                @foreach ($pictures as $index=>$picture)
                <div data-target="#carousel-adv-images" data-slide-to="{{$index + 1}}" class="image-list-item" id="{{$picture->id}}">
                    <img href="#" src="{{URL::to('/').'/'.$picture->image}}" class="image-thumbnail" alt="..." style="width:100%">
                </div>
                @endforeach
            </div>
            <div class="">

            </div>
                <div class="adv-edit">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Full name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" id="name" / value="{{$adv->title}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Price</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="price" id="price" / value="{{$adv->price}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="location">Location</label>
                        <div class="col-md-6">
                            <select class="form-control" name="location">
                          @foreach($locations as $location)
                              <option value="{{$location->id}}" @if($adv->location_id == $location->id) selected="selected" @endif >{{$location->Name}}</option>
                          @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="category">Category</label>
                        <div class="col-md-6">
                            <select class="form-control" name="category">
                             @foreach($categories as $category)
                                 <option value="{{$category->id}}" @if($adv->category_id == $category->id) selected="selected" @endif >{{$category->name}}</option>
                             @endforeach
                         </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Description</label>
                        <div class="col-xs-8">
                            <textarea name="ckbody" id="ckbody">{{$adv->body}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image" class="col-md-4 control-label">Other pictures (select multiple):</label>
                        <div class="col-md-6">
                              <input type="file" multiple name="new_images[]" id="images" value="{{ old('images')}}">
                              @if ($errors->has('images[]'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('images') }}</strong>
                                  </span>
                              @endif
                        </div>
                    </div>
                    <div class="form-group" style="display:none">
                        <input type="file" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
