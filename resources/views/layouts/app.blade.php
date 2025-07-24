<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | StayBuddy</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/profile.js') }}" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />


    <style>
        html,
        body,
        #map {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .flip-card {
            perspective: 1000px;
            width: 16rem;
            height: 30rem;
            cursor: pointer;
        }

        .flip-card-inner {
            /* position: relative; */
            transform-origin: center center;
            transform-style: preserve-3d;
        }

        .flip-card.flipped .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            top: 0;
            left: 0;
            position: absolute;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            width: 100%;
            height: 100%;
        }

        .flip-card-back {
            transform: rotateY(180deg);
        }

        .perspective {
            perspective: 1000px;
        }

        .transform-style-preserve-3d {
            transform-style: preserve-3d;
        }

        .backface-hidden {
            backface-visibility: hidden;
        }

        .rotate-y-180 {
            transform: rotateY(180deg);
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

</head>

<body class="">
    @yield('content')
</body>

</html>
