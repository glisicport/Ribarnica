<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    // LISTA PITANJA (admin)
    public function index()
    {
        $questions = ContactMessage::orderByDesc('created_at')->paginate(10);

        return view('admin.contact.index', compact('questions'));
    }

    // ČUVANJE ODGOVORA
    public function answer(Request $request, $id)
    {
        $request->validate([
            'comment' => ['required', 'string', 'min:3'],
        ]);

        $question = ContactMessage::findOrFail($id);
        $question->comment = $request->comment;
        $question->save();

        return back()->with('status', 'Odgovor je uspešno sačuvan.');
    }

    // BRISANJE PITANJA
    public function destroy($id)
    {
        $question = ContactMessage::findOrFail($id);
        $question->delete();

        return back()->with('status', 'Pitanje je obrisano.');
    }

    // PRIKAZ ADMIN PODEŠAVANJA KONTAKTA
    public function contactSettings()
    {
        $contact = Contact::orderByDesc('id')->first();

        return view('admin.contact.settings', compact('contact'));
    }

    // SNIMANJE IZMENjENIH KONTAKT PODATAKA
    public function contactSettingsSave(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'phone'   => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'hours'   => 'required|string|max:255',
        ]);

        Contact::updateOrCreate(
            ['id' => 1], // fiksiran sistemski ID
            [
                'name'    => $validated['name'],
                'message' => $validated['message'],
                'phone'   => $validated['phone'],
                'email'   => $validated['email'],
                'hours'   => $validated['hours'],
            ]
        );

        return back()->with('status', 'Kontakt informacije su uspešno ažurirane.');
    }
}
