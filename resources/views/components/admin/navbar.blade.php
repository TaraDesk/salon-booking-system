<!-- Header -->
<header id="header" class="bg-white fixed w-full z-10 top-0 shadow">
    <nav class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

        <div class="w-1/2 pl-2 md:pl-0">
            <a href="/admin/dashboard" class="flex items-center cursor-pointer">
                <div class="rounded bg-rose-600 text-white font-bold w-10 h-10 flex justify-center items-center">
                    <i data-lucide="scissors" class="text-2xl"></i>
                </div>
                <h1 class="text-gray-800 font-bold ml-2 hover:text-rose-600 tracking-[.3em]">MIRRA</h1>
            </a>
        </div>

        <div class="w-1/2 pr-0">
            <div class="flex justify-end relative">
                <div class="relative text-sm">
                    <button id="userButton" class="flex items-center focus:outline-none mr-3">
                        <img class="w-8 h-8 rounded-full md:mr-4" src="http://i.pravatar.cc/300" alt="Avatar of User">
                        <span class="hidden md:inline-block">Hi, {{ auth()->user()->name }} </span>
                        <i data-lucide="chevron-down" class="w-4 h-4 ml-2"></i>
                    </button>
                    <div id="userMenu" class="bg-white rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                        <ul class="list-reset">
                            <li><a href="/admin/profile" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">My account</a></li>
                            <li>
                                <form action="/admin/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="text-start px-4 py-2 w-full block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="block lg:hidden pr-4">
                    <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-teal-500 appearance-none focus:outline-none">
                        <i data-lucide="menu" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 bg-white z-20" id="nav-content">
            <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                <li class="mr-6 my-2 md:my-0">
                    <a href="/admin/dashboard" class="flex items-center py-1 md:py-3 pl-1 no-underline hover:text-gray-900 border-b-2 {{ request()->is('admin/dashboard') ? 'border-rose-600 text-pink-600' : 'border-white text-gray-500' }} hover:border-teal-600">
                        <i data-lucide="home" class="w-4 h-4 mr-2 align-middle"></i><span class="text-sm">Home</span>
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="/admin/users" class="flex items-center py-1 md:py-3 pl-1 no-underline hover:text-gray-900 border-b-2 {{ request()->is('admin/users') ? 'border-rose-600 text-pink-600' : 'border-white text-gray-500' }} hover:border-pink-500">
                        <i data-lucide="user" class="w-4 h-4 mr-2 align-middle"></i><span class="text-sm">Users</span>
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="/admin/services" class="flex items-center py-1 md:py-3 pl-1 no-underline hover:text-gray-900 border-b-2 {{ request()->is('admin/services') ? 'border-rose-600 text-pink-600' : 'border-white text-gray-500' }} hover:border-purple-500">
                        <i data-lucide="briefcase" class="w-4 h-4 mr-2 align-middle"></i><span class="text-sm">Services</span>
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="/admin/bookings" class="flex items-center py-1 md:py-3 pl-1 no-underline hover:text-gray-900 border-b-2 {{ request()->is('admin/bookings') ? 'border-rose-600 text-pink-600' : 'border-white text-gray-500' }} hover:border-green-500">
                        <i data-lucide="book" class="w-4 h-4 mr-2 align-middle"></i><span class="text-sm">Bookings</span>
                    </a>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <a href="/admin/transactions" class="flex items-center py-1 md:py-3 pl-1 no-underline hover:text-gray-900 border-b-2 {{ request()->is('admin/transactions') ? 'border-rose-600 text-pink-600' : 'border-white text-gray-500' }} hover:border-red-500">
                        <i data-lucide="credit-card" class="w-4 h-4 mr-2 align-middle"></i><span class="text-sm">Transactions</span>
                    </a>
                </li>                
            </ul>
        </div>      
        
    </nav>
</header>