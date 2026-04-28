@props(['heading' => false])

@if($heading)
    <th class="px-6 py-4 font-medium whitespace-nowrap text-brand-dark">{{ $slot }}</th>
@else
    <td class="px-6 py-4">{{ $slot }}</td>
@endif
