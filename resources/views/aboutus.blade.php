@extends('layouts.app')

@section('content')
@include('components.navbar')

<div class="container mx-auto px-6 py-12" style="font-family: 'Quicksand', sans-serif;">

    <!-- TITLE -->
    <h2 class="text-4xl font-bold mb-2 text-start md:text-left md:pl-20" style="margin-left: 115px">
        About ACE Lombok
    </h2>
    <div class="border-b-4 border-gray-300 w-16 mb-4" style="margin-left: 190px;"></div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

        <!-- TEXT SECTION -->
        <div class="px-4md:pl-20 md:pr-10" style="margin-left: 190px">
            <h2 class="text-1xl font-bold">NAMA DAN KEDUDUKAN</h5>
            <p class="text-gray-700 leading-relaxed mb-6">
                Wadah ini bernama ASOSIASI CHIEF ENGINEER LOMBOK, disingkat ACE LOMBOK, di bentuk
ADART dan di SAH kan pada hari SABTU 08 APRIL 2016 di Lombok Plaza Hotel.
            </p>

            <h2 class="text-1xl font-bold">SIFAT</h5>
            <p class="text-gray-700 leading-relaxed mb-6">
                ACE LOMBOK adalah organisasi profesi para Engineer Building, Mall, Pabrik, Rumah Sakit, Hotel, Apartemen, Building Office, Restaurant, dan Fasilitas Wisata di Nusa Tenggara Barat yang bersifat terbuka, majemuk, dan mandiri.
            </p>

            <h2 class="text-1xl font-bold">IDENTITAS</h5>
            <p class="text-gray-700 leading-relaxed mb-6">
                Identitas ACE Lombok adalah : Menjunjung tinggi professionalisme berdasarkan nilai etika, moral dan kemanusiaan 
            </p>
        </div>

        <!-- IMAGE SECTION -->
        <div class="px-4 md:pr-20 md:pl-10 flex flex-col items-center">
            <img 
                src="{{ asset('images/about1.jpg') }}" 
                alt="About 1" 
                class="rounded-xl shadow-lg w-full max-w-[380px] object-cover"
            >
        </div>

    </div>
</div>

    <!-- BOX SECTION -->
    <div class="mt-14 p-8 border rounded-xl bg-gray-50 ml-4 md:ml-20 mr-4 md:mr-20">
        <p class="font-semibold text-gray-800 mb-3">
            ARTI LOGO ACE LOMBOK 
        </p>
        <img src="{{ asset('images/logoace.png') }}" class="w-28 mx-auto" alt="" style="margin-left: 300px; margin-top: -40px; margin-bottom: 20px; background-image: white; padding: 10px; border-radius: 10px;">
        
        <ul class="list-disc pl-6 text-gray-700">
            <li>Lambang Roda Gigi, bahwa ACE LOMBOK berkiprah secara global yang berkesinambungan dan dinamis semua segi profesi engineer. Meliputi Apartemen, Hotel, Mall, Pabrik, Rumah Sakit, Wisata, Office, Restaurant, Industri, Gedung Pendidikan, Gedung Pemerintahan, Sport dan Multimedia.</li>
            <li>Warna Biru, bahwa memiliki kesan kreatif, tenang dan menekan keinginan, dimana tidak meminta minta untuk memperhatikan, serta menampilkan kekuatan teknologi, kebersihan, udara, langit, air dan laut.</li>
            <li>Lambang  Lumbung Adalah tempat penyimpanan padi suku sasak asli Lombok.</li>
            <li> Tulisan  safety First Adalah setiap pekerja harus mengutamakan keselamatan dalam melakukan pekerjaan.</li>
        </ul>
    </div>
  

@include('components.footer')
@endsection
