<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SizeGuide;
use Illuminate\Http\Request;

class SizeGuideController extends Controller
{
    public function index()
    {
        $menSizes   = SizeGuide::where('type', 'men')->get();
        $womenSizes = SizeGuide::where('type', 'women')->get();
        return view('admin.size-guides.index', compact('menSizes', 'womenSizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'      => ['required', 'in:men,women'],
            'eu'        => ['required', 'string'],
            'uk'        => ['required', 'string'],
            'us'        => ['required', 'string'],
            'length_cm' => ['required', 'string'],
        ]);

        SizeGuide::create($request->all());
        return back()->with('success', 'O\'lcham qo\'shildi.');
    }

    public function destroy(SizeGuide $sizeGuide)
    {
        $sizeGuide->delete();
        return back()->with('success', 'O\'lcham o\'chirildi.');
    }
}
