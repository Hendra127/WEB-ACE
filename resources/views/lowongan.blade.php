@extends('layouts.app')

@section('content')

@include('components.navbar')

<section class="py-20 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6">

        <div class="flex justify-between items-center mb-10">
            <h2 class="text-4xl font-bold">Lowongan Kerja</h2>

            <!-- BUTTON TAMBAH -->
            <button onclick="openAddModal()" 
                class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                + Tambah Lowongan
            </button>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            @foreach ($lowongan as $item)
                <div class="p-4 bg-white rounded-xl shadow hover:shadow-xl transition">

                    <img src="{{ asset($item->image) }}" 
                         class="w-full h-56 object-cover rounded-lg mb-4">

                    <div class="flex justify-between gap-3">

                        <!-- BUTTON EDIT -->
                        <button onclick="openEditModal('{{ $item->id }}', '{{ asset($item->image) }}')" 
                            class="w-1/2 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                            Edit
                        </button>

                        <!-- BUTTON HAPUS -->
                        <form action="{{ route('lowongan.destroy', $item->id) }}" 
                              method="POST" class="w-1/2"
                              onsubmit="return confirm('Hapus lowongan ini?')">

                            @csrf
                            @method('DELETE')

                            <button class="w-full py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </form>

                    </div>
                </div>
            @endforeach

        </div>

    </div>
</section>


{{-- ===================== MODAL TAMBAH ===================== --}}
<div id="addModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg rounded-xl shadow-xl p-8">

        <h2 class="text-2xl font-bold mb-6 text-center">Tambah Lowongan</h2>

        <form action="{{ route('lowongan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="block mb-2 font-semibold text-gray-700">Upload Gambar</label>
            <input type="file" name="image" required
                   class="w-full border rounded-lg p-3 mb-6">

            <div class="flex justify-end gap-4">
                <button type="button" onclick="closeAddModal()" 
                        class="px-4 py-2 bg-gray-300 rounded-lg">Batal</button>

                <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>



{{-- ===================== MODAL EDIT ===================== --}}
<div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg rounded-xl shadow-xl p-8">

        <h2 class="text-2xl font-bold mb-6 text-center">Edit Lowongan</h2>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="font-semibold">Gambar Saat Ini:</label>
                <img id="editImagePreview" src="" 
                     class="w-full h-48 object-cover rounded-lg mt-2">
            </div>

            <label class="block mb-2 font-semibold text-gray-700">Ganti Gambar</label>
            <input type="file" name="image" 
                   class="w-full border rounded-lg p-3 mb-6">

            <div class="flex justify-end gap-4">
                <button type="button" onclick="closeEditModal()" 
                        class="px-4 py-2 bg-gray-300 rounded-lg">Batal</button>

                <button class="px-6 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                    Update
                </button>
            </div>

        </form>
    </div>
</div>


<script>
    // OPEN ADD MODAL
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.getElementById('addModal').classList.add('flex');
    }

    // CLOSE ADD MODAL
    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }


    // OPEN EDIT MODAL
    function openEditModal(id, imgUrl) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');

        document.getElementById('editImagePreview').src = imgUrl;
        document.getElementById('editForm').action = "/lowongan/" + id;
    }

    // CLOSE EDIT MODAL
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

@include('components.footer')
@endsection
