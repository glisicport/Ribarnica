{{-- resources/views/admin/contact/partials/questions_table.blade.php --}}

<h2>Pitanja korisnika</h2>

@if (session('status'))
    <p style="color: green">{{ session('status') }}</p>
@endif

@if ($questions->isEmpty())
    <p>Još uvek nema postavljenih pitanja.</p>
@else

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Datum</th>
            <th>Korisnik</th>
            <th>Pitanje</th>
            <th>Odgovor</th>
            <th>Akcije</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($questions as $q)
            <tr>
                <td>{{ $q->created_at->format('d.m.Y. H:i') }}</td>
                <td>{{ $q->username }}</td>
                <td>{{ $q->message }}</td>
                <td>
                    @if ($q->comment)
                        {{ $q->comment }}
                    @else
                        <em>Nema odgovora</em>
                    @endif
                </td>
                <td>
                    {{-- ODGOVOR --}}
<form method="POST" action="{{ route('kontrolni-panel.update', ['resource' => 'questions', 'id' => $q->id]) }}">

                        @csrf
                        @method('PUT')

                        <textarea name="comment" rows="2">{{ $q->comment }}</textarea><br>
                        <button type="submit">Sačuvaj odgovor</button>
                    </form>

                    {{-- BRISANJE --}}
                    <form method="POST" action="{{ route('kontrolni-panel.destroy', ['resource' => 'questions', 'id' => $q->id]) }}" onsubmit="return confirm('Obrisati pitanje?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit">Obriši</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>
{{ $questions->links() }}

@endif
