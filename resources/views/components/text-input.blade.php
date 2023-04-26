@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-600 dark:text-gray-300 focus:border-green-500 rounded-md shadow-sm']) !!}>
