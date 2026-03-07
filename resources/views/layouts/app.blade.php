<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        content="width=device-width, initial-scale=1.0"
        name="viewport"
    >

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <tallstackui:script />

    @livewireStyles
</head>

<body>
    <x-layout>
        <x-slot:header>
            <x-layout.header>
                <x-slot:right>
                    <x-dropdown text="Hello, {{ auth()->user()->name }}!">
                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                        >
                            @csrf
                            <x-dropdown.items
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                text="Logout"
                            />
                        </form>
                    </x-dropdown>
                </x-slot:right>
            </x-layout.header>
        </x-slot:header>

        <x-slot:menu>
           @include('components.sidebar')
        </x-slot:menu>

        {{ $slot }}
    </x-layout>

    @livewireScripts
</body>

</html>
