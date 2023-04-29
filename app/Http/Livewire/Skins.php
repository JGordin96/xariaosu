<?php

namespace App\Http\Livewire;


use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class Skins extends Component
{
    use WithFileUploads;
    
    public array $skins;

    public string $selectedSkin;


    public function mount()
    {
        $this->skins = self::getUploadedSkins();
        $this->selectedSkin = $this->skins[0] ?? '';
        // View::share('skin', $this->selectedSkin);
    }

    public function getUploadedSkins() {
        $path = public_path();
        $files = File::allFiles($path);
        $skin_directories = File::directories(public_path('images'));
        $skin_names = [];

        foreach($skin_directories as $skin) {
            $skin_names[] = basename($skin);
        }

        return $skin_names;

    }

    public function updatedSelectedSkin($value) {
        
    }


    public function render()
    {
        return view('livewire.skins');
    }
}
