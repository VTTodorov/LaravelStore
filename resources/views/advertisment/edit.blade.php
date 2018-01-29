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
            <h3 class="adv-header">{{$adv->title}}</h3> <span class="pull-right">{{$adv->created_at}}</span></div>
        <div class="panel-body">

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
                          <option value="{{$location->id}}">{{$location->Name}}</option>
                      @endforeach
                    </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="category">Category</label>
                    <div class="col-md-6">
                        <select class="form-control" name="category">
                         @foreach($categories as $category)
                             <option value="{{$category->id}}">{{$category->name}}</option>
                         @endforeach
                     </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Description</label>
                    <div class="col-xs-8">
                        <textarea name="adv-body" id="adv-body">{{$adv->body}}</textarea>
                    </div>
                </div>
                <div class="form-group" style="display:none">
                    <input type="file" name="image" id="image">
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <a href="change">Save</a>
        </div>
    </div>
</div>
@endsection
