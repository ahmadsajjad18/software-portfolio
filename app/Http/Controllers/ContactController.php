<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $contacts = Contact::all();
        return view('backend.dashboard',compact('contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function getMessages()
    {
        $contacts = Contact::all(); // Fetch all contacts
        return response()->json($contacts); // Return as JSON
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        Contact::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'description' => $request->description,
        ]);

        // Store a success message in the session
        return redirect()->route('main.page')->with('success', 'Your Message is Sent');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request)
    {

        $home = Contact::findOrFail($request->contact_id);
        $home->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'description'  => $request->description
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['success' => 'Data deleted successfully']);
    }
}
