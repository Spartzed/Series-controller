<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function index (Request $request) {
        $series = Series::all();
        $message = session('message.sucess');

        return view('series.index')->with('series', $series)->with('message', $message);
    }

    public function create () {

        return view('series.create');
    }

    public function store (SeriesFormRequest $request) {
        $serie = Series::create($request->all());
        $seasons = [];
        $episodes = [];

        for ($i = 0; $i <= $request->seasonQty; $i ++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i,
            ];
        }

        Season::insert($seasons);
        
        foreach ($serie->seasons as $season) {
            for ($i = 0; $i < $request->episodesPerSeason; $i ++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $i,
                ];
            }
        }

        Episode::insert($episodes);
        return to_route('series.index')->with('message.sucess', "Serie {$request->name} created successfully");
    }

    public function destroy (Series $series, Request $request) {

        $series->delete();

        return to_route('series.index')->with('message.sucess', "Serie {$series->name} removed successfully");
    }

    public function edit (Series $series) {

        return view('series.edit')->with('series', $series);
    }

    public function update (Series $series, SeriesFormRequest $request) {

        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('message.sucess', "Serie {$series->name} updated successfully");
    }
}
