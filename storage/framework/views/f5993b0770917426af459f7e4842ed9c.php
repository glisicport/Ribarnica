<!-- PRODUCT MODAL -->
<div id="productModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 px-6 py-5 border-b border-slate-100 bg-white rounded-t-2xl flex justify-between items-center">
            <h3 class="text-lg sm:text-xl font-bold text-slate-800" id="productModalTitle">Novi proizvod</h3>
            <button onclick="closeProductModal()" class="text-slate-400 hover:text-slate-600 transition-colors" aria-label="Zatvori modal">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="productForm" method="POST" enctype="multipart/form-data"
              action="<?php echo e(route('admin.products.store')); ?>"
              class="px-6 py-6 space-y-6">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="productMethod" name="_method" value="POST">
            <input type="hidden" id="productId" name="id">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="productName" class="block text-sm font-semibold text-slate-700 mb-2">Naziv *</label>
                    <input type="text" id="productName" name="name" required
                           class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500"
                           placeholder="Unesite naziv proizvoda">
                </div>

                <div>
                    <label for="productCategory" class="block text-sm font-semibold text-slate-700 mb-2">Kategorija *</label>
                    <select id="productCategory" name="product_categories_id" required
                            class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">Odaberite kategoriju</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label for="productPrice" class="block text-sm font-semibold text-slate-700 mb-2">Cena *</label>
                    <div class="relative">
                        <input type="number" id="productPrice" name="price" required step="0.01" min="0"
                               class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 pr-20"
                               placeholder="0.00">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-slate-500">din.</span>
                    </div>
                </div>

                <div>
                    <label for="productStock" class="block text-sm font-semibold text-slate-700 mb-2">Stanje *</label>
                    <input type="number" id="productStock" name="stock" required min="0" step="1"
                           class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500"
                           value="0" placeholder="Broj artikala na stanju">
                    <p class="text-xs text-slate-500 mt-1">Unesite broj dostupnih artikala (0 = nema na stanju).</p>
                </div>

                <div class="sm:col-span-2">
                    <label for="productDescription" class="block text-sm font-semibold text-slate-700 mb-2">Opis</label>
                    <textarea id="productDescription" name="description" rows="4"
                              class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500"
                              placeholder="Opcionalno: kratki opis proizvoda"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-start">
                <div>
                    <label for="productImage" class="block text-sm font-semibold text-slate-700 mb-2">Slika</label>
                    <div id="imageUploadContainer" class="w-full rounded-lg border-2 border-dashed border-slate-200 p-3 cursor-pointer hover:border-slate-300 transition-colors">
                        <input type="file" id="productImage" name="file_path" accept="image/*" class="hidden" onchange="handleImagePreview(event)">
                        <div id="imagePlaceholder" class="flex flex-col items-center justify-center gap-3 py-8 text-center">
                            <i class="fas fa-cloud-upload-alt text-4xl text-slate-400"></i>
                            <div>
                                <p class="text-sm font-medium text-slate-700">Kliknite da odaberete sliku</p>
                                <p class="text-xs text-slate-500 mt-1">JPEG, PNG, WebP do 20MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pregled slike</label>
                    <div class="w-full h-40 rounded-lg border border-slate-200 overflow-hidden flex items-center justify-center bg-slate-50">
                        <img id="productImagePreview" src="" alt="Preview" class="object-contain max-h-full hidden">
                        <div id="noImagePreview" class="text-sm text-slate-400">Nema izabrane slike</div>
                    </div>

                    <div class="mt-auto">
                        <div class="flex items-center justify-between gap-3 pt-4 border-t border-slate-100">
                            <button type="submit" class="px-6 py-3 bg-brand-500 text-white rounded-lg hover:bg-brand-600 transition-colors font-medium">
                                Sačuvaj
                            </button>
                            <button type="button" onclick="closeProductModal()" class="px-6 py-3 bg-slate-200 text-slate-800 rounded-lg hover:bg-slate-300 transition-colors font-medium">
                                Otkaži
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div><?php /**PATH /var/www/html/resources/views/admin/products/productModal.blade.php ENDPATH**/ ?>