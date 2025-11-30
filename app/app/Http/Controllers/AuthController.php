<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->intended('/kontrolni-panel');
        }

        return view('prijava.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Polje E-mail adresa je obavezno.',
            'email.email' => 'Unesite validnu e-mail adresu.',
            'password.required' => 'Polje Lozinka je obavezno.',
        ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/kontrolni-panel')->with('status', 'Uspešno ste se prijavili!');
        }

        throw ValidationException::withMessages([
            'email' => ['Ovi podaci se ne podudaraju sa našim zapisima.'],
        ])->redirectTo(route('prijava'));
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('prijava')->withErrors(['error' => 'Morate biti prijavljeni da biste ažurirali podatke.']);
        }

        $user = Auth::user();

        $request->validate([
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['required_with:password', 'string'],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ], [
            'email.unique' => 'Ova e-mail adresa je već zauzeta.',
            'password.min' => 'Lozinka mora imati najmanje 8 karaktera.',
            'password.confirmed' => 'Potvrda lozinke se ne podudara.',
            'current_password.required_with' => 'Trenutna lozinka je obavezna ako menjate lozinku.',
        ]);

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['Trenutna lozinka nije ispravna.'],
                ]);
            }
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('status', 'Vaši podaci su uspešno ažurirani!');
    }
}
