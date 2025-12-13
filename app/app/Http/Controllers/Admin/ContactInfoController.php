<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function edit()
    {
        $contactInfo = ContactInfo::first();

        return view('admin.contact-info.edit', compact('contactInfo'));
    }

    public function update(Request $request)
    {
        $contactInfo = ContactInfo::first();

        $contactInfo->update($request->all());

        return redirect()
            ->route('admin.contact-info.edit')
            ->with('success', 'Podaci uspešno izmenjeni!');
    }
}
