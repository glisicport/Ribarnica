 <header class="h-20 glass-header flex items-center justify-between px-6 border-b border-slate-200 z-30 sticky top-0">
                
                <div class="flex items-center gap-4">
                    <label for="sidebar-toggle" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg cursor-pointer transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </label>
                    
                    <h1 class="text-2xl font-bold text-slate-800 hidden sm:block">Kontrolni Panel</h1>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-slate-700"><?php echo e(Auth::user()->name); ?></p>
                            <p class="text-xs text-brand-600 font-medium uppercase tracking-wide">Administrator</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brand-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow-md ring-2 ring-white">
                            <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                        </div>
                        <form action="<?php echo e(route('odjava')); ?>" method="POST" class="hidden lg:block ml-2">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="group p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Odjava">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 001 3h7a2 2 000 2V7a2 2 000-2H7a2 2 000-2v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header><?php /**PATH /var/www/html/resources/views/common/admin_topbar.blade.php ENDPATH**/ ?>