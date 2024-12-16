<div class="login-container">
    <div class="login-header">
        <img src="{{ asset('assets/login.png') }}" alt="Library Logo">
        <h2>Reset Password</h2>
    </div>
    <form wire:submit.prevent="resetPassword">
        <div class="form-group">
            <input type="password" wire:model="password" class="form-control" placeholder="New Password">
            @error('password')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" wire:model="password_confirmation" class="form-control" placeholder="Confirm Password">
            @error('password_confirmation')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-login">Reset Password</button>
    </form>
</div>
