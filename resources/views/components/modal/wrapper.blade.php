@props([
    'size' => 'full',
    'title' => '',
    'subtitle' => '',
    'content' => null,
    'footer' => null
])

@php
    $sizes = [
    '3xs' => 'max-w-3xs',
    '2xs' => 'max-w-2xs',
    'xs'  => 'max-w-xs',
    'sm'  => 'max-w-sm',
    'md'  => 'max-w-md',
    'lg'  => 'max-w-lg',
    'xl'  => 'max-w-xl',
    '2xl' => 'max-w-2xl',
    '3xl' => 'max-w-3xl',
    '4xl' => 'max-w-4xl',
    '5xl' => 'max-w-5xl',
    '6xl' => 'max-w-6xl',
    '7xl' => 'max-w-7xl',
    'full' => 'max-w-full',
];

    $sectionPadding = 'p-4';

@endphp

{{--modal skeleton--}}
<div
    class="w-full {{$sizes[$size]}} bg-neutral-100 rounded-md divide-y divide-brand-dark mx-auto shadow-xl border border-brand-dark">

    <header class="relative {{$sectionPadding}}">
        <h1 class="text-2xl text-center font-bold text-brand-dark">{{$title}}</h1>
        @if(!empty($subtitle))
            <h2 class="text-lg text-center text-brand-dark">{{$subtitle}}</h2>
        @endif
        <x-mini-button class="absolute right-2 top-2" rounded rose xl icon="x-mark" @click="$dispatch('modal-close')"/>
    </header>

    @if(isset($content))
        <div class="{{$sectionPadding}}">
            {{$content}}
        </div>
    @endif

    @if(isset($footer))
        <footer class="{{$sectionPadding}}">
            {{$footer}}
        </footer>
    @endif
</div>
