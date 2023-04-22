@foreach($replays as $replay)
    <div class="card-body" x-show="show === 'replay'">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="{{ $replay['replay_url'] }}" allowfullscreen></iframe>       
        </div>
    </div>
@endforeach
