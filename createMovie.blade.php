@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <h1>Add a new movie</h1>
        <a href="/admin" class="btn btn-default">Go back</a>
        <hr>
        {!! Form::open(['action' => 'MovieController@store', 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Movie Title')}}
            {{Form::text('name', '', ['class'=>'form-control', 'place-holder' =>'Movie title'])}}
        </div>
        <div class="form-group">
            {{Form::label('category', 'Select Movie Category: ')}}
            {{Form::select('category', $category)}}
            &nbsp
            &nbsp
            {{Form::label('year', 'Year: ')}}
            {{Form::selectRange('year', 2018, 1950)}}
        </div>
        <div class="form-group">
            {{Form::label('actors', 'Choose movie actor or actors from a list: ')}}
            <br>
            @foreach($actor as $aktorius)
                {{Form::checkbox('actor_id[]', $aktorius['id'])}}
                {{Form::label('actor', $aktorius['name'])}}
                &nbsp
                &nbsp
            @endforeach
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', '', ['class'=>'form-control', 'place-holder' =>'Description'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>

        // https://select2.org/



    </div>

@endsection

