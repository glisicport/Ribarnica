{{-- resources/views/admin/contact/index.blade.php --}}

<div class="px-4 py-6">
    <h2 class="text-2xl font-semibold mb-4">Pitanja korisnika</h2>

    @if (session('status'))
        <div class="mb-4 px-4 py-2 rounded bg-emerald-100 text-emerald-800 text-sm">
            {{ session('status') }}
        </div>
    @endif

    @if ($questions->isEmpty())
        <p class="text-sm text-slate-500">Još uvek nema postavljenih pitanja.</p>
    @else
        <div class="overflow-x-auto border rounded-lg bg-white">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-3 py-2">Datum</th>
                        <th class="px-3 py-2">Korisnik</th>
                        <th class="px-3 py-2">Pitanje</th>
                        <th class="px-3 py-2">Odgovor</th>
                        <th class="px-3 py-2">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $q)
                        <tr class="border-t">
                            <td class="px-3 py-2 text-xs text-slate-500">
                                {{ $q->created_at->format('d.m.Y. H:i') }}
                            </td>
                            <td class="px-3 py-2 font-medium">{{ $q->username }}</td>
                            <td class="px-3 py-2">{{ $q->message }}</td>

                            <td class="px-3 py-2">
                                @if($q->comment)
                                    <span class="text-slate-800 whitespace-pre-line">{{ $q->comment }}</span>
                                @else
                                    <span class="bg-amber-100 text-amber-700 px-2 py-1 text-xs rounded">
                                        Nema odgovora
                                    </span>
                                @endif
                            </td>

                            <td class="px-3 py-2 space-y-2">
                                
                                {{-- IZMENI ODGOVOR --}}
                                <form action="{{ route('admin.questions.answer', $q->id) }}" method="POST">
                                    @csrf
                                    <textarea
                                        name="comment"
                                        rows="2"
                                        class="w-full border rounded px-2 py-1 text-sm"
                                        placeholder="Unesite ili izmenite odgovor..."
                                    >{{ $q->comment }}</textarea>

                                    <button type="submit"
                                        class="mt-1 bg-sky-600 hover:bg-sky-500 text-white px-3 py-1.5 rounded text-xs">
                                        Sačuvaj odgovor
                                    </button>
                                </form>

                                {{-- OBRISI PITANJE --}}
                                <form action="{{ route('admin.questions.destroy', $q->id) }}" method="POST"
                                      onsubmit="return confirm('Da li sigurno želiš da obrišeš ovo pitanje?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-500 text-white px-3 py-1.5 rounded text-xs">
                                        Obriši pitanje
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $questions->links() }}
            </div>
        </div>
    @endif
</div>
