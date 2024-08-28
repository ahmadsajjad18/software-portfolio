<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function dashboard()
    {
        $services = Service::all();
        return view('backend.service.dashboard', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(ServiceRequest $request)
    {
        $service = new Service();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $service->image = $imagePath;
        }

        $service->name = $request->name;
        $service->description = $request->description;
        $service->save();

        return response()->json(['message' => 'Service created successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(ServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::delete('public/' . $service->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $service->image = $imagePath;
        }

        $service->name = $request->name;
        $service->description = $request->description;
        $service->save();

        return response()->json(['message' => 'Service updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image) {
            Storage::delete('public/' . $service->image);
        }

        $service->delete();

        return response()->json(['message' => 'Service deleted successfully']);
    }
}

