<h1>HERE</h1>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @vite(['resources/js/app.js'])
        @foreach($mostPlayedMaps as $map_i => $map)
                <div @if ($loop->iteration === 1) class="carousel-item active" @else class="carousel-item" @endif :wire:key="{{ $map_i}}">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <img class="rounded img-thumbnail w-25 d-inline" src="{{ $map['beatmapset']['covers']['list@2x'] }}">
                        <h5 class="card-title d-inline">{{ $map['beatmapset']['title_unicode'] }}- {{ $map['beatmapset']['artist_unicode'] }}</h5>
                        <p class="card-text">Mapped by {{ $map['beatmapset']['creator'] }}. <span class="badge bg-primary text-light"><i class="fa fa-play" aria-hidden="true"></i>  {{ $map['count']}}</span></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
