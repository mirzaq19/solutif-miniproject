@extends('layout')
@section('title', 'Dashboard')
@section('content')
    @if (Auth::user()->role == 'admin')
        <div class="container min-h-screen lg:h-min mx-auto px-4 py-10">
            <h1 class="font-bold text-2xl">Dashboard</h1>

            <div class="mt-8 flex flex-col gap-y-4">
                <div class="rounded-lg border">
                    <div class="border-b flex p-4 bg-gray-50">
                        <h3 class="font-semibold text-base md:text-lg"><i class="fas fa-user text-indigo-500"></i>
                            Mahasiswa</h3>
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
                        <a href="{{ route('student.index') }}"
                           class="font-semibold text-sm md:text-base hover:text-indigo-700 transition-colors duration-300">Lihat
                            detail</a>
                    </div>
                </div>

                <div class="rounded-lg border">
                    <div class="border-b flex p-4 bg-gray-50">
                        <h3 class="font-semibold text-base md:text-lg"><i class="fas fa-book text-indigo-500"></i> Mata
                            Kuliah</h3>
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
                        <a href="{{ route('course.index') }}"
                           class="font-semibold text-sm md:text-base hover:text-indigo-700 transition-colors duration-300">Lihat
                            detail</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Auth::user()->role == 'student')
        <div class="container min-h-screen lg:h-min mx-auto px-4 py-10">
            <h1 class="font-bold text-2xl my-6">Detail Mahasiswa</h1>
            <a href="{{ route('dashboard.report',$student) }}" class="inline-block mb-6 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                <i class="fas fa-file-pdf"></i> Download Laporan
            </a>
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
                        <h3 class="font-semibold text-base md:text-lg"><i
                                class="fas fa-graduation-cap text-indigo-500"></i>
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
                                    <option value="male" {{ $student->gender == 'male' ? 'selected':'' }}>Laki-laki
                                    </option>
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
                        @foreach($ownedCourses as $course)
                            <div class="min-w-fit">
                                <div class="flex flex-row gap-4 p-4">
                                    <div class="flex flex-col w-1/4 gap-y-2">
                                        <label for="name-{{ $course->id }}" class="text-sm md:text-base">Nama Mata
                                            Kuliah</label>
                                        <input disabled type="text" name="name" id="name-{{ $course->id }}"
                                               value="{{ $course->name }}"
                                               class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div class="flex flex-col w-1/4 gap-y-2">
                                        <label for="credit-{{ $course->id }}" class="text-sm md:text-base">SKS</label>
                                        <input disabled type="number" name="credit" id="credit-{{ $course->id }}"
                                               value="{{ $course->credit }}"
                                               class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div class="flex flex-col w-1/4 gap-y-2">
                                        <label for="semester-{{ $course->id }}"
                                               class="text-sm md:text-base">Semester</label>
                                        <input disabled type="number" name="semester" id="semester-{{ $course->id }}"
                                               value="{{ $course->pivot->semester }}"
                                               data-input="{{ $course->id }}"
                                               class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div class="flex flex-col w-1/4 gap-y-2">
                                        <label for="grade-{{ $course->id }}" class="text-sm md:text-base">Nilai</label>
                                        <input disabled type="text" name="grade" id="grade-{{ $course->id }}"
                                               value="{{ $course->pivot->grade }}"
                                               data-input="{{ $course->id }}"
                                               class="placeholder:text-sm md:placeholder:text-base border rounded lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
