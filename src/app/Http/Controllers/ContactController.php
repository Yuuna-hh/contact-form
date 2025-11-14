<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['name', 'email', 'tel', 'content']);
        
        $contact['image_path'] = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('tmp', 'public');
            $contact['image_path'] = $path; 
        }

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contactData = $request->only(['name', 'email', 'tel', 'content']);

        if ($request->filled('image_path')) {
            $tmpPath = $request->input('image_path');
            $fileName = basename($tmpPath);
            $finalPath = 'contacts/' . $fileName;
            \Storage::disk('public')->move($tmpPath, $finalPath);
            $contactData['image'] = $finalPath;
        }
        
        Contact::create($contactData);
        return view('thanks');
    }

}