<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index (Request $request) {
        // $series = Serie::all();
        $series = Serie::query()->orderBy('name')->get();
        $message = session('message.sucess');

        return view('series.index')->with('series', $series)->with('message', $message);
    }

    public function create () {

        return view('series.create');
    }

    public function store (Request $request) {

        Serie::create($request->all());
        return to_route('series.index')->with('message.sucess', "Serie {$request->name} created successfully");
    }

    public function destroy (Serie $series, Request $request) {

        $series->delete();

        return to_route('series.index')->with('message.sucess', "Serie {$series->name} removed successfully");
    }

    public function edit (Serie $series) {

        return view('series.edit')->with('series', $series);
    }

    public function update (Serie $series, Request $request) {

        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('message.sucess', "Serie {$series->name} updated successfully");
    }
}
