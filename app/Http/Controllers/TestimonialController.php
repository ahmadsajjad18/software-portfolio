<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $testimonials = Testimonial::all();
        return view('backend.testimonial.dashboard', compact('testimonials'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialRequest $request)
    {
        $testimonial = new Testimonial();

        if ($request->hasFile('image')) {
            $imagePath          = $request->file('image')->store('images', 'public');
            $testimonial->image = $imagePath;
        }

        $testimonial->name        = $request->name;
        $testimonial->description = $request->description;
        $testimonial->save();

        return response()->json(['message' => 'Testimonial created successfully']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return response()->json($testimonial);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialRequest $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::delete('public/' . $testimonial->image);
            }
            $imagePath          = $request->file('image')->store('images', 'public');
            $testimonial->image = $imagePath;
        }

        $testimonial->name         = $request->name;
        $testimonial->description  = $request->description;

        $testimonial->save();

        return response()->json(['message' => 'Description updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->image) {
            Storage::delete('public/' . $testimonial->image);
        }

        $testimonial->delete();

        return response()->json(['message' => 'Testimonial deleted successfully']);
    }
}
