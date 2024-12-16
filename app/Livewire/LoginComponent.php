<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email, $password;
    public $errorMessage; 

    public function render()
    {
        return view('livewire.login-component')->layout('components/layouts/login');
    }

    public function proses()
    {
        // Validasi input
        $credential = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email Tidak Boleh Kosong!',
            'password.required' => 'Password Tidak Boleh Kosong!',
            'email.email' => 'Format Email Tidak Valid!',
        ]);

        // Autentikasi
        if (Auth::attempt($credential)) {
            session()->regenerate();
            return redirect()->route('home');
        }

        // Jika gagal, set pesan error ke properti Livewire
        $this->errorMessage = 'Autentikasi Gagal! Periksa kembali email dan password Anda.';
    }

    public function keluar()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
