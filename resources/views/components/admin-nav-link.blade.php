<?php
// resources/views/components/admin-nav-link.blade.php
$classes = ($active ?? false)
    ? 'bg-gray-900 text-white group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold'
    : 'text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
?>

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $icon ?? '' }}
    {{ $slot }}
</a>