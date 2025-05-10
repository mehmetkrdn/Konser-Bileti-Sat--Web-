@extends('layouts.app')
@section('title','Kullanıcı Düzenle')
@section('content')
<h2 class="mb-4">✏️ {{ $user->name }} Düzenle</h2>

<form action="{{ route('admin.kullanici.update',$user->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Ad Soyad</label>
    <input type="text" name="name" value="{{ old('name',$user->name) }}" class="form-control">
  </div>
  <div class="mb-3">
    <label>E-posta</label>
    <input type="email" name="email" value="{{ old('email',$user->email) }}" class="form-control">
  </div>
  <div class="mb-3">
    <label>Bakiye (₺)</label>
    <input type="text" name="bakiye" value="{{ old('bakiye',$user->bakiye) }}" class="form-control">
  </div>
  <div class="mb-3">
    <label>Rol</label>
    <select name="role" class="form-select">
      <option value="user"{{ $user->role==='user'?' selected':'' }}>User</option>
      <option value="admin"{{ $user->role==='admin'?' selected':'' }}>Admin</option>
    </select>
  </div>
  <div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="aktif" id="aktif"{{ $user->aktif?' checked':'' }}>
    <label class="form-check-label" for="aktif">Aktif mi?</label>
  </div>
  <button class="btn btn-primary">Güncelle</button>
</form>
@endsection
