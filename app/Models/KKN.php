<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KKN extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'k_k_n_s';

    protected $fillable = [
        'deskripsi',
        'tanggal',
        'semester',
        'no_sk',
        'nama_file'
    ];
}
