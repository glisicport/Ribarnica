<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\about_us;

class AdminAboutUsController extends Controller
{
    public function index()
    {
        $about = about_us::first();

        return view('admin.about_us.index', compact('about'));
    }

    public function update(Request $request)
    {
        $about = about_us::first();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'mission' => 'required|string',
            'vision' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('about', 'public');
        }

        $about->update($validated);

        return back()->with('success', "Uspešno ste ažurirali sekciju O nama.");
    }
}
