@props(['title' => null])

<x-app-layout :title="$title" mode="admin">
    {{ $slot }}
</x-app-layout>
