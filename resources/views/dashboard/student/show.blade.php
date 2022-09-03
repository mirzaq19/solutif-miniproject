@extends('layout')
@section('title', 'Detail Mahasiswa')
@section('content')
    <div class="container min-h-screen lg:h-min mx-auto px-4 py-10">
        <a href="{{route('student.index')}}"  class="inline-block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"><i class="fas fa-arrow-left"></i> Kembali</a>
        <h1 class="font-bold text-2xl mt-6">Detail Mahasiswa</h1>
        <div class="my-4 flex flex-col text-center md:flex-row md:justify-end">
            <a href="{{ route('student.edit',$student) }}" class="w-full md:w-1/6 lg:w-1/12 focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2"><i class="fas fa-edit"></i> Edit</a>
            <a href="#" class="w-full md:w-1/6 lg:w-1/12 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-3 py-2 mr-2 mb-2"><i class="fas fa-trash"></i> Hapus</a>
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
@endsection
