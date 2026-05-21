<?php

namespace App\Livewire\Achievements;

use Livewire\Component;

class AchievementsList extends Component
{   
    public $level;
    public $achievements;

     public function mount($level, $achievements)
    {
        $this->level = $level;
        $this->achievements = $achievements;
    }
    
    public function render()
    {
        return view('livewire.achievements.achievements-list');
    }
}
