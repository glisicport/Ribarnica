<?php
    use App\Models\Order;

    $status = request()->query('status');

   $query = Order::with('items.product', 'user')->orderBy('created_at', 'desc');
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $orders = $query->paginate(20);
        $statusCounts = [
            'pending' => Order::where('status', 'pending')->count(),
            'confirmed' => Order::where('status', 'confirmed')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Porudžbine</h1>
            <p class="text-slate-500 mt-1">Upravljanje svim porudžbinama korisnika</p>
        </div>
    </div>

    <!-- Status Filters & Summary -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
        <a href="<?php echo e(route('kontrolni-panel', ['page_type' => 'orders'])); ?>" class="p-4 rounded-lg border-2 <?php if(!request('status')): ?> border-blue-500 bg-blue-50 <?php else: ?> border-slate-200 bg-white hover:border-slate-300 <?php endif; ?> transition">
            <div class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Sve</div>
            <div class="text-2xl font-bold text-slate-900 mt-1"><?php echo e($statusCounts['pending'] + $statusCounts['confirmed'] + $statusCounts['shipped'] + $statusCounts['delivered'] + $statusCounts['cancelled']); ?></div>
        </a>

        <a href="<?php echo e(route('kontrolni-panel', ['page_type' => 'orders', 'status' => 'pending'])); ?>" class="p-4 rounded-lg border-2 <?php if(request('status') === 'pending'): ?> border-yellow-500 bg-yellow-50 <?php else: ?> border-slate-200 bg-white hover:border-slate-300 <?php endif; ?> transition">
            <div class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Čeka</div>
            <div class="text-2xl font-bold text-yellow-700 mt-1"><?php echo e($statusCounts['pending']); ?></div>
        </a>

        <a href="<?php echo e(route('kontrolni-panel', ['page_type' => 'orders', 'status' => 'confirmed'])); ?>" class="p-4 rounded-lg border-2 <?php if(request('status') === 'confirmed'): ?> border-blue-500 bg-blue-50 <?php else: ?> border-slate-200 bg-white hover:border-slate-300 <?php endif; ?> transition">
            <div class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Potvrđena</div>
            <div class="text-2xl font-bold text-blue-700 mt-1"><?php echo e($statusCounts['confirmed']); ?></div>
        </a>

        <a href="<?php echo e(route('kontrolni-panel', ['page_type' => 'orders', 'status' => 'shipped'])); ?>" class="p-4 rounded-lg border-2 <?php if(request('status') === 'shipped'): ?> border-purple-500 bg-purple-50 <?php else: ?> border-slate-200 bg-white hover:border-slate-300 <?php endif; ?> transition">
            <div class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Poslata</div>
            <div class="text-2xl font-bold text-purple-700 mt-1"><?php echo e($statusCounts['shipped']); ?></div>
        </a>

        <a href="<?php echo e(route('kontrolni-panel', ['page_type' => 'orders', 'status' => 'delivered'])); ?>" class="p-4 rounded-lg border-2 <?php if(request('status') === 'delivered'): ?> border-green-500 bg-green-50 <?php else: ?> border-slate-200 bg-white hover:border-slate-300 <?php endif; ?> transition">
            <div class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Dostavljena</div>
            <div class="text-2xl font-bold text-green-700 mt-1"><?php echo e($statusCounts['delivered']); ?></div>
        </a>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Porudžbina</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Korisnik</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Iznos</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Stavki</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Datum</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Akcija</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="font-semibold text-blue-600 hover:text-blue-800">
                                    #<?php echo e($order->id); ?>

                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900"><?php echo e($order->user->name); ?></div>
                                <div class="text-xs text-slate-500"><?php echo e($order->user->email); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-slate-900"><?php echo e(number_format($order->total_amount, 2)); ?> RSD</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                    <?php echo e($order->items->count()); ?> stavki
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($order->status === 'pending'): ?>
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock"></i> Čeka
                                    </span>
                                <?php elseif($order->status === 'confirmed'): ?>
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        <i class="fas fa-check"></i> Potvrđena
                                    </span>
                                <?php elseif($order->status === 'shipped'): ?>
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                        <i class="fas fa-truck"></i> Poslata
                                    </span>
                                <?php elseif($order->status === 'delivered'): ?>
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle"></i> Dostavljena
                                    </span>
                                <?php elseif($order->status === 'cancelled'): ?>
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        <i class="fas fa-times"></i> Otkazana
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                <?php echo e($order->created_at->format('d.m.Y H:i')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    <button onclick="openOrderModal(<?php echo e($order->id); ?>)" class="text-blue-600 hover:text-blue-800 font-semibold">
                                        <i class="fas fa-eye"></i> Pregled
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                <i class="fas fa-inbox text-4xl opacity-30 mb-4 block"></i>
                                <p class="font-medium">Nema porudžbina</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if($orders->hasPages()): ?>
        <div class="flex justify-center">
            <?php echo e($orders->links()); ?>

        </div>
    <?php endif; ?>
</div>

<!-- Order Detail Modal -->
<div id="orderModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" onclick="closeOrderModal(event)">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900" id="modalOrderTitle">Porudžbina</h2>
                <p class="text-slate-500 text-sm mt-1" id="modalOrderDate"></p>
            </div>
            <button onclick="closeOrderModal()" class="text-slate-500 hover:text-slate-700">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <!-- Modal Content -->
        <div id="modalContent" class="p-6">
            <!-- Loading state -->
            <div class="flex items-center justify-center py-12">
                <i class="fas fa-spinner fa-spin text-3xl text-slate-400"></i>
            </div>
        </div>
    </div>
</div>

<script>
    function openOrderModal(orderId) {
        const modal = document.getElementById('orderModal');
        const modalContent = document.getElementById('modalContent');
        
        // Show modal with loading state
        modal.classList.remove('hidden');
        modalContent.innerHTML = '<div class="flex items-center justify-center py-12"><i class="fas fa-spinner fa-spin text-3xl text-slate-400"></i></div>';
        
        // Fetch order details
        fetch(`/admin/orders/${orderId}`)
            .then(response => response.text())
            .then(html => {
                // Parse the response and extract the content
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const content = doc.querySelector('body > div');
                
                if (content) {
                    // Extract order title and date
                    const titleEl = content.querySelector('h1');
                    const dateEl = content.querySelector('p.text-slate-500');
                    
                    if (titleEl) {
                        document.getElementById('modalOrderTitle').textContent = titleEl.textContent;
                    }
                    if (dateEl) {
                        document.getElementById('modalOrderDate').textContent = dateEl.textContent;
                    }
                    
                    // Get the main content (everything except header)
                    const header = content.querySelector('.flex.items-center.justify-between');
                    if (header) {
                        header.remove();
                    }
                    
                    // Remove success message if present
                    const successMsg = content.querySelector('.bg-green-50');
                    if (successMsg) {
                        successMsg.remove();
                    }
                    
                    modalContent.innerHTML = content.innerHTML;
                }
            })
            .catch(error => {
                modalContent.innerHTML = '<div class="text-center text-red-600"><i class="fas fa-exclamation-circle text-3xl mb-2"></i><p>Greška pri učitavanju podataka.</p></div>';
                console.error('Error:', error);
            });
    }

    function closeOrderModal(event) {
        // If event exists and click was on modal background, close it
        if (event && event.target.id !== 'orderModal') {
            return;
        }
        document.getElementById('orderModal').classList.add('hidden');
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeOrderModal();
        }
    });
</script>
<?php /**PATH /var/www/html/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>