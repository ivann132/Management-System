<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'seminars';

    protected $fillable = [
        'nama_mahasiswa',
        'tanggal',
        'semester',
        'no_seminar',
        'nama_file'
    ];
}
