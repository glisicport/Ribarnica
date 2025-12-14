<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt – Ribarnica TFZR</title>
    @include('common.scripts')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body class="bg-slate-50 text-slate-900">

@include('common.topbar')

<main class="contact-hero py-12 md:py-16">
    <div class="container mx-auto px-4 max-w-6xl">

        {{-- OSNOVNE INFORMACIJE --}}
        <section class="contact-glass p-6 md:p-10 mb-10 bg-white border border-slate-200 rounded-2xl shadow-sm">
            <div class="flex flex-col lg:flex-row gap-10 items-start lg:items-center">

                {{-- LEVI BLOK --}}
                <div class="flex-1 space-y-4">
                    <div class="inline-flex items-center gap-3 fish-badge bg-sky-50 border border-sky-100 px-4 py-1 rounded-full">
                        <i class="fas fa-fish text-sky-500"></i>
                        <span class="text-xs tracking-[0.2em] uppercase text-sky-700">
                            {{ $contactInfo->store_name ?? 'TFZR Ribarnica' }}
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold leading-tight text-slate-900">
                        {{ $contactInfo->title ?? 'Ribarnica TFZR' }}
                    </h1>

                    <p class="text-slate-600 text-base md:text-lg max-w-xl">
                        {{ $contactInfo->subtitle ?? 'Dobrodošli u studentsku ribarnicu TFZR – mesto gde se tradicija, znanje i sveža riba sreću na jednom mestu.' }}
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4">
                        {{-- Telefon --}}
                        <div class="contact-card bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.16em] text-slate-400 mb-1">
                                {{ $contactInfo->phone_label ?? 'Telefon' }}
                            </p>
                            <p class="font-semibold text-slate-900 text-lg flex items-center gap-2">
                                <i class="fas fa-phone-alt text-emerald-500"></i>
                                {{ $contactInfo->phone_value ?? '+381 61 234 5678' }}
                            </p>
                        </div>

                        {{-- Email --}}
                        <div class="contact-card bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.16em] text-slate-400 mb-1">
                                {{ $contactInfo->email_label ?? 'Email' }}
                            </p>
                            <p class="font-semibold text-slate-900 text-lg flex items-center gap-2">
                                <i class="fas fa-envelope-open-text text-sky-500"></i>
                                {{ $contactInfo->email_value ?? 'tfzrribarnica@gmail.com' }}
                            </p>
                        </div>

                        {{-- Radno vreme --}}
                        <div class="contact-card bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.16em] text-slate-400 mb-1">
                                {{ $contactInfo->hours_label ?? 'Radno vreme' }}
                            </p>
                            <p class="font-semibold text-slate-900 text-sm leading-relaxed">
                                {{ $contactInfo->hours_value ?? 'Pon–Pet: 07–20h · Subota: 07–18h · Nedelja: 08–15h' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- DESNI BLOK – BRZE ČINJENICE --}}
                <div class="w-full lg:w-72 contact-card bg-sky-50 border border-sky-100 rounded-2xl p-5 shadow-sm">
                    <h3 class="text-lg font-semibold mb-3 flex items-center gap-2 text-slate-900">
                        <i class="fas fa-store-alt text-amber-400"></i>
                        Brze činjenice
                    </h3>
                    <ul class="space-y-2 text-sm text-slate-700">
                        @forelse($quickFacts as $fact)
                            <li class="flex gap-3">
                                <span class="text-sky-500">•</span>
                                <span>{{ $fact->text }}</span>
                            </li>
                        @empty
                            <li class="text-sm text-slate-500">Još uvek nema brzih činjenica.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </section>

        {{-- FORMA I FAQ --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- LEVO – Forma za pitanja --}}
            <section class="contact-card bg-white border border-slate-200 rounded-2xl p-6 md:p-7 shadow-sm">
                <h2 class="text-2xl font-semibold mb-1 flex items-center gap-2 text-slate-900">
                    <i class="fas fa-question-circle text-sky-500"></i>
                    Postavite pitanje
                </h2>
                <p class="text-sm text-slate-500 mb-5">
                    Imate pitanje o ponudi, dostavi ili pripremi ribe? Napišite nam poruku.
                </p>

                @if(session('status'))
                    <div class="mb-4 text-sm font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 px-4 py-2 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 text-sm text-red-700 bg-red-50 border border-red-200 px-4 py-2 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-1">Ime i prezime</label>
                        <input type="text" id="username" name="username" required
                               value="{{ old('username') }}"
                               class="w-full px-4 py-2.5 rounded-lg bg-white border border-slate-300 text-slate-900 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email (opciono)</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               class="w-full px-4 py-2.5 rounded-lg bg-white border border-slate-300 text-slate-900 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
                        <p class="text-xs text-slate-400 mt-1">Email koristimo samo da bismo vam odgovorili.</p>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-700 mb-1">Vaše pitanje</label>
                        <textarea id="message" name="message" rows="4" required
                                  class="w-full px-4 py-2.5 rounded-lg bg-white border border-slate-300 text-slate-900 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 resize-y">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 px-6 py-2.5 rounded-full text-sm font-semibold text-white shadow-sm transition-transform duration-150 active:scale-95">
                        <i class="fas fa-paper-plane"></i>
                        Pošalji pitanje
                    </button>
                </form>
            </section>

            {{-- DESNO – FAQ i poslednja pitanja --}}
            <section class="space-y-6">
                {{-- Najčešća pitanja --}}
                <div class="contact-card bg-white border border-slate-200 rounded-2xl p-6 md:p-7 shadow-sm">
                    <h2 class="text-2xl font-semibold mb-1 flex items-center gap-2 text-slate-900">
                        <i class="fas fa-comments text-amber-400"></i>
                        Najčešća pitanja
                    </h2>
                    <p class="text-sm text-slate-500 mb-5">Pre nego što pošaljete pitanje, možda je odgovor već ovde.</p>

                    <div class="space-y-3">
                        @forelse($faqs as $faq)
                            <article class="faq-item border border-slate-200 rounded-xl overflow-hidden" data-faq>
                                <button type="button" class="faq-question w-full flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100">
                                    <span class="text-sm md:text-base font-medium text-slate-900 text-left pr-4">{{ $faq->question }}</span>
                                    <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-white border border-slate-200 text-slate-500 text-xs transition-transform">
                                        <i class="fas fa-chevron-down"></i>
                                    </span>
                                </button>
                                <div class="faq-answer px-4 pb-3 text-sm text-slate-700" style="max-height:0; overflow:hidden; transition:max-height .25s ease;">
                                    <p class="py-2 border-t border-slate-200 mt-1">{{ $faq->answer }}</p>
                                </div>
                            </article>
                        @empty
                            <p class="text-sm text-slate-500">Još uvek nismo dodali najčešća pitanja.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Poslednja pitanja korisnika --}}
                <div class="contact-card bg-white border border-slate-200 rounded-2xl p-6 md:p-7 shadow-sm">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2 text-slate-900">
                        <i class="fas fa-user-friends text-emerald-500"></i>
                        Poslednja pitanja korisnika
                    </h3>

                    @forelse($questions as $q)
                        <div class="border border-slate-200 rounded-xl px-4 py-3 mb-3 bg-slate-50">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="qa-badge bg-sky-50 text-sky-700 border border-sky-200 uppercase text-[11px] px-2 py-0.5 rounded-full">pitanje</span>
                                    <span class="text-sm font-semibold text-slate-900">{{ $q->username }}</span>
                                </div>
                                <span class="text-[11px] text-slate-500">{{ $q->created_at->format('d.m.Y. H:i') }}</span>
                            </div>
                            <p class="text-sm text-slate-800 mb-2 whitespace-pre-line">{{ $q->message }}</p>

                            @if($q->comment)
                                <div class="mt-2 border-t border-slate-200 pt-2 flex items-start gap-2">
                                    <i class="fas fa-reply text-emerald-500 mt-0.5"></i>
                                    <div>
                                        <span class="qa-badge bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase text-[11px] px-2 py-0.5 rounded-full">odgovor ribarnice</span>
                                        <p class="text-sm text-slate-800 mt-1 whitespace-pre-line">{{ $q->comment }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-xs text-slate-500 mt-1">Odgovor je u pripremi.</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Još uvek nema javnih pitanja. Budite prvi koji će pitati!</p>
                    @endforelse

                    <div class="mt-4">{{ $questions->links() }}</div>
                </div>
            </section>
        </div>
    </div>
</main>

<script>
document.querySelectorAll('[data-faq]').forEach(function(item) {
    const question = item.querySelector('.faq-question');
    const answer   = item.querySelector('.faq-answer');
    const icon     = item.querySelector('.faq-icon i');
    answer.style.maxHeight = '0px';

    question.addEventListener('click', function() {
        const isOpen = item.classList.contains('open');
        document.querySelectorAll('[data-faq].open').forEach(function(openItem) {
            if(openItem !== item) {
                openItem.classList.remove('open');
                const ans = openItem.querySelector('.faq-answer');
                const ic  = openItem.querySelector('.faq-icon i');
                if(ans) ans.style.maxHeight = '0px';
                if(ic)  ic.style.transform = 'rotate(0deg)';
            }
        });

        if(!isOpen) {
            item.classList.add('open');
            answer.style.maxHeight = answer.scrollHeight + 'px';
            if(icon) icon.style.transform = 'rotate(180deg)';
        } else {
            item.classList.remove('open');
            answer.style.maxHeight = '0px';
            if(icon) icon.style.transform = 'rotate(0deg)';
        }
    });
});
</script>

</body>
</html>
