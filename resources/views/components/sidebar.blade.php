<aside x-bind:class="open ? 'w-full sm:w-80' : 'w-0 overflow-hidden'"
       class=" shrink-0 bg-brand-light text-black transition-all duration-300 h-full relative shadow-xl">
    <div class="p-4 flex flex-col gap-4">
        <h1 class="text-4xl text-center font-bold italic text-brand-dark">
            <a href="{{route('dashboard')}}">GabiGrooming</a>
        </h1>
        <h2 class="text-center text-xl">Hi,
            <i>{{auth()->user()->username}}</i>
        </h2>
        @if(app()->isLocal())
            <h3 class="font-bold text-xl text-red-500 text-center">DEBUG LOCAL</h3>
        @endif
        <nav>
            <ul class="flex flex-col gap-2">
                @php
                    $active = 'bg-brand-dark text-white hover:bg-white hover:text-brand-dark';
                    $inactive = 'bg-white text-brand-dark hover:bg-brand-dark hover:text-white'
                @endphp
                <li>
                    <a href="{{route('dashboard')}}"
                       class="{{request()->routeIs('dashboard') ? $active : $inactive}} block text-center text-xl transition-all duration-200 font-bold rounded-md py-1 cursor-pointer shadow-md">
                        Home
                    </a>
                </li>
                <li>
                    <a class="bg-white block text-center text-xl hover:bg-brand-dark hover:text-white transition-all duration-200 font-bold rounded-md py-1 cursor-pointer shadow-md">
                        Dogs
                    </a>
                </li>
                <li>
                    <a class="bg-white block text-center text-xl hover:bg-brand-dark hover:text-white transition-all duration-200 font-bold rounded-md py-1 cursor-pointer shadow-md">
                        Bookings
                    </a>
                </li>
                <li>
                    <a href="{{route('customers.index')}}" class="{{request()->routeIs('customers.*') ? $active : $inactive}} text-xl block text-center transition-all duration-200 font-bold rounded-md py-1 cursor-pointer shadow-md">
                        Customers (owners)
                    </a>
                </li>
                <li>
                    <a href="{{route('breeds.index')}}"
                       class="{{request()->routeIs('breeds.*') ? $active : $inactive}}  block text-center text-xl transition-all duration-200 font-bold rounded-md py-1 cursor-pointer shadow-md">
                        Breeds
                    </a>
                </li>
                <li>
                    <a class="bg-white block text-center text-xl hover:bg-brand-dark hover:text-white transition-all duration-200 font-bold rounded-md py-1 cursor-pointer shadow-md">
                        Settings
                    </a>
                </li>
                <li>
                    <a href="{{route('logs.index')}}"
                       class="{{request()->routeIs('logs.*') ? $active : $inactive}}  block text-center text-xl transition-all duration-200 font-bold rounded-md py-1 cursor-pointer shadow-md">
                        Logs
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{route('auth.logout')}}">
                        @csrf
                        <button type="submit" class="bg-white block text-center text-xl hover:bg-brand-dark hover:text-white transition-all duration-200 font-bold rounded-md py-1 cursor-pointer w-full shadow-md">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
