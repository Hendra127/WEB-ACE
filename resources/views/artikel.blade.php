@extends('layouts.app')

@section('content')

@include('components.navbar')
<div class="max-w-7xl mx-auto p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Manajemen Artikel</h1>
        <button onclick="openAddModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Tambah Artikel
        </button>
    </div>

    <!-- Search & Filter -->
    <form method="GET" action="{{ route('artikel') }}" class="flex gap-4 mb-6">
        <input type="text" name="search" placeholder="Cari judul..." 
               value="{{ request('search') }}"
               class="w-full border px-3 py-2 rounded-lg">

        <select name="kategori" class="border px-3 py-2 rounded-lg">
            <option value="">Semua Kategori</option>
            <option value="Berita" {{ request('kategori')=='Berita' ? 'selected' : '' }}>Berita</option>
            <option value="Pengumuman" {{ request('kategori')=='Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
            <option value="Event" {{ request('kategori')=='Event' ? 'selected' : '' }}>Event</option>
        </select>

        <button class="bg-gray-800 text-white px-4 py-2 rounded-lg">Filter</button>
    </form>

    <!-- Grid Artikel -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($artikel as $item)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            
            @if ($item->gambar)
                <img src="{{ asset($item->gambar) }}" 
                    onclick="openViewModal({{ $item }})"
                    class="w-full h-48 object-cover cursor-pointer hover:opacity-80 transition">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">Tidak ada gambar</span>
                </div>
            @endif

            <div class="p-4">
                <h2 class="text-lg font-bold">{{ $item->judul }}</h2>

                <p class="text-sm text-gray-600 mt-1">Kategori: 
                    <span class="font-semibold">{{ $item->kategori ?? '-' }}</span>
                </p>

                <!-- View Counter -->
                <div class="flex items-center gap-2 text-gray-600 text-sm mt-2">
                    <i class="fa-solid fa-eye"></i>
                    {{ $item->views }} views
                </div>

                <div class="mt-4 flex justify-between">
                    <a href="{{ route('artikel.show', $item->id) }}" 
                       class="text-blue-600 hover:underline">Lihat</a>

                    <button onclick="openEditModal({{ $item }})"
                        class="text-yellow-600 hover:underline">Edit</button>

                    <form method="POST" action="{{ route('artikel.delete', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline"
                            onclick="return confirm('Hapus artikel ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $artikel->links() }}
    </div>

</div>

<!-- ==================== MODAL TAMBAH ==================== -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-lg">

        <h2 class="text-xl font-bold mb-4">Tambah Artikel</h2>

        <form method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
            @csrf

            <label>Judul</label>
            <input name="judul" class="w-full border px-3 py-2 rounded-lg mb-3" required>

            <label>Kategori</label>
            <select name="kategori" class="w-full border px-3 py-2 rounded-lg mb-3">
                <option value="">Pilih kategori</option>
                <option value="Berita">Berita</option>
                <option value="Pengumuman">Pengumuman</option>
                <option value="Event">Event</option>
            </select>

            <label>Konten</label>
            <textarea name="konten" class="w-full border px-3 py-2 rounded-lg mb-3" rows="4" required></textarea>

            <label>Gambar</label>
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded-lg mb-3">

            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeAddModal()" class="mr-3 px-4 py-2">Batal</button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>

    </div>
</div>

<!-- ==================== MODAL EDIT ==================== -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-lg">

        <h2 class="text-xl font-bold mb-4">Edit Artikel</h2>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Judul</label>
            <input id="editJudul" name="judul" class="w-full border px-3 py-2 rounded-lg mb-3" required>

            <label>Kategori</label>
            <select id="editKategori" name="kategori" class="w-full border px-3 py-2 rounded-lg mb-3">
                <option value="Berita">Berita</option>
                <option value="Pengumuman">Pengumuman</option>
                <option value="Event">Event</option>
            </select>

            <label>Konten</label>
            <textarea id="editKonten" name="konten" class="w-full border px-3 py-2 rounded-lg mb-3" rows="4"></textarea>

            <label>Gambar (Opsional)</label>
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded-lg mb-3">

            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeEditModal()" class="mr-3 px-4 py-2">Batal</button>
                <button class="bg-yellow-600 text-white px-4 py-2 rounded-lg">Update</button>
            </div>
        </form>

    </div>
</div>
<!-- ==================== MODAL VIEW / DETAIL ARTIKEL ==================== -->
<div id="viewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden overflow-auto p-4">
    <div class="bg-white max-w-3xl mx-auto rounded-xl shadow-lg p-6">

        <button onclick="closeViewModal()" 
                class="text-red-500 text-xl float-right font-bold">✕</button>

        <img id="viewGambar" class="w-full h-64 object-cover rounded-lg mb-4">

        <h2 id="viewJudul" class="text-2xl font-bold mb-2"></h2>

        <p class="text-sm text-gray-600 mb-1">
            <span class="font-semibold">Kategori:</span>
            <span id="viewKategori"></span>
        </p>

        <p class="text-sm text-gray-600 mb-4 flex items-center gap-1">
            <i class="fa-solid fa-eye"></i>
            <span id="viewViews"></span> views
        </p>

        <div id="viewKonten" class="text-gray-800 leading-relaxed"></div>

    </div>
</div>

<script>
    // =================== MODAL VIEW ===================
function openViewModal(data) {
    document.getElementById("viewModal").classList.remove("hidden");

    document.getElementById("viewJudul").textContent = data.judul;
    document.getElementById("viewKategori").textContent = data.kategori;
    document.getElementById("viewKonten").innerHTML = data.konten;
    document.getElementById("viewViews").textContent = data.views;
    
    document.getElementById("viewGambar").src = data.gambar 
        ? "/" + data.gambar 
        : "https://via.placeholder.com/800x400?text=No+Image";
}

function closeViewModal() {
    document.getElementById("viewModal").classList.add("hidden");
}

</script>
<script>
function openAddModal() {
    document.getElementById("addModal").classList.remove("hidden");
}
function closeAddModal() {
    document.getElementById("addModal").classList.add("hidden");
}

function openEditModal(data) {
    document.getElementById("editModal").classList.remove("hidden");
    document.getElementById("editJudul").value = data.judul;
    document.getElementById("editKategori").value = data.kategori;
    document.getElementById("editKonten").value = data.konten;

    document.getElementById("editForm").action =
        "/artikel/update/" + data.id;
}

function closeEditModal() {
    document.getElementById("editModal").classList.add("hidden");
}
</script>

@include('components.footer')
@endsection
