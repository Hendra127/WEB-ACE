@extends('layouts.app')

@section('content')

@include('components.navbar')

<div class="container mx-auto p-4 md:p-6">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-xl md:text-2xl font-bold">Mitra Kami</h1>
        <!--<button onclick="openAddModal()" class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Tambah Mitra
        </button>-->
    </div>

    {{-- FILTER & SEARCH --}}
    <form method="GET" action="{{ route('mitrakami') }}" class="flex flex-col sm:flex-row gap-3 mb-6">
        <input type="text" name="q" value="{{ $search }}" placeholder="Search..." class="px-3 py-2 border rounded flex-1 text-sm">

        <select name="kategori" class="px-3 py-2 border rounded text-sm">
            <option value="all">Semua Kategori</option>
            @foreach($kategoriList as $kat)
                <option value="{{ $kat }}" @if($kategori === $kat) selected @endif>{{ $kat }}</option>
            @endforeach
        </select>

        <button class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
    </form>

    {{-- LIST VIEW --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">

        @foreach($mitras as $mitra)
            <div class="border rounded p-4 shadow-sm hover:shadow-lg transition">

                @if($mitra->logo)
                    <img src="{{ asset('images/mitra/'.$mitra->logo) }}" class="w-12 h-12 md:w-14 md:h-14 object-contain mb-3">
                @endif

                <h3 class="font-semibold text-base md:text-lg line-clamp-2">{{ $mitra->nama }}</h3>
                <p class="text-gray-600 text-xs md:text-sm line-clamp-3">{{ $mitra->deskripsi }}</p>

                <p class="text-gray-500 mt-2 text-xs md:text-sm">Kategori: {{ $mitra->kategori }}</p>
                <p class="text-gray-500 text-xs md:text-sm">Lokasi: {{ $mitra->lokasi }}</p>

                <!--<div class="flex gap-2 justify-between mt-4">
                    <button onclick="openEditModal({{ $mitra->id }}, '{{ addslashes($mitra->nama) }}', '{{ addslashes($mitra->kategori) }}', '{{ addslashes($mitra->lokasi) }}', `{{ $mitra->deskripsi }}`)"
                        class="flex-1 text-green-600 hover:bg-green-50 py-1 rounded text-sm">
                        Edit
                    </button>

                    <form action="{{ route('mitra.destroy', $mitra->id) }}" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus mitra ini?')" class="w-full text-red-600 hover:bg-red-50 py-1 rounded text-sm">Hapus</button>
                    </form>
                </div>-->
            </div>
        @endforeach

    </div>
</div>

{{-- MODAL ADD --}}
<!--<div id="addModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
    <div class="bg-white p-6 rounded w-full max-w-md max-h-screen overflow-y-auto">
        <h2 class="text-lg md:text-xl font-bold mb-4">Tambah Mitra</h2>

        <form action="{{ route('mitra.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="nama" placeholder="Nama" required class="w-full mb-3 px-3 py-2 border rounded text-sm">
            <input type="text" name="kategori" placeholder="Kategori" required class="w-full mb-3 px-3 py-2 border rounded text-sm">
            <input type="text" name="lokasi" placeholder="Lokasi" required class="w-full mb-3 px-3 py-2 border rounded text-sm">

            <textarea name="deskripsi" placeholder="Deskripsi" required class="w-full mb-3 px-3 py-2 border rounded text-sm"></textarea>

            <input type="file" name="logo" class="mb-3 text-sm">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-300 rounded text-sm hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>-->

{{-- MODAL EDIT --}}
<!--<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
    <div class="bg-white p-6 rounded w-full max-w-md max-h-screen overflow-y-auto">
        <h2 class="text-lg md:text-xl font-bold mb-4">Edit Mitra</h2>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <input type="text" id="editNama" name="nama" required class="w-full mb-3 px-3 py-2 border rounded text-sm">
            <input type="text" id="editKategori" name="kategori" required class="w-full mb-3 px-3 py-2 border rounded text-sm">
            <input type="text" id="editLokasi" name="lokasi" required class="w-full mb-3 px-3 py-2 border rounded text-sm">

            <textarea id="editDeskripsi" name="deskripsi" required class="w-full mb-3 px-3 py-2 border rounded text-sm"></textarea>

            <input type="file" name="logo" class="mb-3 text-sm">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded text-sm hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded text-sm hover:bg-green-700">Update</button>
            </div>
        </form>
    </div>
</div>-->

<script>
function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
}
function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
}
function openEditModal(id, nama, kategori, lokasi, deskripsi) {
    document.getElementById('editNama').value = nama;
    document.getElementById('editKategori').value = kategori;
    document.getElementById('editLokasi').value = lokasi;
    document.getElementById('editDeskripsi').value = deskripsi;
    document.getElementById('editForm').action = "/mitra/" + id;
    document.getElementById('editModal').classList.remove('hidden');
}
function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>

@include('components.footer')

@endsection
