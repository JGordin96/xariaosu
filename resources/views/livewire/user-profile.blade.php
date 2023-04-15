@php use Carbon\Carbon; @endphp
@php use Carbon\CarbonInterval; @endphp
<script type="text/javascript">
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
</script>
<div class="container mt-5">
    @dump($info)
    <div class="card">
        <div class="card-body">
            <div class="imgs-overlay">
                <div class="rounded">
                    {{-- todo: account for other img sizes --}}
                    <img src="{{ $info['cover_url']}}" alt="Card image cap" class="rounded">

                    <div class="card basic-info">

                        <ul class="list-group list-group-flush" id="bio">
                            <li class="list-group-item">
                                {{ $info['username'] }}
                                <i rel="tooltip" title="{{$info['is_online'] ? 'online' : 'offline'}}"
                                   class="fa fa-circle text-secondary @if($info['is_online']) text-success @endif"
                                   aria-hidden="true"></i>

                                <span class="fi fi-{{strtolower($info['country_code'])}}" rel="tooltip"
                                      title="{{ $info['country']['name'] }}"></span>

                                <span class="badge" style="background-color: pink;">
                                        @if($info['support_level'])
                                        @for ($x = 0; $x < $info['support_level']; $x++)
                                            <i class="fa fa-heart-o" aria-hidden="true" rel="tooltip"
                                               title="osu!supporter"></i>
                                        @endfor
                                    @endif
                                    </span>


                                <span class="badge" style="background-color: blueviolet" rel="tooltip"
                                      title="{{ $info['statistics']['level']['progress'] }}%">
                                        {{ $info['statistics']['level']['current'] }}
                                    </span>
                            </li>

                            <li class="list-group-item align-content-center" style="padding-left: 2rem;">

                                <span class="badge badge-primary text-light"
                                      style="background-color: magenta"
                                      rel="tooltip"
                                      title="{{ $info['statistics']['grade_counts']['ssh'] }}"
                                >
                                    SS
                                </span>

                                <span class="badge badge-primary text-warning"
                                      style="background-color: magenta"
                                      rel="tooltip"
                                      title="{{ $info['statistics']['grade_counts']['ss'] }}"
                                >
                                    SS
                                </span>


                                <span class="badge badge-primary bg-primary text-light"
                                      rel="tooltip"
                                      title="{{ $info['statistics']['grade_counts']['sh'] }}"
                                >
                                    S
                                </span>


                                <span class="badge badge-primary bg-primary text-warning"
                                      rel="tooltip"
                                      title="{{ $info['statistics']['grade_counts']['s'] }}"
                                >
                                    S
                                </span>


                                <span class="badge badge-primary text-light bg-success"
                                      rel="tooltip"
                                      title="{{ $info['statistics']['grade_counts']['a'] }}"
                                >
                                    A
                                </span>

                                <span class="badge badge-primary text-light bg-warning"
                                      rel="tooltip"
                                      title="{{ count($info['user_achievements']) }}"
                                >
                                    <i class="fa fa-trophy" aria-hidden="true"></i>
                                </span>
                            </li>

                            <li class="list-group-item">
                                PP: {{ number_format(round($info['statistics']['pp'])) }}
                                Accuracy: {{ number_format((float)$info['statistics']['hit_accuracy'], 2, '.', '') }}%
                            </li>
                        </ul>

                    </div>
                </div>

                <img class="rounded overlay-pp img-thumbnail" src="{{ $info['avatar_url']}}" alt="Card image cap"
                     width="100px;">
            </div>


            <div class="overlay-content container" x-data="{show : 'rank'}">

                <div class="row">
                    <div class="col-sm p-0">

                        <div class="rank-chart card" x-show="show === 'breakdownprofile'">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        @livewire('score-breakdown', ['score' => $info, 'page' => 'profile'])
                                    </div>
                                    <div class="col">
                                        <ul class="list-group list-group-flush text">
                                            <li class="list-group-item text-center h6 pt-3 fw-bold">
                                                Total Hits: {{ number_format($info['statistics']['total_hits']) }}
                                            </li>
                                            <li class="list-group-item text-center h6 fw-bold">
                                                Max Combo: {{ number_format($info['statistics']['maximum_combo']) }}
                                            </li>
                                            <li class="list-group-item text-center h6 fw-bold">
                                                Total Score: {{ number_format($info['statistics']['total_score']) }}
                                            </li>
                                            <li class="list-group-item text-center h6 fw-bold">
                                                Ranked Score: {{ number_format($info['statistics']['ranked_score']) }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="rank-chart card" x-show="show === 'rank'">
                            <span>
                                <h3 class="card-title ml-3 mt-3 d-inline-block">Global Rank: #{{ number_format($info['statistics']['global_rank']) }}</h3>
                                <h3 class="card-title ml-2 mt-3 d-inline">Country Rank: #{{ number_format($info['statistics']['country_rank']) }}</h3>
                            </span>

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
                                                <li class="list-group-item">Highest Global Rank:
                                                    #{{ number_format($info['rank_highest']['rank']) }}</li>
                                                <li class="list-group-item">
                                                    Achieved {{ Carbon::parse($info['rank_highest']['updated_at'])->diffForHumans() }}</li>
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
                                                display: false

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

                        {{-- todo make line chart a component --}}
                        {{-- todo correct labels for play chart --}}
                        @php
                            $playData = array();
                            $playLabel = array();
                            foreach($info['monthly_playcounts'] as $key=> $val){
                            $playData[] = $val['count'];
                            $playLabel[] = $val['start_date'];
                            }
                            $averagePlays = round(array_sum(array_values($playData)) / count($playData));
                        @endphp

                        <div class="rank-chart card" x-show="show === 'play'">
                            <span>
                                <h3 class="card-title ml-3 mt-3 d-inline-block">Total Plays: {{ number_format($info['statistics']['play_count']) }}</h3>
                                <h3 class="card-title ml-2 mt-3 d-inline">Average Monthly Plays: {{ number_format($averagePlays) }}</h3>
                            </span>
                            <div class="card-body">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div style="height: 110px; width: 400px; position:relative;">
                                                <canvas id="playChart"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Play
                                                    Time: {{ CarbonInterval::seconds($info['statistics']['play_time'])->cascade()->forHumans()}}</li>
                                            </ul>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">This Months
                                                    Plays: {{ number_format(end($info['monthly_playcounts'])['count']) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                var plays = document.getElementById('playChart');

                                new Chart(plays, {
                                    type: 'line',
                                    legend: {
                                        display: false
                                    },
                                    data: {
                                        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'],
                                        datasets: [{
                                            label: 'Monthy Plays',
                                            tension: 0.4,
                                            pointRadius: 0.2,
                                            data: {{json_encode($playData)}},
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                display: false

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
                    <div class="col-sm md-1 p-0">
                        <ul class="nav nav-tabs flex-column profile-nav" role="tablist">
                            <li role="presentation" class="active">
                                <button x-on:click="show = 'rank'" class="nav-link border-primary"
                                        x-bind:class="{ 'bg-primary text-light': show === 'rank' }"><i
                                        class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;
                                </button>
                            </li>
                            <li role="presentation">
                                <button x-on:click="show = 'breakdownprofile'" class="nav-link border-primary"
                                        x-bind:class="{ 'bg-primary text-light': show === 'breakdownprofile' }">激
                                </button>
                            </li>
                            <li role="presentation" class="active">
                                <button x-on:click="show = 'play'" class="nav-link border-primary"
                                        x-bind:class="{ 'bg-primary text-light': show === 'play' }"><i
                                        class="fa fa-play-circle" aria-hidden="true"></i>&nbsp;
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
