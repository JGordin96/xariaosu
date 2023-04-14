<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ScoreBreakdown extends Component
{
    public array $score;

    public string $page;
 
    public function mount($score, $page)
    {
        $this->score = $score;
        $this->page = $page;
    }
    public function render()
    {
        return view('livewire.score-breakdown');
    }
}
