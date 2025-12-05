<link href="{{ asset('assets/css/admin/products.css') }}" rel="stylesheet"/>

<div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 lg:p-10">

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-300 text-green-800 font-semibold px-4 py-3 rounded-xl flex items-center justify-between gap-4 shadow-md"
            role="alert">
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle fa-lg text-green-500"></i>
                <span class="text-sm">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-300 text-red-800 font-semibold px-4 py-3 rounded-xl flex items-center justify-between gap-4 shadow-md"
            role="alert">
            <div class="flex items-center gap-3">
                <i class="fas fa-exclamation-triangle fa-lg text-red-500"></i>
                <span class="text-sm">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="mb-8">
        <div class="flex gap-10 border-b border-gray-200">
            <button onclick="switchTab('products')"
                class="tab-btn tab-active pb-4 font-medium text-gray-500 hover:text-brand-600 transition-colors duration-200 ease-in-out"
                data-tab="products">
                <i class="fas fa-box-open fa-fw mr-2 align-text-bottom"></i>
                Proizvodi
            </button>
            <button onclick="switchTab('categories')"
                class="tab-btn tab-inactive pb-4 font-medium text-gray-500 hover:text-brand-600 transition-colors duration-200 ease-in-out"
                data-tab="categories">
                <i class="fas fa-tags fa-fw mr-2 align-text-bottom"></i>
                Kategorije
            </button>
        </div>
    </div>

    <div id="products-tab" class="tab-content">

        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-800">Upravljanje Proizvodima</h2>
                <p class="text-gray-500 mt-1">Pregledajte i administrirajte sve proizvode u vašoj prodavnici.</p>
            </div>
            <button onclick="openProductModal()"
                class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-200 shadow-lg shadow-brand-500/20 whitespace-nowrap">
                <i class="fas fa-plus fa-fw"></i>
                Dodaj Proizvod
            </button>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 mb-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Filteri</h3>
            </div>

            <form id="product-filter-form" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label for="product-search" class="block text-sm font-medium text-gray-600 mb-1">
                        Pretraga
                    </label>
                    <input type="text" id="product-search" name="search" placeholder="Pretraži proizvode..." value="{{ request('search') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-brand-500 focus:border-brand-500 transition">
                </div>

                <div>
                    <label for="product-category-filter" class="block text-sm font-medium text-gray-600 mb-1">
                        Kategorija
                    </label>
                    <select name="category" id="product-category-filter"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white focus:ring-brand-500 focus:border-brand-500 transition">
                        <option value="">Sve kategorije</option>
                        @foreach($allCategories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="w-full md:w-auto flex items-center justify-center gap-2 px-6 py-2.5 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition font-semibold shadow">
                        <i class="fas fa-search"></i>
                        Pretraži
                    </button>
                </div>

            </form>
        </div>

        <div id="products-card-grid" class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300">
                    <div class="flex flex-col md:flex-row h-auto md:h-64">
                        <div class="w-full md:w-1/2 bg-gray-100 flex-shrink-0">
                            @if($product->file_path)
                                <img src="{{ asset('storage/' . $product->file_path) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400 w-full md:h-64">
                                    <i class="fas fa-image fa-3x"></i>
                                </div>
                            @endif
                        </div>

                        <div class="w-full md:w-1/2 p-6 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $product->description ?? 'Nema dostupnog opisa' }}</p>
                                <div class="flex items-center gap-4 mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        <i class="fas fa-tag fa-fw mr-1"></i>
                                        {{ $product->category->name ?? 'N/A' }}
                                    </span>
                                    <p class="text-2xl font-extrabold text-brand-600">
                                        {{ number_format($product->price, 2) }} <span class="text-sm font-semibold">дин.</span>
                                    </p>
                                </div>
                            </div>

                            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                                <button
                                    onclick="editProduct({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ addslashes($product->description ?? '') }}', {{ $product->product_categories_id }})"
                                    class="inline-flex items-center justify-center w-10 h-10 bg-blue-50 text-blue-600 rounded-full hover:bg-blue-100 transition-colors"
                                    title="Izmeni">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Da li ste sigurni da želite da obrišete proizvod {{ addslashes($product->name) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-10 h-10 bg-red-50 text-red-600 rounded-full hover:bg-red-100 transition-colors"
                                        title="Obriši">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-center items-center mt-8 p-4 bg-white rounded-xl shadow-md border border-gray-100">
            <nav class="flex items-center space-x-1">
                @if($products->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <i class="fas fa-arrow-left fa-fw"></i>
                    </span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-arrow-left fa-fw"></i>
                    </a>
                @endif

                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if($page == $products->currentPage())
                        <span class="px-3 py-2 text-white bg-brand-600 rounded-lg font-semibold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-100 transition">{{ $page }}</a>
                    @endif
                @endforeach

                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-arrow-right fa-fw"></i>
                    </a>
                @else
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <i class="fas fa-arrow-right fa-fw"></i>
                    </span>
                @endif
            </nav>
        </div>

    </div>

    <div id="categories-tab" class="tab-content hidden">

        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-800">Upravljanje Kategorijama</h2>
                <p class="text-gray-500 mt-1">Kreirajte, uredite i organizujte kategorije za vaše proizvode.</p>
            </div>
            <button onclick="openCategoryModal()"
                class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-200 shadow-lg shadow-brand-500/20 whitespace-nowrap">
                <i class="fas fa-plus fa-fw"></i>
                Dodaj Kategoriju
            </button>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 mb-8">
            <form id="category-filter-form" method="GET" class="flex gap-4">
                <div class="flex-1">
                    <label for="category-search" class="block text-sm font-medium text-gray-600 mb-1">
                        Pretraga
                    </label>
                    <input type="text" id="category-search" name="category_search" placeholder="Pretraži kategorije..." value="{{ request('category_search') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-brand-500 focus:border-brand-500 transition">
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="flex items-center justify-center gap-2 px-6 py-2.5 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition font-semibold shadow">
                        <i class="fas fa-search"></i>
                        Pretraži
                    </button>
                </div>
            </form>
        </div>

        <div id="categories-card-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($categories as $category)
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 flex flex-col hover:shadow-2xl transition duration-300">

                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-lg font-semibold text-gray-900 mb-1">
                                <i class="fas fa-folder fa-fw text-brand-600 mr-2"></i> {{ $category->name }}
                            </p>
                            <code class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-mono ml-6">{{ $category->slug }}</code>
                        </div>

                        <p class="text-2xl font-bold text-gray-800">
                            {{ $category->products_count ?? 0 }}
                            <span class="text-sm font-medium text-gray-500 block text-right">Proizvoda</span>
                        </p>
                    </div>

                    <div class="mt-auto flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button
                            onclick="editCategory({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->slug) }}')"
                            class="inline-flex items-center justify-center w-10 h-10 bg-blue-50 text-blue-600 rounded-full hover:bg-blue-100 transition-colors"
                            title="Izmeni">
                            <i class="fas fa-edit"></i>
                        </button>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                            class="inline delete-form" data-id="{{ $category->id }}"
                            onsubmit="return confirm('Da li ste sigurni da želite da obrišete kategoriju {{ addslashes($category->name) }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center justify-center w-10 h-10 bg-red-50 text-red-600 rounded-full hover:bg-red-100 transition-colors"
                                title="Obriši">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-center items-center mt-8 p-4 bg-white rounded-xl shadow-md border border-gray-100">
            <nav class="flex items-center space-x-1">
                @if($categories->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <i class="fas fa-arrow-left fa-fw"></i>
                    </span>
                @else
                    <a href="{{ $categories->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-arrow-left fa-fw"></i>
                    </a>
                @endif

                @foreach($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                    @if($page == $categories->currentPage())
                        <span class="px-3 py-2 text-white bg-brand-600 rounded-lg font-semibold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-100 transition">{{ $page }}</a>
                    @endif
                @endforeach

                @if($categories->hasMorePages())
                    <a href="{{ $categories->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-arrow-right fa-fw"></i>
                    </a>
                @else
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <i class="fas fa-arrow-right fa-fw"></i>
                    </span>
                @endif
            </nav>
        </div>

    </div>
</div>
@include('admin.products.productModal')
@include('admin.products.categoryModal')

<script src="{{ asset('assets/js/admin/products.js') }}"></script>