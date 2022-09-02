@extends('layout')
@section('title', 'Home')
@section('content')
    <div class="container min-h-screen lg:h-min mx-auto px-4 py-10 flex flex-col md:flex-row md:justify-between gap-y-4 md:gap-x-4">
        <div>
            <h1 class="font-bold text-xl lg:text-2xl mb-2">Selamat datang di Sistem Informasi Akademik Kampus</h1>
            <p class="text-sm lg:text-base mb-6">Untuk bisa melihat data anda, silahkan untuk login terlebih dahulu</p>
            <img src="{{asset('images/mobile-login.svg')}}" alt="cover" class="hidden md:block">
        </div>
        <div class="lg:pt-20">
            <h3 class="font-bold text-lg mb-2 lg:text-xl">Masuk</h3>
            <p class="text-sm lg:text-base mb-2">Silahkan masuk terlebih dahulu menggunakan email dan password yang sudah terdaftar</p>
            <div class="flex flex-col items-center justify-center mx-auto">
                <div class="w-full bg-white rounded-lg">
                    <form class="space-y-4 md:space-y-6" action="#">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="email@example.com" required>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <div class="flex rounded-md">
                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-l-lg focus:ring-primary-600 block w-full p-2.5" required>
                                <span class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">
                                    <button type="button" id="toggle-password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300" required>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500">Remember me</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
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
    </script>
@endsection
