<x-app>
    <div class="h-screen flex justify-center items-center">
        <div class="flex flex-col gap-4 items-center">
            <h1 class="text-brand-dark text-2xl text-center">
                <strong>404</strong> Page Not Found
            </h1>
            <div class="flex gap-4">
                <a class="text-brand-dark underline hover:no-underline" href="{{route('dashboard')}}">Home</a>
                <a class="text-brand-dark underline hover:no-underline" href="{{route('auth.login.show')}}">Login</a>
            </div>
        </div>
    </div>
</x-app>
