 <aside class="sidebar sidebar-transition w-72 bg-slate-900 text-white flex flex-col fixed lg:relative z-50 shadow-2xl h-full">
            
            <!-- Logo Section -->
            <div class="h-20 flex items-center px-8 border-b border-slate-800 bg-slate-950">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-brand-500 flex items-center justify-center shadow-lg shadow-brand-500/30">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">Admin<span class="text-brand-500">Panel</span></span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 no-scrollbar">
                
                <!-- Section Label -->
                <div class="px-4 mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    Glavni Meni
                </div>

                <!-- Link: Dashboard -->
                <a href="<?php echo e(route('kontrolni-panel')); ?>" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-brand-600 hover:shadow-lg hover:shadow-brand-500/20 text-slate-300 hover:text-white <?php echo e(request()->path() === 'kontrolni-panel' && request()->getQueryString() === null ? 'bg-brand-600 text-white' : ''); ?>">
                    <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-white transition-colors <?php echo e(request()->path() === 'kontrolni-panel' && request()->getQueryString() === null ? 'text-white' : ''); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4l4 2m0 0l4-2m-4 2v2m0 0l-4-2m4 2l4-2" />
                    </svg>
                    Proizvodi
                </a>

                <!-- Link: Gallery -->
                <a href="<?php echo e(route('kontrolni-panel', ['page_type' => 'gallery'])); ?>" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-brand-600 hover:shadow-lg hover:shadow-brand-500/20 text-slate-300 hover:text-white <?php echo e(request('page_type') == 'gallery' ? 'bg-brand-600 text-white' : ''); ?>">
                    <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-white transition-colors <?php echo e(request('page_type') == 'gallery' ? 'text-white' : ''); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Galerija
                </a>

                <!-- Link: About Us -->
                <a href="<?php echo e(route('kontrolni-panel', ['page_type' => 'about'])); ?>" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-brand-600 hover:shadow-lg hover:shadow-brand-500/20 text-slate-300 hover:text-white <?php echo e(request('page_type') == 'about' ? 'bg-brand-600 text-white' : ''); ?>">
                    <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-white transition-colors <?php echo e(request('page_type') == 'about' ? 'text-white' : ''); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    O nama
                </a>

                <!-- Link: Employees -->
                <a href="<?php echo e(route('kontrolni-panel', ['page_type' => 'employees'])); ?>" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-brand-600 hover:shadow-lg hover:shadow-brand-500/20 text-slate-300 hover:text-white <?php echo e(request('page_type') == 'employees' ? 'bg-brand-600 text-white' : ''); ?>">
                    <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-white transition-colors <?php echo e(request('page_type') == 'employees' ? 'text-white' : ''); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M12 4.354L9.172 7.226M15.828 7.226L12 4.354m0 0L4.929 11.86M12 4.354l7.071 7.506" />
                    </svg>
                    Zaposleni
                </a>

                <!-- Link: Orders -->
                <a href="<?php echo e(route('kontrolni-panel', ['page_type' => 'orders'])); ?>" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 hover:bg-brand-600 hover:shadow-lg hover:shadow-brand-500/20 text-slate-300 hover:text-white <?php echo e(request('page_type') == 'orders' ? 'bg-brand-600 text-white' : ''); ?>">
                    <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-white transition-colors <?php echo e(request('page_type') == 'orders' ? 'text-white' : ''); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Porudžbine
                </a>

    

            </nav>

            <!-- User/Logout Footer (Mobile only, desktop uses top bar) -->
            <div class="p-4 border-t border-slate-800 lg:hidden">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold">
                        <!-- LARAVEL: <?php echo e(substr(Auth::user()->name, 0, 1)); ?> -->
                        P
                    </div>
                    <div>
                        <!-- LARAVEL: <?php echo e(Auth::user()->name); ?> -->
                        <p class="text-sm font-medium text-white">Petar Petrović</p>
                        <!-- LARAVEL: <?php echo e(Auth::user()->role); ?> -->
                        <p class="text-xs text-slate-400">Administrator</p>
                    </div>
                </div>
                <form action="/odjava" method="POST">
                    <!-- LARAVEL: <?php echo csrf_field(); ?> -->
                    <input type="hidden" name="_token" value="csrf_token_placeholder">
                    <button type="submit" class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors">
                        Odjava
                    </button>
                </form>
            </div>
        </aside><?php /**PATH /var/www/html/resources/views/common/sidebar.blade.php ENDPATH**/ ?>