@extends('layout')
@section('title', 'Edit Mata Kuliah')
@section('content')
    <div class="container min-h-screen lg:h-min mx-auto px-4 py-10">
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">Gagal!</span> {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">Gagal!</span> Silahkan cek kembali data yang anda masukkan.
            </div>
        @endif
        <h1 class="font-bold text-2xl">Edit Mata Kuliah</h1>
        <form action="{{ route('course.update',$course->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mt-8 flex flex-col gap-y-4">
                <div class="rounded-lg border">
                    <div class="border-b flex p-4 bg-gray-50">
                        <h3 class="font-semibold text-base md:text-lg"><i class="fas fa-book text-indigo-500"></i>
                            Data Mata Kuliah</h3>
                    </div>
                    <div class="p-4">
                        <div class="flex flex-col gap-y-4">
                            <div class="flex flex-col gap-y-2">
                                <label for="code" class="text-sm md:text-base">Kode Mata Kuliah</label>
                                <input type="number" name="code" id="code" placeholder="23874632" value="{{ $course->code }}" required
                                       class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('code')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="name" class="text-sm md:text-base">Nama Mata Kuliah</label>
                                <input type="text" name="name" id="name" placeholder="Komputasi Grid" value="{{ $course->name }}" required
                                       class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('name')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="credit" class="text-sm md:text-base">Jumlah SKS</label>
                                <input type="number" min="1" max="4" name="credit" id="credit" placeholder="4" value="{{ $course->credit }}" required
                                       class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <span>
                                    <i class="fas fa-info-circle text-indigo-500"></i>
                                    <span class="text-xs md:text-sm">Jumlah SKS maksimal 4</span>
                                </span>
                                @error('credit')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="mt-4 w-full bg-indigo-500 text-white font-semibold rounded-lg px-4 py-2 hover:bg-indigo-600">Simpan</button>
        </form>
    </div>
@endsection
