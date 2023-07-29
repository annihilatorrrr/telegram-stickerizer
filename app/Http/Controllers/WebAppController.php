<?php

namespace App\Http\Controllers;

use App\Models\Sticker;
use Illuminate\Http\Request;

class WebAppController extends Controller
{
    public function index(Request $request)
    {
        return view('webapp.main', [
            'text' => $request->input('text'),
            'user_id' => $request->input('user_id'),
        ]);
    }

    public function preview(Request $request, Sticker $sticker)
    {
        return $sticker
            ->getGenerator()
            ->generate($request->input('text', 'TEXT'))
            ->response('webp', 100);
    }
}
