<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());
        return back()->with('success', 'Xabaringiz qabul qilindi. Tez orada javob beramiz!');
    }
}
