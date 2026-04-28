<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="bg-neutral-50">
@auth
    <div class="flex h-svh relative overflow-hidden" x-data="{open: window.innerWidth >= 1280}" x-cloak>
        <x-sidebar/>
        <x-heroicon-s-arrow-right-end-on-rectangle
            class="w-12 h-12 absolute z-[200] bottom-0 left-0 cursor-pointer transition-all duration-500"
            x-bind:class="open ? 'rotate-y-180' : ''" @click="open = !open"/>
        <main class="flex-1 space-y-4 overflow-auto">
            <header class="grid grid-cols-3 top-0 z-10 bg-neutral-50 p-4 shadow-md">
                <x-breadcrumbs/>
                <h1 class="text-4xl text-center font-bold text-brand-dark">{{$headerTitle ?? ''}}</h1>
                <div class="justify-self-end">
                    {{$headerRight ?? ''}}
                </div>
            </header>
            <div class="p-4">
                {{$slot}}
            </div>
        </main>
    </div>
@else
    {{ $slot }}
@endif
<x-notifications />
<livewire:modal.modal-container/>
<wireui:scripts/>
@livewireScripts
</body>
</html>
