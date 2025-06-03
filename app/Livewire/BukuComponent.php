<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;


class BukuComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $kategori, $judul, $penulis, $penerbit, $isbn, $tahun, $jumlah, $cari, $id;

    public function render()
    {
        if ($this->cari != '') {
            $data['buku'] = Buku::where('judul', 'like', '%' . $this->cari . '%')
                ->orWhere('penulis', 'like', '%' . $this->cari . '%')
                ->orWhere('penerbit', 'like', '%' . $this->cari . '%')
                ->orWhere('tahun', 'like', '%' . $this->cari . '%')
                ->paginate(10);
        } else {
            $data['buku'] = Buku::paginate(10);
        }
        $data['category'] = Kategori::all();
        $layout['title'] = 'Kelola Buku';
        return view('livewire.buku-component', $data)->layoutData($layout);
    }

    public function store()
    {
        $this->validate([
            'judul' => 'required',
            'tahun' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required',
            'isbn' => 'required',
            'jumlah' => 'required'
        ], [
            'judul.required' => 'Judul Buku Tidak Boleh Kosong!',
            'tahun.required' => 'Kategori Tidak Boleh Kosong!',
            'penulis.required' => 'Penulis Tidak Boleh Kosong!',
            'penerbit.required' => 'Penerbit Tidak Boleh Kosong!',
            'tahun.required' => 'Tahun Terbit Tidak Boleh Kosong!',
            'isbn.required' => 'ISBN Tidak Boleh Kosong!',
            'jumlah.required' => 'Jumlah Buku Tidak Boleh Kosong!'
        ]);

        Buku::create([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun' => $this->tahun,
            'isbn' => $this->isbn,
            'jumlah' => $this->jumlah
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Tambah!');
        return redirect()->route('buku');
    }

    public function resetForm()
    {
        $this->judul = '';
        $this->kategori = '';
        $this->penulis = '';
        $this->penerbit = '';
        $this->isbn = '';
        $this->tahun = '';
        $this->jumlah = '';
        $this->id = null;
    }

    public function edit($id)
    {
        $buku = Buku::find($id);
        $this->id = $buku->id;
        $this->judul = $buku->judul;
        $this->kategori = $buku->kategori->id;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->tahun = $buku->tahun;
        $this->isbn = $buku->isbn;
        $this->jumlah = $buku->jumlah;
    }

    public function update()
    {
        $buku = Buku::find($this->id);
        $buku->update([
            'judul' => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun' => $this->tahun,
            'isbn' => $this->isbn,
            'jumlah' => $this->jumlah
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil Ubah!');
        return redirect()->route('buku');
    }

    public function confirm($id)
    {
        $this->id = $id;
    }

    public function destroy()
    {
        $buku = Buku::find($this->id);
        $buku->delete();
        $this->reset();
        session()->flash('success', 'Berhasil Hapus!');
        return redirect()->route('buku');
    }


public $searchQuery;

public function searchBook()
{
    $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
        'q' => $this->searchQuery
    ]);

    $books = $response->json()['items'] ?? [];

    if (count($books) > 0) {
        $book = $books[0]['volumeInfo'];

        $this->judul = $book['title'] ?? '';
        $this->penulis = implode(', ', $book['authors'] ?? []);
        $this->penerbit = $book['publisher'] ?? '';
        $this->tahun = isset($book['publishedDate']) ? substr($book['publishedDate'], 0, 4) : '';
        $this->isbn = collect($book['industryIdentifiers'] ?? [])
                        ->firstWhere('type', 'ISBN_13')['identifier'] ?? '';
    } else {
        session()->flash('error', 'Buku tidak ditemukan.');
    }
}


    
}
