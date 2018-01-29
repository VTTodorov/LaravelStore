@extends('layouts.empty') @section('content')
<script src="/js/laravel-ckeditor/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/js/view.blade.js"></script>

<script type="text/javascript">
</script>
<div class="col-md-10 col-md-offset-1 col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="adv-header">{{$adv->title}}</h3> <span class="pull-right">{{$adv->created_at}}</span></div>
        <div class="panel-body">
            <div id="carousel-adv-images" class="carousel slide panel-image" data-ride="carousel" data-interval="false">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active image-container">
                        <img src="{{URL::to('/').'/'.$adv->image}}" alt="...">
                    </div>
                    @foreach ($pictures as $picture)
                    <div class="item image-container">
                        <img src="{{URL::to('/').'/'.$picture->image}}" alt="...">
                    </div>
                    @endforeach
                </div>
            </div>
            <span class='pull-right'><h3>{{$adv->price}}лв.</h3></span>
            <div class="row adv-description">
                <div class="col-md-7">
                        <h4>Description:</h4>
                        <div id="adv-body" data-adv-body="{{$adv->body}}">

                        </div>
                </div>
                <div class="col-md-5">
                    @foreach($pictures as $index=>$picture)
                        @if(($index + 1) % 2 == 1)
                            <div class="row">
                                @if($index == 0)
                                <div class="col-md-6">
                                    <li data-target="#carousel-adv-images" data-slide-to="0" style="list-style:none">
                                        <img href="#" src="{{URL::to('/').'/'.$adv->image}}" class="image-thumbnail" alt="..." style="width:100%">
                                    </li>
                                </div>
                                @endif
                        @endif
                            <div class="col-md-6">
                                <li data-target="#carousel-adv-images" data-slide-to="{{$index + 1}}" style="list-style:none">
                                    <img href="#" src="{{URL::to('/').'/'.$picture->image}}" class="image-thumbnail" alt="..." style="width:100%">
                                </li>
                            </div>
                        @if(($index + 1) % 2 == 0)
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
        <div class="panel-footer">
            @if(Auth::user() && Auth::user()->isAdmin())
            <a href="{{URL::to('/').'/adv/'.$adv->id.'/edit'}}">Edit</a> @else
            <button type="button" class="btn btn-primary" name="button">Add to cart</button> @endif
        </div>
    </div>
</div>
@endsection
