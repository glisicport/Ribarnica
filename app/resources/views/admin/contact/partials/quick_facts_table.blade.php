<h2 class="text-xl font-semibold mb-4">Brze činjenice</h2>

{{-- Dodavanje nove činjenice --}}
<form action="{{ route('kontrolni-panel.store', 'quick-facts') }}" method="POST" class="mb-6">
    @csrf
    <textarea name="text" placeholder="Tekst" class="border rounded px-2 py-1 w-full mb-2" required></textarea>
    <div class="flex gap-4 items-center">
        <input type="number" name="order" placeholder="Redosled" class="border rounded px-2 py-1 w-24" value="0">
        <label>
            <input type="checkbox" name="is_active" value="1" checked> Aktivno
        </label>
        <button type="submit" class="px-4 py-1 bg-sky-600 text-white rounded">Dodaj</button>
    </div>
</form>

@if($items->isEmpty())
    <p>Još uvek nema dodatih činjenica.</p>
@else
    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th>#</th>
                <th>Tekst</th>
                <th>Redosled</th>
                <th>Aktivno</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $fact)
                <tr class="border-t">
                    <td>{{ $fact->id }}</td>

                    {{-- Inline forma za izmenu --}}
                    <td colspan="1">
                        <form action="{{ route('kontrolni-panel.update', ['resource' => 'quick-facts','id'=>$fact->id]) }}" method="POST" class="flex flex-col gap-1">
                            @csrf
                            @method('PUT')
                            <textarea name="text" rows="2" class="border px-1 py-0.5 w-full">{{ $fact->text }}</textarea>
                    </td>

                    <td>
                            <input type="number" name="order" value="{{ $fact->order }}" class="border px-1 py-0.5 w-16">
                    </td>

                    <td class="text-center">
                            <input type="checkbox" name="is_active" value="1" {{ $fact->is_active ? 'checked' : '' }}>
                    </td>

                    <td class="flex gap-2">
                            <button type="submit" class="px-2 py-1 bg-green-600 text-white text-xs rounded">Sačuvaj</button>
                        </form>

                        {{-- Brisanje --}}
                        <form action="{{ route('kontrolni-panel.destroy', ['resource' => 'quick-facts','id'=>$fact->id]) }}" method="POST" onsubmit="return confirm('Obrisati činjenicu?')">
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
