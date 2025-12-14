<?php
  $employees = \App\Models\Employee::orderBy('created_at','desc')->get();

$positions = \App\Models\Employee::select('position')
                ->distinct()
                ->pluck('position');

?>
<link href="<?php echo e(asset('assets/css/admin/employees.css')); ?>" rel="stylesheet"/>

<div class="wrapper">

    <div class="header">
        <div>
            <h2 class="title">Upravljanje Zaposlenima</h2>
            <p class="subtitle">Pregled i administracija zaposlenih u ribarnici.</p>
        </div>

        <button class="btn-add" onclick="openEmployeeModalNew()">
            <i class="fas fa-plus"></i> Dodaj Zaposlenog
        </button>
    </div>

    <!-- FILTERI -->
    <div class="filters-box">
        <form class="filters">

            <div class="filter-item">
                <label>Pretraga:</label>
                <input type="text" id="employee-search" placeholder="Pretraži po imenu...">
            </div>

            <div class="filter-item">
                <label>Pozicija:</label>
                <select id="employee-position">
                    <option value="">Sve pozicije</option>
                    <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(strtolower($pos)); ?>"><?php echo e($pos); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

        </form>
    </div>

    <!-- GRID ZAPOSLENIH -->
    <div id="employees-grid" class="grid">

        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card"
                data-name="<?php echo e(strtolower($emp->name . ' ' . $emp->last_name)); ?>"
                data-position="<?php echo e(strtolower($emp->position)); ?>">

                <img src="<?php echo e(asset('storage/' . $emp->photo)); ?>" class="photo">

                <div class="content">
                    <h3 class="emp-name"><?php echo e($emp->name); ?> <?php echo e($emp->last_name); ?></h3>
                    <p class="emp-position"><?php echo e($emp->position); ?></p>
                    <p class="emp-bio"><?php echo e($emp->bio); ?></p>

                    <div class="actions">

                        
                        <button class="btn-edit"
                                onclick="editEmployee({
                                    id: <?php echo e($emp->id); ?>,
                                    name: '<?php echo e($emp->name); ?>',
                                    last_name: '<?php echo e($emp->last_name); ?>',
                                    position: '<?php echo e($emp->position); ?>',
                                    bio: '<?php echo e(str_replace(["\n", "\r"], ' ', $emp->bio)); ?>'
                                })">
                            <i class="fas fa-edit"></i>
                        </button>

                        
                        <form action="<?php echo e(route('admin.employees.destroy', $emp->id)); ?>"
                              method="POST"
                              onsubmit="return confirm('Da li ste sigurni da želite da obrišete zaposlenog <?php echo e($emp->name); ?>?');">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button type="submit" class="btn-delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>

<script src="<?php echo e(asset('assets/js/admin/employees.js')); ?>"></script>

<?php echo $__env->make('admin.employees.employeesModal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /var/www/html/resources/views/admin/employees/index.blade.php ENDPATH**/ ?>