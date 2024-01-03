<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jabatans';

    protected $fillable = [
        'jabatan',
        'tanggal',
        'no_sk',
        'nama_file'
    ];
}
