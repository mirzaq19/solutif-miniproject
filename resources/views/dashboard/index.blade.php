@extends('layout')
@section('title', 'Dashboard')
@section('content')
    <div class="container min-h-screen lg:h-min mx-auto px-4 py-10">
        <h1 class="font-bold text-2xl">Dashboard</h1>

        <div class="mt-8 flex flex-col gap-y-4">
            <div class="rounded-lg border">
                <div class="border-b flex p-4 bg-gray-50">
                    <h3 class="font-semibold text-base md:text-lg"><i class="fas fa-user text-indigo-500"></i> Mahasiswa</h3>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex flex-col">
                            <h3 class="font-semibold text-base md:text-lg">Total Mahasiswa</h3>
                            <p class="text-gray-500 text-xs md:text-sm">Total mahasiswa yang terdaftar</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-semibold text-base md:text-lg">{{ $numberOfStudent }}</h3>
                            <p class="text-gray-500 text-xs md:text-sm">Orang</p>
                        </div>
                    </div>
                    <a href="{{ route('student.index') }}" class="font-semibold text-sm md:text-base hover:text-indigo-700 transition-colors duration-300">Lihat detail</a>
                </div>
            </div>

            <div class="rounded-lg border">
                <div class="border-b flex p-4 bg-gray-50">
                    <h3 class="font-semibold text-base md:text-lg"><i class="fas fa-book text-indigo-500"></i> Mata Kuliah</h3>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex flex-col">
                            <h3 class="font-semibold text-base md:text-lg">Total Mata Kuliah</h3>
                            <p class="text-gray-500 text-xs md:text-sm ">Total mata kuliah yang terdaftar</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-semibold text-base md:text-lg">{{ $numberOfCourse }}</h3>
                            <p class="text-gray-500 text-xs  md:text-sm">Buah</p>
                        </div>
                    </div>
                    <a href="#" class="font-semibold text-sm md:text-base hover:text-indigo-700 transition-colors duration-300">Lihat detail</a>
                </div>
            </div>
        </div>
    </div>
@endsection
