<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Detalji Porudžbine</title>
    <?php echo $__env->make('common.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'glavna': '#4f46e5',
                        'glavna-hover': '#4338ca',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800">

    <?php echo $__env->make('common.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="max-w-4xl mx-auto mt-10 px-4 md:px-6 lg:px-8 py-12">

        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold">Porudžbina #<?php echo e($order->id); ?></h1>
                <p class="text-gray-500 mt-2"><?php echo e($order->created_at->format('d. F Y. u H:i')); ?></p>
            </div>
            <a href="<?php echo e(route('order.history')); ?>" class="text-glavna hover:text-glavna-hover font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Nazad
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6">Stavke Porudžbine</h2>

                    <div class="space-y-4">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-4 pb-4 border-b last:border-b-0">
                                <!-- Product Image -->
                                <div class="w-24 h-24 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 border">
                                    <?php if(!empty($item->product->file_path)): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->product->file_path)); ?>" alt="<?php echo e($item->product->name); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/images/product-placeholder.png')); ?>" alt="placeholder" class="w-full h-full object-cover">
                                    <?php endif; ?>
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg"><?php echo e($item->product->name); ?></h3>
                                    <p class="text-sm text-gray-500 mt-2">
                                        Količina: <strong><?php echo e($item->quantity); ?> kom</strong> × 
                                        <strong><?php echo e(number_format($item->price, 2)); ?> RSD</strong>
                                    </p>
                                </div>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-900"><?php echo e(number_format($item->quantity * $item->price, 2)); ?> RSD</p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Delivery Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6">Podaci za Isporuku</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600 font-semibold uppercase mb-2">Primaoca</p>
                            <p class="text-lg font-medium"><?php echo e($order->full_name); ?></p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600 font-semibold uppercase mb-2">Kontakt</p>
                            <p class="text-lg font-medium"><?php echo e($order->phone_or_email); ?></p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-600 font-semibold uppercase mb-2">Adresa</p>
                            <p class="text-lg font-medium"><?php echo e($order->address); ?></p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600 font-semibold uppercase mb-2">Poštanski Broj</p>
                            <p class="text-lg font-medium"><?php echo e($order->postal_code); ?></p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <aside class="space-y-6">

                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6">Sažetak Porudžbine</h2>

                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Stavki:</span>
                            <span class="font-medium"><?php echo e($order->items->count()); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Količina:</span>
                            <span class="font-medium"><?php echo e($order->items->sum('quantity')); ?> kom</span>
                        </div>
                        <div class="border-t pt-3 mt-3">
                            <div class="flex justify-between">
                                <span class="font-semibold">Ukupno:</span>
                                <span class="font-bold text-xl text-glavna"><?php echo e(number_format($order->total_amount, 2)); ?> RSD</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Status -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Status Porudžbine</h2>

                    <div class="mb-4">
                        <?php if($order->status === 'pending'): ?>
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg text-sm font-semibold">
                                <i class="fas fa-clock text-yellow-600 text-lg"></i> 
                                <span>Čeka potvrdu</span>
                            </span>
                            <p class="text-xs text-gray-500 mt-3">Vaša porudžbina je primljena i čeka potvrdu od strane naše kompanije.</p>
                        <?php elseif($order->status === 'confirmed'): ?>
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-800 rounded-lg text-sm font-semibold">
                                <i class="fas fa-check text-blue-600 text-lg"></i> 
                                <span>Potvrđena</span>
                            </span>
                            <p class="text-xs text-gray-500 mt-3">Vaša porudžbina je potvrđena i spremna za slanje.</p>
                        <?php elseif($order->status === 'shipped'): ?>
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-purple-100 text-purple-800 rounded-lg text-sm font-semibold">
                                <i class="fas fa-truck text-purple-600 text-lg"></i> 
                                <span>Poslata</span>
                            </span>
                            <p class="text-xs text-gray-500 mt-3">Vaša porudžbina je poslata i u puti.</p>
                        <?php elseif($order->status === 'delivered'): ?>
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-800 rounded-lg text-sm font-semibold">
                                <i class="fas fa-check-circle text-green-600 text-lg"></i> 
                                <span>Dostavljena</span>
                            </span>
                            <p class="text-xs text-gray-500 mt-3">Vaša porudžbina je uspešno dostavljena.</p>
                        <?php elseif($order->status === 'cancelled'): ?>
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 text-red-800 rounded-lg text-sm font-semibold">
                                <i class="fas fa-times-circle text-red-600 text-lg"></i> 
                                <span>Otkazana</span>
                            </span>
                            <p class="text-xs text-gray-500 mt-3">Ova porudžbina je otkazana.</p>
                        <?php endif; ?>
                    </div>

                    <div class="border-t pt-4">
                        <p class="text-xs text-gray-500">
                            <strong>Kreirano:</strong><br>
                            <?php echo e($order->created_at->format('d.m.Y H:i')); ?>

                        </p>
                        <?php if($order->updated_at != $order->created_at): ?>
                            <p class="text-xs text-gray-500 mt-2">
                                <strong>Poslednja Ažuriranja:</strong><br>
                                <?php echo e($order->updated_at->format('d.m.Y H:i')); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Actions -->
                <div class="space-y-2">
                    <a href="<?php echo e(route('order.history')); ?>" class="block w-full text-center px-4 py-3 bg-glavna text-white rounded-lg font-semibold hover:bg-glavna-hover transition">
                        <i class="fas fa-list mr-2"></i> Nazad na Istoriju
                    </a>
                    <a href="<?php echo e(route('proizvodi')); ?>" class="block w-full text-center px-4 py-3 border-2 border-glavna text-glavna rounded-lg font-semibold hover:bg-glavna/5 transition">
                        <i class="fas fa-shopping-bag mr-2"></i> Nastavi Kupovanje
                    </a>
                </div>

            </aside>

        </div>

    </div>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/cart/order-detail.blade.php ENDPATH**/ ?>