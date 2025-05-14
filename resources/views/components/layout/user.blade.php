<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="text-black bg-white relative">
        
    {{ $slot }}

    {{-- Footer --}}
    <footer class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a href="/" class="flex items-center cursor-pointer">
                <div class="rounded bg-rose-600 text-white font-bold w-10 h-10 flex justify-center items-center">
                    <i data-lucide="scissors" class="text-2xl"></i>
                </div>
            </a>
            <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2025 Mirra Salon —
                <a href="/" class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">Tara Desk</a>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                <a class="text-gray-500" href="#">
                    <i data-lucide="instagram" class="w-5 h-5"></i>
                </a>
                <a class="ml-3 text-gray-500" href="#">
                    <i data-lucide="facebook" class="w-5 h-5"></i>
                </a>
                <a class="ml-3 text-gray-500" href="#">
                    <i data-lucide="youtube" class="w-5 h-5"></i>
                </a>
                <a class="ml-3 text-gray-500" href="https://github.com/TaraDesk">
                    <i data-lucide="github" class="w-5 h-5"></i>
                </a>
            </span>
        </div>
    </footer>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        const hamburgerIcon = document.querySelector(".hamburger-icon");
        const closeIcon = document.querySelector(".x-icon");
        const mobileMenus = document.querySelector(".mobile-links");
        const mobileLinks = document.querySelectorAll('[data-event="mobileMenu"]');

        const nav = document.getElementById('nav-header');
        const overlay = document.getElementById('overlay');

        mobileLinks.forEach(btn => {
            btn.addEventListener('click', mobileMenu);
        });

        function mobileMenu() {
            if(hamburgerIcon.classList.contains('hidden')) {
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                mobileMenus.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                nav.classList.remove('bg-white');
            } else {
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                mobileMenus.classList.remove('hidden');
                nav.classList.add('bg-white');
                document.body.classList.add('overflow-hidden');
            }
        }

        window.addEventListener('scroll', function () {
            const overlayBottom = overlay.offsetHeight;

            if (window.scrollY > overlayBottom) {
                nav.classList.add('bg-white/10');
                nav.classList.add('backdrop-blur-md');
                nav.classList.add('border-b');
                nav.classList.add('border-white/20');
            } else {
                nav.classList.remove('bg-white/10');
                nav.classList.remove('backdrop-blur-md');
                nav.classList.remove('border-b');
                nav.classList.remove('border-white/20');
            }
        });
    </script>
</body>
</html>