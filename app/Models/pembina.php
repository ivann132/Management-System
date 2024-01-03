<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembina extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pembinas';

    protected $fillable = [
        'nama_penasehat',
        'tanggal',
        'no_sk',
        'nama_file'
    ];
}
