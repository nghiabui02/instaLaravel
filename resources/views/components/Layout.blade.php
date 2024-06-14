<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Instagram</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<div class="h-full flex">
{{--        @if (Route('login_form'))--}}
{{--            <div class="top-right links">--}}
{{--                @auth--}}
{{--                    <a href="{{ url('/home') }}">Home</a>--}}
{{--                @else--}}
{{--                    <a href="{{ route('login_form') }}">Login</a>--}}

{{--                    @if (Route::has('register_form'))--}}
{{--                        <a href="{{ route('register_form') }}">Register</a>--}}
{{--                    @endif--}}
{{--                @endauth--}}
{{--            </div>--}}
{{--        @endif--}}
    @auth()
        <div>
            @include('static.sidebar')
        </div>
    @endauth


    <main class="h-screen w-full">
        {{ $slot }}
    </main>

</div>
</body>
</html>
