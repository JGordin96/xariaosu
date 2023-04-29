<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class UserScores extends Component

{
    public array $scores = [];
    public array $replays = [];
    public array $errors = [];
    public string $skin;


    public function mount()
    {
        $this->scores = self::getTopScores(env('OSU_USER_ID', null));

        $this->replays = self::getReplays(env('OSU_USER_NAME', null));

        $scoresWithReplays = [];
        foreach ($this->scores as $i => &$score) {
            $key = array_search($score['beatmapset']['id'], array_column($this->replays, 'mapID'));
            $score['replay_url'] = $this->replays[$key]['videoUrl'];
            $scoresWithReplays[] = $score;
        }
        $this->scores = $scoresWithReplays;

    }

    public function getReplays(string $user_name)
    {
        $usr = urldecode($user_name);


        $response = Http::get("https://apis.issou.best/ordr/renders?ordrUsername=$usr");


        return json_decode($response->getBody(), true)['renders'];


    }


    public function getTopScores(string $id)
    {
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
