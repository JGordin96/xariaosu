<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class UserProfile extends Component
{
    public array $info = [];

    public function mount()
    {
        $this->info = self::getUserInfo(env('OSU_USER_ID', null));
    }

    public function getUserInfo(string $id)
    {
        // TODO: break data down-beatmapset to go in its own array
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $response = Http::withToken(config('osu.access_token'))->get("https://osu.ppy.sh/api/v2/users/$id", [
            'headers' => $headers,
        ]);

        return (json_decode($response->getBody(), true));

    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
