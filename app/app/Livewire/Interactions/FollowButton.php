<?php

namespace App\Livewire\Interactions;

use Livewire\Component;
use App\Events\UserFollowed;
use App\Events\UserUnfollowed;
use App\Models\User;

class FollowButton extends Component
{
    public $user;
    public bool $isFollowing = false;
    public int $followersCount = 0;
    public int $followingCount = 0;

    public function mount(User $user)
    {
      // Usuario recibido dentro del estadp del componente
      $this->user = $user; 

      $authUser = auth()->user();

      if (! $authUser) {
        $this->isFollowing = false;
        return;
      }

      // Usuario autenticado ya sigue a este perfil?
      // auth()->user() obtenemos el usuario logueado
      // following() usa esta relación, devuelve todos los usuarios que el usuario sigue

      // SQL SELECT * FROM followers WHERE folloer_id = auth_user_id
      // Dentro de los seguidores existe ese usuario?
      $this->isFollowing = $authUser->following()->where('following_id', $user->id)->exists(); 
    }

    public function toggleFollow()
    {
      // Usuario autenticado actualmente
      $authUser = auth()->user();
      
      // Evitar self-follow
      if (! $authUser || $authUser->id === $this->user->id) {
        return;
      }

      // Comprueba si usuario autenticado ya sigue al otro usuario
      if ($this->isFollowing) {
        // Deatch -> elimina la relación en la tabla pivote
        $authUser->following()->detach($this->user->id);

        $this->isFollowing = false;

        event(new UserUnfollowed(
          $authUser,
          $this->user
        ));

      } else {

        $authUser->following()->attach($this->user->id);
  
        $this->isFollowing = true;
  
        event (new UserFollowed(
          $authUser,
          $this->user
        ));
      }
            
      $this->followersCount = $this->user->followers()->count();
      $this->followingCount = $this->user->following()->count();
      $this->dispatch('followUpdated', userId: $this->user->id);
    }

    public function render()
    {
        return view('livewire.interactions.follow-button');
    }
}
