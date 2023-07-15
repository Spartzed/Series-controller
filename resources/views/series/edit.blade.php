<x-series.layout title="Edit Serie '{{$series->name}}'">
    <x-series.form :action="route('series.update', $series)" :name="$series->name"/>
</x-series.layout>