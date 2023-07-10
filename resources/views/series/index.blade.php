<x-layout title="Series">
    <a href="/series/create" class="btn btn-dark mb-2"> Add Serie </a>

    <ul class="list-group">
       @foreach ($series as $serie)
            <li class="list-group-item">{{ $serie->name }}</li>
        @endforeach
    </ul>

    <script>
        const series = {{ Js::from($series) }};
    </script>
</x-layout>