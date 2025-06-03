<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    public function index()
    {
        $books = Buku::with('kategori')->get();

        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);
    }

    public function show($id)
{
    $book = Buku::with('kategori')->find($id);

    if (!$book) {
        return response()->json([
            'status' => 'error',
            'message' => 'Buku tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'status' => 'success',
        'data' => $book
    ]);
}

}





