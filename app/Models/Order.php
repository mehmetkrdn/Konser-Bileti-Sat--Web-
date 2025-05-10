<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
protected $fillable = [
    'user_id',
    'urunler',
    'toplam_tutar',
    'durum',
    'odeme_yontemi', // varsa
];
}

