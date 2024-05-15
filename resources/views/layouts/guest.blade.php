<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Staff Mangement Solutions For Brgy.8</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta+Vaani:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="js/app.js"></script>
        <script>
            tailwind.config = {
              theme: {
                extend: {
                  colors: {
                    bg: '#f4f8ff',
                   
                    button: '#1291ee',
                    hover: '#0c68ab'
                  },
                  backgroundImage:{
                    watermark: "url('/img/logo.png')"
                  },
                 
                  fontFamily:{
                    ecom: ['Mukta Vaani'],
                  },
                  gridTemplateColumns:{
                    footer: '400px repeat(3, 1fr)'
                  }
                 
    
                }
              }
            }
          </script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-ecom text-gray-900 antialiased">
       
        @if (Route::has('login'))
        
        <nav class="fixed w-full mt-4 mr-4">
           
            @auth

                <a
                    href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 font-medium text-lg text-black ring-1 ring-transparent transition hover:text-hover focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Dashboard
                </a>
            @else
            {{-- <div class="block absolute left-0 ml-14 bottom-1">
                <a class="font-medium text-lg ml-2" href="{{ route('admin-login') }}"><i class="ri-admin-line text-button text-2xl"></i> Admin Login</a>
            </div> --}}
                {{-- <a
                    href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 font-medium text-lg text-black ring-1 ring-transparent transition hover:text-hover focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </a> --}}

                @if (Route::has('register'))
                    {{-- <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 mr-14 py-2 font-medium text-lg text-black ring-1 ring-transparent transition hover:text-hover focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Register
                    </a> --}}
                @endif
            @endauth
        </nav>
    
    @endif
    
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-bg dark:bg-gray-900">
        <div class="max-w-44">
            <img src="/img/logo.png" alt="">
        </div>
        <div class="mt-5">
            <a href="/">
                <x-application-logo/>
            </a>
        </div>
    
        <!-- Watermark covering the entire background -->
       
        <div class="absolute inset-12 bg-contain bg-watermark bg-center bg-no-repeat opacity-10 z-0"></div>
    
        <!-- Main content container with form -->
        <div class="w-full sm:max-w-lg mt-6 mb-28 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg z-10">
            {{ $slot }}
        </div>
    </div>
    
        {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
        
    </body>
</html>
