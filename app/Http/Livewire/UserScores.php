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
        self::getReplays(env('OSU_USER_NAME', null));

        foreach($this->scores as $score) {
            self::getRenderById($score['beatmapset']['id']); 
        }
        dd($this->scores);
    }

    public function getReplays(string $user_name)
    {
        $usr = urldecode($user_name);


        $response = Http::get("https://apis.issou.best/ordr/renders?ordrUsername=$usr");

        $this->replays = json_decode($response->getBody(), true);
    }

    public function getRenderById($bm_id)
    {
        foreach ($this->replays['renders'] as $replay) {
            if(!empty($replay['mapID']) && $replay['mapID'] === $bm_id) {
                return $replay['videoUrl'];
            } else {
                return '';
            }
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

        $res = json_decode($response->getBody(), true);
        dd($res);

    }

    public function render()
    {
        return view('livewire.user-scores');
    }
}
