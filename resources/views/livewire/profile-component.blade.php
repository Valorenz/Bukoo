<div>
    <div class="card">
        <div class="card-header">
            Profil Saya
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Update Profile -->
            <form wire:submit.prevent="updateProfile">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" wire:model="nama">
                    @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" wire:model="email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" class="form-control" wire:model="telepon">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" wire:model="alamat"></textarea>
                </div>
                <div class="form-group">
                    <label>Jenis Akun</label>
                    <input type="text" class="form-control" value="{{ $user->jenis }}" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>

            <hr>

            <!-- Update Password -->
            <form wire:submit.prevent="updatePassword">
                <h3>Ubah Password</h3>

                <!-- Input Password Lama -->
                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" class="form-control" wire:model="currentPassword">
                    @error('currentPassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Password Baru -->
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" class="form-control" wire:model="newPassword">
                    @error('newPassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Konfirmasi Password Baru -->
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" wire:model="newPassword_confirmation">
                    @error('newPassword_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-warning">Update Password</button>
            </form>
        </div>
    </div>
    <hr>

    <!-- Delete Account -->
    <button type="button" class="btn btn-danger mt-3" data-toggle="modal" data-target="#deleteAccountModal">
        Hapus Akun
    </button>
    <div wire:ignore.self class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountLabel">Hapus Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus akun ini? Data Anda tidak akan bisa dipulihkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteAccount" data-dismiss="modal">
                        Ya, Hapus Akun
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
