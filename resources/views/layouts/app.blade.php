<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        @toastScripts
    </head>
    <body class="font-sans antialiased">
        <livewire:toasts />

        <div class="min-h-screen bg-gray-800">
            <nav class="rounded-b-3xl bg-white sticky top-0 h-20">
                <div class="mx-auto max-w-7xl px-2 sm:px-3 lg:px-4 relative z-50 flex justify-between py-2 align-middle items-center">
    
                    <div class="relative z-10 flex items-center">
                        <a href="{{ route('index')}}" class="flex items-center gap-1">
                            <svg width="60" height="60" viewBox="0 0 256 256"><path fill="currentColor" d="M216 100h-84.9l51-13.7l31-8.3a11.8 11.8 0 0 0 7.3-5.6a12 12 0 0 0 1.2-9.1l-8.3-30.9a20 20 0 0 0-24.5-14.1L34.3 59.7a20.1 20.1 0 0 0-14.2 24.5l7.9 29.4V200a20.1 20.1 0 0 0 20 20h160a20.1 20.1 0 0 0 20-20v-88a12 12 0 0 0-12-12Zm-87.6-40.7L148 70.6l-36.8 9.9l-19.6-11.3Zm62.8-16.8l4.1 15.5l-14.5 3.9l-19.6-11.4ZM58.9 78l19.6 11.3l-30 8l-4.2-15.5ZM204 196H52v-72h152Z"/></svg>
                            <p class='text-gray-700 font-bold text-3xl'>Film</p>
                        </a>
                    </div>
                    <a href="{{ route('index') }}" class="flex items-center py-3 px-4 text-king text-lg font-bold whitespace-nowrap" @click="open = false">
                        <svg width="32" height="32" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z" />
                        </svg>
                        Liste des films
                    </a>
                    <a href="{{ route('store') }}" class="flex items-center py-3 px-4 text-king text-lg font-bold whitespace-nowrap" @click="open = false">
                        <svg width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M11 17h2v-4h4v-2h-4V7h-2v4H7v2h4Zm1 5q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Zm0-2q3.35 0 5.675-2.325Q20 15.35 20 12q0-3.35-2.325-5.675Q15.35 4 12 4Q8.65 4 6.325 6.325Q4 8.65 4 12q0 3.35 2.325 5.675Q8.65 20 12 20Zm0-8Z"/></svg>
                        Ajouter un film
                    </a>
                    <div x-data="{ open: false }" @keydown.escape.stop="open = false" @click.away="open = false" class="relative z-50 inline-block text-left">
                        <div>
                            <button @click="open = !open" type="button" aria-label="menu" class="relative group flex p-1 items-center rounded-full text-king hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-honey focus:ring-offset-2 focus:ring-offset-honey">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>
                        </div>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-50 mt-2 origin-top-right rounded-3xl bg-white shadow-lg focus:outline-none">
                            <div class="py-1 z-50" role="none">
                                <a href="{{ route('profile.show') }}" class="flex items-center py-3 px-4 text-king text-lg font-bold whitespace-nowrap" @click="open = false">
                                    <svg width="32" height="32" class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5.85 17.1q1.275-.975 2.85-1.538Q10.275 15 12 15q1.725 0 3.3.562q1.575.563 2.85 1.538q.875-1.025 1.363-2.325Q20 13.475 20 12q0-3.325-2.337-5.663Q15.325 4 12 4T6.338 6.337Q4 8.675 4 12q0 1.475.488 2.775q.487 1.3 1.362 2.325ZM12 13q-1.475 0-2.488-1.012Q8.5 10.975 8.5 9.5t1.012-2.488Q10.525 6 12 6t2.488 1.012Q15.5 8.025 15.5 9.5t-1.012 2.488Q13.475 13 12 13Zm0 9q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z" />
                                    </svg>
                                    Compte
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="flex items-center py-3 px-4 text-king text-lg font-bold whitespace-nowrap">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center text-red-600">
                                        <svg width="32" height="32" class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2a9.985 9.985 0 0 1 8 4h-2.71a8 8 0 1 0 .001 12h2.71A9.985 9.985 0 0 1 12 22zm7-6v-3h-8v-2h8V8l5 4l-5 4z" />
                                        </svg>
                                        Me déconnecter
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
