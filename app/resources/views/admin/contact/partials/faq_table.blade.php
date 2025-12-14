<h2 class="text-xl font-semibold mb-4">FAQ</h2>

{{-- Dodavanje novog FAQ --}}
<form action="{{ route('kontrolni-panel.store', 'faq') }}" method="POST" class="mb-6">
    @csrf
    <input type="text" name="question" placeholder="Pitanje" class="border rounded px-2 py-1 w-full mb-2" required>
    <textarea name="answer" placeholder="Odgovor" class="border rounded px-2 py-1 w-full mb-2" required></textarea>
    <div class="flex gap-4 items-center">
        <input type="number" name="order" placeholder="Redosled" class="border rounded px-2 py-1 w-24" value="0">
        <label>
            <input type="checkbox" name="is_active" value="1" checked> Aktivno
        </label>
        <button type="submit" class="px-4 py-1 bg-sky-600 text-white rounded">Dodaj</button>
    </div>
</form>

@if($items->isEmpty())
    <p>Još uvek nema postavljenih pitanja.</p>
@else
    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th>#</th>
                <th>Pitanje</th>
                <th>Odgovor</th>
                <th>Redosled</th>
                <th>Aktivno</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $faq)
                <tr class="border-t">
                    <td>{{ $faq->id }}</td>
                    <td>
                        <form action="{{ route('kontrolni-panel.update', ['resource' => 'faq','id'=>$faq->id]) }}" method="POST" class="flex flex-col gap-1">
                            @csrf
                            @method('PUT')
                            <input type="text" name="question" value="{{ $faq->question }}" class="border px-1 py-0.5 w-full">
                    </td>
                    <td>
                            <textarea name="answer" class="border px-1 py-0.5 w-full">{{ $faq->answer }}</textarea>
                    </td>
                    <td>
                            <input type="number" name="order" value="{{ $faq->order }}" class="border px-1 py-0.5 w-16">
                    </td>
                    <td class="text-center">
                            <input type="checkbox" name="is_active" value="1" {{ $faq->is_active ? 'checked' : '' }}>
                    </td>
                    <td class="flex gap-2">
                            <button type="submit" class="px-2 py-1 bg-green-600 text-white text-xs rounded">Sačuvaj</button>
                        </form>

                        {{-- Brisanje FAQ --}}
                        <form action="{{ route('kontrolni-panel.destroy', ['resource' => 'faq','id'=>$faq->id]) }}" method="POST" onsubmit="return confirm('Obrisati pitanje?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-600 text-white text-xs rounded">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $items->links() }}
    </div>
@endif
