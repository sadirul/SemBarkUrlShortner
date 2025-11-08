<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UrlShortenerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = UrlShortener::query();

        if ($user->role === 'Admin') {
            $query->where('company_id', $user->company_id);
        }

        elseif ($user->role === 'Member') {
            $query->where('created_by', $user->id);
        }

        $urls = $query->orderBy('id', 'desc')->get();

        return view('url.index', compact('urls'));
    }


    public function create()
    {
        return view('url.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url'
        ]);

        $code = Str::random(6);

        UrlShortener::create([
            'company_id' => Auth::user()->company_id,
            'created_by' => Auth::id(),
            'short_url'  => $code,
            'long_url'   => $request->long_url,
            'hits'       => 0,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Short URL created');
    }

    public function redirect($code)
    {
        $url = UrlShortener::where('short_url', $code)->firstOrFail();

        // increase hits
        $url->increment('hits');

        return redirect()->away($url->long_url);
    }
}
