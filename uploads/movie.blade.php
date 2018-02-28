@extends('layouts.app')

@section('content')
    <a href="/movies" class="btn btn-default">Go back</a>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1>{{$movie['name']}}</h1>
                <h3>{{$movie['year']}}</h3>
            </div>
            <div class="col-md-2">
                <p>Rating:</p>
                <h1>{{$movie['rating']}}</h1>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                {{$movie['description']}}
            </div>
            <div class="col-md-3">
               <img style= "100%" src="/storage/images/{{$image['filename']}}">
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <h3>Movie actors:</h3>
        <ul>
            @foreach($movie->actors as $filmas)
                <li><a href="/actor/{{$filmas['id']}}" >{{$filmas['name']}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection

