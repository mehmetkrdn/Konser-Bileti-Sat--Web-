<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $arama = $request->input('q');

        $query = Concert::where('aktif', true);

        if ($arama) {
            $query->where('baslik', 'like', '%' . $arama . '%');
        }

        $konserler = $query->latest()->take(15)->get();

        return view('dashboard', compact('konserler', 'arama'));
    }
}
