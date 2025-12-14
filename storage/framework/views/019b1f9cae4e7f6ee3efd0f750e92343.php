<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Kontrolni Panel'); ?></title>

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
                        }
                    }
                }
            }
        }
    </script>

    <link href="<?php echo e(asset('assets/css/admin/dashboard.css')); ?>" rel="stylesheet"/>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-brand-100 selection:text-brand-900">

<input type="checkbox" id="sidebar-toggle" class="hidden">
<label for="sidebar-toggle"
       class="overlay hidden fixed inset-0 bg-slate-900/50 z-40 lg:hidden transition-opacity cursor-pointer"></label>

<div class="flex h-screen overflow-hidden">
    <?php echo $__env->make('common.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="flex-1 flex flex-col overflow-y-auto bg-slate-50">
        <?php echo $__env->make('common.admin_topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="p-6 flex-1 min-h-[calc(100vh-4rem)]">
            <!-- Dynamic Content Based on currentPage Type -->
            <?php if($currentPage === 'products' || empty($currentPage)): ?>
                <?php echo $__env->make('admin.products.index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php elseif($currentPage === 'gallery'): ?>
                <?php echo $__env->make('admin.gallery.index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php elseif($currentPage === 'about'): ?>
                <?php echo $__env->make('admin.about_us.index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php elseif($currentPage === 'employees'): ?>
                <?php echo $__env->make('admin.employees.index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php elseif($currentPage === 'settings'): ?>
                <?php echo $__env->make('admin.settings.index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php elseif($currentPage === 'orders'): ?>
                <?php echo $__env->make('admin.orders.index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php elseif($currentPage === 'faq'): ?>
                <?php echo $__env->make('admin.contact.partials.faq_table', [
                    'items' => $items ?? []
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php elseif($currentPage === 'quick-facts'): ?>
                <?php echo $__env->make('admin.contact.partials.quick_facts_table', [
                    'items' => $items ?? []
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php elseif($currentPage === 'poruke'): ?>
                <?php echo $__env->make('admin.contact.partials.questions_table', [
                    'questions' => $questions ?? []
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php elseif($currentPage === 'contact_info'): ?>
                <?php echo $__env->make('admin.contact.partials.contact_info_table', [
                    'items' => $items ?? []
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php else: ?>
                <p class="text-sm text-slate-500">
                    Izabrani panel ne postoji.
                </p>
            <?php endif; ?>
        </div>
    </main>
</div>

<script>
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('tab-active');
        btn.classList.add('tab-inactive');
    });
    event.target.closest('.tab-btn').classList.remove('tab-inactive');
    event.target.closest('.tab-btn').classList.add('tab-active');
</script>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/admin/index.blade.php ENDPATH**/ ?>