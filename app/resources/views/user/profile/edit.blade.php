<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'glavna': '#4f46e5',
                        'glavna-hover': '#4338ca',
                        'pozadina': '#eef2ff',
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body class="bg-pozadina">

<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('korisnicki-nalog') }}" class="flex items-center text-glavna hover:text-glavna-hover font-medium transition duration-200 mb-4">
                <i class="fas fa-arrow-left mr-2"></i> Vrati se nazad
            </a>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                Uredi Profil
            </h1>
            <p class="text-gray-500 mt-2">Ažurirajte svoje lične podatke i informacije o adresi.</p>
        </div>

        <!-- Success Message -->
        @if (session('status'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg flex items-start" role="alert">
                <i class="fas fa-check-circle mr-3 mt-0.5 flex-shrink-0"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- Edit Form -->
        <form action="{{ route('profil.update') }}" method="POST" class="bg-white shadow-lg rounded-lg p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Ime i Prezime -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="name">
                    Ime i Prezime *
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-user text-gray-400"></i>
                    </span>
                    <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
                                  @error('name') border-red-500 @else border-gray-300 @enderror" 
                           id="name" 
                           name="name" 
                           type="text" 
                           value="{{ old('name', $user->name) }}"
                           required>
                </div>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- E-mail -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">
                    E-mail Adresa *
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </span>
                    <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
                                  @error('email') border-red-500 @else border-gray-300 @enderror" 
                           id="email" 
                           name="email" 
                           type="email" 
                           value="{{ old('email', $user->email) }}"
                           required>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="phone">
                    Telefonski Broj
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-phone text-gray-400"></i>
                    </span>
                    <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
                                  @error('phone') border-red-500 @else border-gray-300 @enderror" 
                           id="phone" 
                           name="phone" 
                           type="tel" 
                           placeholder="+381..."
                           value="{{ old('phone', $user->phone) }}">
                </div>
                @error('phone')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="address">
                    Adresa
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                    </span>
                    <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
                                  @error('address') border-red-500 @else border-gray-300 @enderror" 
                           id="address" 
                           name="address" 
                           type="text" 
                           placeholder="npr. Ulica Petra Novakovića 10"
                           value="{{ old('address', $user->address) }}">
                </div>
                @error('address')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- City -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="city">
                    Grad
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-city text-gray-400"></i>
                    </span>
                    <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
                                  @error('city') border-red-500 @else border-gray-300 @enderror" 
                           id="city" 
                           name="city" 
                           type="text" 
                           placeholder="npr. Beograd"
                           value="{{ old('city', $user->city) }}">
                </div>
                @error('city')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Postal Code -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="postal_code">
                    Poštanski Broj
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-envelope-open-text text-gray-400"></i>
                    </span>
                    <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
                                  @error('postal_code') border-red-500 @else border-gray-300 @enderror" 
                           id="postal_code" 
                           name="postal_code" 
                           type="text" 
                           placeholder="npr. 11000"
                           value="{{ old('postal_code', $user->postal_code) }}">
                </div>
                @error('postal_code')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Country -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="country">
                    Država
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-globe text-gray-400"></i>
                    </span>
                    <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
                                  @error('country') border-red-500 @else border-gray-300 @enderror" 
                           id="country" 
                           name="country" 
                           type="text" 
                           placeholder="npr. Srbija"
                           value="{{ old('country', $user->country) }}">
                </div>
                @error('country')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 py-3 text-white font-bold rounded-lg bg-gradient-to-r from-glavna to-indigo-500 hover:from-glavna-hover hover:to-indigo-600 focus:outline-none focus:ring-4 focus:ring-glavna/50 transition duration-300 transform hover:scale-[1.01]">
                    <i class="fas fa-save mr-2"></i> Sačuvaj Izmene
                </button>
                <a href="{{ route('korisnicki-nalog') }}" class="py-3 px-6 text-gray-700 font-bold rounded-lg bg-gray-200 hover:bg-gray-300 focus:outline-none transition duration-300">
                    <i class="fas fa-times mr-2"></i> Otkaži
                </a>
            </div>
        </form>

        <!-- Change Password Link -->
        <div class="mt-8 bg-white shadow-lg rounded-lg p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Promena Lozinke</h3>
                    <p class="text-gray-500 text-sm mt-1">Ažurirajte vašu lozinku da ostanete sigurni.</p>
                </div>
                <a href="{{ route('profil.change-password') }}" class="py-2 px-6 text-white font-bold rounded-lg bg-gradient-to-r from-glavna to-indigo-500 hover:from-glavna-hover hover:to-indigo-600 focus:outline-none focus:ring-4 focus:ring-glavna/50 transition duration-300">
                    <i class="fas fa-key mr-2"></i> Promeni Lozinku
                </a>
            </div>
        </div>

    </div>
</div>

</body>
</html>
