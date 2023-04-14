<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>xaria.osu</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        @livewireStyles
        
        <!-- Scripts -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    
        <!-- Alpine Plugins -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Alpine Core -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
 
        <script type="text/javascript" href="{{ asset('css/app.css') }}"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    </head>
    <body class="antialiased">
    
       
        @livewireScripts
        <div class="container ">
            @livewire('user-profile')
            <div class="row mt-5">
                <div class="col-md-6 rounded">
                    @livewire('user-scores')
                </div>

                <div class="col-md-6 rounded">
                    @livewire('recent-scores')
                </div>
            </div>
        </div>
    </body>
</html>
<style>
    .imgs-overlay{
        position: relative;
    }

    .overlay-pp {
        position: absolute;
        top: 15rem;
        left: 2rem;
        z-index: 3;
    }
    
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 3;
    }
    
    .overlay-content {
        position: absolute;
        opacity: 0.75;
        top: 3rem;
        left: 20rem;
        z-index: 3;
    }

    .overlay-content:hover {
        opacity: 1;
    }

    .basic-info {
        position: absolute;
        top: 16rem;
        left: 9.2rem;
        z-index: 3;
    }

    #bio {
        padding-right: 1.5rem;
        padding-bottom: 0.2rem;
    }

    .profile-nav {
        border-bottom: none;
    }
</style>