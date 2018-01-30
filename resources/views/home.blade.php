@extends('layouts.app')

@section('pagescript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/js/nohtml.js"></script>
@stop

@section('adverts')
@yield('pagescript')

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
                        <p class="card-text">{{$ad->body}}</p>
                        <a href="{{'/adv/'.$ad->id}}" class="btn btn-primary more-info">More info</a>
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
