<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="bg-slate-100">
@auth
    <div class="flex h-svh relative overflow-hidden" x-data="{open: window.innerWidth >= 640}" x-cloak>
        <x-sidebar/>
        <x-heroicon-s-arrow-right-end-on-rectangle class="w-12 h-12 absolute bottom-0 left-0 cursor-pointer transition-all duration-500" x-bind:class="open ? 'rotate-y-180' : ''" @click="open = !open"/>
        <main class="flex-1 overflow-auto p-4">
            <header>
                <h1 class="text-4xl text-center font-bold">{{$headerTitle ?? ''}}</h1>
            </header>
            {{$slot}}
        </main>
    </div>

@else
    {{ $slot }}
@endif
<wireui:scripts />
@livewireScripts
</body>
</html>
