{{--navbar tailwind--}}
<nav class="bg-gray-900 shadow-md">
    <div class="container mx-auto px-4 py-5">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-800">
                    <img src="{{ asset('images/logo.svg') }}" alt="logo" class="w-16">
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center gap-x-1 sm:gap-x-2 lg:gap-x-3">
                    @if (Auth::check())
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ url('/dashboard') }}" class="text-xs md:text-sm text-gray-300 hover:text-gray-100 rounded-md text-sm font-medium">Dashboard</a>
                            <a href="{{ route('student.index') }}" class="text-xs md:text-sm text-gray-300 hover:text-gray-100 rounded-md text-sm font-medium">Mahasiswa</a>
                            <a href="{{ route('course.index') }}" class="text-xs md:text-sm text-gray-300 hover:text-gray-100 rounded-md text-sm font-medium">Mata Kuliah</a>
                        @endif
                        <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-xs md:text-sm text-gray-300 hover:text-gray-100 rounded-md text-sm font-medium">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
