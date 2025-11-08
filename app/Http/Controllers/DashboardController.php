<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = UrlShortener::query();

        if ($user->role === 'Admin') {
            $query->where('company_id', $user->company_id);
        }

        if ($user->role === 'SuperAdmin' && $request->has('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        elseif ($user->role === 'Member') {
            $query->where('created_by', $user->id);
        }

        $urls = $query->orderBy('id', 'desc')->get();

        return view('dashboard.index', compact('urls'));
    }
}
