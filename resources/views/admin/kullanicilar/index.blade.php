@extends('layouts.app')
@section('title','Kullanıcı Yönetimi')
@section('content')
<h2 class="mb-4">👥 Kullanıcılar</h2>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th><th>Ad</th><th>Email</th><th>Rol</th><th>Durum</th><th>İşlem</th>
    </tr>
  </thead>
  <tbody>
  @foreach($kullanicilar as $u)
    <tr>
      <td>{{ $u->id }}</td>
      <td>{{ $u->name }}</td>
      <td>{{ $u->email }}</td>
      <td>{{ ucfirst($u->role) }}</td>
      <td>
        <span class="badge bg-{{ $u->aktif ? 'success' : 'secondary' }}">
          {{ $u->aktif ? 'Aktif' : 'Pasif' }}
        </span>
      </td>
      <td>
        <a href="{{ route('admin.kullanici.edit',$u->id) }}" class="btn btn-sm btn-warning">Düzenle</a>
        <form action="{{ route('admin.kullanici.destroy',$u->id) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger">Sil</button>
        </form>
        <form action="{{ route('admin.kullanici.pasif',$u->id) }}" method="POST" class="d-inline">
          @csrf
          <button class="btn btn-sm btn-info">
            {{ $u->aktif ? 'Pasifleştir' : 'Aktifleştir' }}
          </button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

{{ $kullanicilar->links() }}
@endsection
