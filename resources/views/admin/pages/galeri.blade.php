<h3>Kelola Galeri</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="judul" class="form-control mb-2" placeholder="Judul">
    <input type="text" name="kategori" class="form-control mb-2" placeholder="Kategori">
    <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi"></textarea>
    <input type="file" name="foto" class="form-control mb-2">

    <button class="btn btn-primary">Simpan</button>
</form>

<hr>

<div class="row">
@foreach($galeri as $g)
  <div class="col-md-4 mb-4">
    <img src="{{ asset('images/galeri/'.$g->foto) }}" class="img-fluid mb-2">

    <form method="POST" action="{{ route('galeri.update',$g->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <input type="text" name="judul" value="{{ $g->judul }}" class="form-control mb-1">
        <button class="btn btn-warning btn-sm w-100">Update</button>
    </form>

    <form method="POST" action="{{ route('galeri.destroy',$g->id) }}">
        @csrf @method('DELETE')
        <button class="btn btn-danger btn-sm w-100 mt-1">Hapus</button>
    </form>
  </div>
@endforeach
</div>
