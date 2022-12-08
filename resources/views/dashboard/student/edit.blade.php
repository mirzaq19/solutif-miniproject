@extends('layout')
@section('title', 'Edit Mahasiswa')
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
        <a href="{{ URL::previous() }}"
           class="inline-block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"><i
                class="fas fa-arrow-left"></i> Kembali</a>
        <h1 class="font-bold text-2xl mt-6">Edit Mahasiswa</h1>
        <form action="{{ route('student.update',$student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mt-8 flex flex-col gap-y-4">
                <div class="rounded-lg border">
                    <div class="border-b flex p-4 bg-gray-50">
                        <h3 class="font-semibold text-base md:text-lg"><i class="fas fa-user text-indigo-500"></i>
                            Data Login</h3>
                    </div>
                    <div class="p-4">
                        <div class="flex flex-col gap-y-4">
                            <div class="flex flex-col gap-y-2">
                                <label for="name" class="text-sm md:text-base">Nama</label>
                                <input type="text" name="name" id="name" placeholder="Budi"
                                       value="{{ $student->user->name }}"
                                       class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('name')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="email" class="text-sm md:text-base">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email"
                                       value="{{ $student->user->email }}"
                                       class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('email')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="username" class="text-sm md:text-base">Username</label>
                                <input type="text" name="username" id="username" placeholder="Username"
                                       value="{{ $student->user->username }}"
                                       class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('username')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="password" class="text-sm md:text-base">Password</label>
                                <div class="flex rounded-md relative">
                                    <input type="password" name="password" id="password" placeholder="••••••••"
                                           class="placeholder:text-sm z-10 md:placeholder:text-base border border-gray-300 text-gray-900 sm:text-sm rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent block w-full p-2.5">
                                    <span
                                        class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">
                                        <button type="button" id="toggle-password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </span>
                                </div>
                                @error('password')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="password-confirmation" class="text-sm md:text-base">Konfirmasi
                                    Password</label>
                                <div class="flex rounded-md">
                                    <input type="password" name="password_confirmation" id="password-confirmation"
                                           placeholder="••••••••"
                                           class="placeholder:text-sm z-10 md:placeholder:text-base border border-gray-300 text-gray-900 sm:text-sm rounded-l-lg f focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent block w-full p-2.5">
                                    <span
                                        class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">
                                        <button type="button" id="toggle-password-confirmation">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </span>
                                </div>
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
                                <input type="number" name="nim" id="nim" placeholder="1234" value="{{ $student->nim }}"
                                       class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('nim')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="gender" class="text-sm md:text-base">Jenis Kelamin</label>
                                <select name="gender" id="gender"
                                        class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="male" {{ $student->gender == 'male' ? 'selected':'' }}>Laki-laki
                                    </option>
                                    <option value="female" {{ $student->gender == 'male' ? 'selected':'' }}>Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-y-4">
                                <div class="flex flex-col gap-y-2">
                                    <label for="address" class="text-sm md:text-base">Alamat</label>
                                    <textarea type="number" name="address" id="address" placeholder="alamat" rows="2"
                                              class="placeholder:text-sm md:placeholder:text-base border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ $student->address }}</textarea>
                                </div>
                                @error('address')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="Jurusan" class="text-sm md:text-base">Jurusan</label>
                                <select name="major" id="Jurusan"
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
                                @error('major')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="year" class="text-sm md:text-base">Tahun Masuk</label>
                                <select name="year" id="year"
                                        class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    @for ($i = date('Y')-3; $i <= date('Y')+3; $i++)
                                        <option
                                            value="{{ $i }}" {{ $student->year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('year')
                                <span class="text-red-500 text-xs md:text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit"
                    class="mt-4 w-full bg-indigo-500 text-white font-semibold rounded-lg px-4 py-2 hover:bg-indigo-600">
                Simpan
            </button>
        </form>
    </div>
@endsection
@section('insert-js')
    <script>
        const togglePassword = document.getElementById('toggle-password');
        const password = document.getElementById('password');
        togglePassword.addEventListener('click', () => {
            if (password.type === 'password') {
                password.type = 'text';
                togglePassword.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                password.type = 'password';
                togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
        const togglePasswordConfirmation = document.getElementById('toggle-password-confirmation');
        const passwordConfirmation = document.getElementById('password-confirmation');
        togglePasswordConfirmation.addEventListener('click', () => {
            if (passwordConfirmation.type === 'password') {
                passwordConfirmation.type = 'text';
                togglePasswordConfirmation.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordConfirmation.type = 'password';
                togglePasswordConfirmation.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    </script>
@endsection
