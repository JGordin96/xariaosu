<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class RecentScores extends Component
{
    public array $recentScores = [];

    public function mount()
    {
        $this->recentScores = self::getRecentScores(env('OSU_USER_ID', null));
    }

    public function getRecentScores(string $id)
    {
        // TODO: break data down-beatmapset to go in its own array
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $body = [
            'include_fails' => 1,
            'mode' => 'osu',
            'limit' => 9,
            'offset' => 1,
        ];

        $response = Http::withToken(config('osu.access_token'))->get("https://osu.ppy.sh/api/v2/users/$id/recent_activity", [
            'headers' => $headers,
            'body' => $body
        ]);

        return (json_decode($response->getBody(), true));

    }

    public function render()
    {
        return view('livewire.recent-scores');
    }
}
