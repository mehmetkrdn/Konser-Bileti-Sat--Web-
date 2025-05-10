<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;

class PublicConcertController extends Controller
{
    // Satıştaki konserleri listele
    public function index()
    {
        $konserler = Concert::where('aktif', true)->get();
        return view('user.konserler', compact('konserler'));
    }
    public function show($slug)
{
    $konser = \App\Models\Concert::where('slug', $slug)->where('aktif', true)->firstOrFail();
    return view('user.konser-detay', compact('konser'));
}
}