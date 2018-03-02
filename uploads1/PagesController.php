<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Movie;
use Blog\Categorie;
use Blog\Actor;


class PagesController extends Controller
{
    /*

    public function index() {
        $title = "Welcome to Laravel";

        return view('pages.index')->with('title', $title);
    }


    public function index() {
        $title = "Welcome to Laravel";

        return view('pages.index', compact('title'));
    }
    */

    public function index() {



        return view('pages.index');
    }

    public function movies() {
        $array = [
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwswZVnaDs2Sn9AyTVbEhdfGc3cCr3tbh_tiytTGd_cJf1d8_a",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSfpGcZfNOEMi5KxNb9tPlxzhY4BXZIFC8x1K4i1PbjjeFGnnJ",
            "https://static.pexels.com/photos/162389/lost-places-old-decay-ruin-162389.jpeg"
        ];

        $movies = Movie::orderBy('name', 'asc')->paginate(10); // paginate - puslapiavimas kas 10 irasu
        return view('pages.movies', [
            'movies' => $movies,
            'array' => $array
        ]);
    }

    public function categories() {
        $categories = Categorie::all();

        return view('pages.categories', [
            'categories' => $categories,
        ]);
    }

    public function actors() {
        $actors= Actor::paginate(10);

        return view('pages.actors', [
            'actors' => $actors,
        ]);
    }

    public function admin() {


        return view('pages.admin');
    }
}
