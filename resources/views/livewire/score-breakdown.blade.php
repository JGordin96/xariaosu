
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
