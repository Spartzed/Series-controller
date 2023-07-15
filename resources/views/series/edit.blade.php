<x-series.layout title="Edit Serie '{!! $series->name !!}'">
    <x-series.form :action="route('series.update', $series)" :name="$series->name" :update="false"/>
</x-series.layout>