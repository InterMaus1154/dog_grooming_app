<aside x-bind:class="open ? 'w-full sm:w-80' : 'w-0 overflow-hidden'"
       class=" shrink-0 bg-brand-light text-black transition-all duration-300 h-full relative">
    <div class="p-4 flex flex-col gap-4">
        <h1 class="text-4xl text-center font-bold italic">
            <a href="{{route('dashboard')}}">GabiGrooming</a>
        </h1>
        <h2 class="text-center text-xl">Hi, <i>{{auth()->user()->username}}</i></h2>
        <nav>
            <ul class="flex flex-col gap-2">
                <li>
                    <a href="{{route('dashboard')}}" class="bg-white block text-center text-xl hover:bg-brand-dark hover:text-white transition-all duration-200 font-bold rounded-md py-1 cursor-pointer">Home</a>
                </li>
                <li>
                    <a class="bg-white block text-center text-xl hover:bg-brand-dark hover:text-white transition-all duration-200 font-bold rounded-md py-1 cursor-pointer">Dogs</a>
                </li>
                <li>
                    <a class="bg-white block text-center text-xl hover:bg-brand-dark hover:text-white transition-all duration-200 font-bold rounded-md py-1 cursor-pointer">Bookings</a>
                </li>
                <li>
                    <a class="bg-white block text-center text-xl hover:bg-brand-dark hover:text-white transition-all duration-200 font-bold rounded-md py-1 cursor-pointer">Customers (owners)</a>
                </li>
                <li>
                    <a class="bg-white block text-center text-xl hover:bg-brand-dark hover:text-white transition-all duration-200 font-bold rounded-md py-1 cursor-pointer">Settings</a>
                </li>
                <li>
                    <form method="POST" action="{{route('auth.logout')}}">
                        @csrf
                        <button type="submit" class="bg-white block text-center text-xl hover:bg-brand-dark hover:text-white transition-all duration-200 font-bold rounded-md py-1 cursor-pointer w-full">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
