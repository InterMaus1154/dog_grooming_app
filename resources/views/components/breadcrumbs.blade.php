@php
    use Illuminate\Support\Facades\Request;

    $segments = collect(Request::segments())->filter(fn($segment) => !is_numeric($segment));
    $sectionIdentifier = Str::kebab($segments->first());
    @endphp
<div>
    <div class="flex gap-2">
        <a href="{{route('dashboard')}}">
            <x-icon name="home" class="text-brand-dark"/>
        </a>
        @if($segments->isNotEmpty())
            <span class="text-brand-dark"> &gt;</span>
        @endif
        @foreach($segments as $segment)
            @if($loop->first)
                <a class="text-brand-dark hover:underline" href="{{route(sprintf('%s.index', $sectionIdentifier))}}">{{ucfirst($sectionIdentifier)}}</a>
            @else
                <span class="text-brand-dark"> &gt; {{\Illuminate\Support\Str::headline($segment)}} </span>
            @endif
        @endforeach
    </div>

</div>
