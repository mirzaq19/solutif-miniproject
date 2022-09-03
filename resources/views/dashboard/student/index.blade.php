@extends('layout')
@section('title', 'Daftar Mahasiswa')
@section('content')
    <div class="container min-h-screen lg:h-min mx-auto px-4 py-10">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif
        <h1 class="font-bold text-2xl mb-6">Daftar Mahasiswa</h1>
        <div class="flex flex-col-reverse lg:flex-row mb-6 lg:justify-between lg:text-left">
            <div class="flex lg:w-1/6">
                <a class="text-center align-middle lg:inline-block w-full bg-gray-700 text-white rounded-lg px-4 py-2 hover:bg-gray-800 transition-colors duration-300" href="{{route('student.create')}}">Tambah mahasiswa</a>
            </div>
            <div class="mb-6 lg:mb-0 lg:w-1/3">
                <form action="{{ route('student.index') }}" method="GET">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="lg:w-3/4">
                            <label>
                                <input type="text" name="keyword" placeholder="Cari mahasiswa..." class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </label>
                        </div>
                        <div class="lg:w-1/4">
                            <button type="submit" class="w-full bg-indigo-500 text-white rounded-lg px-4 py-2 hover:bg-indigo-600 transition-colors duration-300">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto relative shadow sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-gray-200">
                <tr class="text-center">
                    <th scope="col" class="py-4 px-6">
                        Nama
                    </th>
                    <th scope="col" class="py-4 px-6">
                        NIM
                    </th>
                    <th scope="col" class="py-4 px-6">
                        Alamat
                    </th>
                    <th scope="col" class="py-4 px-6">
                        Jurusan
                    </th>
                    <th scope="col" class="py-4 px-6">
                        Tahun Masuk
                    </th>
                    <th scope="col" class="py-4 px-6">
                        Aksi
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr class="text-center hover:bg-gray-100">
                        <td class="py-3 px-6">
                            {{ $student->name }}
                        </td>
                        <td class="py-3 px-6">
                            {{ $student->nim }}
                        </td>
                        <td class="py-3 px-6">
                            {{ $student->address }}
                        </td>
                        <td class="py-3 px-6">
                            {{ $student->major }}
                        </td>
                        <td class="py-3 px-6">
                            {{ $student->year }}
                        </td>
                        <td class="py-4 px-6 justify-center flex flex-col lg:flex-row">
                            <a href="{{route('student.show',$student)}}"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <i class="fas fa-info-circle"></i> Detail
                            </a>
                            <a href="#" class="focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2"><i class="fas fa-edit"></i> Edit</a>
                            <a href="#" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $students->links('partials._pagination') }}
        </div>

    </div>
@endsection
