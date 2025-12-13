<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuickFact;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class QuickFactController extends Controller
{
    public function index()
    {
        $facts = QuickFact::orderBy('order')->paginate(10);

        return view('admin.quick_facts.index', compact('facts'));
    }

    public function create()
    {
        return view('admin.quick_facts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'text'      => 'required|string|max:500',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        QuickFact::create([
            'text'      => $data['text'],
            'order'     => $data['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.quick-facts.index')
            ->with('status', 'Brza činjenica je dodata.');
    }

    public function edit(QuickFact $quick_fact)
    {
        return view('admin.quick_facts.edit', [
            'fact' => $quick_fact,
        ]);
    }

    public function update(Request $request, QuickFact $quick_fact): RedirectResponse
    {
        $data = $request->validate([
            'text'      => 'required|string|max:500',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $quick_fact->update([
            'text'      => $data['text'],
            'order'     => $data['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.quick-facts.index')
            ->with('status', 'Brza činjenica je izmenjena.');
    }

    public function destroy(QuickFact $quick_fact): RedirectResponse
    {
        $quick_fact->delete();

        return redirect()
            ->route('admin.quick-facts.index')
            ->with('status', 'Brza činjenica je obrisana.');
    }
}
