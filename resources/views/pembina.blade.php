@extends('layouts.app')

@section('content')

@include('components.navbar')

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">

        <!-- TITLE -->
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold">
                Pembina ACE Lombok
            </h2>

            <!-- TOMBOL TAMBAH -->
            <button onclick="openAddModal()"
                class="bg-green-600 text-white px-5 py-3 rounded shadow hover:bg-green-700">
                + Tambah Pembina
            </button>
        </div>

        <!-- GRID -->
        <div id="pembina-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @foreach($pembinas as $p)
            <div class="bg-white shadow-lg rounded-lg p-6 text-center border-b-4 border-[#1e324c]">

                <img src="{{ asset('images/pembina/' . $p->foto) }}"
                     class="w-40 h-40 object-cover mx-auto rounded-md mb-4 shadow">

                <p class="font-semibold text-gray-800 text-lg mb-4">
                    {{ $p->nama }}
                </p>

                <!-- BUTTON UPDATE -->
                <button onclick="openEditModal({{ $p->id }}, '{{ $p->nama }}')"
                    class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                    Update
                </button>

            </div>
            @endforeach

        </div>

    </div>
</section>

@include('components.footer')


<!-- ============================= -->
<!-- MODAL TAMBAH DATA -->
<!-- ============================= -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3 class="font-bold text-xl mb-4">Tambah Pembina</h3>

        <form action="{{ route('pembina.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border px-3 py-2 rounded mb-3" required>

            <label class="block font-semibold mb-1">Foto</label>
            <input type="file" name="foto" class="w-full border px-3 py-2 rounded mb-4" required>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeAddModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>


<!-- ============================= -->
<!-- MODAL UPDATE -->
<!-- ============================= -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3 class="font-bold text-xl mb-4">Update Pembina</h3>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" id="editNama" name="nama" class="w-full border px-3 py-2 rounded mb-3" required>

            <label class="block font-semibold mb-1">Foto (opsional)</label>
            <input type="file" name="foto" class="w-full border px-3 py-2 rounded mb-4">

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>


<script>
    function openAddModal() {
        const modal = document.getElementById('addModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeAddModal() {
        const modal = document.getElementById('addModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openEditModal(id, nama) {
        document.getElementById('editNama').value = nama;
        document.getElementById('editForm').action = "/pembina/" + id;
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

@endsection
