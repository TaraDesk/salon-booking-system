<!-- Header-->
<header class="sticky top-0 relative z-12" id="nav-header">
    <nav class="relative max-w-screen-xl mx-auto flex items-center justify-between h-18">
        <a href="/" class="flex items-center cursor-pointer px-2 ml-3">
            <div class="rounded bg-rose-600 text-white font-bold w-10 h-10 flex justify-center items-center">
                <i data-lucide="scissors" class="text-2xl"></i>
            </div>
            <h1 class="text-gray-800 font-bold ml-2 hover:text-rose-600 tracking-[.3em]">MIRRA</h1>
        </a>

        <button class="p-2 mr-3 cursor-pointer md:hidden" data-event="mobileMenu" id="mobile-button">
            <i data-lucide="align-justify" class="hamburger-icon"></i>
            <i data-lucide="x" class="x-icon hidden"></i>
        </button>

        <!-- Nav Links-->
        <ul class="nav-links p-2 gap-8 items-center hidden md:flex">
            <li class="px-3 text-sm text-gray-700 hover:text-rose-600 transition duration-300 delay-75"><a href="/">Home</a></li>
            <li class="px-3 text-sm text-gray-700 hover:text-rose-600 transition duration-300 delay-75"><a href="/services">Services</a></li>
            <li class="px-3 text-sm text-gray-700 hover:text-rose-600 transition duration-300 delay-75"><a href="/#features">Features</a></li>
            <li class="px-3 text-sm text-gray-700 hover:text-rose-600 transition duration-300 delay-75"><a href="/#teams">Teams</a></li>
            <li class="px-3 text-sm text-gray-700 hover:text-rose-600 transition duration-300 delay-75"><a href="/#contact">Contact</a></li>
        </ul>

        <!-- CTA Button -->
        @auth
        <div class="items-center space-x-4 hidden md:flex">
            <a href="/profile" class="cursor-pointer hover:text-rose-600 transition duration-300">
                <i data-lucide="user" class="w-4 h-4"></i>
            </a>
            <div class="w-[2px] rounded-xl bg-gray-100/50 h-8"></div>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-2 rounded-xl cursor-pointer border border-rose-500 text-rose-500 mr-5 px-4 py-2 bg-transparent hidden md:flex hover:bg-rose-50 hover:text-rose-600 hover:border-rose-600 hover:shadow transition duration-300">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
                
            </form>
        </div>
        @endauth

        @guest
            <a href="/login" class="rounded-xl cursor-pointer bg-rose-500 mr-5 px-8 py-2 text-white hidden md:block hover:bg-rose-600 hover:shadow-md transition duration-300">
                Sign In
            </a>
        @endguest

        <!-- Mobile Links-->
        <ul class="mobile-links z-40 absolute top-full left-0 w-full bg-white border-gray-200 rounded-b-xl shadow-md p-2 pb-4 hidden md:hidden">
            <li class="px-4 py-3 cursor-pointer hover:bg-gray-50 transition duration-300 hover:text-rose-600 border-t border-gray-100">
                <a href="/">Home</a>
            </li>
            <li class="px-4 py-3 cursor-pointer hover:bg-gray-50 transition duration-300 hover:text-rose-600 border-t border-gray-100">
                <a href="/services">Services</a>
            </li>
            <li class="px-4 py-3 cursor-pointer hover:bg-gray-50 transition duration-300 hover:text-rose-600 border-t border-gray-100">
                <a href="/#features">Features</a>
            </li>
            <li class="px-4 py-3 cursor-pointer hover:bg-gray-50 transition duration-300 hover:text-rose-600 border-t border-gray-100">
                <a href="/#teams">Teams</a>
            </li>
            <li class="px-4 py-3 cursor-pointer hover:bg-gray-50 transition duration-300 hover:text-rose-600 border-t border-gray-100">
                <a href="/#contact">Contact</a>
            </li>

            @guest
            <li class="px-4 py-3 cursor-pointer hover:bg-gray-50 transition duration-300 hover:text-rose-600 border-t border-gray-100">
                <a href="/login">Sign In</a>
            </li>
            @endguest
            
            @auth
            <li class="px-4 py-3 cursor-pointer hover:bg-gray-50 transition duration-300 hover:text-rose-600 border-t border-gray-100">
                <a href="/profile">Profile</a>
            </li>
            <li class="px-4 py-3 cursor-pointer hover:bg-gray-50 transition duration-300 hover:text-rose-600 border-t border-gray-100">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
            @endauth
        </ul>
    </nav>
</header>