<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Istorija Porudžbina</title>
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

    <div class="max-w-6xl mx-auto mt-10 px-4 md:px-6 lg:px-8 py-12">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold">Istorija Porudžbina</h1>
                    <p class="text-gray-500 mt-2">Pregled vašich poslednjich <?php echo e($orders->count()); ?> porudžbina</p>
                </div>
                <a href="<?php echo e(route('korisnicki-nalog')); ?>" class="text-glavna hover:text-glavna-hover font-medium">
                    <i class="fas fa-arrow-left mr-2"></i> Nazad
                </a>
            </div>
        </div>

        <?php if($orders->count()): ?>
            <div class="space-y-4">
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
                        <div class="p-6">
                            <!-- Order Header -->
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4 pb-4 border-b">
                                <div>
                                    <h3 class="text-lg font-semibold">Porudžbina #<?php echo e($order->id); ?></h3>
                                    <p class="text-sm text-gray-500"><?php echo e($order->created_at->format('d.m.Y H:i')); ?></p>
                                </div>

                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <!-- Status Badge -->
                                    <div>
                                        <?php if($order->status === 'pending'): ?>
                                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                                <i class="fas fa-clock text-yellow-600"></i> Čeka potvrdu
                                            </span>
                                        <?php elseif($order->status === 'confirmed'): ?>
                                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                                <i class="fas fa-check text-blue-600"></i> Potvrđena
                                            </span>
                                        <?php elseif($order->status === 'shipped'): ?>
                                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                                <i class="fas fa-truck text-purple-600"></i> Poslata
                                            </span>
                                        <?php elseif($order->status === 'delivered'): ?>
                                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                                <i class="fas fa-check-circle text-green-600"></i> Dostavljena
                                            </span>
                                        <?php elseif($order->status === 'cancelled'): ?>
                                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                                                <i class="fas fa-times-circle text-red-600"></i> Otkazana
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Total -->
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">Ukupno</p>
                                        <p class="text-2xl font-bold text-glavna"><?php echo e(number_format($order->total_amount, 2)); ?> RSD</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items Preview -->
                            <div class="mb-4">
                                <p class="text-sm font-semibold text-gray-700 mb-2">Stavke (<?php echo e($order->items->count()); ?>)</p>
                                <div class="flex flex-wrap gap-2">
                                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-gray-100 rounded-full text-sm">
                                            <span><?php echo e($item->product->name); ?></span>
                                            <span class="text-gray-500">x<?php echo e($item->quantity); ?></span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <!-- Delivery Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 pb-4 border-b">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Primaoca</p>
                                    <p class="text-sm font-medium"><?php echo e($order->full_name); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Adresa</p>
                                    <p class="text-sm font-medium"><?php echo e($order->address); ?>, <?php echo e($order->postal_code); ?></p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="flex gap-2">
                                <a href="<?php echo e(route('order.detail', $order->id)); ?>" class="inline-flex items-center gap-2 px-4 py-2 text-white bg-glavna hover:bg-glavna-hover rounded-lg font-semibold transition">
                                    <i class="fas fa-eye"></i> Detalji
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-8 p-4 bg-blue-50 rounded-lg text-sm text-blue-900">
                <i class="fas fa-info-circle mr-2"></i>
                Prikazane su poslednje 30 porudžbina.
            </div>

        <?php else: ?>
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="text-6xl text-gray-300 mb-4">
                    <i class="fas fa-inbox"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Nema Porudžbina</h3>
                <p class="text-gray-500 mb-6">Još uvek niste napravili nijednu porudžbinu. Počnite sa kupovanjem!</p>
                <a href="<?php echo e(route('proizvodi')); ?>" class="inline-block px-6 py-3 bg-glavna text-white rounded-lg font-semibold hover:bg-glavna-hover transition">
                    <i class="fas fa-shopping-bag mr-2"></i> Pregledaj Proizvode
                </a>
            </div>
        <?php endif; ?>

    </div>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/cart/order-history.blade.php ENDPATH**/ ?>