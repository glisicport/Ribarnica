<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->paginate(10);

        return view('admin.dashboard', [
            'page' => 'faq',
            'faqs' => $faqs
        ]);
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question'  => 'required|string|max:255',
            'answer'    => 'required|string',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        Faq::create([
            'question'  => $request->question,
            'answer'    => $request->answer,
            'order'     => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.faqs.index') // <-- plural "faqs"
                         ->with('status', 'FAQ uspešno dodat!');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question'  => 'required|string|max:255',
            'answer'    => 'required|string',
            'order'     => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $faq->update([
            'question'  => $request->question,
            'answer'    => $request->answer,
            'order'     => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.faqs.index') // <-- plural "faqs"
                         ->with('status', 'FAQ uspešno izmenjen!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index') // <-- plural "faqs"
                         ->with('status', 'FAQ je obrisan.');
    }
}
