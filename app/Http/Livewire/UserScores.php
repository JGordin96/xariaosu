<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class UserScores extends Component

{
    public array $scores = [];
    public array $replayScores = [];
    public array $replays = [];
    public array $errors = [];


    public function mount()
    {
        $this->scores = self::getTopScores(env('OSU_USER_ID', null));
        // $this->replays = self::getReplays(env('OSU_USER_ID', null));
        $this->replays = self::getReplays(env('OSU_USER_NAME', null));
        $array = [];
foreach ($this->scores as $i => &$score) {
    $key = array_search($score['beatmapset']['id'], array_column($this->replays, 'mapID'));
    $score['replay_url'] = $this->replays[$key]['videoUrl'];
    $array[] = $score;
}
$this->scores = $array;

    }

    public function getReplays(string $user_name)
    {
        $usr = urldecode($user_name);


        $response = Http::get("https://apis.issou.best/ordr/renders?ordrUsername=$usr");


        return json_decode($response->getBody(), true)['renders'];


    }

    public function getRenderById()
    {
        foreach ($this->scores as $i => &$score) {
            $key = array_search($score['beatmapset']['id'], array_column($this->replays, 'mapID'));
            $score['replay_url'] = $this->replays[$key]['videoUrl'];
            return $score;
        }
    }



    public function getTopScores(string $id)
    {
        // TODO: break data down-beatmapset to go in its own array
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $body = [
            'include_fails' => 0,
            'mode' => 'osu',
            'limit' => 9,
            'offset' => 1,
        ];

        $response = Http::withToken(config('osu.access_token'))->get("https://osu.ppy.sh/api/v2/users/$id/scores/best", [
            'headers' => $headers,
            'body' => $body
        ]);

        return json_decode($response->getBody(), true);


    }

    public function render()
    {
        return view('livewire.user-scores');
    }
}
