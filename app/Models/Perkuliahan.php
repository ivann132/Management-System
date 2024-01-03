<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkuliahan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'perkuliahans';

    protected $fillable = [
        'mata_Kuliah',
        'semester',
        'sks',
        'no_sk',
        'nama_file'
    ];
}
