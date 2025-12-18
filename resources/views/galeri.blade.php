@extends('layouts.app')

@section('content')
@include('components.navbar')

<section class="py-12 md:py-20 bg-gray-50">
    <div class="container mx-auto px-4">

        <!-- HEADER -->
        <div class="flex flex-col gap-6">
            <!-- Judul -->
            <h2 class="text-3xl md:text-4xl font-bold">
                Gallery Foto
            </h2>

            <!-- Kategori Filter -->
            <div class="w-full">
                <select id="filterKategori" class="w-full border rounded px-4 py-3 text-gray-700 focus:outline-none focus:border-blue-600">
                    <option value="all">Semua Kategori</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k }}">{{ $k }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Tambah -->
            <button onclick="openAddModal()"
                    class="w-full bg-green-600 text-white px-5 py-3 rounded shadow hover:bg-green-700 font-semibold md:w-auto">
                + Tambah Foto
            </button>
        </div>

        <!-- GRID -->
        <div id="galeriGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-8 md:mt-10">
            @foreach($galeri as $g)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border-b-4 border-[#1e324c] gallery-item"
                 data-kategori="{{ $g->kategori }}">

                <div class="relative group">

                    <!-- THUMBNAIL -->
                    <img src="{{ asset('public/images/galeri/' . $g->foto) }}"
                         alt="{{ $g->judul }}"
                         class="w-full h-48 sm:h-56 lg:h-64 object-cover transition-transform duration-300 group-hover:scale-105 cursor-pointer"
                         onclick="openLightbox(
                             '{{ asset('public/images/galeri/' . $g->foto) }}',
                             `{{ addslashes($g->judul) }}`,
                             `{{ addslashes($g->deskripsi) }}`,
                             '{{ $g->kategori }}'
                         )">

                    <!-- BADGE KATEGORI -->
                    <span class="absolute left-3 top-3 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">
                        {{ $g->kategori }}
                    </span>
                </div>

                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 text-lg mb-2 line-clamp-2">{{ $g->judul }}</h3>

                    <!-- Deskripsi pendek -->
                    <p class="text-gray-600 text-sm desc-limit mb-4">
                        {{ $g->deskripsi }}
                    </p>

                    <div class="flex flex-col gap-3">
                        <button onclick="openEditModal(
                            {{ $g->id }},
                            `{{ addslashes($g->judul) }}`,
                            `{{ addslashes($g->kategori) }}`,
                            `{{ addslashes($g->deskripsi) }}`)"
                        class="w-full px-3 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700 text-center">
                            Edit
                        </button>

                        <form action="{{ route('galeri.destroy', $g->id) }}" 
                              method="POST"
                              onsubmit="return confirm('Hapus foto ini?')"
                              class="w-full">
                            @csrf
                            @method('DELETE')
                            <button class="w-full px-3 py-2 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>

@include('components.footer')


<!-- ===================================================== -->
<!-- ===============  ADD MODAL   ======================== -->
<!-- ===================================================== -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white w-full sm:w-96 max-w-full rounded-lg shadow p-6 overflow-auto max-h-[90vh]">
        <h3 class="font-bold text-lg sm:text-xl mb-4">Tambah Foto</h3>

        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="block font-semibold mb-1">Judul</label>
            <input type="text" name="judul" class="w-full border rounded px-3 py-2 mb-3" required>

            <label class="block font-semibold mb-1">Kategori</label>
            <input type="text" name="kategori" class="w-full border rounded px-3 py-2 mb-3" required>

            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded px-3 py-2 mb-3" rows="3" required></textarea>

            <label class="block font-semibold mb-1">Foto</label>
            <input type="file" name="foto" class="w-full mb-4" accept="image/*" required>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>


<!-- ===================================================== -->
<!-- ===============  EDIT MODAL   ======================== -->
<!-- ===================================================== -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white w-full sm:w-96 max-w-full rounded-lg shadow p-6 overflow-auto max-h-[90vh]">
        <h3 class="font-bold text-lg sm:text-xl mb-4">Edit Foto</h3>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="block font-semibold mb-1">Judul</label>
            <input id="editJudul" name="judul" type="text" class="w-full border rounded px-3 py-2 mb-3" required>

            <label class="block font-semibold mb-1">Kategori</label>
            <input id="editKategori" name="kategori" type="text" class="w-full border rounded px-3 py-2 mb-3" required>

            <label class="block font-semibold mb-1">Deskripsi</label>
            <textarea id="editDeskripsi" name="deskripsi" class="w-full border rounded px-3 py-2 mb-3" rows="3" required></textarea>

            <label class="block font-semibold mb-1">Foto Baru (opsional)</label>
            <input type="file" name="foto" class="w-full mb-4" accept="image/*">

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>


<!-- ===================================================== -->
<!-- ===============  LIGHTBOX MODAL  ===================== -->
<!-- ===================================================== -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-80 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow max-w-4xl w-full overflow-hidden max-h-[90vh]">
        <div class="flex flex-col md:flex-row h-full">

            <img id="lightboxImg" src="" class="w-full md:w-1/2 object-cover h-64 sm:h-80 md:h-auto md:max-h-[90vh]" style="max-height: calc(90vh - 3rem);">

            <div class="p-4 md:w-1/2 overflow-auto">
                <h3 id="lightboxJudul" class="font-semibold text-xl sm:text-2xl mb-2"></h3>
                <p id="lightboxKategori" class="text-sm text-gray-500 mb-3"></p>
                <p id="lightboxDeskripsi" class="text-gray-700"></p>

                <div class="mt-4 flex justify-end">
                    <button onclick="closeLightbox()" class="px-4 py-2 bg-red-600 text-white rounded">
                        Tutup
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- CLAMP -->
<style>
    .desc-limit {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @media (min-width: 768px) {
        .desc-limit {
            -webkit-line-clamp: 2;
        }
    }
</style>

<script>
function openAddModal(){
    document.getElementById('addModal').classList.remove('hidden');
    document.getElementById('addModal').classList.add('flex');
}
function closeAddModal(){
    document.getElementById('addModal').classList.add('hidden');
    document.getElementById('addModal').classList.remove('flex');
}

function openEditModal(id, judul, kategori, deskripsi){
    document.getElementById('editForm').action = "/galeri/" + id;
    document.getElementById('editJudul').value = judul;
    document.getElementById('editKategori').value = kategori;
    document.getElementById('editDeskripsi').value = deskripsi;

    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}
function closeEditModal(){
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

function openLightbox(img, judul, deskripsi, kategori = ""){
    document.getElementById('lightboxImg').src = img;
    document.getElementById('lightboxJudul').innerText = judul;
    document.getElementById('lightboxKategori').innerText = kategori;
    document.getElementById('lightboxDeskripsi').innerText = deskripsi;

    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox').classList.add('flex');
}
function closeLightbox(){
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
}

document.getElementById('filterKategori').addEventListener('change', function(){
    const selected = this.value;

    document.querySelectorAll('.gallery-item').forEach(card => {
        if(selected === 'all' || card.getAttribute('data-kategori') === selected){
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>

@endsection
