<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ForgotPasswordComponent extends Component
{
    public $email, $nama, $telepon;

    public function verifyUser()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'nama' => 'required|string',
            'telepon' => 'required|string',
        ], [
            'email.exists' => 'Email tidak terdaftar!',
        ]);

        $user = User::where('email', $this->email)
            ->where('nama', $this->nama)
            ->where('telepon', $this->telepon)
            ->first();

        if ($user) {
            return redirect()->route('reset-password-form', ['email' => $this->email]);
        }

        session()->flash('error', 'Data yang Anda masukkan tidak cocok!');
    }

    public function render()
    {
        return view('livewire.forgot-component')->layout('components/layouts/login');
    }
}
