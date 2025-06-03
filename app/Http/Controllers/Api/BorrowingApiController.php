<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pinjam;

class BorrowingApiController extends Controller
{
    public function index()
    {
        $borrowings = Pinjam::with(['user', 'buku'])->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $borrowings
        ]);
    }
}
