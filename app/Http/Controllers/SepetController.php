<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;
 
class SepetController extends Controller
{
    public function ekle(Request $request, $id)
    {
        $konser = Concert::findOrFail($id);

        $sepet = session()->get('sepet', []); #sepete eklenir.

        
        if (isset($sepet[$id])) {
            $sepet[$id]['adet'] += 1; // Eğer bu bilet daha önce sepete eklendiyse bilet adedi artar sepetteki
        } else {
            // Yeni ekleniyorsa
            $sepet[$id] = [
                'id' => $konser->id,
                'baslik' => $konser->baslik,
                'fiyat' => $konser->fiyat,
                'adet' => 1,
                'gorsel' => $konser->gorsel,
            ];
        }

        session()->put('sepet', $sepet);

        return redirect()->back()->with('success', 'Konser bileti sepete eklendi!');
    }
    public function goster() #sepeti gösterme
{
    $sepet = session()->get('sepet', []);
    $toplam = 0;

    foreach ($sepet as $item) {
        $toplam += $item['fiyat'] * $item['adet'];
    }

    return view('user.sepet', compact('sepet', 'toplam'));
}

public function sil($id)#sepetten çıkarma
{
    $sepet = session()->get('sepet', []);

    if (isset($sepet[$id])) {
        unset($sepet[$id]);
        session()->put('sepet', $sepet);
    }

    return redirect()->route('sepet.goster')->with('success', 'Ürün sepetten çıkarıldı.');
}
public function artir($id)
{
    $sepet = session()->get('sepet', []);
    if (isset($sepet[$id])) {
        $sepet[$id]['adet']++;
        session()->put('sepet', $sepet);
    }
    return redirect()->back();
}

public function azalt($id)
{
    $sepet = session()->get('sepet', []);
    if (isset($sepet[$id]) && $sepet[$id]['adet'] > 1) {
        $sepet[$id]['adet']--;
        session()->put('sepet', $sepet);
    }
    return redirect()->back();
}
}
