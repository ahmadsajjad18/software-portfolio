<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $portfolios = Portfolio::all();
        return view('backend.portfolio.dashboard', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PortfolioRequest $request)
    {
        $portfolio = new Portfolio();

        if ($request->hasFile('image')) {
            $imagePath        = $request->file('image')->store('images', 'public');
            $portfolio->image = $imagePath;
        }

        $portfolio->name     = $request->name;
        $portfolio->category = $request->category;
        $portfolio->url      = $request->url;

        $portfolio->save();

        return response()->json(['message' => 'Service created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return response()->json($portfolio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PortfolioRequest $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($portfolio->image) {
                Storage::delete('public/' . $portfolio->image);
            }
            $imagePath        = $request->file('image')->store('images', 'public');
            $portfolio->image = $imagePath;
        }

        $portfolio->name      = $request->name;
        $portfolio->category  = $request->category;
        $portfolio->url       = $request->url;

        $portfolio->save();

        return response()->json(['message' => 'Portfolio updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->image) {
            Storage::delete('public/' . $portfolio->image);
        }

        $portfolio->delete();

        return response()->json(['message' => 'Portfolio deleted successfully']);
    }
}
