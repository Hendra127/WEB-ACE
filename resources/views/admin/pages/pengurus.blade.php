<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">

            <h3 class="mb-4">
                <i class="fas fa-users"></i> Kelola Pengurus
            </h3>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="text-end mb-3">
                <button class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambahPengurus">
                    <i class="fas fa-plus"></i> Tambah Pengurus
                </button>
            </div>

            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i> Daftar Pengurus
                    </h5>
                </div>

                <div class="card-body">
                    @if(count($pengurus))
                        <div class="row">
                            @foreach($pengurus as $p)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm">

                                        <img src="{{ asset('images/pengurus/'.$p->foto) }}"
                                             class="card-img-top"
                                             style="height:250px;object-fit:cover;"
                                             alt="{{ $p->nama }}">

                                        <div class="card-body">
                                            <h6>{{ $p->nama }}</h6>
                                            <p class="small text-muted">{{ $p->jabatan }}</p>
                                        </div>

                                        <div class="card-footer bg-light">

                                            <!-- UPDATE BUTTON -->
                                            <button class="btn btn-warning btn-sm w-100 mb-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditPengurus{{ $p->id }}">
                                                <i class="fas fa-edit"></i> Update
                                            </button>

                                            <!-- DELETE -->
                                            <form method="POST"
                                                  action="{{ route('pengurus.destroy',$p->id) }}"
                                                  class="form-hapus">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-danger btn-sm w-100 btn-hapus">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- ================= MODAL EDIT ================= -->
                                <div class="modal fade"
                                     id="modalEditPengurus{{ $p->id }}"
                                     tabindex="-1">

                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">

                                            <form method="POST"
                                                  action="{{ route('pengurus.update',$p->id) }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-edit"></i> Edit Pengurus
                                                    </h5>
                                                    <button class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label>Nama</label>
                                                        <input type="text"
                                                               name="nama"
                                                               class="form-control"
                                                               value="{{ $p->nama }}"
                                                               required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Jabatan</label>
                                                        <input type="text"
                                                               name="jabatan"
                                                               class="form-control"
                                                               value="{{ $p->jabatan }}"
                                                               required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Foto (opsional)</label>
                                                        <input type="file"
                                                               name="foto"
                                                               class="form-control">

                                                        <img src="{{ asset('images/pengurus/'.$p->foto) }}"
                                                             class="img-fluid mt-2 rounded"
                                                             style="max-height:150px;">
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button class="btn btn-warning">
                                                        <i class="fas fa-save"></i> Update
                                                    </button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- ================= END MODAL EDIT ================= -->

                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info text-center py-5">
                            <i class="fas fa-inbox fs-1 opacity-50"></i>
                            <p class="mt-3">Belum ada data pengurus</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="modalTambahPengurus" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('pengurus.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-users"></i> Tambah Pengurus
                    </h5>
                    <button class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- === SweetAlert Hapus === --}}
<style>
  .swal2-actions { z-index: 9999 !important; }
  .swal2-confirm, .swal2-cancel { opacity:1 !important; visibility:visible !important; color:#fff; font-weight:600;}
  .swal2-cancel { background-color:#6c757d !important; }
  .swal2-confirm { background-color:#dc3545 !important; }
  .swal2-confirm:hover, .swal2-cancel:hover { filter: brightness(1.1); }
</style>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data pengurus yang dihapus tidak dapat dikembalikan!',
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
