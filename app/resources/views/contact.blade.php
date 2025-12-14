<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt – Ribarnica TFZR</title>
    @include('common.scripts')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body class="bg-slate-900 text-slate-100">

@include('common.topbar')

<main class="contact-hero py-12 md:py-16">
    <div class="container mx-auto px-4 max-w-6xl">

        {{-- GLAVNI BLOK – OSNOVNE INFORMACIJE --}}
        <section class="contact-glass p-6 md:p-10 mb-10">
            <div class="flex flex-col lg:flex-row gap-10 items-start lg:items-center">
                <div class="flex-1 space-y-4">
                    <div class="inline-flex items-center gap-3 fish-badge bg-sky-500/20 border border-sky-400/40 px-4 py-1 rounded-full">
                        <i class="fas fa-fish text-sky-300"></i>
                        <span class="text-xs tracking-[0.2em] uppercase text-sky-100">TFZR Ribarnica</span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold leading-tight">
                        {{ optional($contact)->name ?? 'Ribarnica TFZR' }}
                    </h1>

                    <p class="text-slate-200/90 text-base md:text-lg max-w-xl">
                        {{ optional($contact)->message ?? 'Dobrodošli u studentsku ribarnicu TFZR – mesto gde se tradicija, znanje i sveža riba sreću na jednom mestu.' }}
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4">
                        <div class="contact-card bg-slate-900/70 p-4">
                            <p class="text-xs uppercase tracking-[0.16em] text-slate-400 mb-1">Telefon</p>
                            <p class="font-semibold text-slate-50 text-lg flex items-center gap-2">
                                <i class="fas fa-phone-alt text-emerald-400"></i>
                                {{ optional($contact)->phone ?? '+381 61 234 5678' }}
                            </p>
                        </div>
                        <div class="contact-card bg-slate-900/70 p-4">
                            <p class="text-xs uppercase tracking-[0.16em] text-slate-400 mb-1">Email</p>
                            <p class="font-semibold text-slate-50 text-lg flex items-center gap-2">
                                <i class="fas fa-envelope-open-text text-sky-400"></i>
                                {{ optional($contact)->email ?? 'tfzrribarnica@gmail.com' }}
                            </p>
                        </div>
                        <div class="contact-card bg-slate-900/70 p-4">
                            <p class="text-xs uppercase tracking-[0.16em] text-slate-400 mb-1">Radno vreme</p>
                            <p class="font-semibold text-slate-50 text-sm leading-relaxed whitespace-pre-line">
                                {{ optional($contact)->working_hours ?? "Pon–Pet: 07–20h\nSubota: 07–18h · Nedelja: 08–15h" }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- mali info panel – BRZE ČINJENICE --}}
                <div class="w-full lg:w-72 contact-card bg-gradient-to-br from-sky-600/90 to-blue-700/95 p-5">
                    <h3 class="text-lg font-semibold mb-3 flex items-center gap-2">
                        <i class="fas fa-store-alt text-amber-300"></i>
                        Brze činjenice
                    </h3>

                    @php
                        $facts = $quickFacts ?? collect();
                    @endphp

                    @if($facts->isEmpty())
                        <p class="text-sm text-sky-50/90">
                            Uskoro ćemo dodati informacije o posebnim pogodnostima, popustima i akcijama.
                        </p>
                    @else
                        <ul class="space-y-2 text-sm">
                            @foreach($facts as $fact)
                                <li class="flex gap-3">
                                    <span class="text-sky-100">•</span>
                                    <span>{{ $fact->text }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- LEVO – FORMA ZA PITANJA --}}
            <section class="contact-card bg-slate-900/80 p-6 md:p-7">
                <h2 class="text-2xl font-semibold mb-1 flex items-center gap-2">
                    <i class="fas fa-question-circle text-sky-400"></i>
                    Postavite pitanje
                </h2>
                <p class="text-sm text-slate-400 mb-5">
                    Imate pitanje o ponudi, dostavi ili pripremi ribe? Napišite nam poruku – odgovori
                    se kasnije mogu pojaviti u javnim pitanjima (bez vašeg emaila).
                </p>

                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-emerald-300 bg-emerald-900/40 border border-emerald-500/60 px-4 py-2 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 text-sm text-red-300 bg-red-900/40 border border-red-500/60 px-4 py-2 rounded-lg">
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
                        <label for="username" class="block text-sm font-medium text-slate-200 mb-1">
                            Ime i prezime
                        </label>
                        <input type="text" id="username" name="username" required
                               value="{{ old('username') }}"
                               class="w-full px-4 py-2.5 rounded-lg bg-slate-800/80 border border-slate-600 text-slate-50 focus:outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-400">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-200 mb-1">
                            Email (opciono)
                        </label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               class="w-full px-4 py-2.5 rounded-lg bg-slate-800/80 border border-slate-600 text-slate-50 focus:outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-400">
                        <p class="text-xs text-slate-400 mt-1">
                            Email koristimo samo da bismo vam odgovorili – ne prikazuje se javno.
                        </p>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-200 mb-1">
                            Vaše pitanje
                        </label>
                        <textarea id="message" name="message" rows="4" required
                                  class="w-full px-4 py-2.5 rounded-lg bg-slate-800/80 border border-slate-600 text-slate-50 focus:outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-400 resize-y">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 px-6 py-2.5 rounded-full text-sm font-semibold shadow-lg shadow-sky-900/50 transition-transform duration-150 active:scale-95">
                        <i class="fas fa-paper-plane"></i>
                        Pošalji pitanje
                    </button>
                </form>
            </section>

            {{-- DESNO – FAQ + poslednja pitanja --}}
            <section class="space-y-6">

                {{-- NAJČEŠĆA PITANJA --}}
                <div class="contact-card bg-slate-900/85 p-6 md:p-7">
                    <h2 class="text-2xl font-semibold mb-1 flex items-center gap-2">
                        <i class="fas fa-comments text-amber-300"></i>
                        Najčešća pitanja
                    </h2>
                    <p class="text-sm text-slate-400 mb-5">
                        Pre nego što pošaljete pitanje, možda je odgovor već ovde.
                    </p>

                    <div class="space-y-3">
                        @forelse($faqs as $faq)
                            <article class="faq-item" data-faq>
                                <button type="button" class="faq-question w-full flex items-center justify-between px-4 py-3">
                                    <span class="text-sm md:text-base font-medium text-slate-100 text-left pr-4">
                                        {{ $faq->question }}
                                    </span>
                                    <span class="faq-icon w-8 h-8 rounded-full flex items-center justify-center bg-slate-800/80 border border-slate-600 text-slate-200 text-xs">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </button>
                                <div class="faq-answer px-4 pb-3 text-sm text-slate-300" style="max-height:0; overflow:hidden; transition:max-height .25s ease;">
                                    <p class="py-1.5 border-t border-slate-700/60 mt-1">
                                        {{ $faq->answer }}
                                    </p>
                                </div>
                            </article>
                        @empty
                            <p class="text-sm text-slate-400">Još uvek nismo dodali najčešća pitanja.</p>
                        @endforelse
                    </div>
                </div>

                {{-- POSLEDNJA PITANJA KORISNIKA --}}
                <div class="contact-card bg-slate-900/85 p-6 md:p-7">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-user-friends text-emerald-300"></i>
                        Poslednja pitanja korisnika
                    </h3>

                    @forelse($questions as $q)
                        <div class="border border-slate-700/70 rounded-xl px-4 py-3 mb-3 bg-slate-950/40">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="qa-badge bg-sky-500/20 text-sky-200 border border-sky-500/40 uppercase">
                                        pitanje
                                    </span>
                                    <span class="text-sm font-semibold text-slate-100">{{ $q->username }}</span>
                                </div>
                                <span class="text-[11px] text-slate-500">
                                    {{ $q->created_at->format('d.m.Y. H:i') }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-200 mb-2 whitespace-pre-line">
                                {{ $q->message }}
                            </p>

                            @if($q->comment)
                                <div class="mt-2 border-t border-slate-700/70 pt-2 flex items-start gap-2">
                                    <i class="fas fa-reply text-emerald-300 mt-0.5"></i>
                                    <div>
                                        <span class="qa-badge bg-emerald-500/20 text-emerald-200 border border-emerald-500/40 uppercase">
                                            odgovor ribarnice
                                        </span>
                                        <p class="text-sm text-slate-200 mt-1 whitespace-pre-line">
                                            {{ $q->comment }}
                                        </p>
                                    </div>
                                </div>
                            @else
                                <p class="text-xs text-slate-500 mt-1">
                                    Odgovor je u pripremi.
                                </p>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">Još uvek nema javnih pitanja. Budite prvi koji će pitati!</p>
                    @endforelse

                    <div class="mt-4">
                        {{ $questions->links() }}
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<script>
    // FAQ toggle
    document.querySelectorAll('[data-faq]').forEach(function (item) {
        const question = item.querySelector('.faq-question');
        const answer   = item.querySelector('.faq-answer');
        const icon     = item.querySelector('.faq-icon i');

        // inicijalno zatvoreno
        answer.style.maxHeight = '0px';

        question.addEventListener('click', function () {
            const isOpen = item.classList.contains('open');

            // zatvori ostale
            document.querySelectorAll('[data-faq].open').forEach(function (openItem) {
                if (openItem !== item) {
                    openItem.classList.remove('open');
                    const ans = openItem.querySelector('.faq-answer');
                    const ic  = openItem.querySelector('.faq-icon i');
                    if (ans) ans.style.maxHeight = '0px';
                    if (ic)  ic.style.transform = 'rotate(0deg)';
                }
            });

            if (!isOpen) {
                item.classList.add('open');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                if (icon) icon.style.transform = 'rotate(90deg)';
            } else {
                item.classList.remove('open');
                answer.style.maxHeight = '0px';
                if (icon) icon.style.transform = 'rotate(0deg)';
            }
        });
    });
</script>

</body>
</html>
