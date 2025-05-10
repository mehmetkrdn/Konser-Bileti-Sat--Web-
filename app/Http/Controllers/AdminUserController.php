<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $kullanicilar = User::latest()->paginate(15);
        return view('admin.kullanicilar.index', compact('kullanicilar'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.kullanicilar.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => "required|email|unique:users,email,{$id}",
            'bakiye' => 'nullable|numeric',
            'role'   => 'required|in:admin,user',
            'aktif'  => 'sometimes|boolean'
        ]);

        User::findOrFail($id)->update($data);

        return redirect()->route('admin.kullanicilar')
                         ->with('success','Kullanıcı başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success','Kullanıcı silindi.');
    }

    public function pasiflestir($id)
    {
        $user = User::findOrFail($id);
        $user->aktif = !$user->aktif;
        $user->save();

        $mesaj = $user->aktif ? 'Kullanıcı aktifleştirildi.' : 'Kullanıcı pasifleştirildi.';
        return back()->with('success',$mesaj);
    }
}
