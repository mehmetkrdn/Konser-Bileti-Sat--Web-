<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;
use Illuminate\Support\Str;

class ConcertController extends Controller
{
    public function index()
    {
        $konserler = Concert::all();
        return view('admin.konser.index', compact('konserler'));
    }

    public function create()
    {
        return view('admin.konser.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'baslik' => 'required',
        'aciklama' => 'required',
        'konum' => 'required',
        'tarih' => 'required|date',
        'saat' => 'required',
        'stok' => 'required|integer',
        'fiyat' => 'required|numeric',
        'gorsel' => 'nullable|image|mimes:jpeg,png,jpg'
    ]);

    $dosyaAdi = null;
    if ($request->hasFile('gorsel')) {
        $dosya = $request->file('gorsel');
        $dosyaAdi = Str::random(10) . '.' . $dosya->getClientOriginalExtension();
        $dosya->move(public_path('uploads'), $dosyaAdi);
    }

    Concert::create([
        'baslik' => $request->baslik,
        'aciklama' => $request->aciklama,
        'konum' => $request->konum,
        'tarih' => $request->tarih,
        'saat' => $request->saat,
        'stok' => $request->stok,
        'fiyat' => $request->fiyat,
        'gorsel' => $dosyaAdi,
        'aktif' => true,
        'slug' => Str::slug($request->baslik), // ✅ burada olmalı
    ]);

    return redirect()->route('konser.index')->with('success', 'Konser başarıyla eklendi!');
}

    public function edit($id)
    {
        $konser = Concert::findOrFail($id);
        return view('admin.konser.edit', compact('konser'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'baslik' => 'required',
            'aciklama' => 'required',
            'konum' => 'required',
            'tarih' => 'required|date',
            'saat' => 'required',
            'stok' => 'required|integer',
            'fiyat' => 'required|numeric',
            'gorsel' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $konser = Concert::findOrFail($id);

        if ($request->hasFile('gorsel')) {
            $dosya = $request->file('gorsel');
            $dosyaAdi = time() . '.' . $dosya->getClientOriginalExtension();
            $dosya->move(public_path('uploads'), $dosyaAdi);
            $konser->gorsel = $dosyaAdi;
        }

        $konser->update([
            'baslik' => $request->baslik,
            'aciklama' => $request->aciklama,
            'konum' => $request->konum,
            'tarih' => $request->tarih,
            'saat' => $request->saat,
            'stok' => $request->stok,
            'fiyat' => $request->fiyat,
            'aktif' => $request->has('aktif'),
        ]);

        return redirect()->route('konser.index')->with('success', 'Konser güncellendi!');
    }

    public function destroy($id)
    {
        $konser = Concert::findOrFail($id);
        if ($konser->gorsel && file_exists(public_path('uploads/' . $konser->gorsel))) {
            unlink(public_path('uploads/' . $konser->gorsel));
        }
        $konser->delete();
        return redirect()->route('konser.index')->with('success', 'Konser silindi!');
    }
}
