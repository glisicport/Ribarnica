<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Porudžbina Potvrđena</title>
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

        <!-- Success Message -->
        <div class="bg-green-50 border-l-4 border-green-500 p-6 mb-8 rounded-lg">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-green-800 mb-1">Porudžbina Potvrđena!</h2>
                    <p class="text-green-700">Vaša porudžbina je uspešno primljena. Broj porudžbine: <strong>#<?php echo e($order->id); ?></strong></p>
                </div>
            </div>
        </div>

        <!-- Order Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left: Order Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-6">Stavke Porudžbine</h3>

                    <div class="space-y-4">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-4 pb-4 border-b last:border-b-0">
                                <!-- Product Image -->
                                <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 border">
                                    <?php if(!empty($item->product->file_path)): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->product->file_path)); ?>" alt="<?php echo e($item->product->name); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/images/product-placeholder.png')); ?>" alt="placeholder" class="w-full h-full object-cover">
                                    <?php endif; ?>
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1">
                                    <h4 class="font-semibold text-lg"><?php echo e($item->product->name); ?></h4>
                                    <p class="text-sm text-gray-500 mt-1">Količina: <strong><?php echo e($item->quantity); ?> kom</strong></p>
                                    <p class="text-sm text-gray-500">Cena po komadu: <strong><?php echo e(number_format($item->price, 2)); ?> RSD</strong></p>
                                </div>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-gray-900"><?php echo e(number_format($item->quantity * $item->price, 2)); ?> RSD</p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- Right: Summary and Delivery Info -->
            <aside class="space-y-6">
                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-semibold text-lg mb-4">Sažetak Porudžbine</h3>

                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium"><?php echo e(number_format($order->total_amount, 2)); ?> RSD</span>
                        </div>
                        <div class="border-t pt-3 mt-3">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-lg">Ukupno:</span>
                                <span class="font-bold text-xl text-green-600"><?php echo e(number_format($order->total_amount, 2)); ?> RSD</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-900">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Status:</strong> Čeka potvrdu
                        </p>
                    </div>
                </div>

                <!-- Delivery Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-semibold text-lg mb-4">Podaci za Isporuku</h3>

                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Primaoca:</p>
                            <p class="font-medium"><?php echo e($order->full_name); ?></p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Adresa:</p>
                            <p class="font-medium"><?php echo e($order->address); ?></p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Poštanski Broj:</p>
                            <p class="font-medium"><?php echo e($order->postal_code); ?></p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Telefon / Email:</p>
                            <p class="font-medium"><?php echo e($order->phone_or_email); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Order Status -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-semibold text-lg mb-4">Status Porudžbine</h3>

                    <div class="flex items-center gap-3">
                        <?php if($order->status === 'pending'): ?>
                            <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full"></span>
                            <span class="text-sm font-medium text-yellow-700">Čeka potvrdu</span>
                        <?php elseif($order->status === 'confirmed'): ?>
                            <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                            <span class="text-sm font-medium text-blue-700">Potvrđena</span>
                        <?php elseif($order->status === 'shipped'): ?>
                            <span class="inline-block w-3 h-3 bg-purple-500 rounded-full"></span>
                            <span class="text-sm font-medium text-purple-700">Poslata</span>
                        <?php elseif($order->status === 'delivered'): ?>
                            <span class="inline-block w-3 h-3 bg-green-500 rounded-full"></span>
                            <span class="text-sm font-medium text-green-700">Dostavljena</span>
                        <?php elseif($order->status === 'cancelled'): ?>
                            <span class="inline-block w-3 h-3 bg-red-500 rounded-full"></span>
                            <span class="text-sm font-medium text-red-700">Otkazana</span>
                        <?php endif; ?>
                    </div>

                    <p class="text-xs text-gray-500 mt-3">
                        Kreirano: <?php echo e($order->created_at->format('d.m.Y H:i')); ?>

                    </p>
                </div>
            </aside>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
            <a href="<?php echo e(route('order.history')); ?>" class="px-6 py-3 bg-glavna text-white rounded-lg font-semibold hover:bg-glavna-hover transition text-center">
                <i class="fas fa-list mr-2"></i> Vidi Sve Porudžbine
            </a>
            <a href="<?php echo e(route('proizvodi')); ?>" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition text-center">
                <i class="fas fa-shopping-bag mr-2"></i> Nastavi sa Kupovanjem
            </a>
            <a href="<?php echo e(route('korisnicki-nalog')); ?>" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:border-gray-400 transition text-center">
                <i class="fas fa-user mr-2"></i> Nazad na Nalog
            </a>
        </div>

    </div>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/cart/order-success.blade.php ENDPATH**/ ?>