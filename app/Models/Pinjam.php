<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pinjams';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'buku_id', 'user_id', 'tgl_pinjam', 'tgl_kembali', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
