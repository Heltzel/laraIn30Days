@props(['active' => false])

<a class="{{ $active ? 'bg-gray-400 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 font-bold"
    {{ $attributes }}>{{ $slot }}</a>
