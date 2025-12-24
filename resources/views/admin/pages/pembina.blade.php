<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">

            <h3 class="mb-4"><i class="fas fa-chalkboard-teacher"></i> Kelola Pembina</h3>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="text-end mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPembina">
                    <i class="fas fa-plus"></i> Tambah Pembina
                </button>
            </div>

            <div class="row">
                @forelse($pembinas as $p)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('images/pembina/'.$p->foto) }}" class="card-img-top" style="height:250px; object-fit:cover;">
                        <div class="card-body">
                            <h6>{{ $p->nama }}</h6>
                            <!--<p class="small text-muted">{{ $p->jabatan ?? '-' }}</p>
                            <p>{{ Str::limit($p->deskripsi,60) ?? '-' }}</p>-->
                        </div>
                        <div class="card-footer bg-light">
                            <!-- EDIT BUTTON -->
                            <button class="btn btn-warning btn-sm w-100 mb-2" data-bs-toggle="modal" data-bs-target="#modalEditPembina{{ $p->id }}">
                                <i class="fas fa-edit"></i> Update
                            </button>
                            <!-- DELETE BUTTON -->
                            <form method="POST" action="{{ route('pembina.destroy',$p->id) }}" class="form-hapus">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm w-100 btn-hapus">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEditPembina{{ $p->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('pembina.update',$p->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Pembina</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $p->nama }}" required>
                                    </div>
                                    <!--<div class="mb-3">
                                        <label>Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control" value="{{ $p->jabatan }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="4">{{ $p->deskripsi }}</textarea>
                                    </div>-->
                                    <div class="mb-3">
                                        <label>Foto (opsional)</label>
                                        <input type="file" name="foto" class="form-control">
                                        <img src="{{ asset('images/pembina/'.$p->foto) }}" class="img-fluid mt-2 rounded" style="max-height:150px;">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                <div class="col-md-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="fas fa-inbox fs-1 opacity-50"></i>
                        <p class="mt-3">Belum ada data pembina</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahPembina" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('pembina.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-chalkboard-teacher"></i> Tambah Pembina</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <!--<div class="mb-3">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                    </div>-->
                    <div class="mb-3">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert untuk konfirmasi hapus -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('form');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data pembina yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
