<h2 class="text-xl font-semibold mb-4">FAQ</h2>


<form action="<?php echo e(route('kontrolni-panel.store', 'faq')); ?>" method="POST" class="mb-6">
    <?php echo csrf_field(); ?>
    <input type="text" name="question" placeholder="Pitanje" class="border rounded px-2 py-1 w-full mb-2" required>
    <textarea name="answer" placeholder="Odgovor" class="border rounded px-2 py-1 w-full mb-2" required></textarea>
    <div class="flex gap-4 items-center">
        <input type="number" name="order" placeholder="Redosled" class="border rounded px-2 py-1 w-24" value="0">
        <label>
            <input type="checkbox" name="is_active" value="1" checked> Aktivno
        </label>
        <button type="submit" class="px-4 py-1 bg-sky-600 text-white rounded">Dodaj</button>
    </div>
</form>

<?php if($items->isEmpty()): ?>
    <p>Još uvek nema postavljenih pitanja.</p>
<?php else: ?>
    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th>#</th>
                <th>Pitanje</th>
                <th>Odgovor</th>
                <th>Redosled</th>
                <th>Aktivno</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-t">
                    <td><?php echo e($faq->id); ?></td>
                    <td>
                        <form action="<?php echo e(route('kontrolni-panel.update', ['resource' => 'faq','id'=>$faq->id])); ?>" method="POST" class="flex flex-col gap-1">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="text" name="question" value="<?php echo e($faq->question); ?>" class="border px-1 py-0.5 w-full">
                    </td>
                    <td>
                            <textarea name="answer" class="border px-1 py-0.5 w-full"><?php echo e($faq->answer); ?></textarea>
                    </td>
                    <td>
                            <input type="number" name="order" value="<?php echo e($faq->order); ?>" class="border px-1 py-0.5 w-16">
                    </td>
                    <td class="text-center">
                            <input type="checkbox" name="is_active" value="1" <?php echo e($faq->is_active ? 'checked' : ''); ?>>
                    </td>
                    <td class="flex gap-2">
                            <button type="submit" class="px-2 py-1 bg-green-600 text-white text-xs rounded">Sačuvaj</button>
                        </form>

                        
                        <form action="<?php echo e(route('kontrolni-panel.destroy', ['resource' => 'faq','id'=>$faq->id])); ?>" method="POST" onsubmit="return confirm('Obrisati pitanje?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="px-2 py-1 bg-red-600 text-white text-xs rounded">Obriši</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    
    <div class="mt-4">
        <?php echo e($items->links()); ?>

    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/contact/partials/faq_table.blade.php ENDPATH**/ ?>