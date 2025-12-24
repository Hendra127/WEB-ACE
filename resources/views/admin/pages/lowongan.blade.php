<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">

            <h3 class="mb-4">
                <i class="fas fa-briefcase"></i> Kelola Lowongan
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
                        data-bs-target="#modalTambahLowongan">
                    <i class="fas fa-plus"></i> Tambah Lowongan
                </button>
            </div>

            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i> Daftar Lowongan
                    </h5>
                </div>

                <div class="card-body">
                    @if(count($lowongan))
                        <div class="row">
                            @foreach($lowongan as $l)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm">

                                        <img src="{{ asset($l->image) }}"
                                             class="card-img-top"
                                             style="height:260px;object-fit:cover;">

                                        <div class="card-footer bg-light">

                                            <!-- UPDATE -->
                                            <button class="btn btn-warning btn-sm w-100 mb-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditLowongan{{ $l->id }}">
                                                <i class="fas fa-edit"></i> Update
                                            </button>

                                            <!-- DELETE -->
                                            <form method="POST"
                                                  action="{{ route('lowongan.destroy',$l->id) }}"
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
                                     id="modalEditLowongan{{ $l->id }}"
                                     tabindex="-1">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">

                                            <form method="POST"
                                                  action="{{ route('lowongan.update',$l->id) }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-edit"></i> Edit Lowongan
                                                    </h5>
                                                    <button class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Gambar Baru</label>
                                                        <input type="file"
                                                               name="image"
                                                               class="form-control"
                                                               required>
                                                    </div>

                                                    <img src="{{ asset($l->image) }}"
                                                         class="img-fluid rounded"
                                                         style="max-height:250px;">
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
                            <p class="mt-3">Belum ada data lowongan</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="modalTambahLowongan" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('lowongan.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-briefcase"></i> Tambah Lowongan
                    </h5>
                    <button class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Gambar Lowongan</label>
                        <input type="file"
                               name="image"
                               class="form-control"
                               required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
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
  .swal2-confirm, .swal2-cancel {
    opacity:1 !important;
    visibility:visible !important;
    color:#fff;
    font-weight:600;
  }
  .swal2-cancel { background-color:#6c757d !important; }
  .swal2-confirm { background-color:#dc3545 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data lowongan akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
