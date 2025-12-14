a<h2 class="text-2xl font-semibold mb-4">Pitanja korisnika</h2>

<?php if(session('status')): ?>
    <p class="mb-4 text-green-700 bg-green-100 px-4 py-2 rounded"><?php echo e(session('status')); ?></p>
<?php endif; ?>

<?php if($questions->isEmpty()): ?>
    <p class="text-gray-500">Još uvek nema postavljenih pitanja.</p>
<?php else: ?>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Datum</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Korisnik</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Pitanje</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Odgovor</th>
                    <th class="px-4 py-2 text-left text-gray-600 font-medium">Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-2 text-gray-700"><?php echo e($q->created_at->format('d.m.Y. H:i')); ?></td>
                        <td class="px-4 py-2 text-gray-700"><?php echo e($q->username); ?></td>
                        <td class="px-4 py-2 text-gray-700"><?php echo e($q->message); ?></td>
                        <td class="px-4 py-2 text-gray-700">
                            <?php if($q->comment): ?>
                                <?php echo e($q->comment); ?>

                            <?php else: ?>
                                <span class="italic text-gray-400">Nema odgovora</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2 flex flex-col gap-2">
                            <form method="POST" action="<?php echo e(route('kontrolni-panel.update', ['resource' => 'questions', 'id' => $q->id])); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <textarea name="comment" rows="2" class="w-full border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400"><?php echo e($q->comment); ?></textarea>
                                <button type="submit" class="mt-1 w-full bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Sačuvaj odgovor</button>
                            </form>

                            <form method="POST" action="<?php echo e(route('kontrolni-panel.destroy', ['resource' => 'questions', 'id' => $q->id])); ?>" onsubmit="return confirm('Obrisati pitanje?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="w-full bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">Obriši</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($questions->links('pagination::tailwind')); ?>

    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/contact/partials/questions_table.blade.php ENDPATH**/ ?>