@extends('layout')
@section('title', 'Daftar Mahasiswa')
@section('content')
    <div class="container min-h-screen lg:h-min mx-auto px-4 py-10">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                 role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">Gagal!</span> {{ session('error') }}
            </div>
        @endif
        <h1 class="font-bold text-2xl mb-6">Daftar Mahasiswa</h1>
        <div class="flex flex-col-reverse lg:flex-row mb-6 lg:justify-between lg:text-left">
            <div class="flex lg:w-1/6">
                <a class="text-center align-middle lg:inline-block w-full bg-gray-700 text-white rounded-lg px-4 py-2 hover:bg-gray-800 transition-colors duration-300"
                   href="{{route('student.create')}}">Tambah mahasiswa</a>
            </div>
            <div class="mb-6 lg:mb-0 lg:w-1/3">
                <form action="{{ route('student.index') }}" method="GET">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="lg:w-3/4">
                            <label>
                                <input type="text" name="keyword" placeholder="Cari mahasiswa..."
                                       class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </label>
                        </div>
                        <div class="lg:w-1/4">
                            <button type="submit"
                                    class="w-full bg-indigo-500 text-white rounded-lg px-4 py-2 hover:bg-indigo-600 transition-colors duration-300">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto relative shadow sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-700">
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
                            <a href="{{ route('student.show',$student->id) }}"
                               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <i class="fas fa-info-circle"></i> Detail
                            </a>
                            <a href="{{ route('student.edit',$student->id) }}"
                               class="focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2"><i
                                    class="fas fa-edit"></i> Edit</a>
                            <button
                                onclick="setModal('{{ $student->id }}', '{{ $student->name }}')"
                                data-modal-target="#modal-delete-student"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
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


    <div id="modal-delete-student" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none">
        <div id="modal-overlay" class="fixed inset-0 bg-zinc-800 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div id="modal-box" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Hapus mahasiswa</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Apakah anda yakin ingin ingin menghapus data mahasiswa "<span class="font-semibold" id="delete-name"></span>" ? Data akan terhapus secara permanen</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form id="delete-student" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Hapus</button>
                        </form>
                        <button data-modal-close="#modal-delete-student" type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('insert-js')
    <script>
        const MODAL_DELETE_STUDENT = new window.modal('modal-delete-student')
        const setModal = (id, name) => {
            document.getElementById('delete-student').action = '/dashboard/student/' + id;
            document.getElementById('delete-name').innerHTML = name;
        }

    </script>
@endsection
