<?php

namespace App\Http\Controllers;

use App\Models\SizeGuide;

class SizeGuideController extends Controller
{
    public function index()
    {
        $menSizes   = SizeGuide::where('type', 'men')->get();
        $womenSizes = SizeGuide::where('type', 'women')->get();
        return view('pages.size-guide', compact('menSizes', 'womenSizes'));
    }
}
