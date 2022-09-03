{{--navbar tailwind--}}
<nav class="bg-gray-900 shadow-md">
    <div class="container mx-auto px-4 py-5">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-800">
                    <img src="{{ asset('images/logo.svg') }}" alt="logo" class="w-20">
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center">
                    @if (Auth::check())
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-gray-100 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        @endif
                        <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-300 hover:text-gray-100 px-3 py-2 rounded-md text-sm font-medium">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
