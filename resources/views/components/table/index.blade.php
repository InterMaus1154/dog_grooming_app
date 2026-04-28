@props(['headers' => []])

<div class="relative overflow-x-auto bg-white shadow-lg rounded-md border border-brand-dark">
    <table class="w-full text-sm text-left">
        <thead class="bg-neutral-50 border-b border-brand-light">
        <tr>
            {{ $headers }}
        </tr>
        </thead>
        <tbody>
        {{ $slot }}
        </tbody>
    </table>
    @if(isset($pagination))
        {{$pagination}}
    @endif
</div>
