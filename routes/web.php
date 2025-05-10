<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\PublicConcertController;
use App\Http\Controllers\SepetController;
use App\Http\Controllers\OdemeController;
use App\Http\Controllers\AdminSiparisController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiparisController;

Route::get('/', function () {
    return view('welcome');
});

// Konser listeleme ve detay
Route::get('/konserler', [PublicConcertController::class, 'index'])->name('user.konserler');
Route::get('/konser/{slug}', [PublicConcertController::class, 'show'])->name('konser.detay');

// Sepet işlemleri
Route::post('/sepet/ekle/{id}', [SepetController::class, 'ekle'])->name('sepet.ekle');
Route::get('/sepet', [SepetController::class, 'goster'])->name('sepet.goster');
Route::post('/sepet/artir/{id}', [SepetController::class, 'artir'])->name('sepet.artir');
Route::post('/sepet/azalt/{id}', [SepetController::class, 'azalt'])->name('sepet.azalt');
Route::post('/sepet/sil/{id}', [SepetController::class, 'sil'])->name('sepet.sil');

// Ödeme
Route::get('/odeme', [OdemeController::class, 'index'])->name('odeme.index');
Route::post('/odeme', [OdemeController::class, 'odemeYap'])->name('odeme.yap');

// Hesap pasif/aktif
Route::post('/profilim/pasif', [ProfilController::class, 'pasif'])->name('profil.pasif');
Route::post('/profilim/aktif-et', [ProfilController::class, 'aktifEt'])->name('profil.aktif');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin panel
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.panel');
    
     Route::get('/kullanicilar', [App\Http\Controllers\AdminUserController::class, 'index'])
         ->name('admin.kullanicilar');
    Route::get('/kullanici-duzenle/{id}', [App\Http\Controllers\AdminUserController::class, 'edit'])
         ->name('admin.kullanici.edit');
    Route::put('/kullanici-duzenle/{id}', [App\Http\Controllers\AdminUserController::class, 'update'])
         ->name('admin.kullanici.update');
    Route::delete('/kullanici-sil/{id}', [App\Http\Controllers\AdminUserController::class, 'destroy'])
         ->name('admin.kullanici.destroy');
    Route::post('/kullanici/pasiflestir/{id}', [App\Http\Controllers\AdminUserController::class, 'pasiflestir'])
         ->name('admin.kullanici.pasif');

    Route::get('/admin/konserler', [ConcertController::class, 'index'])->name('konser.index');
    Route::get('/admin/konser-ekle', [ConcertController::class, 'create'])->name('konser.create');
    Route::post('/admin/konser-ekle', [ConcertController::class, 'store'])->name('konser.store');
    Route::get('/admin/konser-duzenle/{id}', [ConcertController::class, 'edit'])->name('konser.edit');
    Route::put('/admin/konser-duzenle/{id}', [ConcertController::class, 'update'])->name('konser.update');
    Route::delete('/admin/konser-sil/{id}', [ConcertController::class, 'destroy'])->name('konser.destroy');

    Route::get('/admin/siparisler', [AdminSiparisController::class, 'index'])->name('admin.siparisler');
    Route::post('/admin/siparis/{id}/guncelle', [AdminSiparisController::class, 'guncelle'])->name('admin.siparis.guncelle');
});

// Kullanıcı işlemleri
Route::middleware('auth')->group(function () {
    // Profil işlemleri
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profilim', [ProfilController::class, 'goster'])->name('profil.goster');
    Route::post('/profilim', [ProfilController::class, 'guncelle'])->name('profil.guncelle');

    // Sipariş işlemleri
    Route::get('/siparislerim', [SiparisController::class, 'index'])->name('user.siparisler');
    Route::post('/siparislerim/{id}/teslim-al', [SiparisController::class, 'teslimAl'])->name('user.siparis.teslimal');
    Route::post('/siparislerim/{id}/iptal', [\App\Http\Controllers\SiparisController::class, 'iptalEt'])->name('user.siparis.iptal');
});

require __DIR__.'/auth.php';
