<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MostPlayed extends Component
{
    public array $mostPlayedMaps = [];

    public function mount()
    {
        $this->mostPlayedMaps = self::getMostPlayedMaps(env('OSU_USER_ID', null));
    }
    public function getMostPlayedMaps(string $id)
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $body = [
            'include_fails' => 0,
            'mode' => 'osu',
            'limit' => 5,
            'offset' => 1,
        ];

        $response = Http::withToken(config('osu.access_token'))->get("https://osu.ppy.sh/api/v2/users/$id/beatmapsets/most_played", [
            'headers' => $headers,
            'body' => $body
        ]);

        return json_decode($response->getBody(), true);

    }
    public function render()
    {
        return view('livewire.most-played');
    }
}
