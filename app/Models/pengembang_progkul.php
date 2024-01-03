<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengembang_progkul extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'pengembang_progkuls';

    protected $fillable = [
        'deskripsi',
        'nama_file'
    ];
}
