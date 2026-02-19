<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question'   => ['required', 'string'],
            'answer'     => ['required', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        Faq::create($request->only('question', 'answer', 'sort_order'));
        return back()->with('success', 'FAQ qo\'shildi.');
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question'   => ['required', 'string'],
            'answer'     => ['required', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $faq->update($request->only('question', 'answer', 'sort_order'));
        return back()->with('success', 'FAQ yangilandi.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ o\'chirildi.');
    }
}
