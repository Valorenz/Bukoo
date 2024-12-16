<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PinjamComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';

    public $id, $user, $buku, $tgl_pinjam, $tgl_kembali;

    public function mount()
    {
        // Set user ke ID member yang sedang login
        $this->user = auth()->user()->id;
    }

    public function render()
    {
        $user = auth()->user(); // Mendapatkan data pengguna yang sedang login
        
        // Filter data peminjaman
        if ($user->jenis === 'admin') {
            // Jika admin, ambil semua data pinjam
            $data['pinjam'] = Pinjam::with(['buku', 'user'])
                ->whereHas('buku')
                ->whereHas('user')
                ->paginate(10);
        } else {
            // Jika member, hanya ambil data pinjam yang sesuai dengan user login
            $data['pinjam'] = Pinjam::with(['buku', 'user'])
                ->where('user_id', $user->id) // Filter berdasarkan ID pengguna
                ->whereHas('buku')
                ->paginate(10);
        }
        
        // Data tambahan
        $data['members'] = User::where('jenis', 'member')->get();
        $data['book'] = Buku::all();
    
        // Layout tambahan
        $layout['title'] = 'Pinjam Buku';
    
        // Return view dengan data dan layout
        return view('livewire.pinjam-component', $data)->layoutData($layout);
    }
    

    public function store()
    {
        $this->validate([
            'buku' => 'required',
        ], [
            'buku.required' => 'Buku Harus Dipilih!',
        ]);

        $this->tgl_pinjam = date('Y-m-d');
        $this->tgl_kembali = date('Y-m-d', strtotime($this->tgl_pinjam . '+7 days'));

        Pinjam::create([
            'user_id' => $this->user, // Menggunakan ID user yang login
            'buku_id' => $this->buku,
            'tgl_pinjam' => $this->tgl_pinjam,
            'tgl_kembali' => $this->tgl_kembali,
            'status' => 'pinjam',
        ]);

        $this->reset(['buku']); // Reset hanya buku, user tetap login
        session()->flash('success', 'Berhasil Proses Data!');
        return redirect()->route('pinjam');
    }

    public function resetForm()
    {
        $this->buku = '';
        $this->id = null;
    }

    public function edit($id)
    {
        $pinjam = Pinjam::find($id);
        $this->id = $pinjam->id;
        $this->user = $pinjam->user_id;
        $this->buku = $pinjam->buku_id;
        $this->tgl_pinjam = $pinjam->tgl_pinjam;
        $this->tgl_kembali = $pinjam->tgl_kembali;
    }

    public function update()
    {
        $pinjam = Pinjam::find($this->id);

        $this->tgl_pinjam = date('Y-m-d');
        $this->tgl_kembali = date('Y-m-d', strtotime($this->tgl_pinjam . '+7 days'));

        $pinjam->update([
            'user_id' => $this->user, // Tetap menggunakan ID user yang login
            'buku_id' => $this->buku,
            'tgl_pinjam' => $this->tgl_pinjam,
            'tgl_kembali' => $this->tgl_kembali,
            'status' => 'pinjam',
        ]);

        $this->reset(['buku']);
        session()->flash('success', 'Berhasil Ubah Data!');
        return redirect()->route('pinjam');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $pinjam = Pinjam::find($this->id);
        $pinjam->delete();
        $this->reset();
        session()->flash('success', 'Berhasil Hapus Data!');
        return redirect()->route('pinjam');
    }
}
