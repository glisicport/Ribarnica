<link href="<?php echo e(asset('assets/css/admin/products.css')); ?>" rel="stylesheet"/>

<div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 lg:p-10">

    
    <?php if(session('success')): ?>
        <div class="mb-6 bg-green-50 border border-green-300 text-green-800 font-semibold px-4 py-3 rounded-xl flex items-center justify-between gap-4 shadow-md" role="alert">
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle fa-lg text-green-500"></i>
                <span class="text-sm"><?php echo e(session('success')); ?></span>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-6 bg-red-50 border border-red-300 text-red-800 font-semibold px-4 py-3 rounded-xl flex items-center justify-between gap-4 shadow-md" role="alert">
            <div class="flex items-center gap-3">
                <i class="fas fa-exclamation-triangle fa-lg text-red-500"></i>
                <span class="text-sm"><?php echo e(session('error')); ?></span>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-800">Galerija TFZR</h2>
            <p class="text-gray-500 mt-1">Upravljajte slikama galerije</p>
        </div>
        <div class="flex gap-2">
            <button onclick="document.getElementById('addImageModal').showModal()"
                    class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-200 shadow-lg shadow-brand-500/20 whitespace-nowrap">
                <i class="fas fa-plus fa-fw"></i>
                Dodaj Sliku
            </button>

            <button onclick="document.getElementById('renameImageModal').showModal()"
                    class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-200 shadow-lg shadow-brand-500/20 whitespace-nowrap">
                <i class="fas fa-i-cursor"></i>
                Izmeni
            </button>
        </div>
    </div>

    
    <?php
        $folderPath = storage_path('app/public/images/ambijent');
        $files = File::exists($folderPath) ? File::files($folderPath) : [];
    ?>

    <?php if(count($files) > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $fileName = $file->getFilename();
                    $fileUrl = asset('storage/images/ambijent/' . $fileName);
                ?>
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300">

                    
                    <div class="w-full h-64 bg-gray-100 flex items-center justify-center overflow-hidden">
                        <img src="<?php echo e($fileUrl); ?>" 
                             class="w-full h-full object-cover" 
                             alt="<?php echo e(pathinfo($fileName, PATHINFO_FILENAME)); ?>"
                             onerror="this.onerror=null;this.src='<?php echo e(asset('assets/images/placeholder.png')); ?>';">
                    </div>

                    
                    <div class="p-4 flex flex-col justify-between min-h-[100px]">
                        <span class="text-gray-900 font-semibold truncate"><?php echo e(pathinfo($fileName, PATHINFO_FILENAME)); ?></span>
                        <div class="flex justify-end gap-2 mt-3">

                            
                            <button onclick="openEditModal('<?php echo e($fileName); ?>')"
                                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-200 shadow-lg shadow-blue-500/20 whitespace-nowrap">
                                <i class="fas fa-edit"></i>
                                Izmeni Sliku
                            </button>

                            
                            <form action="<?php echo e(route('admin.gallery.delete', $fileName)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-200 shadow-lg shadow-red-500/20 whitespace-nowrap"
                                        onclick="return confirm('Da li ste sigurni da želite obrisati sliku?');">
                                    <i class="fas fa-trash"></i>
                                    Obriši Sliku
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Još uvek nema slika</h3>
            <p class="text-gray-600">Dodajte prvu sliku klikom na dugme iznad.</p>
        </div>
    <?php endif; ?>

</div>


<dialog id="addImageModal" class="rounded-xl shadow-xl p-6 backdrop:bg-black/50">
    <h3 class="text-xl font-semibold mb-4">Dodaj novu sliku</h3>

    <form method="POST" action="<?php echo e(route('admin.gallery.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <label class="block text-sm font-medium mb-1">Naziv slike:</label>
        <input type="text" name="naziv_slike" class="w-full border rounded-lg p-2 mb-4" required>

        <label class="block text-sm font-medium mb-1">Kategorija:</label>
        <select name="kategorija" class="w-full border rounded-lg p-2 mb-4" required>
            <option value="">-- Izaberite kategoriju --</option>
            <option value="Enterijer">Enterijer</option>
            <option value="Eksterijer">Eksterijer</option>
        </select>

        <label class="block text-sm font-medium mb-1">Odaberite sliku:</label>
        <input type="file" name="image" class="w-full border rounded-lg p-2 mb-6" required>

        <div class="flex justify-end gap-3">
            <button type="button" onclick="document.getElementById('addImageModal').close();" class="px-4 py-2 bg-slate-200 rounded-lg">Otkaži</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg">Dodaj</button>
        </div>
    </form>
</dialog>


<dialog id="editImageModal" class="rounded-xl shadow-xl p-6 backdrop:bg-black/50">
    <h3 class="text-xl font-semibold mb-4">Izmeni sliku</h3>

    <form method="POST" id="editImageForm" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label class="block text-sm font-medium mb-1">Naziv slike:</label>
        <input type="text" name="naziv_slike" id="editImageName" class="w-full border rounded-lg p-2 mb-4" required>

        <label class="block text-sm font-medium mb-1">Zameni fajl (opciono):</label>
        <input type="file" name="image" class="w-full border rounded-lg p-2 mb-6">

        <div class="flex justify-end gap-3">
            <button type="button" onclick="document.getElementById('editImageModal').close();" class="px-4 py-2 bg-slate-200 rounded-lg">Otkaži</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg">Sačuvaj</button>
        </div>
    </form>
</dialog>


<dialog id="renameImageModal" class="rounded-xl shadow-xl p-6 backdrop:bg-black/50">
    <h3 class="text-xl font-semibold mb-4">Izmeni naziv slike</h3>

    <?php
        $folderFiles = File::exists($folderPath) ? File::files($folderPath) : [];
    ?>

    <form method="POST" id="renameImageForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label class="block text-sm font-medium mb-1">Izaberite sliku:</label>
        <select name="stari_naziv" id="renameSelect" class="w-full border rounded-lg p-2 mb-4" required>
            <option value="">-- Izaberite fajl --</option>
            <?php $__currentLoopData = $folderFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($file->getFilename()); ?>"><?php echo e(pathinfo($file->getFilename(), PATHINFO_FILENAME)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <label class="block text-sm font-medium mb-1">Novi naziv slike:</label>
        <input type="text" name="novi_naziv" id="renameImageName" class="w-full border rounded-lg p-2 mb-6" required>

        <div class="flex justify-end gap-3">
            <button type="button" onclick="document.getElementById('renameImageModal').close();" class="px-4 py-2 bg-slate-200 rounded-lg">Otkaži</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg">Sačuvaj naziv</button>
        </div>
    </form>
</dialog>

<script>
function openEditModal(fileName) {
    document.getElementById('editImageName').value = fileName.replace(/\.[^/.]+$/, "");
    document.getElementById('editImageForm').action = '/admin/gallery/update/' + fileName;
    document.getElementById('editImageModal').showModal();
}

// Dinamički postavlja action forme za rename
const renameForm = document.getElementById('renameImageForm');
const renameSelect = document.getElementById('renameSelect');
const renameInput = document.getElementById('renameImageName');

renameSelect.addEventListener('change', function() {
    const fileName = this.value;
    if(fileName) {
        renameForm.action = '/admin/gallery/rename/' + fileName; // PUT ruta
        renameInput.value = fileName;
    } else {
        renameForm.action = '';
        renameInput.value = '';
    }
});
</script>
<?php /**PATH /var/www/html/resources/views/admin/gallery/index.blade.php ENDPATH**/ ?>