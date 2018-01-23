@extends('layouts.app')

@section('categories')
<ul class="list-group">
    <li class="list-group-item"><a href="/home">Home</a></li>
    <li class="list-group-item"><a href="/adverts">All</a></li>

    @foreach($categories as $category)
        <li class="list-group-item"><a href="/adverts/{{$category->name}}">{{$category->name}}</a></li>
    @endforeach
</ul>

@endsection

@section('locations')
    <ul class="nav">
      @foreach($locations as $loc)
        <div class="location-item">
            <a class="nav-link" href="{{'/adverts/'.($hasCategory ? $hasCategory : 'location').'/'.$loc->Name }}">{{$loc->Name}}</a>
        </div>
      @endforeach
    </ul>
@endsection

@section('adverts')
    <div class="panel panel-default">
        <div class="panel-heading">
            @yield('locations')
        </div>

        <div class="panel-body">
            <div class="row">
                @foreach($ads as $key=>$ad)
                    <div class="col-md-2 {{$key % 5 == 0 ? 'col-md-offset-1' : ''}}">
                        <div class="card">
                          <img class="card-img-top" src="{{URL::to('/').'/'.$ad->image}}" alt="Card image cap">
                          <div class="card-block">
                            <h4 class="card-title">{{$ad->title}}</h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                          </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="panel-footer">
            {{$ads->links()}}
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-default">
                        @yield('categories')
                </div>
            </div>
            <div class="col-md-10">
                @yield ('adverts')
            </div>
        </div>
    </div>
@endsection
