<?php

namespace App\Livewire;

use App\Models\Pengembalian;
use App\Models\Pinjam;
use DateTime;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class KembaliComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $id, $judul, $member, $tglkembali, $lama, $status, $denda;

    public function render()
    {
        $user = auth()->user(); // Mendapatkan data pengguna yang sedang login
        
        if ($user->jenis === 'admin') {
            // Admin melihat semua data peminjaman dan pengembalian
            $data['pinjam'] = Pinjam::where('status', 'pinjam')->paginate(10);
            $data['pengembalian'] = Pengembalian::paginate(10);
        } else {
            // Member hanya melihat data peminjaman dan pengembalian yang terkait dirinya
            $data['pinjam'] = Pinjam::where('status', 'pinjam')
                ->where('user_id', $user->id)
                ->paginate(10);
            $data['pengembalian'] = Pengembalian::whereHas('pinjam', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->paginate(10);
        }
    
        $layout['title'] = 'Pengembalian Buku';
        return view('livewire.kembali-component', $data)->layoutData($layout);
    }
    

    public function pilih($id)
    {
        $pinjam = Pinjam::find($id);
        $this->judul = $pinjam->buku->judul;
        $this->member = $pinjam->user->nama;
        $this->tglkembali = $pinjam->tgl_kembali;
        $this->id = $pinjam->id;

        $kembali = new DateTime($this->tglkembali);
        $today = new DateTime();
        $selisih = $today->diff($kembali);
        if ($selisih->invert == 1) {
            $this->status = true;
        } else {
            $this->status = false;
        }
        $this->lama = $selisih->d;
    }

    public function store()
    {
        if ($this->status == true) {
            $this->denda = $this->lama * 1000;
        } else {
            $this->denda = 0;
        }
        $pinjam = Pinjam::find($this->id);
        Pengembalian::create([
            'pinjam_id' => $this->id,
            'tgl_kembali' => date('Y-m-d'),
            'denda' => $this->denda
        ]);
        $pinjam->update([
            'status' => 'kembali'
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Proses Data!');
        return redirect()->route('kembali');
    }
}
