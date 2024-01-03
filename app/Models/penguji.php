<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penguji extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pengujis';

    protected $fillable = [
        'nama_mahasiswa',
        'tanggal',
        'no_sk',
        'nama_file'
    ];
}
