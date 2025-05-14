<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login Admin | Mirra Salon</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="text-black bg-white relative h-screen overflow-hidden font-sans">
  
    <!-- Auth -->
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center bg-gray-100 ">
        <div class="relative sm:max-w-sm w-full">
            <div class="card bg-blue-400 shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
            <div class="card bg-red-400 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
            <div class="relative w-full rounded-3xl p-6 bg-gray-100 shadow-lg">
                <label for="" class="block mt-3 text-xl text-gray-700 text-center font-semibold">
                    Mirra Salon Dashboard
                </label>
                <form method="POST" action="/admin" class="mt-10">
                    @csrf

                    <div class="my-6">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input name="email" value="{{ old('email') }}" type="email" placeholder="Enter your email" class="mt-2 block w-full border-none bg-gray-100 p-4 rounded-md shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0" required>
                    </div>
                    
                    <div class="my-6">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input name="password" type="password" placeholder="Enter your password" class="mt-2 block w-full border-none bg-gray-100 p-4 rounded-md shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0" required>
                    </div>
                        
                    <button type="submit" class="mt-4 bg-teal-500 hover:bg-teal-600 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                        Login
                    </button>

                    <!-- Go Back Link -->
                    <div class="mt-4 text-teal-500 text-center">
                        <a href="/" class="hover:underline">Cancel</a>
                    </div>
                </form>
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
        
    <script src="https://unpkg.com/lucide@latest"></script>
    <script> 
        lucide.createIcons(); 
    </script>
</body>
</html>