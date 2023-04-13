
<div class="container mt-5">
    <div class="row">
        @vite(['resources/js/app.js'])
        @foreach($recentScores as $i => $recent)
        <div class="col mb-5" :wire:key="{{ $i}}" x-data="{show : 'info'}">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $recent['beatmap']['title'] }}</h5>
                    <p class="card-text">{{ucfirst($recent['type'])}} achieved {{ \Carbon\Carbon::parse($recent['created_at'])->diffForHumans() }}.</p>
                </div>
 {{-- C:\Users\dedgv\AppData\Local\osu!   --}}
                
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Rank: #{{ $recent['rank']}} <img src="{{URL("/images/magik/ranking-{$recent['scoreRank']}.png")}}" alt="" width="25px" class="d-inline mb-1"> </li>
                        {{-- <li class="list-group-item">
                            Score: 
                            <img src="{{URL("/images/magik/ranking-{$recent['scoreRank']}.png")}}" alt="" width="25px" class="d-inline"> 
                        </li> --}}
                    </ul>
                

                
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            </div>
        </div>
        @endforeach
    </div>
</div>