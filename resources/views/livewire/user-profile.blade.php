<div class="container mt-5">
    {{-- @dump($info) --}}
    <div class="card">
        <div class="card-body" >
            <div class="imgs-overlay">
                <div class="rounded">
                    {{-- todo: account for other img sizes --}}
                    <img  src="{{ $info['cover_url']}}" alt="Card image cap" class="rounded">
                    <div class="card basic-info">

                            <ul class="list-group list-group-flush" id="bio">
                                <li class="list-group-item">
                                    {{ $info['username'] }} 
                                    <i class="fa fa-circle text-secondary @if($info['is_online']) text-success @endif" aria-hidden="true"></i> 
                                    <span class="fi fi-{{strtolower($info['country_code'])}} "></span>

                                    <span class="badge" style="background-color: pink;">   
                                        @for ($x = 0; $x < $info['support_level']; $x++) 
                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        @endfor     
                                    </span>
                                    
                                    
                                    <span class="badge" style="background-color: blueviolet">
                                        {{ $info['statistics']['level']['current'] }}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    PP: {{ round($info['statistics']['pp']) }}
                                    Accuracy: {{ number_format((float)$info['statistics']['hit_accuracy'], 2, '.', '') }}
                                </li>
                            </ul>
                
                    </div>
                </div>
                
                <img class="rounded overlay" src="{{ $info['avatar_url']}}" alt="Card image cap">
            </div>
  
            <div class="card overlay-content">
                <div class="">
                    <h3 class="card-title ml-3 mt-3">Global Rank: #{{ end($info['rank_history']['data']) }}</h3>
                    <div class="card-body">
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div style="height: 110px; width: 400px;">
                                        <canvas id="rankChart"></canvas>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Highest Global Rank: #{{ $info['rank_highest']['rank'] }}</li>
                                        <li class="list-group-item">Achieved {{ \Carbon\Carbon::parse($info['rank_highest']['updated_at'])->diffForHumans() }}</li>
                                    </ul>  
                                </div>
                            </div>    
                        </div>
                    </div>
                    
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
                    <script>
                    var rank = document.getElementById('rankChart');
    
                    new Chart(rank, {
                        type: 'line',
                        legend: {
                            display: false
                        },
                        data: {
                        labels: {{json_encode($info['rank_history']['data'])}},
                            datasets: [{
                                label: 'Global Ranking',
                                tension: 0.4,
                                pointRadius: 0.2,
                                data: {{json_encode($info['rank_history']['data'])}},
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    reverse: true,
                                    display:false
   
                                },
                                x: {
                                    display: false,
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                    </script>
                </div>
            </div>   
        </div>
    </div>
</div>