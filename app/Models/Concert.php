<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $fillable = [
        'baslik',
        'aciklama',
        'konum',
        'tarih',
        'saat',
        'stok',
        'fiyat',
        'gorsel',
        'aktif',
        'slug',
    ];
}
