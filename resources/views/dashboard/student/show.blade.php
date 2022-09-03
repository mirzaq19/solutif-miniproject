@extends('layout')
@section('title', 'Detail Mahasiswa')
@section('content')
    <div class="container min-h-screen lg:h-min mx-auto px-4 py-10">
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">Gagal!</span> {{ session('error') }}
            </div>
        @endif
        <a href="{{route('student.index')}}"  class="inline-block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"><i class="fas fa-arrow-left"></i> Kembali</a>
        <h1 class="font-bold text-2xl mt-6">Detail Mahasiswa</h1>
        <div class="my-4 flex flex-col text-center md:flex-row md:justify-end">
            <a href="{{ route('student.edit',$student) }}" class="w-full md:w-1/6 lg:w-1/12 focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2"><i class="fas fa-edit"></i> Edit</a>
{{--            <a href="#" class="w-full md:w-1/6 lg:w-1/12 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2"><i class="fas fa-trash"></i> Hapus</a>--}}
            <button
                onclick="openModal('{{ $student->id }}', '{{ $student->name }}')"
                class="w-full md:w-1/6 lg:w-1/12 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </div>
        <div class="flex flex-col gap-y-4">
            <div class="rounded-lg border">
                <div class="border-b flex p-4 bg-gray-50">
                    <h3 class="font-semibold text-base md:text-lg"><i class="fas fa-user text-indigo-500"></i>
                        Data Login</h3>
                </div>
                <div class="p-4">
                    <div class="flex flex-col gap-y-4">
                        <div class="flex flex-col gap-y-2">
                            <label for="name" class="text-sm md:text-base">Nama</label>
                            <input disabled type="text" name="name" id="name" placeholder="Budi" value="{{ $student->user->name }}"
                                   class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="email" class="text-sm md:text-base">Email</label>
                            <input disabled type="email" name="email" id="email" placeholder="Email" value="{{ $student->user->email }}"
                                   class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="username" class="text-sm md:text-base">Username</label>
                            <input disabled type="text" name="username" id="username" placeholder="Username"
                                   value="{{ $student->user->username }}"
                                   class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 flex flex-col gap-y-4">
            <div class="rounded-lg border">
                <div class="border-b flex p-4 bg-gray-50">
                    <h3 class="font-semibold text-base md:text-lg"><i class="fas fa-graduation-cap text-indigo-500"></i>
                        Data Mahasiswa</h3>
                </div>
                <div class="p-4">
                    <div class="flex flex-col gap-y-4">
                        <div class="flex flex-col gap-y-2">
                            <label for="nim" class="text-sm md:text-base">NIM</label>
                            <input disabled type="number" name="nim" id="nim" placeholder="1234" value="{{ $student->nim }}"
                                   class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="gender" class="text-sm md:text-base">Jenis Kelamin</label>
                            <select disabled name="gender" id="gender"
                                    class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="male" {{ $student->gender == 'male' ? 'selected':'' }}>Laki-laki</option>
                                <option value="female" {{ $student->gender == 'female' ? 'selected':'' }}>Perempuan</option>
                            </select>
                            @error('gender')
                            <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-y-4">
                            <div class="flex flex-col gap-y-2">
                                <label for="address" class="text-sm md:text-base">Alamat</label>
                                <textarea disabled type="number" name="address" id="address" placeholder="alamat" rows="2"
                                          class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ $student->address }}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="Jurusan" class="text-sm md:text-base">Jurusan</label>
                            <select disabled name="major" id="Jurusan"
                                    class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="Sistem Informasi" {{ $student->major == 'Sistem Informasi' ? 'selected':'' }}>Sistem Informasi</option>
                                <option value="Teknik Informatika" {{ $student->major == 'Teknik Informatika' ? 'selected':'' }}>Teknik Informatika</option>
                                <option value="Teknologi Informasi" {{ $student->major == 'Teknologi Informasi' ? 'selected':'' }}>Teknologi Informasi</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="year" class="text-sm md:text-base">Tahun Masuk</label>
                            <select disabled name="year" id="year"
                                    class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @for ($i = date('Y')-3; $i <= date('Y')+3; $i++)
                                    <option value="{{ $i }}" {{ $student->year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div id="modal" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none">
        <!--
          Background backdrop, show/hide based on modal state.

          Entering: "ease-out duration-300"
            From: "opacity-0"
            To: "opacity-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <div id="modal-overlay" class="fixed inset-0 bg-zinc-800 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!--
                  Modal panel, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
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
                            <button onclick="closeModal()" type="submit" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Hapus</button>
                        </form>
                        <button onclick="closeModal()" type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('insert-js')
    <script>
        const MODAL = document.getElementById('modal');
        const MODAL_BOX = document.getElementById('modal-box');
        const MODAL_OVERLAY = document.getElementById('modal-overlay');
        const DELETE_STUDENT = document.getElementById('delete-student');
        const DELETE_NAME = document.getElementById('delete-name');

        function openModal(id, name) {
            DELETE_STUDENT.action = '/dashboard/student/' + id;
            DELETE_NAME.innerHTML = name;
            MODAL.style.display = null;
            MODAL_OVERLAY.style.display = null;
            MODAL_BOX.style.display = null;
            MODAL_BOX.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
            MODAL_OVERLAY.classList.add('ease-out', 'duration-300', 'opacity-0');
            setTimeout(() => {
                MODAL_BOX.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
                MODAL_BOX.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
                MODAL_OVERLAY.classList.remove('opacity-0');
                MODAL_OVERLAY.classList.add('opacity-100');
                MODAL_BOX.classList.remove('opacity-100', 'translate-y-0', 'sm:translate-y-0', 'sm:scale-100');
                MODAL_OVERLAY.classList.remove('ease-out', 'duration-300', 'opacity-100');
            }, 200);
        }

        function closeModal() {
            MODAL_BOX.classList.add('ease-in', 'duration-200', 'opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
            MODAL_OVERLAY.classList.add('ease-in', 'duration-200', 'opacity-0');
            setTimeout(() => {
                MODAL_BOX.classList.remove('ease-in', 'duration-200', 'opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
                MODAL_OVERLAY.classList.remove('ease-in', 'duration-200', 'opacity-0');
                MODAL.style.display = 'none';
                MODAL_OVERLAY.style.display = 'none';
                MODAL_BOX.style.display = 'none';
            }, 200);
        }
    </script>
@endsection
