<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Neon Admin Panel" />
        <meta name="author" content="" />
    
        <link rel="icon" href="assets/images/favicon.ico">
    
        <title>Neon | Dashboard</title>
    
        <link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/neon-core.css">
        <link rel="stylesheet" href="assets/css/neon-theme.css">
        <link rel="stylesheet" href="assets/css/neon-forms.css">
        <link rel="stylesheet" href="assets/css/custom.css">
    
        <script src="js/jquery-1.11.3.min.js"></script>
    
        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        
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
    <body class="font-ecom antialiased">
      
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')
            
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                
            @endif

            <!-- Page Content -->
            <main class="">
                {{ $slot }}
                
            </main>
        </div>
        <script src="js/app.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <!-- Include FullCalendar JavaScript -->
        <script src="
        https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js
        "></script>
       
    </body>
</html>