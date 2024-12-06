<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPasswordComponent extends Component
{
    public $email, $password, $password_confirmation;

    public function mount($email)
    {
        $this->email = $email;
    }

    public function resetPassword()
    {
        $this->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $this->email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($this->password),
            ]);

            session()->flash('success', 'Password berhasil direset! Silakan login.');
            return redirect()->route('login');
        }

        session()->flash('error', 'Terjadi kesalahan, silakan coba lagi.');
    }

    public function render()
    {
        return view('livewire.reset-component')->layout('components/layouts/login');
    }
}
