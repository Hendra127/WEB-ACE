@extends('layouts.app')

@section('content')

@include('components.navbar')

{{-- HERO SECTION --}}
<section class="relative w-full h-[90vh] overflow-hidden">
    <img src="{{ asset($setting->hero_image ?? 'hero.jpg') }}" 
         class="absolute inset-0 w-full h-full object-cover brightness-75" 
         alt="Hero Image">

    <div class="absolute inset-0 flex items-center justify-center text-center text-white px-4">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 animate__animated animate__fadeInDown">
                {{ $setting->hero_title ?? 'Welcome to ACE Lombok Experience' }}
            </h1>
            <p class="text-lg md:text-xl mb-6 animate__animated animate__fadeInUp">
                {{ $setting->hero_subtitle ?? 'Keahlian Teknik Teruji, Solusi Industri Terdepan' }}
            </p>
            <!--<a href="#services" 
               class="px-8 py-3 bg-yellow-400 text-black rounded-full text-lg font-semibold hover:bg-yellow-500 transition">
               Explore Services
            </a>-->
        </div>
    </div>
</section>

{{-- WELCOME SECTION --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6 text-center max-w-4xl">

        <h2 class="text-4xl font-bold mb-6 leading-snug">
            Welcome to ACE Lombok Association
        </h2>

        <p class="text-gray-700 text-lg leading-relaxed mb-8">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet, neque sed 
            sollicitudin fermentum, turpis nibh cursus sapien, vitae hendrerit enim turpis eget 
            lorem. Integer sed pulvinar libero, id interdum nulla. Vestibulum ante ipsum primis in 
            faucibus orci luctus et ultrices posuere cubilia curae; Praesent dictum urna in libero 
            hendrerit, vel bibendum massa tempus. Nunc laoreet sit amet massa ac suscipit.
        </p>

        <p class="text-gray-700 text-lg leading-relaxed mb-10">
            Suspendisse potenti. Aenean sed ipsum vitae turpis tristique facilisis. Praesent ut 
            semper ipsum. Phasellus pharetra, nisi vitae viverra blandit, magna massa euismod 
            justo, vel convallis lectus magna in tellus. Sed vitae massa semper, sollicitudin 
            libero sed, aliquam mauris. Nulla facilisi.
        </p>
    </div>
</section>

{{-- ABOUT --}}
<section class="py-20">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

        <img src="{{ asset('about.jpg') }}" class="rounded-xl shadow-lg" alt="About">

        <div>
            <h2 class="text-4xl font-bold mb-4">About Us</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent massa ex, suscipit ac est sit amet, semper molestie mi. Aenean consectetur porta urna nec porta. Etiam tincidunt feugiat dolor quis tempus. Donec varius ipsum nibh. Integer suscipit ultricies tellus, vitae mattis elit commodo in. Sed tincidunt leo a ante efficitur, ac dapibus leo imperdiet. Sed vitae augue a felis pharetra sagittis.
            </p>
            <a href="{{ route('aboutus') }}" class="px-6 py-3 bg-black text-white rounded-full" style="height: 25px; line-height: 45px;">
                Learn More
            </a>
        </div>

    </div>
</section>

<!-- SECTION VISI MISI -->
<section class="py-24 bg-gray-50">
    <div class="text-center mb-16">
        <h2 class="text-4xl font-bold">Visi & Misi Kami</h5>
        <div class="w-16 h-1 bg-black mx-auto mt-4"></div>
    </div>

    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- Item 1 -->
        <div class="p-10 bg-white rounded-xl shadow text-center">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-blue-900 text-white rounded-full">
                ⚡
            </div>
            <h3 class="text-xl font-bold mb-2">Management Energy</h3>
            <p class="text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet tortor id libero.
            </p>
        </div>

        <!-- Item 2 -->
        <div class="p-10 bg-white rounded-xl shadow text-center">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-blue-900 text-white rounded-full">
                🤝
            </div>
            <h3 class="text-xl font-bold mb-2">Membina Hubungan Kekeluargaan</h3>
            <p class="text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor tellus sed urna placerat.
            </p>
        </div>

        <!-- Item 3 -->
        <div class="p-10 bg-white rounded-xl shadow text-center">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-blue-900 text-white rounded-full">
                👥
            </div>
            <h3 class="text-xl font-bold mb-2">Melakukan Hubungan Kerjasama</h3>
            <p class="text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae elit ac mauris fermentum.
            </p>
        </div>

        <!-- Item 4 -->
        <div class="p-10 bg-white rounded-xl shadow text-center">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-blue-900 text-white rounded-full">
                🌐
            </div>
            <h3 class="text-xl font-bold mb-2">Kegiatan Sosial</h3>
            <p class="text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In commodo ligula ac efficitur gravida.
            </p>
        </div>

        <!-- Item 5 -->
        <div class="p-10 bg-white rounded-xl shadow text-center">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-blue-900 text-white rounded-full">
                📘
            </div>
            <h3 class="text-xl font-bold mb-2">Mengasah Pengetahuan</h3>
            <p class="text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum finibus mi sed justo aliquam.
            </p>
        </div>

        <!-- Item 6 -->
        <div class="p-10 bg-white rounded-xl shadow text-center">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-blue-900 text-white rounded-full">
                🔄
            </div>
            <h3 class="text-xl font-bold mb-2">Wadah Tukar – Menukar Informasi</h3>
            <p class="text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras a nisi vitae felis faucibus.
            </p>
        </div>

    </div>
</section>

<!-- SERVICES SECTION -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Our Services</h2>
            <p class="text-gray-600 text-lg">Layanan unggulan kami untuk kesuksesan bisnis Anda</p>
            <div class="w-16 h-1 bg-black mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 border border-gray-200 rounded-xl hover:shadow-lg transition">
                <div class="text-4xl mb-4">🔧</div>
                <h3 class="text-2xl font-bold mb-3">Technical Service</h3>
                <p class="text-gray-600">Solusi teknis profesional dengan standar industri terkini</p>
            </div>

            <div class="p-8 border border-gray-200 rounded-xl hover:shadow-lg transition">
                <div class="text-4xl mb-4">💼</div>
                <h3 class="text-2xl font-bold mb-3">Consulting</h3>
                <p class="text-gray-600">Konsultasi ahli untuk pengembangan bisnis Anda</p>
            </div>

            <div class="p-8 border border-gray-200 rounded-xl hover:shadow-lg transition">
                <div class="text-4xl mb-4">📊</div>
                <h3 class="text-2xl font-bold mb-3">Analysis</h3>
                <p class="text-gray-600">Analisis mendalam untuk keputusan bisnis yang tepat</p>
            </div>
        </div>
    </div>
</section>

{{-- PARTNER --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 text-center">

        <h2 class="text-4xl font-bold mb-10">Partner & Sponsor</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 opacity-80">

            <img src="{{ asset('images/partner1.png') }}" class="w-28 mx-auto" alt="">
            <img src="{{ asset('images/partner2.png') }}" class="w-28 mx-auto" alt="">
            <img src="{{ asset('images/partner3.png') }}" class="w-28 mx-auto" alt="">
            <img src="{{ asset('images/partner4.png') }}" class="w-28 mx-auto" alt="">

        </div>

    </div>
</section>

<!-- STATISTICS SECTION -->
<section class="py-20 bg-blue-900 text-white" style="margin-top: -100px;">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div>
                <h3 class="text-5xl font-bold mb-2">500+</h3>
                <p class="text-lg">Members</p>
            </div>
            <div>
                <h3 class="text-5xl font-bold mb-2">50+</h3>
                <p class="text-lg">Projects</p>
            </div>
            <div>
                <h3 class="text-5xl font-bold mb-2">15+</h3>
                <p class="text-lg">Years Experience</p>
            </div>
            <div>
                <h3 class="text-5xl font-bold mb-2">100%</h3>
                <p class="text-lg">Satisfaction</p>
            </div>
        </div>
    </div>
</section>

{{-- GALLERY --}}
<!-- GALLERY SECTION WITH SLIDING IMAGES -->
<section class="py-20 bg-gray-100 overflow-hidden">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-12">Gallery</h2>

        <!-- Wrapper -->
        <div class="relative w-full overflow-hidden">

            <!-- Sliding Track -->
            <div class="flex gap-6 animate-slide">

                <img src="{{ asset('images/galery1.jpg') }}" class="w-64 h-40 object-cover rounded-xl shadow" />
                <img src="{{ asset('images/galery2.jpg') }}" class="w-64 h-40 object-cover rounded-xl shadow" />
                <img src="{{ asset('images/galery3.jpg') }}" class="w-64 h-40 object-cover rounded-xl shadow" />
                <img src="{{ asset('images/galery4.jpg') }}" class="w-64 h-40 object-cover rounded-xl shadow" />
                <img src="{{ asset('images/galery5.jpg') }}" class="w-64 h-40 object-cover rounded-xl shadow" />

                <!-- Duplicate for infinite slide -->
                <img src="{{ asset('images/galery1.jpg') }}" class="w-64 h-40 object-cover rounded-xl shadow" />
                <img src="{{ asset('images/galery2.jpg') }}" class="w-64 h-40 object-cover rounded-xl shadow" />
                <img src="{{ asset('images/galery3.jpg') }}" class="w-64 h-40 object-cover rounded-xl shadow" />
                <img src="{{ asset('images/galery4.jpg') }}" class="w-64 h-40 object-cover rounded-xl shadow" />
                <img src="{{ asset('images/galery5.jpg') }}" class="w-64 h-40 object-cover rounded-xl shadow" />

            </div>
        </div>
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-20 bg-blue-900 text-white">
    <div class="container mx-auto px-6 text-center max-w-3xl">

        <h2 class="text-4xl font-bold mb-6">Ingin Bergabung Bersama Kami?</h2>
        <p class="text-white/80 mb-8">
            Jadilah bagian dari komunitas profesional yang aktif, solid, dan berkembang.
        </p>

        <a href="/register"
           class="px-8 py-3 bg-white text-blue-900 font-bold rounded-full shadow-lg hover:bg-gray-200 transition">
            Daftar Sekarang
        </a>

    </div>
</section>

<style>
@keyframes slide {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.animate-slide {
    animation: slide 20s linear infinite;
}
</style>

@include('components.footer')

@endsection
