
    <!-- PRODUCT MODAL -->
    <div id="productModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 px-8 py-6 border-b border-slate-100 bg-white rounded-t-2xl flex justify-between items-center">
                <h3 class="text-xl font-bold text-slate-800" id="productModalTitle">Novi Proizvod</h3>
                <button onclick="closeProductModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="productForm" method="POST" enctype="multipart/form-data"       action="{{ route('admin.products.store') }}" class="px-8 py-6 space-y-6">
                @csrf
                <input type="hidden" id="productMethod" name="_method" value="POST">
                <input type="hidden" id="productId">

                <div>
                    <label for="productName" class="block text-sm font-semibold text-slate-700 mb-2">Naziv *</label>
                    <input type="text" id="productName" name="name" required class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500">
                </div>

                <div>
                    <label for="productCategory" class="block text-sm font-semibold text-slate-700 mb-2">Kategorija *</label>
                    <select id="productCategory" name="product_categories_id" required class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">Odaberite kategoriju</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="productPrice" class="block text-sm font-semibold text-slate-700 mb-2">Cena *</label>
                    <input type="number" id="productPrice" name="price" required step="0.01" min="0" class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500">
                </div>

                <div>
                    <label for="productDescription" class="block text-sm font-semibold text-slate-700 mb-2">Opis</label>
                    <textarea id="productDescription" name="description" rows="4" class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500"></textarea>
                </div>

                <div>
                    <label for="productImage" class="block text-sm font-semibold text-slate-700 mb-2">Slika</label>
                    <input type="file" id="productImage" name="file_path" accept="image/*" class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <p class="text-xs text-slate-500 mt-2">Dozvoljeni formati: JPEG, PNG, JPG, GIF (maks. 2MB)</p>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
                    <button type="submit" class="px-6 py-3 bg-brand-500 text-white rounded-lg hover:bg-brand-600 transition-colors font-medium">
                        Sačuvaj
                    </button>
                    <button type="button" onclick="closeProductModal()" class="px-6 py-3 bg-slate-200 text-slate-800 rounded-lg hover:bg-slate-300 transition-colors font-medium">
                        Otkaži
                    </button>
                </div>
            </form>
        </div>
    </div>
