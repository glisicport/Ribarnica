<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korisnički Nalog</title>


  
    <?php echo $__env->make('common.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            900: '#0c4a6e'
                        },
                        'glavna': '#4f46e5',
                        'glavna-hover': '#4338ca',
                    }
                }
            }
        }
    </script>
<link href="<?php echo e(asset('assets/css/admin/dashboard.css')); ?>" rel="stylesheet"/>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-brand-100 selection:text-brand-900">

    <input type="checkbox" id="sidebar-toggle" class="hidden">
    <label for="sidebar-toggle" class="overlay hidden fixed inset-0 bg-slate-900/50 z-40 lg:hidden transition-opacity cursor-pointer"></label>

    <div class="flex h-screen overflow-hidden">


        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50">
            
           <?php echo $__env->make('common.admin_topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
           
           <!-- User Dashboard Content -->
           <div class="flex-1 overflow-auto">
               <div class="p-8">
                   <!-- Header -->
                   <div class="mb-8">
                       <h1 class="text-4xl font-extrabold text-gray-900 mb-2">
                           Dobrodošli, <?php echo e(Auth::user()->name); ?>!
                       </h1>
                       <p class="text-gray-500">Upravljajte vašim naloga i podacima.</p>
                   </div>

                   <!-- Success Message -->
                   <?php if(session('status')): ?>
                       <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg flex items-start" role="alert">
                           <i class="fas fa-check-circle mr-3 mt-0.5 flex-shrink-0"></i>
                           <span><?php echo e(session('status')); ?></span>
                       </div>
                   <?php endif; ?>

                   <!-- Dashboard Cards Grid -->
                   <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                       <!-- Profile Card -->
                       <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-200">
                           <div class="bg-gradient-to-r from-glavna to-indigo-500 h-32 flex items-center justify-center">
                               <i class="fas fa-user text-white text-5xl opacity-30"></i>
                           </div>
                           <div class="p-6">
                               <h3 class="text-xl font-bold text-gray-900 mb-2">Moj Profil</h3>
                               <p class="text-gray-500 text-sm mb-4">Pogledajte i ažurirajte svoje lične podatke.</p>
                               <a href="<?php echo e(route('profil.edit')); ?>" class="inline-block w-full text-center py-2 px-4 text-white font-bold rounded-lg bg-gradient-to-r from-glavna to-indigo-500 hover:from-glavna-hover hover:to-indigo-600 transition duration-300">
                                   <i class="fas fa-edit mr-2"></i> Uredi Profil
                               </a>
                           </div>
                       </div>

                       <!-- Password Card -->
                       <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-200">
                           <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-32 flex items-center justify-center">
                               <i class="fas fa-key text-white text-5xl opacity-30"></i>
                           </div>
                           <div class="p-6">
                               <h3 class="text-xl font-bold text-gray-900 mb-2">Promena Lozinke</h3>
                               <p class="text-gray-500 text-sm mb-4">Ažurirajte vašu lozinku da ostanete sigurni.</p>
                               <a href="<?php echo e(route('profil.change-password')); ?>" class="inline-block w-full text-center py-2 px-4 text-white font-bold rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 transition duration-300">
                                   <i class="fas fa-lock mr-2"></i> Promeni Lozinku
                               </a>
                           </div>
                       </div>

                       <!-- Cart Card -->
                       <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-200">
                           <div class="bg-gradient-to-r from-orange-400 to-red-500 h-32 flex items-center justify-center">
                               <i class="fas fa-shopping-cart text-white text-5xl opacity-30"></i>
                           </div>
                           <div class="p-6">
                               <h3 class="text-xl font-bold text-gray-900 mb-2">Moja Korpa</h3>
                               <p class="text-gray-500 text-sm mb-4">Pregledajte stavke u vašoj korpi.</p>
                               <a href="<?php echo e(route('cart.view')); ?>" class="inline-block w-full text-center py-2 px-4 text-white font-bold rounded-lg bg-gradient-to-r from-orange-400 to-red-500 hover:from-orange-500 hover:to-red-600 transition duration-300">
                                   <i class="fas fa-eye mr-2"></i> Vidi Korpu
                               </a>
                           </div>
                       </div>

                       <!-- Order History Card -->
                       <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-200">
                           <div class="bg-gradient-to-r from-teal-400 to-cyan-500 h-32 flex items-center justify-center">
                               <i class="fas fa-history text-white text-5xl opacity-30"></i>
                           </div>
                           <div class="p-6">
                               <h3 class="text-xl font-bold text-gray-900 mb-2">Istorija Porudžbina</h3>
                               <p class="text-gray-500 text-sm mb-4">Pregledajte vaše poslednje porudžbine.</p>
                               <a href="<?php echo e(route('order.history')); ?>" class="inline-block w-full text-center py-2 px-4 text-white font-bold rounded-lg bg-gradient-to-r from-teal-400 to-cyan-500 hover:from-teal-500 hover:to-cyan-600 transition duration-300">
                                   <i class="fas fa-list mr-2"></i> Vidi Porudžbine
                               </a>
                           </div>
                       </div>

                   </div>

                   <!-- Profile Info Section -->
                   <div class="mt-8 bg-white rounded-lg shadow-md p-8 border border-gray-200">
                       <h2 class="text-2xl font-bold text-gray-900 mb-6">Moji Podaci</h2>
                       
                       <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                           <div>
                               <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide">Ime i Prezime</p>
                               <p class="text-gray-900 font-medium text-lg mt-1"><?php echo e(Auth::user()->name); ?></p>
                           </div>
                           <div>
                               <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide">E-mail Adresa</p>
                               <p class="text-gray-900 font-medium text-lg mt-1"><?php echo e(Auth::user()->email); ?></p>
                           </div>
                           <div>
                               <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide">Telefonski Broj</p>
                               <p class="text-gray-900 font-medium text-lg mt-1"><?php echo e(Auth::user()->phone ?? 'Nije navedeno'); ?></p>
                           </div>
                           <div>
                               <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide">Grad</p>
                               <p class="text-gray-900 font-medium text-lg mt-1"><?php echo e(Auth::user()->city ?? 'Nije navedeno'); ?></p>
                           </div>
                           <div>
                               <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide">Adresa</p>
                               <p class="text-gray-900 font-medium text-lg mt-1"><?php echo e(Auth::user()->address ?? 'Nije navedeno'); ?></p>
                           </div>
                           <div>
                               <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide">Poštanski Broj</p>
                               <p class="text-gray-900 font-medium text-lg mt-1"><?php echo e(Auth::user()->postal_code ?? 'Nije navedeno'); ?></p>
                           </div>
                           <div class="md:col-span-2">
                               <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide">Država</p>
                               <p class="text-gray-900 font-medium text-lg mt-1"><?php echo e(Auth::user()->country ?? 'Nije navedeno'); ?></p>
                           </div>
                       </div>

                       <div class="mt-6">
                           <a href="<?php echo e(route('profil.edit')); ?>" class="py-2 px-6 text-white font-bold rounded-lg bg-gradient-to-r from-glavna to-indigo-500 hover:from-glavna-hover hover:to-indigo-600 transition duration-300">
                               <i class="fas fa-edit mr-2"></i> Ažuriraj Podatke
                           </a>
                       </div>
                   </div>

               </div>
           </div>
           
        </main>
    </div>


 


</body>
</html>
<?php /**PATH /var/www/html/resources/views/user/index.blade.php ENDPATH**/ ?>