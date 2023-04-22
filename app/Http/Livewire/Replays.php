<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Replays extends Component
{
    public ?string $osuUserName = '';

    public string $mapId = '';

    public string $replayUrl;

    public array $errors = [];

    public array $replays = [];

    public function mount(string $mapId)
    {
        $this->mapId = $mapId;
        $this->osuUserName = env('OSU_USER_NAME', null);
        $this->replays = self::getReplay($this->osuUserName);
        
    }

    public function getReplays(string $user_name)
    {
        $usr = urldecode($user_name);

        try {
    
            $response = Http::get("https://apis.issou.best/ordr/renders?ordrUsername=$usr");
    
            return json_decode($response->getBody(), true);

        } catch(\Exception $e) {
            $this->errors[] = 'Error getting renders!';
        }
        
    }

    public function render()
    {
        return view('livewire.replays');
    }
}
