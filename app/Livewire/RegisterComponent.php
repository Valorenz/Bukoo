<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterComponent extends Component
{
    public $nama, $alamat, $telepon, $email, $password, $password_confirmation;

    public function render()
    {
        return view('livewire.register-component')->layout('components/layouts/login');
    }

    public function register()
    {
        // Validasi input
        $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nama.required' => 'Nama tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal 8 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);

        // Simpan ke database
        User::create([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'password' => Hash::make($this->password, ['rounds' => 10]),
            'jenis' => 'member', // Hanya bisa sebagai member
        ]);

        session()->flash('success', 'Pendaftaran berhasil!');
        $this->reset(['nama', 'email', 'password', 'password_confirmation']); // Reset form
        return redirect()->route('login'); // Arahkan ke halaman login
    }
}
