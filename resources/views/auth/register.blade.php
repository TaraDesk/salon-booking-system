<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Register | Mirra Salon</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-black bg-gray-100 relative h-screen">
  
  <!-- Auth -->
  <div class="flex h-screen overflow-hidden">
    <div class="w-1/2 hidden lg:block">
      <img src="{{ asset('images/illustration.png') }}" alt="Placeholder Image" class="object-cover w-full h-screen">
    </div>
  
    <div class="w-full lg:w-1/2 overflow-y-auto p-8 sm:p-20 md:p-52 lg:p-22">
      <h1 class="text-2xl font-semibold mb-4">Sign Up</h1>
      <p class="text-gray-600 mb-6">Create your account and book your first salon appointment in minutes! It's quick and easy.</p>

      <form action="/register" method="POST">
        @csrf

        <!-- Username Input -->
        <div class="mb-4">
          <label for="name" class="block text-gray-600">Name</label>
          <input type="text" value="{{ old('name') }}" id="name" name="name" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">

          @error('name')
            <p class="block text-red-400"> {{ $message }}</p>
          @enderror
        </div>

        <!-- Phone & Email Input -->
        <div class="flex space-x-3">
          <div class="mb-4">
            <label for="email" class="block text-gray-600">Email</label>
            <input type="text" value="{{ old('email') }}" id="email" name="email" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
            
            @error('email')
              <p class="block text-red-400"> {{ $message }}</p>
            @enderror
          </div>
          <div class="mb-4">
            <label for="phone" class="block text-gray-600">Phone</label>
            <input type="text" value="{{ old('phone') }}" id="phone" name="phone" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" maxlength="13">

            @error('phone')
              <p class="block text-red-400"> {{ $message }}</p>
            @enderror
          </div>
        </div>
          
        <!-- Password Input -->
        <div class="mb-4">
          <label for="password" class="block text-gray-600">Password</label>
          <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">

          @error('password')
            <p class="block text-red-400"> {{ $message }}</p>
          @enderror
        </div>

        <!-- Confirmation Password Input -->
        <div class="mb-8">
          <label for="password_conf" class="block text-gray-600">Confirm Password</label>
          <input type="password" id="password_conf" name="password_confirmation" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">

          @error('password_confirmation')
            <p class="block text-red-400"> {{ $message }}</p>
          @enderror
        </div>

        <!-- Login Button -->
        <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold rounded-md py-2 px-4 w-full">Sign Up</button>
      </form>

      <div class="mt-6 flex justify-center gap-8 text-sm font-medium">
        <a href="/login" class="text-teal-600 hover:underline hover:text-teal-800">Sign In here</a>
        <a href="/" class="text-gray-500 hover:underline hover:text-gray-700">Cancel</a>
      </div>

    </div>
  </div>

</body>
</html>