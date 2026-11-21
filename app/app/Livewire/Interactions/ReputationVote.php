<?php

namespace App\Livewire\Interactions;

use Livewire\Component;
use App\Models\User;
use App\Services\ReputationService;

class ReputationVote extends Component
{
    public User $target;
    public int $reputation;
    public ?string $myVote = null;
    public string $errorMessage = '';

    public function mount(User $target): void
    {
      $this->target = $target;
      $this->reputation = $target->reputation;
      $cacheKey = 'rep_vote:' . auth()->id() . ':' . $target->id;
      $this->myVote     = \Illuminate\Support\Facades\Cache::get($cacheKey);
    }

    public function vote(string $type): void
    {
      if (!auth()->check()) return;

      $result = app(ReputationService::class)->vote(
        $this->target,
        auth()->user(),
        $type
      );

      if ($result['success']) {
        $this->reputation = $result['reputation'];
        $this->myVote = $type;
        $this->errorMessage = '';
      } else {
        $this->errorMessage = $result['message'];
      }
    }
    public function render()
    {
        return view('livewire.interactions.reputation-vote');
    }
}
