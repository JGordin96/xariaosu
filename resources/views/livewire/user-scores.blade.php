
<div class="container mt-5">
    <div class="row">
        @vite(['resources/js/app.js'])
        @foreach($scores as $i => $score)
        <div class="col-sm mb-5" :wire:key="{{ $i}}" x-data="{show : 'info'}">
            <div class="card" style="width: 18rem;">
                <div id="imgs-overlay">
                    <img class="rounded" src="{{ $score['beatmapset']['covers']['list@2x'] }}" alt="Card image cap">
                    <img src="{{URL("/images/magik/ranking-{$score['rank']}.png")}}" alt="" class="opacity-75 overlay"/>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $score['beatmapset']['title_unicode'] }} - {{ $score['beatmapset']['artist_unicode'] }}</h5>
                    <p class="card-text">Score achieved {{ \Carbon\Carbon::parse($score['created_at'])->diffForHumans() }}.</p>
                </div>

                
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active px-1"><button x-on:click="show = 'info'" class="nav-link border-primary" x-bind:class="{ 'bg-primary text-light': show === 'info' }"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>&nbsp;</button></li>
                    <li role="presentation"><button x-on:click="show = 'breakdown'" class="nav-link border-primary" x-bind:class="{ 'bg-primary text-light': show === 'breakdown' }">激</button></li>
                    <li role="presentation" class="active px-1"><button x-on:click="show = 'pie'" class="nav-link border-primary" x-bind:class="{ 'bg-primary text-light': show === 'pie' }"><i class="fa fa-pie-chart fa-lg" aria-hidden="true"></i>&nbsp;</button></li>
                </ul>
                

   
                <div class="card-body" x-show="show === 'info'">
                    <ul class="list-group list-group-flush">
                        {{-- todo loop through mods as its an array --}}
                        <li class="list-group-item">Score: {{ $score['score']}}</li>
                        <li class="list-group-item">Mods: {{ $score['mods'][0] ?? 'None' }}</li>
                        <li class="list-group-item">PP: {{ $score['pp'] }}</li>
                        <li class="list-group-item">Accuracy: {{ $score['accuracy'] }}</li>
                    </ul>
                </div>

                <div class="card-body" x-show="show === 'breakdown'">
                    <ul class="list-group list-group-flush text">
                    <li class="list-group-item text-center h6 fw-bold">
                        <img src="{{URL('/images/magik/hit300.png')}}" alt="" width="35px" class="d-inline">
                        : {{ $score['statistics']['count_300'] }}   
                    </li>
                    <li class="list-group-item text-center h6 fw-bold">
                        <img src="{{URL('/images/magik/hit100.png')}}" alt="" width="35px" class="d-inline">
                        : {{ $score['statistics']['count_100'] }}   
                    </li>
                    <li class="list-group-item text-center h6 fw-bold">
                        <img src="{{URL('/images/magik/hit50.png')}}" alt="" width="35px" class="d-inline">
                        : {{ $score['statistics']['count_50'] }}   
                    </li>
                    <li class="list-group-item text-center h6 fw-bold">
                        <img src="{{URL('/images/magik/hit0.png')}}" alt="" width="35px" class="d-inline">
                        : {{ $score['statistics']['count_miss'] }}   
                    </li>
                    </ul>
                </div>

                <div class="card-body" x-show="show === 'pie'">
                    <canvas id="{{$i}}"></canvas>
                </div>
                
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                var id = {!! json_encode($i) !!}
                var ctx = document.getElementById(id);

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                    labels: ['300', '100', '50', 'X'],
                    datasets: [{
                        label: '# of Hits',
                        backgroundColor: ["#49beb7", "#085f63", "#facf5a","#ff5959"],
                        data: [{{ $score['statistics']['count_300'] }}, {{ $score['statistics']['count_100'] }}, {{ $score['statistics']['count_50'] }}, {{ $score['statistics']['count_miss'] }}],
                        borderWidth: 1
                    }]
                    },
                    options: {
                    }
                });
                </script>
                
            </div>
        </div>
        @endforeach
    </div>
</div>


