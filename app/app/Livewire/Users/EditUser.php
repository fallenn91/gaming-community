<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EditUser extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $bio = '';
    public $avatar; 
    public $banner; 
    public bool $success = false;
    public string $message = '';

    public function mount()
    {
      $user = auth()->user();

      $this->name = $user->name;
      $this->username = $user->username;
      $this->email = $user->email;
      $this->bio = $user->bio ?? '';
    }
    public function editUser()
    {
      $this->reset(['success', 'message']);

      $user = auth()->user();
      $this->validate([
        'name' => 'required|string|max:55',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email',
        'password' => 'nullable|password|min:8',
        'bio' => 'required|string|max:255',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'banner' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
      ]);

      $avatarPath = $user->avatar;
      $bannerPath = $user->banner;

      if ($this->avatar) {
          $avatarPath = $this->avatar->store('avatars', 'public');
      }

      if ($this->banner) {
          $bannerPath = $this->banner->store('banners', 'public');
      }

      $data = [
          'name' => $this->name,
          'username' => $this->username,
          'email' => $this->email,
          'bio' => $this->bio,
          'avatar' => $avatarPath,
          'banner' => $bannerPath,
      ];

      if (!empty($this->password)) {
          $data['password'] = Hash::make($this->password);
      }

      $user->update($data);

      $this->success = true;
      $this->message = 'Perfil actualizado correctamente';

      $this->password = '';
            
    }

    public function render()
    {
        return view('livewire.users.edit-user');
    }
}
