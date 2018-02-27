@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <h1>Add a new actor</h1>
        <hr>
        <a href="/admin" class="btn btn-default">Go back</a>
        <hr>
        {!! Form::open(['action' => 'ActorsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Actor name')}}
            {{Form::text('name', '', ['class'=>'form-control', 'place-holder' =>'Actors name'])}}
        </div>
        <div class="form-group">
            {{Form::label('birthday', 'Actor\'s birth date: ')}}
            {{Form::date('birthday', \Carbon\Carbon::now())}}
            &nbsp
            &nbsp
            {{Form::label('deathday', 'Actor\'s death date: ')}}
            {{Form::date('deathday', \Carbon\Carbon::now())}}
        </div>
        <div class="form-group">
            {{Form::label('movies', 'Choose actor movies: ')}}
            <br>
            @foreach($movie as $filmai)
                {{Form::checkbox('movie_id[]', $filmai['id'])}}
                {{Form::label('actor', $filmai['name'])}}
                &nbsp
                &nbsp
            @endforeach
        </div>
        <hr>
        {{Form::submit('Submit', ['class'=>"btn btn-default"])}}
        {!! Form::close() !!}
    </div>

@endsection
