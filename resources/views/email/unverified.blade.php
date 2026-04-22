<x-app title="Verify your email">
    <div class="h-screen flex justify-center items-center">
        <div class="flex flex-col gap-4">
            @session('info')
                <p class="text-2xl font-bold">{{session('info')}}</p>
            @endsession
            <h1 class="text-4xl text-brand">Please verify your email!</h1>
            <p>You have been sent a link to <span class="italic">{{Auth::user()->email}}</span></p>
            <form method="POST" action="{{route('verification.send')}}">
                @csrf
                <x-form.input type="submit" value="Resend notification!"/>
            </form>
        </div>
    </div>
</x-app>
