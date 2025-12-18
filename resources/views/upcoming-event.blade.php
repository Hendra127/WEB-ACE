@extends('layouts.app')

@section('content')

@include('components.navbar')

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />

<div class="max-w-7xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-center items-center mb-10">
        <div>
            <h1 class="text-4xl font-bold">Upcoming Events</h1>
            <p class="text-gray-600 mt-2">Event menarik yang akan segera berlangsung</p>
        </div>
    </div>

    <!-- FILTER -->
    <form method="GET" class="flex flex-wrap gap-4 mb-8 justify-center">
        <select name="kategori" class="border px-4 py-2 rounded-lg">
            <option value="">Semua Kategori</option>
            <option value="Seminar">Seminar</option>
            <option value="Event Besar">Event Besar</option>
            <option value="Workshop">Workshop</option>
            <option value="Webinar">Webinar</option>
            <option value="Komunitas">Komunitas</option>
        </select>
        <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
            Filter
        </button>
        <button type="button" onclick="openAddModal(event)"
                class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
            Tambah Event
        </button>
    </form>

    <!-- CAROUSEL FEATURED -->
    <div class="relative mb-10">
        <div id="eventSlider" class="overflow-hidden rounded-xl shadow-lg">
            <div id="sliderContent" class="flex transition-transform duration-700">
                @foreach ($featuredEvents as $event)
                <div class="min-w-full relative">
                    <img src="{{ asset($event->gambar) }}" class="w-full h-64 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-40 p-4 text-white">
                        <h2 class="text-xl font-bold">{{ $event->judul }}</h2>
                        <p class="text-sm">{{ $event->tanggal_event }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <button onclick="prevSlide()" class="absolute top-1/2 left-0 -translate-y-1/2 bg-black bg-opacity-40 text-white px-3 py-2">❮</button>
        <button onclick="nextSlide()" class="absolute top-1/2 right-0 -translate-y-1/2 bg-black bg-opacity-40 text-white px-3 py-2">❯</button>
    </div>

<!-- GRID EVENT -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($events as $event)
    <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-xl transition relative group">
        <!-- IMAGE -->
        <div class="relative">
            <img src="{{ asset($event->gambar) }}" 
                 onclick="openEventModal({{ $event }})"
                 class="w-full h-48 object-cover cursor-pointer hover:scale-105 transition duration-300">
        </div>

        <!-- CONTENT -->
        <div class="p-4">
            <h2 class="text-lg font-bold">{{ $event->judul }}</h2>
            <p class="text-gray-600 text-sm mt-1 flex items-center gap-2">
                <i class="fas fa-calendar"></i> {{ $event->tanggal_event }}
            </p>

            <!-- COUNTDOWN -->
            <div class="mt-3">
                <span class="text-sm font-semibold">Countdown:</span>
                <div id="countdown-{{ $event->id }}" class="text-blue-600 font-bold"></div>
            </div>

            <!-- IKON INTERAKTIF DI BAWAH COUNTDOWN -->
            <div class="flex justify-center items-center gap-6 mt-4">
                <!-- Ikut Event (pesawat kertas) kiri -->
                <a href="{{ route('event.rsvp', $event->id) }}" 
                title="Ikut Event"
                class="text-blue-600 hover:text-blue-800 hover:scale-110 transition transform">
                    <i class="fas fa-paper-plane text-2xl"></i>
                </a>

                <!-- Simpan ke Kalender kanan -->
                <a href="{{ route('event.calendar', $event->id) }}" 
                title="Simpan ke Kalender"
                class="text-green-600 hover:text-green-800 hover:scale-110 transition transform">
                    <i class="fas fa-calendar-plus text-2xl"></i>
                </a>
            </div>

            <!-- EDIT & DELETE -->
            <div class="flex gap-2 mt-4">
                <button onclick="openEditModal({{ $event }})"
                        class="flex-1 bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 transition">
                    Edit
                </button>
                <form method="POST" action="{{ route('event.delete', $event->id) }}" onsubmit="return confirm('Hapus event ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>

<!-- MODAL TAMBAH / EDIT -->
<div id="eventFormModal" class="fixed inset-0 bg-black bg-opacity-60 hidden overflow-auto z-50">
    <div class="max-w-3xl mx-auto bg-white mt-10 rounded-xl p-6 relative">
        <button onclick="closeFormModal()" class="absolute top-3 right-3 text-red-600 text-xl font-bold">✕</button>
        <h2 id="formTitle" class="text-2xl font-bold mb-4">Tambah Event</h2>
        <form id="eventForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4">
                <input type="text" name="judul" placeholder="Judul Event" class="border px-3 py-2 rounded-lg w-full">
                <input type="text" name="kategori" placeholder="Kategori" class="border px-3 py-2 rounded-lg w-full">
                <textarea name="deskripsi" placeholder="Deskripsi" class="border px-3 py-2 rounded-lg w-full"></textarea>
                <input type="date" name="tanggal_event" class="border px-3 py-2 rounded-lg w-full">
                <input type="time" name="jam_event" class="border px-3 py-2 rounded-lg w-full">
                <input type="text" name="lokasi" placeholder="Lokasi" class="border px-3 py-2 rounded-lg w-full">
                <select name="status" class="border px-3 py-2 rounded-lg w-full">
                    <option value="Draft">Draft</option>
                    <option value="Published">Published</option>
                </select>
                <input type="file" name="banner" class="border px-3 py-2 rounded-lg w-full">
            </div>
            <button type="submit" class="mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 w-full">Simpan</button>
        </form>
    </div>
</div>

@include('components.footer')

<script>
// Slider
let slideIndex = 0;
function nextSlide(){slideIndex++;updateSlider();}
function prevSlide(){slideIndex--;updateSlider();}
function updateSlider(){
    const slider = document.getElementById("sliderContent");
    const count = slider.children.length;
    if(slideIndex>=count) slideIndex=0;
    if(slideIndex<0) slideIndex=count-1;
    slider.style.transform = `translateX(-${slideIndex*100}%)`;
}
setInterval(nextSlide, 5000);

// Modal event preview
function openEventModal(data){
    const modal = document.getElementById("eventModal");
    if(modal){
        modal.classList.remove("hidden"); 
        document.getElementById("modalBanner").src='/' + data.gambar;
        document.getElementById("modalJudul").textContent = data.judul;
        document.getElementById("modalTanggal").textContent = data.tanggal_event;
        document.getElementById("modalDeskripsi").innerHTML = data.deskripsi;
        document.getElementById("modalLokasi").textContent = data.lokasi;
        document.getElementById("modalWaktu").textContent = data.jam_event;
    }
}

// Modal form tambah
function openAddModal(event){
    event.preventDefault();
    event.stopPropagation();
    document.getElementById("eventFormModal").classList.remove("hidden");
    document.getElementById("formTitle").textContent = "Tambah Event";
    const form = document.getElementById("eventForm");
    form.action = "{{ route('event.store') }}";
    form.method = "POST";
    form.reset();
    let methodInput = form.querySelector('input[name="_method"]');
    if(methodInput) methodInput.remove();
}

// Modal form edit
function openEditModal(eventData){
    document.getElementById("eventFormModal").classList.remove("hidden");
    document.getElementById("formTitle").textContent = "Edit Event";
    const form = document.getElementById("eventForm");
    form.action = "/upcoming-event/update/" + eventData.id;
    form.method = "POST";

    let methodInput = form.querySelector('input[name="_method"]');
    if(!methodInput){
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);
    }

    form.judul.value = eventData.judul;
    form.kategori.value = eventData.kategori;
    form.deskripsi.value = eventData.deskripsi;
    form.tanggal_event.value = eventData.tanggal_event;
    form.jam_event.value = eventData.jam_event;
    form.lokasi.value = eventData.lokasi;
    form.status.value = eventData.status;
}

// Close modal
function closeFormModal(){
    document.getElementById("eventFormModal").classList.add("hidden");
}

// Countdown timer
@foreach ($events as $event)
(function(){
    const countdown = document.getElementById("countdown-{{ $event->id }}");
    const target = new Date("{{ $event->tanggal_event }}").getTime();
    setInterval(()=>{
        const now = new Date().getTime();
        const diff = target - now;
        if(diff <= 0){ countdown.innerHTML = "Event Berlangsung!"; return; }
        const days = Math.floor(diff/(1000*60*60*24));
        const hours = Math.floor((diff/(1000*60*60))%24);
        const minutes = Math.floor((diff/(1000*60))%60);
        const seconds = Math.floor((diff/1000)%60);
        countdown.innerHTML = `${days}h ${hours}j ${minutes}m ${seconds}s`;
    }, 1000);
})();
@endforeach
</script>
@endsection
