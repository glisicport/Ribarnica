<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'country' => ['nullable', 'string', 'max:255'],
        ], [
            'name.required' => 'Polje Ime i prezime je obavezno.',
            'name.max' => 'Ime i prezime ne smeju biti duži od 255 karaktera.',
            'email.required' => 'Polje E-mail adresa je obavezno.',
            'email.email' => 'Unesite validnu e-mail adresu.',
            'email.unique' => 'Ova e-mail adresa je već u upotrebi.',
            'phone.max' => 'Telefonski broj ne sme biti duži od 20 karaktera.',
            'address.max' => 'Adresa ne sme biti duža od 255 karaktera.',
            'city.max' => 'Naziv grada ne sme biti duži od 255 karaktera.',
            'postal_code.max' => 'Poštanski broj ne sme biti duži od 10 karaktera.',
            'country.max' => 'Naziv zemlje ne sme biti duži od 255 karaktera.',
        ]);

        $user->update($validated);

        return back()->with('status', 'Vaši lični podaci su uspešno ažurirani!');
    }

    public function changePasswordShow()
    {
        return view('user.profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Trenutna lozinka je obavezna.',
            'password.required' => 'Polje Lozinka je obavezno.',
            'password.min' => 'Nova lozinka mora imati najmanje 8 karaktera.',
            'password.confirmed' => 'Potvrda nove lozinke se ne podudara.',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Trenutna lozinka nije ispravna.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'Vaša lozinka je uspešno promenjena!');
    }
}
