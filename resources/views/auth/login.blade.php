<x-app title="Login">
    <div class="h-screen p-4 sm:p-0 flex items-center sm:justify-center">
        <div
            class="p-8 w-full sm:w-auto sm:min-w-[25%] border border-gray-200 rounded-md flex flex-col text-center gap-8 bg-white">
            <h1 class="text-4xl text-brand font-bold">Login</h1>
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
                              class="text-brand hover:bg-zinc-50 cursor-pointer text-xl font-bold"
                              title="Login to the site"/>
            </form>
        </div>
    </div>
</x-app>
