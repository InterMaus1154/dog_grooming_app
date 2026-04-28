<tr
    {{$attributes->merge([
    'class' => "odd:bg-white even:bg-neutral-100 border-b border-rose-200 last:border-0"
])}}>
    {{ $slot }}
</tr>
