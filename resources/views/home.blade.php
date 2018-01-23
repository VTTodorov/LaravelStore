@extends('layouts.app')

@section('filters')
<ul class="list-group">
    <li class="list-group-item"><a href="/home">Home</a></li>
    @foreach($categories as $category)
        <li class="list-group-item"><a href="/home/{{$category->name}}">{{$category->name}}</a></li>
    @endforeach
</ul>

@endsection


@section('adverts')
    <div class="panel panel-default">
        <div class="panel-heading">{{$ads->links()}}</div>

        <div class="panel-body">
            <div class="row">
                @foreach($ads as $key=>$ad)
                    <div class="col-md-2 {{$key % 5 == 0 ? 'col-md-offset-1' : ''}}">
                        <div class="card" style="100%">
                          <img class="card-img-top" src="{{URL::to('/').'/'.$ad->image}}" alt="Card image cap">
                          <div class="card-block">
                            <h4 class="card-title">{{$ad->title}}</h4>
                            <p class="card-text">{{$ad->body}}</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                          </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="panel panel-default">
                        @yield('filters')
                </div>
            </div>
            <div class="col-md-10">
                @yield ('adverts')
            </div>
        </div>
    </div>
@endsection
