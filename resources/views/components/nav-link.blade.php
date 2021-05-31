@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'nav-link active font-weight-bolder'
                : 'nav-link';
@endphp

<li class="nav-item mr-2 " style="font-size: 32px; font-family: 'Just Another Hand', cursive;">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
