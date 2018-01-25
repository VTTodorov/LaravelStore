@extends('layouts.app')

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
                            <div class="image-container">
                                <img class="card-img-top" src="{{URL::to('/').'/'.$ad->image}}" alt="Card image cap">
                            </div>
                          <div class="card-block">
                            <h4 class="card-title">{{$ad->title}}</h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                            @if(Auth::user() && Auth::user()->isAdmin())
                            <div style="position: absolute; top: 0;">
                                <a href="/edit/{{$ad->id}}" class="btn" style="background-color: rgba(33,106,148,0.8)"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            </div>
                            @endif
                          </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>#216a94
        <div class="panel-footer">
            {{$ads->links()}}
        </div>
    </div>
@endsection
