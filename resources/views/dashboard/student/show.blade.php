@extends('layout')
@section('title', 'Detail Mahasiswa')
@section('content')
    <div class="container min-h-screen lg:h-min mx-auto px-4 py-10">
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                 role="alert">
                <span class="font-medium">Gagal!</span> {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                 role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif
        <a href="{{route('student.index')}}"
           class="inline-block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"><i
                class="fas fa-arrow-left"></i> Kembali</a>
        <h1 class="font-bold text-2xl mt-6">Detail Mahasiswa</h1>
        <div class="my-4 flex flex-col text-center md:flex-row md:justify-end">
            <a href="{{ route('student.report',$student) }}"
               class="inline-block focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                <i class="fas fa-file-pdf"></i> Download Laporan
            </a>
            <a href="{{ route('student.edit',$student) }}"
               class="w-full md:w-1/6 lg:w-1/12 focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2"><i
                    class="fas fa-edit"></i> Edit</a>
            <button
                onclick="setModalStudent('{{ $student->id }}', '{{ $student->name }}')"
                data-modal-target="#modal-delete-student"
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
                            <input disabled type="text" name="name" id="name" placeholder="Budi"
                                   value="{{ $student->user->name }}"
                                   class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="email" class="text-sm md:text-base">Email</label>
                            <input disabled type="email" name="email" id="email" placeholder="Email"
                                   value="{{ $student->user->email }}"
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
                            <input disabled type="number" name="nim" id="nim" placeholder="1234"
                                   value="{{ $student->nim }}"
                                   class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="gender" class="text-sm md:text-base">Jenis Kelamin</label>
                            <select disabled name="gender" id="gender"
                                    class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="male" {{ $student->gender == 'male' ? 'selected':'' }}>Laki-laki</option>
                                <option value="female" {{ $student->gender == 'female' ? 'selected':'' }}>Perempuan
                                </option>
                            </select>
                            @error('gender')
                            <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-y-4">
                            <div class="flex flex-col gap-y-2">
                                <label for="address" class="text-sm md:text-base">Alamat</label>
                                <textarea disabled type="number" name="address" id="address" placeholder="alamat"
                                          rows="2"
                                          class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ $student->address }}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="Jurusan" class="text-sm md:text-base">Jurusan</label>
                            <select disabled name="major" id="Jurusan"
                                    class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option
                                    value="Sistem Informasi" {{ $student->major == 'Sistem Informasi' ? 'selected':'' }}>
                                    Sistem Informasi
                                </option>
                                <option
                                    value="Teknik Informatika" {{ $student->major == 'Teknik Informatika' ? 'selected':'' }}>
                                    Teknik Informatika
                                </option>
                                <option
                                    value="Teknologi Informasi" {{ $student->major == 'Teknologi Informasi' ? 'selected':'' }}>
                                    Teknologi Informasi
                                </option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="year" class="text-sm md:text-base">Tahun Masuk</label>
                            <select disabled name="year" id="year"
                                    class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @for ($i = date('Y')-3; $i <= date('Y')+3; $i++)
                                    <option
                                        value="{{ $i }}" {{ $student->year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 flex flex-col gap-y-4">
            <div class="rounded-lg border">
                <div class="border-b flex justify-between p-4 bg-gray-50 items-center">
                    <h3 class="font-semibold text-base md:text-lg"><i class="fas fa-book text-indigo-500"></i>
                        Data Pengambilan Mata Kuliah </h3>
                </div>
                <div class="overflow-x-auto">
                    <div class="min-w-fit">
                        <div class="bg-gray-100 p-4">
                            <h3 class="font-semibold">Ambil mata kuliah baru</h3>
                        </div>
                        <form action="{{ route('student.take-course.store',$student) }}" method="POST">
                            @csrf
                            <div class="flex flex-row gap-4 p-4">
                                <div class="flex flex-col w-1/4 gap-y-2">
                                    <label for="course_id" class="text-sm md:text-base">Mata kuliah</label>
                                    <select name="course_id" id="course_id"
                                            class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        <option value="" disabled selected>Pilih mata kuliah</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}
                                                - {{ $course->credit }}
                                                Sks
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex flex-col w-1/4 gap-y-2">
                                    <label for="semester" class="text-sm md:text-base">Semester</label>
                                    <input type="number" name="semester" id="semester"
                                           class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>
                                <div class="flex flex-col w-1/4 gap-y-2">
                                    <label for="grade" class="text-sm md:text-base">Nilai</label>
                                    <input type="text" name="grade" id="grade"
                                           class="placeholder:text-sm md:placeholder:text-base border rounded lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>
                                <div class="flex flex-col w-1/4 justify-end">
                                    <button type="submit"
                                            class="text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 font-medium rounded text-sm px-4 py-2.5 text-center">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <div class="min-w-fit">
                        <div class="bg-gray-100 p-4">
                            <h3 class="font-semibold">Data mata kuliah yang diambil</h3>
                        </div>
                        @foreach($ownedCourses as $course)
                            <form action="{{ route('student.take-course.update',[$student,$course]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-row gap-4 p-4">
                                    <div class="flex flex-col w-1/4 gap-y-2">
                                        <label for="name-{{ $course->id }}" class="text-sm md:text-base">Nama Mata
                                            Kuliah</label>
                                        <input disabled type="text" name="name" id="name-{{ $course->id }}"
                                               value="{{ $course->name }}"
                                               class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div class="flex flex-col w-1/5 gap-y-2">
                                        <label for="credit-{{ $course->id }}" class="text-sm md:text-base">SKS</label>
                                        <input disabled type="number" name="credit" id="credit-{{ $course->id }}"
                                               value="{{ $course->credit }}"
                                               class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div class="flex flex-col w-1/5 gap-y-2">
                                        <label for="semester-{{ $course->id }}"
                                               class="text-sm md:text-base">Semester</label>
                                        <input disabled type="number" name="semester" id="semester-{{ $course->id }}"
                                               value="{{ $course->pivot->semester }}"
                                               data-input="{{ $course->id }}"
                                               class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div class="flex flex-col w-1/5 gap-y-2">
                                        <label for="grade-{{ $course->id }}" class="text-sm md:text-base">Nilai</label>
                                        <input disabled type="text" name="grade" id="grade-{{ $course->id }}"
                                               value="{{ $course->pivot->grade }}"
                                               data-input="{{ $course->id }}"
                                               class="placeholder:text-sm md:placeholder:text-base border rounded lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div class="flex flex-col w-1/5 justify-between">
                                        <button onclick="editCourse('{{ $course->id }}')" type="button"
                                                id="edit-{{ $course->id }}"
                                                class="bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded text-sm px-2 py-1.5 text-center">
                                            <i class="fas fa-edit"></i> Edit Data
                                        </button>
                                        <button id="delete-{{ $course->id }}" type="button" onclick="setModalCourse('{{ $student->id }}','{{ $course->id }}','{{ $course->name }}')"
                                                data-modal-target="#modal-delete-course"
                                                class="text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded text-sm px-2 py-1.5 text-center">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                        <button id="cancel-{{ $course->id }}" onclick="cancelCourse('{{ $course->id }}')" type="button"
                                                class="hidden text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded text-sm px-2 py-1.5 text-center">
                                            Batal
                                        </button>
                                        <button id="save-{{ $course->id }}" type="submit"
                                                class="hidden text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-4 focus:ring-indigo-300 font-medium rounded text-sm px-2 py-1.5 text-center">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-delete-student" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
         style="display: none">
        <div id="modal-overlay" class="fixed inset-0 bg-zinc-800 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div id="modal-box"
                     class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Hapus
                                    mahasiswa</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Apakah anda yakin ingin ingin menghapus data
                                        mahasiswa "<span class="font-semibold" id="delete-student-name"></span>" ? Data akan
                                        terhapus secara permanen</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form id="delete-student" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                Hapus
                            </button>
                        </form>
                        <button data-modal-close="#modal-delete-student" type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-delete-course" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
         style="display: none">
        <div id="modal-overlay" class="fixed inset-0 bg-zinc-800 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div id="modal-box"
                     class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Hapus
                                    mata kuliah</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Apakah anda yakin ingin ingin menghapus data
                                        mata kuliah "<span class="font-semibold" id="delete-course-name"></span>" ? Data akan
                                        terhapus secara permanen</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form id="delete-course" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                Hapus
                            </button>
                        </form>
                        <button data-modal-close="#modal-delete-course" type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('insert-js')
    <script>
        function editCourse(id) {
            const editButton = document.getElementById('edit-' + id);
            const deleteButton = document.getElementById('delete-' + id);
            const cancelButton = document.getElementById('cancel-' + id);
            const saveButton = document.getElementById('save-' + id);
            const input = document.querySelectorAll('[data-input="' + id + '"]');

            editButton.classList.add('hidden');
            deleteButton.classList.add('hidden');
            cancelButton.classList.remove('hidden');
            saveButton.classList.remove('hidden');

            input.forEach((item) => {
                item.removeAttribute('disabled');
            });
        }

        function cancelCourse(id) {
            const editButton = document.getElementById('edit-' + id);
            const deleteButton = document.getElementById('delete-' + id);
            const cancelButton = document.getElementById('cancel-' + id);
            const saveButton = document.getElementById('save-' + id);
            const input = document.querySelectorAll('[data-input="' + id + '"]');

            editButton.classList.remove('hidden');
            deleteButton.classList.remove('hidden');
            cancelButton.classList.add('hidden');
            saveButton.classList.add('hidden');

            input.forEach((item) => {
                item.setAttribute('disabled', 'true');
            });
        }

        const MODAL_DELETE_STUDENT = new window.modal('modal-delete-student');
        const setModalStudent = (id, name) => {
            document.getElementById('delete-student').action = '/dashboard/student/' + id;
            document.getElementById('delete-student-name').innerText = name;
        }

        const MODAL_DELETE_COURSE = new window.modal('modal-delete-course');
        const setModalCourse = (student,course,name) => {
            document.getElementById('delete-course').action = '/dashboard/student/' + student + '/take-course/' + course;
            document.getElementById('delete-course-name').innerHTML = name;
        }

    </script>
@endsection
