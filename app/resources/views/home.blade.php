<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ribarnica Tfzr - Sveže ribe</title>
    @include('common.scripts')
    <style>
        .product-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(229, 231, 235, 0.5);
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
            border-color: rgba(37, 99, 235, 0.3);
        }

        .hero-overlay {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.95) 0%, rgba(6, 182, 212, 0.9) 100%);
        }

        .hero-bg {
            background-image: url('https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920&h=600&fit=crop');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto;
            transition: all 0.3s;
        }

        .product-card:hover .icon-circle {
            transform: scale(1.1) rotate(5deg);
        }

        .category-btn {
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .category-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .category-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .navbar-scroll {
            transition: all 0.3s;
        }

        .feature-card {
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        .badge-new {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.3);
        }

        .price-tag {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: bold;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }
    </style>
</head>

<body class="bg-gray-50">
    @include('common.topbar')
    
    <section id="pocetna" class="hero-bg relative">
        <div class="hero-overlay py-24 md:py-32">
            <div class="container mx-auto px-4 text-center text-white">
                <div class="float-animation mb-6">
                    <i class="fas fa-fish text-6xl md:text-7xl text-white opacity-90"></i>
                </div>
                <h2 class="text-4xl md:text-6xl font-bold mb-4 tracking-tight">Sveže ribe direktno iz mora</h2>
                <p class="text-xl md:text-2xl mb-8 text-blue-50 max-w-2xl mx-auto">
                    Vrhunski kvalitet, tradicija i poverenje - više od 15 godina sa vama
                </p>

                <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-2xl p-3 flex flex-col md:flex-row gap-3">
                    <div class="flex-1 relative">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="searchInput" placeholder="Pretražite naše proizvode..."
                            class="w-full pl-12 pr-4 py-4 text-gray-700 outline-none rounded-xl"
                            onkeyup="filterProducts()">
                    </div>
                    <button
                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-4 rounded-xl transition flex items-center justify-center space-x-2 font-semibold shadow-lg">
                        <i class="fas fa-search"></i>
                        <span>Pretraži</span>
                    </button>
                </div>

                <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                    <div class="glass-effect rounded-xl p-4">
                        <i class="fas fa-check-circle text-3xl mb-2"></i>
                        <p class="font-semibold">100% Sveže</p>
                    </div>
                    <div class="glass-effect rounded-xl p-4">
                        <i class="fas fa-truck text-3xl mb-2"></i>
                        <p class="font-semibold">Brza dostava</p>
                    </div>
                    <div class="glass-effect rounded-xl p-4">
                        <i class="fas fa-award text-3xl mb-2"></i>
                        <p class="font-semibold">Premium kvalitet</p>
                    </div>
                    <div class="glass-effect rounded-xl p-4">
                        <i class="fas fa-shield-alt text-3xl mb-2"></i>
                        <p class="font-semibold">Garancija svežine</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="inline-block bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-star mr-2"></i>BESTSELLER
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Preporučeni proizvodi</h2>
                <p class="text-gray-600 text-lg">Najbolji izbor iz naše bogate ponude</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
                    <span class="badge-new">
                        <i class="fas fa-fire mr-1"></i>NOVO
                    </span>
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-12 text-center">
                        <div
                            class="icon-circle bg-gradient-to-br from-blue-500 to-cyan-500 text-white rounded-full shadow-lg">
                            <i class="fas fa-fish"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-bold text-gray-800">Svež losos</h3>
                            <span class="flex items-center text-yellow-500 text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i>4.8
                            </span>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            Norveški losos premium kvaliteta
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="price-tag">1,890 din/kg</span>
                            <button onclick="addToCart()"
                                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2 rounded-xl transition shadow-md flex items-center space-x-2">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Dodaj</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-12 text-center">
                        <div
                            class="icon-circle bg-gradient-to-br from-green-500 to-emerald-500 text-white rounded-full shadow-lg">
                            <i class="fas fa-fish"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-bold text-gray-800">Sveža pastrmka</h3>
                            <span class="flex items-center text-yellow-500 text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i>4.6
                            </span>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            Lokalna slatkovodna pastrmka
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="price-tag">990 din/kg</span>
                            <button onclick="addToCart()"
                                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2 rounded-xl transition shadow-md flex items-center space-x-2">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Dodaj</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
                    <span class="badge-new">
                        <i class="fas fa-fire mr-1"></i>AKCIJA
                    </span>
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-12 text-center">
                        <div
                            class="icon-circle bg-gradient-to-br from-purple-500 to-pink-500 text-white rounded-full shadow-lg">
                            <i class="fas fa-fish"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-bold text-gray-800">Brancin</h3>
                            <span class="flex items-center text-yellow-500 text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i>4.7
                            </span>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            Mediteranski brancin svež
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="price-tag">1,450 din/kg</span>
                            <button onclick="addToCart()"
                                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2 rounded-xl transition shadow-md flex items-center space-x-2">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Dodaj</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-12 text-center">
                        <div
                            class="icon-circle bg-gradient-to-br from-orange-500 to-red-500 text-white rounded-full shadow-lg">
                            <i class="fas fa-shrimp"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-bold text-gray-800">Škampi</h3>
                            <span class="flex items-center text-yellow-500 text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i>4.9
                            </span>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            Sveži jadranski škampi
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="price-tag">2,890 din/kg</span>
                            <button onclick="addToCart()"
                                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2 rounded-xl transition shadow-md flex items-center space-x-2">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Dodaj</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- All Products -->
    <section id="proizvodi" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Svi proizvodi</h2>
                <p class="text-gray-600 text-lg">Pronađite savršenu ribu za svaku priliku</p>
            </div>

            <!-- Category Filter -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button onclick="filterCategory('sve', event)"
                    class="category-btn active px-8 py-3 rounded-full bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 transition shadow-lg font-semibold">
                    <i class="fas fa-th mr-2"></i>Sve
                </button>
                <button onclick="filterCategory('slatkovodno', event)"
                    class="category-btn px-8 py-3 rounded-full bg-white text-gray-700 hover:bg-blue-600 hover:text-white transition shadow-md font-semibold">
                    <i class="fas fa-water mr-2"></i>Slatkovodne ribe
                </button>
                <button onclick="filterCategory('morsko', event)"
                    class="category-btn px-8 py-3 rounded-full bg-white text-gray-700 hover:bg-blue-600 hover:text-white transition shadow-md font-semibold">
                    <i class="fas fa-fish mr-2"></i>Morske ribe
                </button>
                <button onclick="filterCategory('skoljke', event)"
                    class="category-btn px-8 py-3 rounded-full bg-white text-gray-700 hover:bg-blue-600 hover:text-white transition shadow-md font-semibold">
                    <i class="fas fa-shrimp mr-2"></i>Školjke i rakovi
                </button>
                <button onclick="filterCategory('dimljeno', event)"
                    class="category-btn px-8 py-3 rounded-full bg-white text-gray-700 hover:bg-blue-600 hover:text-white transition shadow-md font-semibold">
                    <i class="fas fa-fire mr-2"></i>Dimljene ribe
                </button>
            </div>

            <div id="productsGrid" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="feature-card text-center p-8 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl shadow-lg">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl">
                        <i class="fas fa-leaf text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Ekološki uzgoj</h3>
                    <p class="text-gray-600">Sve naše ribe dolaze iz sertifikovanih uzgajališta koja poštuju prirodu i
                        standarde kvaliteta.</p>
                </div>

                <div
                    class="feature-card text-center p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-lg">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl">
                        <i class="fas fa-clock text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Dnevna dostava</h3>
                    <p class="text-gray-600">Svakodnevno nabavljamo najsvežije ribe kako bismo vam garantovali vrhunski
                        kvalitet.</p>
                </div>

                <div
                    class="feature-card text-center p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl shadow-lg">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl">
                        <i class="fas fa-users text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Stručan tim</h3>
                    <p class="text-gray-600">Naš tim sa dugogodišnjim iskustvom uvek je tu da vam pomogne u izboru
                        najbolje ribe.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="o-nama" class="py-20 bg-gradient-to-br from-blue-600 to-cyan-600 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <i class="fas fa-fish absolute top-10 left-10 text-9xl transform rotate-12"></i>
            <i class="fas fa-fish absolute bottom-20 right-20 text-9xl transform -rotate-12"></i>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-8">
                    <i class="fas fa-anchor text-6xl mb-4"></i>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-8">O nama</h2>
                <p class="text-xl mb-6 leading-relaxed text-blue-50">
                    Ribarnica Tfzr posluje već <strong>15 godina</strong> sa ciljem da vam pruži najsvežije ribe i
                    morske plodove vrhunskog kvaliteta. Naša ponuda uključuje širok asortiman slatkovodnih i morskih
                    riba, školjki i rakova.
                </p>
                <p class="text-xl leading-relaxed text-blue-50">
                    Ponosimo se dugogodišnjom tradicijom i poverenjem naših kupaca. Svaki dan donosimo svež ulov i
                    garantujemo kvalitet svakog proizvoda. Naša misija je da učinimo ribu dostupnom svima, uz održavanje
                    najviših standarda kvaliteta.
                </p>
                <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="glass-effect rounded-xl p-6">
                        <div class="text-4xl font-bold mb-2">15+</div>
                        <div class="text-blue-100">Godina iskustva</div>
                    </div>
                    <div class="glass-effect rounded-xl p-6">
                        <div class="text-4xl font-bold mb-2">50+</div>
                        <div class="text-blue-100">Vrsta riba</div>
                    </div>
                    <div class="glass-effect rounded-xl p-6">
                        <div class="text-4xl font-bold mb-2">10K+</div>
                        <div class="text-blue-100">Zadovoljnih kupaca</div>
                    </div>
                    <div class="glass-effect rounded-xl p-6">
                        <div class="text-4xl font-bold mb-2">100%</div>
                        <div class="text-blue-100">Garancija svežine</div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-blue-600 w-12 h-12 rounded-full flex items-center justify-center">
                            <i class="fas fa-fish text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold">Ribarnica Tfzr</h3>
                    </div>
                    <p class="text-gray-400 text-sm">Vaš pouzdan partner za svežu ribu već 15 godina.</p>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-lg">Linkovi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#pocetna" class="hover:text-white transition">Početna</a></li>
                        <li><a href="#proizvodi" class="hover:text-white transition">Proizvodi</a></li>
                        <li><a href="#o-nama" class="hover:text-white transition">O nama</a></li>
                        <li><a href="#kontakt" class="hover:text-white transition">Kontakt</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-lg">Radno vreme</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><i class="far fa-clock mr-2"></i>Pon - Pet: 7:00 - 20:00</li>
                        <li><i class="far fa-clock mr-2"></i>Subota: 7:00 - 18:00</li>
                        <li><i class="far fa-clock mr-2"></i>Nedelja: 8:00 - 15:00</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-lg">Pratite nas</h4>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-pink-600 hover:bg-pink-700 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-blue-400 hover:bg-blue-500 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2025 Ribarnica Tfzr. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div id="loginModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 relative">
            <button onclick="closeLogin()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">
                <i class="fas fa-times"></i>
            </button>
            <div class="text-center mb-8">
                <div class="inline-block bg-blue-100 p-4 rounded-full mb-4">
                    <i class="fas fa-user text-blue-600 text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Prijava</h2>
                <p class="text-gray-600 mt-2">Ulogujte se na vaš nalog</p>
            </div>
            <form class="space-y-6">
                <div>
                    <input type="email" placeholder="Email adresa"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
                <div>
                    <input type="password" placeholder="Lozinka"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2">
                        <span class="text-gray-600">Zapamti me</span>
                    </label>
                    <a href="#" class="text-blue-600 hover:text-blue-700">Zaboravili ste lozinku?</a>
                </div>
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl transition font-semibold shadow-lg">
                    Prijavite se
                </button>
                <p class="text-center text-gray-600 text-sm">
                    Nemate nalog? <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Registrujte se</a>
                </p>
            </form>
        </div>
    </div>
    <script>
        let cartCount = 0;

        const products = @json($products);
        const productsGrid = document.getElementById('productsGrid');

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function renderProducts(productsList) {
            productsGrid.innerHTML = '';

            productsList.forEach(product => {
                const productHTML = `
        <div class="group relative bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 p-6">
            <!-- Kategorija -->
            <div class="flex items-center justify-between mb-4">
                <span class="px-3 py-1 text-xs font-semibold rounded-lg bg-gradient-to-r ${product.gradient} text-white shadow-sm">
                    ${capitalizeFirstLetter(product.category)}
                </span>
                <div class="flex items-center gap-1">
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                    <span class="font-bold text-gray-900">${product.rating}</span>
                </div>
            </div>
            
            <!-- Naziv proizvoda -->
            <h2 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                ${product.name}
            </h2>
            
            <!-- Opis -->
            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                ${product.description}
            </p>
            
            <!-- Cena i dugme -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <div>
                    <span class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                        ${Number(product.price).toFixed(2)}
                    </span>
                    <span class="text-sm text-gray-500 font-medium ml-1">RSD</span>
                </div>
                <button 
                    onclick="addToCart(${product.id})" 
                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 active:scale-95 transition-all duration-200 shadow-md hover:shadow-lg flex items-center gap-2 group"
                >
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Dodaj
                </button>
            </div>
        </div>
        `;
                productsGrid.innerHTML += productHTML;
            });
        }

        // Filter by category
        function filterCategory(category, event) {
            const buttons = document.querySelectorAll('.category-btn');
            buttons.forEach(btn => {
                btn.classList.remove('bg-gradient-to-r', 'from-blue-600', 'to-blue-700', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700');
            });

            if (event) {
                event.target.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-blue-700', 'text-white');
                event.target.classList.remove('bg-white', 'text-gray-700');
            }

            const filteredProducts = category === 'sve' ? products : products.filter(p => p.category === category);
            renderProducts(filteredProducts);
        }

        // Search products
        function filterProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const filteredProducts = products.filter(p => p.name.toLowerCase().includes(searchTerm));
            renderProducts(filteredProducts);
        }

        // Add to cart
        function addToCart() {
            cartCount++;
            const cartCountElement = document.getElementById('cartCount');
            cartCountElement.textContent = cartCount;
            cartCountElement.classList.remove('hidden');

            // Animation effect
            cartCountElement.classList.add('animate-bounce');
            setTimeout(() => {
                cartCountElement.classList.remove('animate-bounce');
            }, 500);
        }

        // Toggle mobile menu
        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            const icon = document.getElementById('menuIcon');
            menu.classList.toggle('hidden');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        }

        // Login modal
        function openLogin() {
            document.getElementById('loginModal').classList.remove('hidden');
        }

        function closeLogin() {
            document.getElementById('loginModal').classList.add('hidden');
        }

        // Scroll effect for header
        window.addEventListener('scroll', () => {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 100) {
                header.classList.add('shadow-2xl');
            } else {
                header.classList.remove('shadow-2xl');
            }
        });

        // Initialize products on page load
        document.addEventListener('DOMContentLoaded', () => {
            renderProducts(products);
        });
    </script>

</body>

</html>