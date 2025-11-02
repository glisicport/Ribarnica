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
                    <button onclick="openLogin()"
                        class="hidden md:flex items-center space-x-2 bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-full transition glass-effect">
                        <i class="fas fa-user"></i>
                        <span>Prijava</span>
                    </button>
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
                <a href="#pocetna" class="block hover:text-blue-200 transition flex items-center space-x-2">
                    <i class="fas fa-home"></i>
                    <span>Početna</span>
                </a>
                <a href="#proizvodi" class="block hover:text-blue-200 transition flex items-center space-x-2">
                    <i class="fas fa-fish"></i>
                    <span>Proizvodi</span>
                </a>
                <a href="#o-nama" class="block hover:text-blue-200 transition flex items-center space-x-2">
                    <i class="fas fa-info-circle"></i>
                    <span>O nama</span>
                </a>
                <a href="#kontakt" class="block hover:text-blue-200 transition flex items-center space-x-2">
                    <i class="fas fa-envelope"></i>
                    <span>Kontakt</span>
                </a>
                <button onclick="openLogin()" class="flex items-center space-x-2 hover:text-blue-200 transition">
                    <i class="fas fa-user"></i>
                    <span>Prijava</span>
                </button>
            </nav>
        </div>
    </header>
