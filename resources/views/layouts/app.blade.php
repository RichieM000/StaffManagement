<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Staff Mangement Solutions For Brgy.8</title>

        

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
      {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> --}}
     
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mukta+Vaani:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/app.css">
      
        <!-- Include FullCalendar CSS -->

        {{-- <link rel="stylesheet" href="js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css ">
        <link rel="stylesheet" href="{{ asset('css/font-icons/entypo/css/entypo.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/neon-core.css') }}">
        <link rel="stylesheet" href="{{ asset('css/neon-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('css/neon-forms.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
        <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script> --}}

        
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="js/app.js"></script>
        <link rel="stylesheet" href="resources/css/app.css">
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
    <style>
      body, html {
          margin: 0;
          padding: 0;
          height: 100%;
          width: 100%;
      }
  </style>
    <body class="font-ecom antialiased m-0 p-0 h-full w-full">
      
        <div class="min-h-screen w-screen bg-gray-200 dark:bg-gray-900 overflow-hidden">
         
            @include('layouts.navigation')
            
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                
            @endif
            <div class="w-full"></div>
            <!-- Page Content -->
            <main class="w-full">
                {{ $slot }}
                
            </main>
        </div>
        <script src="js/app.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <!-- Include FullCalendar JavaScript -->
        <script src="
        https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js
        "></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    </body>
</html>