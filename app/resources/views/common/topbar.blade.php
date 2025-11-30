<header id="mainHeader"
    class="bg-gradient-to-r from-blue-700 via-blue-600 to-cyan-600 text-white shadow-2xl sticky top-0 z-50 navbar-scroll">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="bg-white text-blue-600 w-14 h-14 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-fish text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Ribarnica Tfzr</h1>
                    <p class="text-xs text-blue-100 flex items-center">
                        <i class="fas fa-star text-yellow-300 mr-1"></i>
                        Sveže ribe svakog dana
                    </p>
                </div>
            </div>

            <nav class="hidden lg:flex items-center space-x-8">
                <a href="/" class="hover:text-blue-200 transition flex items-center space-x-2">
                    <i class="fas fa-home"></i>
                    <span>Početna</span>
                </a>
                <a href="/proizvodi" class="hover:text-blue-200 transition flex items-center space-x-2">
                    <i class="fas fa-fish"></i>
                    <span>Proizvodi</span>
                </a>
                <a href="/o-nama" class="hover:text-blue-200 transition flex items-center space-x-2">
                    <i class="fas fa-info-circle"></i>
                    <span>O nama</span>
                </a>
                <a href="/kontakt" class="hover:text-blue-200 transition flex items-center space-x-2">
                    <i class="fas fa-envelope"></i>
                    <span>Kontakt</span>
                </a>
                <a href="/Galerija" class="hover:text-blue-200 transition flex items-center space-x-2">
                    <i class="fas fa-image"></i>
                    <span>Galerija</span>
                </a>
            </nav>

            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-4">

                    @if(Auth::check())
                    <div class="relative hidden md:flex group">
                        <button
                            class="flex items-center space-x-2 bg-white/20 hover:bg-white/30 px-4 py-2 rounded-full transition focus:outline-none backdrop-blur-sm shadow-md">
                            <i class="fas fa-user text-white"></i>
                            <span class="text-white font-medium">Korisnik: {{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-2 text-white text-xs"></i>
                        </button>

                        <div
                            class="absolute right-0 mt-12 w-48 bg-gray-900/80 backdrop-blur-md rounded-xl shadow-xl py-2 
                                        opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                                        transition-all duration-300 z-50 transform group-hover:translate-y-0 translate-y-2">

                            <h3
                                class="px-4 pt-2 text-xs font-semibold uppercase text-gray-400 border-b border-gray-700 pb-2 mb-1">
                                Opcije
                            </h3>

                            {{-- DYNAMIC LINK FOR USER/ADMIN --}}
                            <a href="{{ Auth::user()->role === 'admin' ? '/kontrolni-panel' : '/korisnicki-nalog' }}"
                                class="block px-4 py-2 text-white hover:bg-indigo-600/50 hover:text-white rounded-md transition duration-150">
                                <i class="fas fa-cog mr-2"></i> 
                                {{ Auth::user()->role === 'admin' ? 'Kontrolni panel' : 'Korisnički panel' }}
                            </a>
                            {{-- END DYNAMIC LINK --}}

                            <form method="POST" action="{{ route('odjava') }}" class="pt-1 border-t border-gray-700 mt-1">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-red-300 hover:bg-red-600/50 hover:text-white rounded-md transition duration-150">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Odjavi se
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="/prijava"
                        class="hidden md:flex items-center space-x-2 bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-full transition glass-effect">
                        <i class="fas fa-user"></i>
                        <span>Prijava</span>
                    </a>
                    @endif

                </div>

                <button class="relative hover:text-blue-200 transition">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span id="cartCount"
                        class="hidden absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">0</span>
                </button>
                <button onclick="toggleMenu()" class="lg:hidden text-2xl">
                    <i id="menuIcon" class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <nav id="mobileMenu" class="hidden lg:hidden mt-4 pb-4 space-y-3 border-t border-blue-500 pt-4">
            <a href="/" class="block hover:text-blue-200 transition flex items-center space-x-2">
                <i class="fas fa-home"></i>
                <span>Početna</span>
            </a>
            <a href="/proizvodi" class="block hover:text-blue-200 transition flex items-center space-x-2">
                <i class="fas fa-fish"></i>
                <span>Proizvodi</span>
            </a>
            <a href="/o-nama" class="block hover:text-blue-200 transition flex items-center space-x-2">
                <i class="fas fa-info-circle"></i>
                <span>O nama</span>
            </a>
            <a href="/kontakt" class="block hover:text-blue-200 transition flex items-center space-x-2">
                <i class="fas fa-envelope"></i>
                <span>Kontakt</span>
            </a>
            <a href="/Galerija" class="block hover:text-blue-200 transition flex items-center space-x-2">
                <i class="fas fa-image"></i>
                <span>Galerija</span>
            </a>

            <div class="flex flex-col space-y-3 pt-3 border-t border-blue-500">
                @if(Auth::check())
                {{-- DYNAMIC LINK FOR USER/ADMIN IN MOBILE MENU --}}
                <a href="{{ Auth::user()->role === 'admin' ? '/kontrolni-panel' : '/korisnicki-nalog' }}" 
                    class="flex items-center space-x-2 hover:text-blue-200 transition">
                    <i class="fas fa-cog"></i>
                    <span>{{ Auth::user()->role === 'admin' ? 'Kontrolni panel' : 'Korisnički panel' }} ({{ Auth::user()->name }})</span>
                </a>
                {{-- END DYNAMIC LINK --}}

                <form method="POST" action="{{ route('odjava') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left flex items-center space-x-2 text-red-300 hover:text-white transition">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Odjavi se</span>
                    </button>
                </form>
                @else
                <a href="/prijava" class="flex items-center space-x-2 hover:text-blue-200 transition">
                    <i class="fas fa-user"></i>
                    <span>Prijava</span>
                </a>
                @endif
            </div>

        </nav>
    </div>
</header>