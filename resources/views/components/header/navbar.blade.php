<header
    class="lg:px-16 px-6 bg-black shadow-md max-w-4xl w-full mx-auto shadow-gray-900 flex flex-wrap items-center lg:py-0 py-2">
    <div class="flex-1 py-3 flex justify-between items-center">
        <a href="/" aria-label="home">
            <i class="text-4xl fas fa-user-secret text-yellow-500"></i>
        </a>
    </div>

    <label for="menu-toggle" class="cursor-pointer lg:hidden block">
        <i class="fas fa-bars text-xl dark:text-white "></i>
    </label>
    <input class="hidden" type="checkbox" id="menu-toggle" />

    <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
        <nav>
            <ul class="lg:flex items-center justify-between text-base lg:gap-2 text-white pt-4 lg:pt-0">
                <li><a class="lg:p-4 py-3 px-0 block hover:border-b lg:w-full w-12  hover:border-teal-500  transition-all duration-300 {{ Request::is('/') ? 'border-teal-500 border-b' : 'border-transparent' }}"
                        href="/">Home</a></li>
                @auth

                    <li><a class="lg:p-4 py-3 px-0 block hover:border-b lg:w-full w-12  hover:border-teal-500  transition-all duration-300 {{ Request::is('dashboard') ? 'border-teal-500 border-b' : 'border-transparent' }}"
                            href="{{ route('dashboard') }}">Dashboard</a></li>
                @endauth
                <li><a class="lg:p-4 py-3 px-0 block hover:border-b lg:w-full w-12  hover:border-teal-500  transition-all duration-300 {{ Request::is('chats') ? 'border-teal-500 border-b' : 'border-transparent' }}"
                        href="{{ route('chats.index') }}">Discuss</a></li>
                <li><a class="lg:p-4 py-3 px-0 block hover:border-b lg:w-full w-12  hover:border-teal-500  transition-all duration-300 {{ Request::is('about') ? 'border-teal-500 border-b' : 'border-transparent' }}"
                        href="/about">About</a></li>
                @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}"
                            class="lg:p-4 py-3 px-0 block hover:border-b lg:w-full w-12  hover:border-teal-500  transition-all duration-300 lg:mb-0 mb-2 {{ Request::is('logout') ? 'border-teal-500 border-b' : 'border-transparent' }}">
                            @csrf
                            <button type="submit">

                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li><a class="lg:p-4 py-3 px-0 block hover:border-b lg:w-full w-12  hover:border-teal-500  transition-all duration-300 lg:mb-0 mb-2"
                            href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </nav>


    </div>

</header>
