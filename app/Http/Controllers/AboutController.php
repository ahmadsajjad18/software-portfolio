<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutRequest;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function dashboard()
    {
        $about = About::first();
        return view('backend.about.dashboard', compact('about'));
    }

    public function store(AboutRequest $request)
    {
        $about = About::first() ?: new About();

        if ($request->hasFile('profile_image')) {
            if ($about->profile_image) {
                Storage::delete('public/' . $about->profile_image);
            }
            $imagePath = $request->file('profile_image')->store('images', 'public');
            $about->profile_image = $imagePath;
        }

        if ($request->hasFile('user_cv')) {
            if ($about->user_cv) {
                Storage::delete('public/' . $about->user_cv);
            }
            $cvPath = $request->file('user_cv')->store('user_cv', 'public');
            $about->user_cv = $cvPath;
        }

        $about->description = $request->input('description');
        $about->save();

        return response()->json(['success' => 'About section updated successfully.']);
    }


    public function downloadCV()
    {
        $about = About::first();

        if ($about && $about->user_cv) {
            return Storage::download('public/' . $about->user_cv);
        }

        return redirect()->back()->with('error', 'CV not found.');
    }


    public function edit($id)
    {
        $about = About::findOrFail($id);
        return response()->json($about);
    }

    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        // Handle profile image
        if ($request->hasFile('profile_image')) {
            // Delete the old image if it exists
            if ($about->profile_image) {
                Storage::delete('public/' . $about->profile_image);
            }
            // Store the new image
            $imagePath = $request->file('profile_image')->store('images', 'public');
            $about->profile_image = $imagePath;
        }

        // Handle CV file
        if ($request->hasFile('user_cv')) {
            // Delete the old CV if it exists
            if ($about->user_cv) {
                Storage::delete('public/' . $about->user_cv);
            }
            // Store the new CV
            $cvPath = $request->file('user_cv')->store('user_cv', 'public');
            $about->user_cv = $cvPath;
        }

        // Update description
        $about->description = $request->input('description');
        $about->save();

        return response()->json(['success' => 'About section updated successfully.']);
    }


    public function destroy($id)
    {
        $about = About::findOrFail($id);

        if ($about->profile_image) {
            Storage::delete('public/' . $about->profile_image);
        }
        if ($about->user_cv) {
            Storage::delete('public/' . $about->user_cv);
        }

        $about->delete();

        return response()->json(['success' => 'About section deleted successfully.']);
    }
}
