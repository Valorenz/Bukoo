<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfileComponent extends Component
{
    public $nama, $email, $password, $telepon, $alamat, $user, $currentPassword, $newPassword, $newPassword_confirmation;

    public function mount()
    {
        $this->user = Auth::user();
        $this->nama = $this->user->nama;
        $this->email = $this->user->email;
        $this->telepon = $this->user->telepon;
        $this->alamat = $this->user->alamat;
    }

    public function updateProfile()
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'telepon' => 'nullable',
            'alamat' => 'nullable',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak sesuai dengan format.'
        ]);

        $this->user = Auth::user();
        $this->user->update([
            'nama' => $this->nama,
            'email' => $this->email,
            'telepon' => $this->telepon,
            'alamat' => $this->alamat,
        ]);

        session()->flash('success', 'Profile berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|same:newPassword_confirmation',
            'newPassword_confirmation' => 'required',
        ], [
            'currentPassword.required' => 'Password lama harus diisi.',
            'newPassword.required' => 'Password baru harus diisi.',
            'newPassword.min' => 'Password baru minimal harus 6 karakter.',
            'newPassword_confirmation.required' => 'Konfirmasi password baru harus diisi.',
            'newPassword.same' => 'Konfirmasi password baru tidak sesuai.'
        ]);

        $this->user = Auth::user();

        if (!Hash::check($this->currentPassword, $this->user->password)) {
            session()->flash('error', 'Password lama tidak sesuai.');
            return;
        }

        $this->user->update([
            'password' => Hash::make($this->newPassword),
        ]);

        session()->flash('success', 'Password berhasil diperbarui.');
        $this->reset(['currentPassword', 'newPassword', 'newPassword_confirmation']);
    }

    public function deleteAccount()
    {
        $user = $this->user;
        $user->delete();
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();
        session()->flash('success', 'Akun Anda berhasil dihapus.');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.profile-component')->layout('components.layouts.app', ['title' => 'Profile']);
    }
}
