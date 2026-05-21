<?php

namespace App\Livewire\Achievements;

use Livewire\Component;

class UserProgress extends Component
{   
    public $user;
    public $level;
    public $progress;

    public function render()
    {
        return view('livewire.achievements.user-progress');
    }

    public function mount($user)
    {
      $this->user = $user;
      $this->level = $user->getAchievementLevelAttribute();
      $this->progress = $user->achievements()->wherePivot('progress', '>', 0)->count();
    }
}
