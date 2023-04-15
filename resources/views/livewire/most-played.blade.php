<div class="container mt-5">
    <div class="row">
        @vite(['resources/js/app.js'])
        @foreach($mostPlayedMaps as $map_i => $map)
            <div class="col-lg mb-5" :wire:key="{{ $map_i}}">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <img class="rounded img-thumbnail w-25 d-inline" src="{{ $map['beatmapset']['covers']['list@2x'] }}">
                        <h5 class="card-title d-inline">{{ $map['beatmapset']['title_unicode'] }}- {{ $map['beatmapset']['artist_unicode'] }}</h5>
                        <p class="card-text">Mapped by {{ $map['beatmapset']['creator'] }}. <span class="badge bg-primary text-light"><i class="fa fa-play" aria-hidden="true"></i>  {{ $map['count']}}</span></p>
                    </div>
{{--                    <ul class="list-group list-group-flush">--}}
{{--                        <li class="list-group-item"> <i class="fa fa-play" aria-hidden="true"></i>: {{ $map['count']}}</li>--}}
{{--                    </ul>--}}
                </div>
            </div>
        @endforeach
    </div>
</div>
