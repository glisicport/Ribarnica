  
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Porudžbina #{{ $order->id }}</h1>
            <p class="text-slate-500 mt-1">{{ $order->created_at->format('d. F Y. u H:i') }}</p>
        </div>
        <a href="{{ route('kontrolni-panel', ['page_type' => 'orders']) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
            <i class="fas fa-arrow-left mr-2"></i> Nazad
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600 text-lg"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-4">Stavke Porudžbine</h2>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 border-b">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-slate-700">Proizvod</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-700">Količina</th>
                                <th class="px-4 py-3 text-right font-semibold text-slate-700">Cena</th>
                                <th class="px-4 py-3 text-right font-semibold text-slate-700">Ukupno</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach($order->items as $item)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 rounded bg-slate-100 overflow-hidden flex-shrink-0">
                                                @if(!empty($item->product->file_path))
                                                    <img src="{{ asset('storage/' . $item->product->file_path) }}" alt="" class="w-full h-full object-cover">
                                                @else
                                                    <i class="fas fa-image text-slate-400"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-medium text-slate-900">{{ $item->product->name }}</p>
                                                <p class="text-xs text-slate-500">#{{ $item->product->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center font-medium text-slate-900">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 text-right font-medium text-slate-900">{{ number_format($item->price, 2) }} RSD</td>
                                    <td class="px-4 py-3 text-right font-bold text-slate-900">{{ number_format($item->quantity * $item->price, 2) }} RSD</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t mt-4 pt-4">
                    <div class="flex justify-end">
                        <div class="text-right">
                            <p class="text-slate-600 mb-2">Ukupan iznos:</p>
                            <p class="text-2xl font-bold text-slate-900">{{ number_format($order->total_amount, 2) }} RSD</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-4">Podaci Kupca</h2>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-slate-600 font-semibold uppercase tracking-wide mb-1">Ime i Prezime</p>
                        <p class="text-slate-900 font-medium">{{ $order->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 font-semibold uppercase tracking-wide mb-1">Email</p>
                        <p class="text-slate-900 font-medium">{{ $order->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 font-semibold uppercase tracking-wide mb-1">Telefonski Broj</p>
                        <p class="text-slate-900 font-medium">{{ $order->phone_or_email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 font-semibold uppercase tracking-wide mb-1">Korisnik ID</p>
                        <p class="text-slate-900 font-medium">{{ $order->user->id }}</p>
                    </div>
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-4">Adresa Isporuke</h2>
                
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-slate-600 font-semibold uppercase tracking-wide mb-1">Ulica i Kuća</p>
                        <p class="text-slate-900 font-medium">{{ $order->address }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-slate-600 font-semibold uppercase tracking-wide mb-1">Poštanski Broj</p>
                            <p class="text-slate-900 font-medium">{{ $order->postal_code }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <aside class="space-y-6">
            
            <!-- Status Management -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Status Porudžbine</h3>

                <div class="mb-4 p-4 rounded-lg border-2 border-slate-200 bg-slate-50">
                    @if($order->status === 'pending')
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                            <span class="font-bold text-yellow-700">Čeka Potvrdu</span>
                        </div>
                        <p class="text-xs text-slate-600">Porudžbina je primljena i čeka potvrdu admina.</p>
                    @elseif($order->status === 'confirmed')
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-check text-blue-600 text-xl"></i>
                            <span class="font-bold text-blue-700">Potvrđena</span>
                        </div>
                        <p class="text-xs text-slate-600">Porudžbina je potvrđena i spremna za slanje.</p>
                    @elseif($order->status === 'shipped')
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-truck text-purple-600 text-xl"></i>
                            <span class="font-bold text-purple-700">Poslata</span>
                        </div>
                        <p class="text-xs text-slate-600">Porudžbina je poslata i u puti.</p>
                    @elseif($order->status === 'delivered')
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            <span class="font-bold text-green-700">Dostavljena</span>
                        </div>
                        <p class="text-xs text-slate-600">Porudžbina je uspešno dostavljena.</p>
                    @elseif($order->status === 'cancelled')
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-times-circle text-red-600 text-xl"></i>
                            <span class="font-bold text-red-700">Otkazana</span>
                        </div>
                        <p class="text-xs text-slate-600">Ova porudžbina je otkazana.</p>
                    @endif
                </div>

                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="space-y-2">
                    @csrf
                    @method('PATCH')

                    <label class="block text-sm font-medium text-slate-700 mb-2">Promeni Status:</label>
                    <select name="status" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending" @if($order->status === 'pending') selected @endif>Čeka Potvrdu</option>
                        <option value="confirmed" @if($order->status === 'confirmed') selected @endif>Potvrđena</option>
                        <option value="shipped" @if($order->status === 'shipped') selected @endif>Poslata</option>
                        <option value="delivered" @if($order->status === 'delivered') selected @endif>Dostavljena</option>
                        <option value="cancelled" @if($order->status === 'cancelled') selected @endif>Otkazana</option>
                    </select>

                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i> Sačuvaj Status
                    </button>
                </form>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Brze Akcije</h3>

                @if($order->status !== 'confirmed')
                    <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                            <i class="fas fa-check mr-2"></i> Potvrdi Porudžbinu
                        </button>
                    </form>
                @endif

                <a href="{{ route('kontrolni-panel', ['page_type' => 'orders']) }}" class="block w-full px-4 py-2 text-center border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition">
                    <i class="fas fa-list mr-2"></i> Sve Porudžbine
                </a>
            </div>

            <!-- Order Meta -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Informacije</h3>

                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-slate-600 font-semibold mb-1">ID Porudžbine</p>
                        <p class="text-slate-900 font-mono">#{{ $order->id }}</p>
                    </div>
                    <div>
                        <p class="text-slate-600 font-semibold mb-1">Kreirano</p>
                        <p class="text-slate-900">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-slate-600 font-semibold mb-1">Broj Stavki</p>
                        <p class="text-slate-900">{{ $order->items->count() }}</p>
                    </div>
                    <div>
                        <p class="text-slate-600 font-semibold mb-1">Korisnik</p>
                        <p class="text-slate-900">{{ $order->user->name }}</p>
                    </div>
                </div>
            </div>

        </aside>

    </div>
</div>
