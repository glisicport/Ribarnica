<h2 class="text-xl font-semibold mb-4">Kontakt informacije</h2>

@if(session('status'))
    <p class="mb-4 text-green-600">{{ session('status') }}</p>
@endif

@if($items)
<form action="{{ route('kontrolni-panel.update', ['resource'=>'contact-info','id'=>$items->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label class="block font-semibold">Naslov</label>
        <input type="text" name="title" value="{{ $items->title }}" class="border rounded px-2 py-1 w-full">
    </div>

    <div class="mb-2">
        <label class="block font-semibold">Podnaslov</label>
        <input type="text" name="subtitle" value="{{ $items->subtitle }}" class="border rounded px-2 py-1 w-full">
    </div>

    <div class="mb-2 flex gap-4">
        <div>
            <label class="block font-semibold">Telefon - labela</label>
            <input type="text" name="phone_label" value="{{ $items->phone_label }}" class="border rounded px-2 py-1 w-full">
        </div>
        <div>
            <label class="block font-semibold">Telefon - broj</label>
            <input type="text" name="phone_value" value="{{ $items->phone_value }}" class="border rounded px-2 py-1 w-full">
        </div>
    </div>

    <div class="mb-2 flex gap-4">
        <div>
            <label class="block font-semibold">Email - labela</label>
            <input type="text" name="email_label" value="{{ $items->email_label }}" class="border rounded px-2 py-1 w-full">
        </div>
        <div>
            <label class="block font-semibold">Email - adresa</label>
            <input type="text" name="email_value" value="{{ $items->email_value }}" class="border rounded px-2 py-1 w-full">
        </div>
    </div>

    <div class="mb-2 flex gap-4">
        <div>
            <label class="block font-semibold">Radno vreme - labela</label>
            <input type="text" name="hours_label" value="{{ $items->hours_label }}" class="border rounded px-2 py-1 w-full">
        </div>
        <div>
            <label class="block font-semibold">Radno vreme - vrednost</label>
            <textarea name="hours_value" class="border rounded px-2 py-1 w-full">{{ $items->hours_value }}</textarea>
        </div>
    </div>

    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Sačuvaj izmene</button>
</form>
@else
<p>Kontakt informacije nisu postavljene.</p>
@endif
