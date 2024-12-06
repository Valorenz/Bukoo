<div class="login-container">
    <div class="login-header">
        <img src="{{ asset('assets/login.png') }}" alt="Library Logo">
        <h2>Forgot Password</h2>
    </div>
    <form>
        <div class="form-group">
            <input type="text" wire:model="email" class="form-control" placeholder="Enter Your Email">
            @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" wire:model="nama" class="form-control" placeholder="Enter Your Name">
            @error('nama')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" wire:model="telepon" class="form-control" placeholder="Enter Your Phone Number">
            @error('telepon')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="button" wire:click="verifyUser" class="btn btn-primary btn-login">Verify</button>
    </form>
    <div class="text-center">
        <a href="{{ route('login') }}">Back to Login</a>
    </div>
</div>
