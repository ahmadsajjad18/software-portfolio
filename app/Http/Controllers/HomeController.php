<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeRequest;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $homes = Home::all();
        return view('backend.home.dashboard',compact('homes'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(HomeRequest $request)
    {
        Home::create([
            'name'       => $request->name,
            'profession' => $request->profession,
            'url'        => $request->url
        ]);

        return response()->json(['success' => true]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getHome($id)
    {
        $home = Home::findOrFail($id);
        return response()->json($home);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HomeRequest $request)
    {

        $home = Home::findOrFail($request->home_id);
        $home->update([
            'name'       => $request->name,
            'profession' => $request->profession,
            'url'        => $request->url
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $home = Home::findOrFail($id);
        $home->delete();

        return response()->json(['success' => 'Data deleted successfully']);
    }
}
