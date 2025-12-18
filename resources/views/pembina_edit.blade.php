@extends('layouts.app')

@section('content')

@include('components.navbar')

<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-5">Update Pembina</h2>

    <form action="{{ route('pembina.update', $pembina->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Nama Pembina</label>
            <input type="text" name="nama" value="{{ $pembina->nama }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Foto Lama</label>
            <img src="{{ asset('images/pembina/'.$pembina->foto) }}" 
                 class="h-40 object-cover border rounded mb-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Upload Foto Baru (opsional)</label>
            <input type="file" name="foto" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Update
        </button>
    </form>

</div>

@include('components.footer')

@endsection
