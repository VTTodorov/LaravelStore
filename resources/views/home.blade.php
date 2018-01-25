@extends('layouts.app')

@section('filters')
<ul class="list-group">
    <li class="list-group-item"><a href="/home">Home</a></li>
    <li class="list-group-item"><a href="/adverts">All</a></li>
    @foreach($categories as $category)
        <li class="list-group-item"><a href="/adverts/{{$category->name}}">{{$category->name}}</a></li>
    @endforeach
</ul>

@endsection

@section('adverts')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Laravel web shop</h3>
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
                        <a href="{{'/ads/'.$ad->id}}" class="btn btn-primary more-info">More info</a>
                      </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="panel-footer">
        </div>
    </div>
@endsection
