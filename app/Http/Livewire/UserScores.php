<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class UserScores extends Component

{
    public array $scores = [];
    

    public function mount()
    {
        $this->scores = self::getTopScores(env('OSU_USER_ID', null));
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
