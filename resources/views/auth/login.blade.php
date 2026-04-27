<x-app title="Login">
    <div class="fixed top-2 left-2">
        <h1 class="text-xl">Developed and maintained by
            <a href="https://markkweb.net/" target="_blank" class="underline text-blue-400">MK</a>
        </h1>
    </div>
    <div class="h-svh p-4 sm:p-0 flex items-center sm:justify-center">
        <div
            class="p-8 w-full sm:w-auto sm:min-w-[25%] border border-gray-200 rounded-md flex flex-col text-center gap-8 bg-white">
            <h1 class="text-4xl text-brand-dark font-bold">Login</h1>
            <x-message.error />
            <form method="POST" action="{{route('auth.login')}}" class="flex flex-col gap-6">
                @csrf
                <x-form.wrapper>
                    <x-form.label for="identifier">Username or Email</x-form.label>
                    <x-form.input type="text" id="identifier" name="identifier" placeholder="Username or Email" value="{{old('identifier')}}"/>
                </x-form.wrapper>
                <x-form.wrapper>
                    <x-form.label for="password">Password</x-form.label>
                    <x-form.input type="password" id="password" name="password" placeholder="Password"/>
                </x-form.wrapper>
                <x-form.input type="submit" value="Login"
                              class="text-brand-dark hover:bg-zinc-50 cursor-pointer text-xl font-bold"
                              title="Login to the site"/>
            </form>
        </div>
    </div>
</x-app>
