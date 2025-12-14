<link href="<?php echo e(asset('assets/css/admin/employees.css')); ?>" rel="stylesheet"/>

<div id="employeeModal" class="modal-hidden">
    <div class="modal-content">

        <!-- HEADER -->
        <div class="modal-header">
            <h3 id="employeeModalTitle">Novi Zaposleni</h3>

            <button class="modal-close-btn" onclick="closeEmployeeModal()">
                ✕
            </button>
        </div>

        <!-- FORM -->
        <form id="employeeForm" method="POST" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
            <input type="hidden" id="employeeMethod" name="_method" value="POST">
            <input type="hidden" id="employeeId" name="id">

            <div class="modal-form">

                <div class="form-group">
                    <label>Ime *</label>
                    <input type="text" name="name" id="empName" required class="modal-input">
                </div>

                <div class="form-group">
                    <label>Prezime *</label>
                    <input type="text" name="last_name" id="empLastName" required class="modal-input">
                </div>

                <div class="form-group">
                    <label>Pozicija *</label>
                    <select name="position" id="empPosition" required class="modal-input">
                        <option value="">Izaberi poziciju</option>
                        <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($pos); ?>"><?php echo e($pos); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Biografija</label>
                    <textarea name="bio" id="empBio" rows="4" class="modal-input"></textarea>
                </div>

                <div class="form-group">
                    <label>Slika</label>
                    <input type="file" name="photo" class="modal-input">
                </div>

                <div class="modal-buttons">
                    <button type="submit" class="btn-primary">Sačuvaj</button>
                    <button type="button" class="btn-secondary" onclick="closeEmployeeModal()">Otkaži</button>
                </div>

            </div>
        </form>

    </div>
</div>
<?php /**PATH /var/www/html/resources/views/admin/employees/employeesModal.blade.php ENDPATH**/ ?>