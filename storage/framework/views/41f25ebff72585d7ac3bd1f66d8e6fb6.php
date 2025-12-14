<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ribarnica Tfzr - Sveže ribe</title>
    <?php echo $__env->make('common.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

        .feature-card {
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        @keyframes float {
            0%, 100% {
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

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
        }
    </style>
</head>

<body class="bg-gray-50">
    <?php echo $__env->make('common.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
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

                <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-2xl p-3">
                    <form action="/proizvodi" method="GET" class="flex flex-col md:flex-row gap-3">
                        <div class="flex-1 relative">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="search" placeholder="Pretražite naše proizvode..."
                                class="w-full pl-12 pr-4 py-4 text-gray-700 outline-none rounded-xl"
                                value="<?php echo e(request('search')); ?>">
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-4 rounded-xl transition flex items-center justify-center space-x-2 font-semibold shadow-lg">
                            <i class="fas fa-search"></i>
                            <span>Pretraži</span>
                        </button>
                    </form>
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
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    <?php if($loggedin): ?>
                        Za vas preporučeno
                    <?php else: ?>
                        Preporučeni proizvodi
                    <?php endif; ?>
                </h2>
                <p class="text-gray-600 text-lg">
                    <?php if($loggedin): ?>
                        Na osnovu vaše istorije narudžbina
                    <?php else: ?>
                        Najbolji izbor iz naše bogate ponude
                    <?php endif; ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
                    <?php if($index == 0): ?>
                    <span class="badge-new">
                        <i class="fas fa-fire mr-1"></i>TOP PREPORUKA
                    </span>
                    <?php elseif($index < 3): ?>
                    <span class="badge-new">
                        <i class="fas fa-star mr-1"></i>PREPORUKA
                    </span>
                    <?php endif; ?>
                    
                    <div class="p-4">
                        <img src="<?php echo e(asset('storage/'.$product->file_path)); ?>" 
                             alt="<?php echo e($product->name); ?>" 
                             class="product-image">
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-bold text-gray-800"><?php echo e($product->name); ?></h3>
                            <span class="flex items-center text-yellow-500 text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i><?php echo e(number_format(rand(45, 50) / 10, 1)); ?>

                            </span>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm flex items-start">
                            <i class="fas fa-check-circle text-green-500 mr-2 mt-1"></i>
                            <?php echo e($product->description); ?>

                        </p>
                        <div class="flex items-center justify-between">
                            <span class="price-tag"><?php echo e(number_format($product->price, 0, ',', '.')); ?> din/kg</span>
                            <?php if($loggedin): ?>
                                <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                        class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2 rounded-xl transition shadow-md flex items-center space-x-2">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>Dodaj</span>
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="<?php echo e(route('prijava')); ?>"
                                    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-5 py-2 rounded-xl transition shadow-md flex items-center space-x-2">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Dodaj</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    Ribarnica Tfzr posluje već <strong>15 godina</strong> sa ciljem da vam pruži najsvežije ribe i morske plodove vrhunskog kvaliteta. Naša ponuda uključuje širok asortiman slatkovodnih i morskih riba, školjki i rakova.
                </p>
                <p class="text-xl leading-relaxed text-blue-50">
                    Ponosimo se dugogodišnjom tradicijom i poverenjem naših kupaca. Svaki dan donosimo svež ulov i garantujemo kvalitet svakog proizvoda. Naša misija je da učinimo ribu dostupnom svima, uz održavanje najviših standarda kvaliteta.
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
                        <li><a href="/proizvodi" class="hover:text-white transition">Proizvodi</a></li>
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
                        <a href="#" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-pink-600 hover:bg-pink-700 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-400 hover:bg-blue-500 rounded-full flex items-center justify-center transition">
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

    <script>

        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            const icon = document.getElementById('menuIcon');
            menu.classList.toggle('hidden');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        }

        window.addEventListener('scroll', () => {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 100) {
                header.classList.add('shadow-2xl');
            } else {
                header.classList.remove('shadow-2xl');
            }
        });
    </script>

</body>

</html><?php /**PATH /var/www/html/resources/views/home.blade.php ENDPATH**/ ?>