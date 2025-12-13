<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\QuickFact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    // Stranica /contact
    public function index(): View
    {
        // Poslednji unos iz tabele contact – osnovne info o ribarnici
        $contact = Contact::orderByDesc('id')->first();

        // Aktivna najčešća pitanja
        $faqs = Faq::where('is_active', true)
            ->orderBy('order')
            ->orderBy('id')
            ->get();

        // Aktivne brze činjenice (quick facts)
        $quickFacts = QuickFact::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Poslednja pitanja korisnika sa paginacijom
        $questions = ContactMessage::orderByDesc('created_at')->paginate(6);

        // Prosleđujemo sve potrebne promenljive u view
        return view('contact.index', compact('contact', 'faqs', 'quickFacts', 'questions'));
    }

    // Forma za slanje pitanja
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'message'  => ['required', 'string', 'min:5'],
            'email'    => ['nullable', 'email'],
        ]);

        ContactMessage::create([
            'username' => $validated['username'],
            'message'  => $validated['message'] . ($request->filled('email') ? "\n\nEmail: " . $request->email : ''),
            // 'comment' ostaje null – kasnije admin popunjava odgovor
        ]);

        return redirect()
            ->route('contact')
            ->with('status', 'Hvala na pitanju! Odgovorićemo u najkraćem roku.');
    }
}
