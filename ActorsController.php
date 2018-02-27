<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Actor;
use Blog\Movie;

class ActorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movie = Movie::all();
        return view('create.createActor', [
            'movie'=>$movie
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'birthday' => 'required'
        ]);

        $actor = new Actor;
        $actor->name=$request->input('name');
        $actor->user_id=auth()->user()->id;
        $actor->birthday=$request->input('birthday');

        if(null !== $request->input('deathday')){
            $actor->deathday=$request->input('deathday');
        } else {
            $actor->deathday=null;
        }
        $actor->save();

        $actor->movies()->sync($request->input('movie_id', FALSE));

        return redirect('/actors')->with('success', 'Actor has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $actor= Actor::find($id);

        return view('pages.actor', [
            'actor'=> $actor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actor = Actor::find($id);
        $movie = Movie::all();
        return view('create.editActor', [
            'actor'=>$actor,
            'movie'=>$movie
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'birthday' => 'required'
        ]);

        $actor = Actor::find($id);
        $actor->name=$request->input('name');
        $actor->birthday=$request->input('birthday');

        if(null !== $request->input('deathday')){
            $actor->deathday=$request->input('deathday');
        } else {
            $actor->deathday=null;
        }
        $actor->user_id=auth()->user()->id;
        $actor->save();

        $movie_id = $request->input('movie_id');
        if ($movie_id) {
            $actor->movies()->sync($movie_id);
        } else {
            $actor->movies()->sync(array());
        }

        return redirect('/actors')->with('success', 'Actor has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actor = Actor::find($id);
        $actor->delete();

        return redirect('/actors')->with('success', 'Actor Removed');
    }
}
