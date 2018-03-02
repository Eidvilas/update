@extends('layouts.app')

@section('content')
    <h1>List of Movies</h1>
    @if(count($movies) > 0)
        <div class="container">
            <div class="row">
                @foreach($movies as $movie)
                    @foreach($array as $ar)
                    <a href="/movie/{{$movie['id']}}">
                    <div class="col-md-4 well" style="background:url('{{$ar}}'); background-size: cover; background-repeat: no-repeat;">

                        <div class="row">
                            <div class="col" >
                                <h1 style="font-family: 'Zilla Slab Highlight', cursive; color: black; margin:0; paggind:0;">{{$movie['name']}}</h1>
                                <h3 style="font-family: 'Zilla Slab Highlight', cursive; color: black; margin:0; paggind:0;">{{$movie['year']}}</h3>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                @if($movie['rating'])
                                    @for($i=1; $i<=$movie['rating']; $i++)
                                        <div style="float: right;">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/FA_star.svg/2000px-FA_star.svg.png" height="25">
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                    </div>
                    </a>
                    @endforeach
                @endforeach
            </div>
        </div>

        {{$movies->links()}}
    @endif

@endsection

