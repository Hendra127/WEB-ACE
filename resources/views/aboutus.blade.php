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
            <p class="text-gray-700 leading-relaxed mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae justo nec nulla facilisis bibendum. Integer non suscipit orci.
            </p>

            <p class="text-gray-700 leading-relaxed mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel libero nec sapien aliquet porttitor. Donec vulputate lacus sem fermentum.
            </p>

            <p class="text-gray-700 leading-relaxed mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam et arcu sed orci feugiat congue. Aliquam erat volutpat.
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
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </p>
        <ul class="list-disc pl-6 text-gray-700">
            <li>Lorem ipsum dolor sit amet consectetur.</li>
            <li>Lorem ipsum dolor sit amet consectetur.</li>
            <li>Lorem ipsum dolor sit amet consectetur.</li>
        </ul>
    </div>
  

@include('components.footer')
@endsection
