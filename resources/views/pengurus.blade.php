@extends('layouts.app')
@section('content')
@include('components.navbar')

<div class="max-w-5xl mx-auto mt-10">

    <div class="flex justify-between items-center mb-5">
        <div class="w-full flex flex-col md:flex-row md:justify-between md:items-center">
            <h2 class="text-2xl font-bold">Data Pengurus ACE Lombok</h2>
            <button onclick="openAddModal()" class="mt-3 md:mt-0 px-2 py-2 bg-green-600 text-white rounded">
                + Tambah Pengurus
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 border border-green-400 text-green-600 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded shadow">
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Foto</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Jabatan</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengurus as $p)
                <tr>
                    <td class="p-2 border text-center">
                        <img src="{{ asset('images/pengurus/' . $p->foto) }}" 
                             class="w-16 h-16 object-cover rounded">
                    </td>
                    <td class="p-2 border">{{ $p->nama }}</td>
                    <td class="p-2 border">{{ $p->jabatan }}</td>
                    <td class="p-2 border text-center">

                        <button 
                            onclick="openEditModal({{ $p->id }}, '{{ $p->nama }}', '{{ $p->jabatan }}')"
                            class="px-3 py-1 bg-blue-500 text-white rounded">
                            Edit
                        </button>

                        <form action="{{ route('pengurus.destroy', $p->id) }}" 
                              method="POST" class="inline-block"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

{{-- Modal Tambah --}}
<div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-40 items-center justify-center">
    <div class="bg-white w-96 p-5 rounded shadow">
        
        <h3 class="text-lg font-bold mb-3">Tambah Pengurus</h3>

        <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Nama</label>
            <input type="text" name="nama" class="w-full border px-3 py-2 mb-3" required>

            <label>Jabatan</label>
            <input type="text" name="jabatan" class="w-full border px-3 py-2 mb-3" required>

            <label>Foto</label>
            <input type="file" name="foto" class="w-full border px-3 py-2 mb-4" required>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
            </div>

        </form>

    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-40 items-center justify-center">
    <div class="bg-white w-96 p-5 rounded shadow">

        <h3 class="text-lg font-bold mb-3">Edit Pengurus</h3>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>Nama</label>
            <input id="editNama" type="text" name="nama" class="w-full border px-3 py-2 mb-3" required>

            <label>Jabatan</label>
            <input id="editJabatan" type="text" name="jabatan" class="w-full border px-3 py-2 mb-3" required>

            <label>Foto (Opsional)</label>
            <input type="file" name="foto" class="w-full border px-3 py-2 mb-4">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>

    </div>
</div>


<script>
function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
    document.getElementById('addModal').classList.add('flex');
}

function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
    document.getElementById('addModal').classList.remove('flex');
}

function openEditModal(id, nama, jabatan) {
    document.getElementById('editForm').action = "/pengurus/" + id;
    document.getElementById('editNama').value = nama;
    document.getElementById('editJabatan').value = jabatan;

    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}
</script>

@include('components.footer')
@endsection
