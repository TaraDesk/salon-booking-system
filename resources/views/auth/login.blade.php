<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login | Mirra Salon</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="text-black bg-white relative h-screen overflow-hidden">
    
    <!-- Auth -->
    <div class="bg-gray-100 flex justify-center items-center h-screen">
        <!-- Left: Image -->
        <div class="w-1/2 h-screen hidden lg:block">
            <img src="{{ asset('images/illustration.png') }}" alt="Placeholder Image" class="object-cover w-full h-full">
        </div>
    
        <!-- Right: Auth Form -->
        <div class="lg:p-22 md:p-52 sm:20 p-8 w-full lg:w-1/2" id="login">
            <h1 class="text-2xl font-semibold mb-4">Sign In</h1>
            <p class="text-gray-600 mb-6">Welcome back! Sign in to book your next salon appointment in just a few taps.</p>
        
            <form action="/login" method="POST">
                @csrf
    
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-600">Email</label>
                    <input type="text" id="email" name="email" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" value="{{ old('email') }}" required>
                </div>
    
                <!-- Password Input -->
                <div class="mb-8">
                    <label for="password" class="block text-gray-600">Password</label>
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                </div>
    
                <!-- Login Button -->
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold rounded-md py-2 px-4 w-full">Sign In</button>
            </form>

            <!-- Action Links (Text Only) -->
            <div class="mt-6 flex justify-center gap-8 text-sm font-medium">
                <a href="/register" class="text-teal-600 hover:underline hover:text-teal-800">Sign up here</a>
                <a href="/" class="text-gray-500 hover:underline hover:text-gray-700">Cancel</a>
            </div>
        </div>
    </div>

    @error('email')
    <script>
        Swal.fire({
            icon: "error",
            title: "{{ $message }}",
            text: "Something went wrong!"
        });
    </script>
    @enderror
</body>
</html>