<?php
namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Movie;
use Blog\Categorie;
use Blog\Actor;
use Blog\Image;
use DB;

class MovieController extends Controller
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
        $categories=Categorie::all()->pluck('name');
        $actors=Actor::all();
        return view('create.createMovie', [
            'category' => $categories,
            'actor'=>$actors
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
            'name'=>'required',
            'category'=>'required',
            'year'=>'required',
            'description'=>'required'
        ]);

        // Image upload

        if($request->hasFile('image')) {
                // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
                // Get just file name
            $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
                // Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                // Upload Image
            $path=$request->file('image')->storeAs('public/images', $fileNameToStore);


        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $image = new Image;
        $image->filename=$fileNameToStore;
        $image->save();

        // Create Movie

        $movie = new Movie;
        $movie->name = $request->input('name');
        $movie->category_id = $request->input('category');
        $movie->user_id = auth()-> user()-> id;
        $movie->rating= 9;
        $movie->year = $request->input('year');
        $movie->description = $request->input('description');
        $movie->save();

        if ($request->input('actor_id')>0) {
        $movie->actors()->sync($request->input('actor_id', FALSE));
        }



        return redirect('/movies')->with('success', 'New movie added');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $movie = Movie::find($id);
        $image = Image::all();

        return view('pages.movie', [
            'movie'=> $movie,
            'image'=>$image
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
        $movie = Movie::find($id);
        $categories=Categorie::all()->pluck('name');
        $actors=Actor::all();
        return view('create.editMovie', [
            'movie'=>$movie,
            'category'=>$categories,
            'actor'=>$actors
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
            'name'=>'required',
            'category'=>'required',
            'year'=>'required',
            'description'=>'required'
        ]);

        $movie = Movie::find($id);
        $movie->name = $request->input('name');
        $movie->category_id = $request->input('category');
        $movie->user_id=auth()->user()->id;
        $movie->rating= 9;
        $movie->year = $request->input('year');
        $movie->description = $request->input('description');
        $movie->save();

        $movie->actors()->sync($request->input('actor_id'));

        return redirect('/movies')->with('success', 'Movie updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        return redirect('/movies')->with('success', 'Movie Removed');
    }
}