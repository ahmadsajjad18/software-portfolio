<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialLinkRequest;
use App\Models\SocialLink;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $socialLinks = SocialLink::all();
        return view('backend.social_link.dashboard', compact('socialLinks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialLinkRequest $request)
    {
        $socialLink = new SocialLink();

        $socialLink->name  = $request->name;
        $socialLink->url   = $request->url;

        $socialLink->save();

        return response()->json(['message' => 'Social Link created successfully']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        return response()->json($socialLink);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialLinkRequest $request, $id)
    {
        $socialLink = SocialLink::findOrFail($id);

        $socialLink->name   = $request->name;
        $socialLink->url    = $request->url;

        $socialLink->save();

        return response()->json(['message' => 'SocialLink updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $socialLink = SocialLink::findOrFail($id);

        $socialLink->delete();

        return response()->json(['message' => 'SocialLink deleted successfully']);
    }
}
