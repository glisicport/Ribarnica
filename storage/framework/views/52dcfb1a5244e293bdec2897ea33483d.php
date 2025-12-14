<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Korpa</title>
    <?php echo $__env->make('common.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <link href="<?php echo e(asset('assets/css/admin/products.css')); ?>" rel="stylesheet"/>
    <!-- Ako koristiš Tailwind, ovo već treba da radi; dodatne stilove možeš staviti u products.css -->
</head>
<body class="bg-gray-50 min-h-screen text-gray-800">

    <?php echo $__env->make('common.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="max-w-6xl mx-auto mt-10 px-4 md:px-6 lg:px-8">

        <h1 class="text-3xl md:text-4xl font-extrabold mb-8 text-center">Vaša korpa</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEVI PANEL: Lista proizvoda -->
            <div class="lg:col-span-2 space-y-6">
                <?php if($cart && $cart->items->count()): ?>
                    <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white shadow-sm rounded-2xl p-4 flex items-center gap-4 hover:shadow-md transition">
                            <!-- SLIKA -->
                            <div class="w-28 h-28 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100 border">
                                <?php if(!empty($item->product->file_path)): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->product->file_path)); ?>" alt="<?php echo e($item->product->name); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <!-- fallback -->
                                    <img src="<?php echo e(asset('assets/images/product-placeholder.png')); ?>" alt="placeholder" class="w-full h-full object-cover">
                                <?php endif; ?>
                            </div>

                            <!-- DETALJI -->
                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h2 class="text-lg font-semibold"><?php echo e($item->product->name); ?></h2>
                                        <p class="text-sm text-gray-500 mt-1"><?php echo e(Str::limit($item->product->description ?? '', 110)); ?></p>
                                    </div>

                                    <div class="text-right">
                                        <div class="text-lg font-semibold text-gray-900"><?php echo e(number_format($item->price, 2)); ?> RSD</div>
                                        <div class="text-sm text-gray-500">po komadu</div>
                                    </div>
                                </div>

                                <!-- KOLIČINA I OPCIJE -->
                                <div class="mt-3 flex items-center justify-between gap-4">
                                    <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST" class="flex items-center gap-2">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" name="action" value="decrease" class="px-2 py-1 rounded-md border hover:bg-gray-100">-</button>
                                        <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1" class="w-16 text-center px-2 py-1 rounded-md border" />
                                        <button type="submit" name="action" value="increase" class="px-2 py-1 rounded-md border hover:bg-gray-100">+</button>
                                    </form>

                                    <div class="flex items-center gap-2">
                                        <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-sm px-3 py-1 rounded-md bg-red-50 text-red-600 border border-red-100 hover:bg-red-100">Ukloni</button>
                                        </form>
                                        <div class="text-sm text-gray-500">Subtotal: <span class="font-medium"><?php echo e(number_format($item->quantity * $item->price, 2)); ?> RSD</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>
                    <div class="bg-white rounded-2xl p-6 shadow-sm text-center">
                        <p class="text-lg text-gray-600">Korpa je prazna.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- DESNI PANEL: Pregled porudžbine i checkout -->
            <aside class="bg-white rounded-2xl p-6 shadow-sm h-fit sticky top-6">
                <h3 class="text-xl font-semibold mb-4">Pregled porudžbine</h3>

                <div class="space-y-3">
                    <?php if($cart && $cart->items->count()): ?>
                        <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg overflow-hidden border bg-gray-100">
                                        <?php if(!empty($item->product->file_path)): ?>
                                            <img src="<?php echo e(asset('storage/' . $item->product->file_path)); ?>" alt="" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/images/product-placeholder.png')); ?>" alt="" class="w-full h-full object-cover">
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-sm">
                                        <div class="font-medium"><?php echo e(Str::limit($item->product->name, 28)); ?></div>
                                        <div class="text-gray-500">x<?php echo e($item->quantity); ?></div>
                                    </div>
                                </div>

                                <div class="text-sm font-medium"><?php echo e(number_format($item->quantity * $item->price, 2)); ?> RSD</div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="border-t pt-3 mt-3">
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-sm text-gray-600">Ukupno</div>
                                <div class="text-lg font-bold"><?php echo e(number_format($cart->items->sum(fn($i) => $i->quantity * $i->price), 2)); ?> RSD</div>
                            </div>

                            <!-- Checkout dugme: otvara modal -->
                            <button id="openCheckoutModal" class="w-full mt-2 inline-block text-center px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl shadow hover:scale-[1.01] transition">
                                Nastavi na plaćanje
                            </button>
                        </div>

                    <?php else: ?>
                        <div class="text-sm text-gray-500">Dodaj proizvode da bi mogao da nastaviš</div>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </div>

    <!-- CHECKOUT MODAL -->
    <div id="checkoutModal" class="fixed inset-0 z-50 hidden">
        <!-- overlay -->
        <div id="modalOverlay" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

        <!-- modal dialog -->
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="max-w-3xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all">
                <div class="flex items-center justify-between px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold">Završetak kupovine</h2>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>

                <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Forma -->
                    <form id="checkoutForm" action="<?php echo e(route('cart.checkout')); ?>" method="POST" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <!-- Polja su required; backend treba da validira ponovo -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <label class="block">
                                <span class="text-sm font-medium">Ime</span>
                                <input name="ime" required class="mt-1 block w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['ime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       placeholder="Ime"
                                       value="<?php echo e(old('ime', Auth::user()->name ? explode(' ', Auth::user()->name)[0] : '')); ?>">
                                <?php $__errorArgs = ['ime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </label>

                            <label class="block">
                                <span class="text-sm font-medium">Prezime</span>
                                <input name="prezime" required class="mt-1 block w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['prezime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       placeholder="Prezime"
                                       value="<?php echo e(old('prezime', Auth::user()->name ? (explode(' ', Auth::user()->name)[1] ?? '') : '')); ?>">
                                <?php $__errorArgs = ['prezime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </label>
                        </div>

                        <label class="block">
                            <span class="text-sm font-medium">Adresa</span>
                            <input name="adresa" required class="mt-1 block w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['adresa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   placeholder="Ulica, broj, grad"
                                   value="<?php echo e(old('adresa', Auth::user()->address ?? '')); ?>">
                            <?php $__errorArgs = ['adresa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <label class="block">
                                <span class="text-sm font-medium">Poštanski broj</span>
                                <input name="ppt" required class="mt-1 block w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['ppt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       placeholder="Poštanski broj"
                                       value="<?php echo e(old('ppt', Auth::user()->postal_code ?? '')); ?>">
                                <?php $__errorArgs = ['ppt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </label>

                            <label class="block">
                                <span class="text-sm font-medium">Telefon ili Email</span>
                                <input name="contact" required class="mt-1 block w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       placeholder="Telefon ili Email"
                                       value="<?php echo e(old('contact', Auth::user()->phone ?? Auth::user()->email)); ?>">
                                <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </label>
                        </div>

                        <!-- Provera i slanje -->
                        <div class="flex items-center justify-between gap-3">
                            <button type="button" id="cancelBtn" class="px-4 py-2 rounded-lg border hover:bg-gray-50">Nazad</button>

                            <!-- U formu uključujemo i sadrzaj kosare (možeš poslati kao hidden polja) -->
                            <input type="hidden" name="total" value="<?php echo e($cart ? $cart->items->sum(fn($i) => $i->quantity * $i->price) : 0); ?>">

                            <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Potvrdi i plati</button>
                        </div>
                    </form>

                    <!-- Sažetak porudžbine u modalu -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-md font-semibold mb-3">Sažetak porudžbine</h4>

                        <div class="space-y-3 max-h-64 overflow-auto pr-2">
                            <?php if($cart && $cart->items->count()): ?>
                                <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-14 h-14 rounded-lg overflow-hidden border bg-white">
                                                <?php if(!empty($item->product->file_path)): ?>
                                                    <img src="<?php echo e(asset('storage/' . $item->product->file_path)); ?>" alt="" class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('assets/images/product-placeholder.png')); ?>" alt="" class="w-full h-full object-cover">
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium"><?php echo e(Str::limit($item->product->name, 30)); ?></div>
                                                <div class="text-xs text-gray-500">x<?php echo e($item->quantity); ?></div>
                                            </div>
                                        </div>

                                        <div class="text-sm font-medium"><?php echo e(number_format($item->quantity * $item->price, 2)); ?> RSD</div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>

                        <div class="border-t mt-4 pt-3 flex items-center justify-between">
                            <div class="text-sm text-gray-600">Ukupno</div>
                            <div class="text-lg font-bold"><?php echo e(number_format($cart->items->sum(fn($i) => $i->quantity * $i->price), 2)); ?> RSD</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<script>
    // Komentari na srpskom radi lakšeg održavanja
    document.addEventListener('DOMContentLoaded', function () {
        const openBtn = document.getElementById('openCheckoutModal');
        const modal = document.getElementById('checkoutModal');
        const overlay = document.getElementById('modalOverlay');
        const closeBtn = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');

        const openModal = () => {
            modal.classList.remove('hidden');
            // fokus na prvo polje u formi
            const firstInput = modal.querySelector('input[name="ime"]');
            if (firstInput) firstInput.focus();
            document.body.style.overflow = 'hidden';
        };

        const closeModal = () => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        };

        if (openBtn) openBtn.addEventListener('click', function (e) {
            e.preventDefault();
            openModal();
        });

        if (overlay) overlay.addEventListener('click', closeModal);
        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

        // zatvaranje ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });

        // osnovna klijentska validacija (pre slanja)
        const checkoutForm = document.getElementById('checkoutForm');
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function (e) {
                // primer provere minimalnih polja (backend mora validirati isto)
                const ime = checkoutForm.querySelector('input[name="ime"]').value.trim();
                const prezime = checkoutForm.querySelector('input[name="prezime"]').value.trim();
                const adresa = checkoutForm.querySelector('input[name="adresa"]').value.trim();
                const ppt = checkoutForm.querySelector('input[name="ppt"]').value.trim();
                const contact = checkoutForm.querySelector('input[name="contact"]').value.trim();

                if (!ime || !prezime || !adresa || !ppt || !contact) {
                    e.preventDefault();
                    alert('Popunite sva obavezna polja pre potvrde porudžbine.');
                }
            });
        }
    });
</script>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/cart/index.blade.php ENDPATH**/ ?>