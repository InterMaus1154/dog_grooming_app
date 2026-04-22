<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="bg-taupe-50">
@auth
    <div class="flex h-screen" x-data="{open: true}" x-cloak>
        <x-sidebar/>
        <main class="flex-1 overflow-auto">
            {{$slot}}
        </main>
    </div>

@else
    {{ $slot }}
@endif

@livewireScripts
</body>
</html>
