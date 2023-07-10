<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index (Request $request) {
        // $series = Serie::all();
        $series = Serie::query()->orderBy('name')->get();

        return view('series.index', compact('series'));
    }

    public function create () {

        return view('series.create');
    }

    public function store (Request $request) {

        $nomeSerie = $request->input('name');
        $serie = new Serie();
        $serie->name = $nomeSerie;
        $serie->save();

       return redirect('/series');
    }
}
