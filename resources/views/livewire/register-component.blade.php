<div class="login-container">
    <div class="login-header">
        <img src="{{ asset('assets/login.png') }}" alt="Library Logo">
        <h2>Register Bukoo</h2>
    </div>
    <form>
        <div class="form-group">
            <input type="text" wire:model="nama" class="form-control" id="nama" placeholder="Nama Lengkap">
            @error('nama')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" wire:model="alamat" class="form-control" id="alamat" placeholder="Alamat">
            @error('alamat')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" wire:model="telepon" class="form-control" id="telepon" placeholder="Nomor Telepon">
            @error('telepon')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" wire:model="email" class="form-control" id="email" placeholder="Alamat Email">
            @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" wire:model="password" class="form-control" id="password" placeholder="Password">
            @error('password')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" wire:model="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password">
            @error('password_confirmation')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="button" wire:click="register" class="btn btn-primary btn-login">Register</button>
    </form>
</div>
