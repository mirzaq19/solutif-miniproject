@extends('layout')
@section('title', 'Detail Mata Kuliah')
@section('content')
    <div class="container min-h-screen lg:h-min mx-auto px-4 py-10">
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                 role="alert">
                <span class="font-medium">Gagal!</span> {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                 role="alert">
                <span class="font-medium">Gagal!</span> Silahkan cek kembali data yang anda masukkan.
            </div>
        @endif
        <h1 class="font-bold text-2xl">Detail Mata Kuliah</h1>
        <div class="my-4 flex flex-col text-center md:flex-row md:justify-end">
            <a href="{{ route('course.edit',$course) }}"
               class="w-full md:w-1/6 lg:w-1/12 focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2"><i
                    class="fas fa-edit"></i> Edit</a>
            <button
                class="w-full md:w-1/6 lg:w-1/12 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </div>
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
                            <input disabled type="number" name="code" id="code" placeholder="23874632"
                                   value="{{ $course->code }}"
                                   class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="name" class="text-sm md:text-base">Nama Mata Kuliah</label>
                            <input disabled type="text" name="name" id="name" placeholder="Komputasi Grid"
                                   value="{{ $course->name }}"
                                   class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="credit" class="text-sm md:text-base">Jumlah SKS</label>
                            <input disabled type="number" min="1" max="4" name="credit" id="credit" placeholder="4"
                                   value="{{ $course->credit }}"
                                   class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
