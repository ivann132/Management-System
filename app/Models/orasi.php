<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orasi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'orasis';

    protected $fillable = [
        'keg_orasi',
        'nama_file'
    ];
}
