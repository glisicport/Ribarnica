<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proizvodi - Ribarnica Tfzr</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body { font-family: 'Inter', sans-serif; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Klasa za plavi tekst kada je filter aktivan (koristimo je za kategorije) */
        .active-filter {
             background-color: #eff6ff; /* blue-50 */
             color: #2563eb; /* blue-600 */
             font-weight: 500;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    @include('common.topbar')

    
    <div class="container mx-auto px-4 py-8 lg:py-12">
        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <aside class="w-full lg:w-1/4 lg:sticky lg:top-28 transition-all">
                
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Filteri</h2>
                    @if(request()->hasAny(['category', 'search', 'sort', 'min_price', 'max_price']))
                        <a href="{{ route('proizvodi') }}" class="text-xs font-semibold text-red-500 hover:text-red-700 uppercase tracking-wide">
                            Obriši sve
                        </a>
                    @endif
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-8">
                    
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-layer-group text-blue-600 mr-2"></i> Kategorije
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('proizvodi', request()->except(['category', 'page'])) }}" 
                               class="flex items-center justify-between group py-1.5 px-2 rounded-lg transition-colors {{ !request('category') ? 'active-filter font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <span>Svi proizvodi</span>
                                @if(!request('category')) <i class="fas fa-check text-xs"></i> @endif
                            </a>

                            @foreach($categories as $category)
                                <a href="{{ route('proizvodi', array_merge(request()->except(['page']), ['category' => $category->slug])) }}" 
                                   class="flex items-center justify-between group py-1.5 px-2 rounded-lg transition-colors {{ request('category') == $category->slug ? 'active-filter font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    
                                    <span class="capitalize">{{ $category->name }}</span>
                                    
                                    @if(request('category') == $category->slug)
                                        <i class="fas fa-check text-xs"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <div>
                        <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-tag text-blue-600 mr-2"></i> Cena (RSD)
                        </h3>
                        
                        <form action="{{ route('proizvodi') }}" method="GET">
                            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                            @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                            
                            <div class="flex items-center gap-2">
                               <div class="relative w-full">
                                   <input type="number" 
                                          name="min_price"
                                          value="{{ request('min_price') }}"
                                          placeholder="Od" 
                                          min="0"
                                          class="w-full pl-3 pr-2 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:bg-white outline-none">
                               </div>
                               <div class="relative w-full">
                                   <input type="number" 
                                          name="max_price"
                                          value="{{ request('max_price') }}"
                                          placeholder="Do" 
                                          min="0"
                                          class="w-full pl-3 pr-2 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:bg-white outline-none">
                               </div>
                            </div>
                            <button type="submit" class="w-full mt-3 bg-blue-600 text-white text-sm py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                                Primeni filter
                            </button>
                        </form>
                    </div>

                </div>
            </aside>

            <main class="w-full lg:w-3/4">
                
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
             
                      <div class="container mx-auto px-4 py-4">
            <form action="{{ route('proizvodi') }}" method="GET" class="max-w-3xl mx-auto relative group">
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                @if(request('min_price')) <input type="hidden" name="min_price" value="{{ request('min_price') }}"> @endif
                @if(request('max_price')) <input type="hidden" name="max_price" value="{{ request('max_price') }}"> @endif
                
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Pretražite svežu ribu, morske plodove..." 
                           class="w-full pl-12 pr-4 py-3 bg-gray-100 border-2 border-transparent focus:bg-white focus:border-blue-600 rounded-xl text-gray-900 placeholder-gray-500 transition-all duration-300 outline-none text-base">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg group-focus-within:text-blue-600 transition-colors"></i>
                    
                    @if(request('search'))
                        <a href="{{ route('proizvodi', request()->except('search')) }}" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 transition-colors">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
                    <form action="{{ route('proizvodi') }}" method="GET" class="flex items-center gap-3">
                        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('min_price')) <input type="hidden" name="min_price" value="{{ request('min_price') }}"> @endif
                        @if(request('max_price')) <input type="hidden" name="max_price" value="{{ request('max_price') }}"> @endif
                        
                        <label for="sort" class="text-sm font-medium text-gray-600 hidden sm:block">Sortiraj:</label>
                        <div class="relative">
                            <select name="sort" onchange="this.form.submit()" 
                                    class="appearance-none pl-4 pr-10 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 hover:bg-white transition-all">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Najnovije</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Cena: Rastuća</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Cena: Opadajuća</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Naziv: A-Z</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-xs text-gray-400 pointer-events-none"></i>
                        </div>
                    </form>
                </div>

                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                        <div class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col relative">
                            
                            <div class="relative aspect-[4/3] overflow-hidden bg-gray-50">
                                <img src="{{ asset('assets' . $product->file_path) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                     onerror="this.src='https://placehold.co/600x400?text=Nema+slike'">
                                
                                <span class="absolute top-3 left-3 px-2 py-1 bg-white/90 backdrop-blur-sm text-[10px] font-bold uppercase tracking-wider text-gray-800 rounded shadow-sm">
                                    {{ $product->category ? $product->category->name : 'Riba' }}
                                </span>
                            </div>

                            <div class="p-5 flex flex-col flex-grow">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                    {{ $product->name }}
                                </h3>
                                
                                <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-grow">
                                    {{ $product->description ?? 'Sveže i kvalitetno.' }}
                                </p>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-50 mt-auto">
                                    <div>
                                        <span class="text-xl font-bold text-blue-600">{{ number_format($product->price, 2, ',', '.') }}</span>
                                        <span class="text-xs text-gray-500 font-medium">RSD/kg</span>
                                    </div>
                                    
                                    <form action="#" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                                            <i class="fas fa-shopping-cart"></i> 
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $products->onEachSide(1)->links('pagination::tailwind') }}
                    </div>

                @else
                    <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 border-dashed">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 rounded-full mb-4">
                            <i class="fas fa-search text-2xl text-gray-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Nema pronađenih proizvoda</h3>
                        <p class="text-gray-500 mb-6">Pokušajte sa drugom kategorijom ili terminom pretrage.</p>
                        <a href="{{ route('proizvodi') }}" class="inline-flex items-center px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Prikaži sve proizvode
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-200 py-12 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Ribarnica Tfzr. Sva prava zadržana.</p>
        </div>
    </footer>

</body>
</html>