<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt podešavanja – Admin panel</title>

    @include('common.scripts')

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: { 500:'#0ea5e9', 600:'#0284c7' }
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="{{ asset('assets/css/admin/dashboard.css') }}">
</head>
<body class="bg-slate-50 text-slate-800">

<input type="checkbox" id="sidebar-toggle" class="hidden">
<label for="sidebar-toggle"
       class="overlay hidden fixed inset-0 bg-slate-900/50 z-40 lg:hidden"></label>

<div class="flex h-screen overflow-hidden">

    @include('common.sidebar')

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        @include('common.admin_topbar')

        <div class="flex-1 overflow-y-auto p-6 lg:p-10">

            <div class="max-w-3xl mx-auto">

                <div class="mb-8">
                    <a href="{{ route('kontrolni-panel') }}" 
                       class="text-sm text-slate-500 hover:text-slate-700 inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Nazad na kontrolni panel
                    </a>
                </div>

                <div class="bg-white border border-slate-200 p-8 rounded-2xl shadow-sm">

                    <h1 class="text-2xl font-semibold mb-2">Kontakt informacije</h1>
                    <p class="text-sm text-slate-500 mb-6">
                        Ove informacije se prikazuju korisnicima na stranici Kontakt.
                    </p>

                    @if (session('status'))
                        <div class="mb-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.contact.settings.save') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Naziv ustanove --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Naziv</label>
                            <input type="text" name="name"
                                   value="{{ old('name', $contact->name ?? '') }}"
                                   class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500">
                        </div>

                        {{-- Opis / Uvodni tekst --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Uvodni tekst</label>
                            <textarea name="message" rows="4"
                                      class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500">{{ old('message', $contact->message ?? '') }}</textarea>
                        </div>

                        {{-- Telefon --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Telefon</label>
                            <input type="text" name="phone"
                                   value="{{ old('phone', $contact->phone ?? '') }}"
                                   class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                            <input type="email" name="email"
                                   value="{{ old('email', $contact->email ?? '') }}"
                                   class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500">
                        </div>

                        {{-- Radno vreme --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Radno vreme</label>
                            <input type="text" name="hours"
                                   value="{{ old('hours', $contact->hours ?? 'Pon–Pet: 07–20h / Sub: 07–18h / Ned: 08–15h') }}"
                                   class="w-full border border-slate-300 rounded-lg px-4 py-2.5 text-sm focus:border-brand-500 focus:ring-brand-500">
                        </div>

                        {{-- Submit --}}
                        <button class="px-6 py-2.5 rounded-full bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold shadow">
                            <i class="fas fa-save mr-2"></i> Sačuvaj izmene
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </main>

</div>

</body>
</html>
