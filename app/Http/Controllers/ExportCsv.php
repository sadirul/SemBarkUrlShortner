<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportCsv extends Controller
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
        } elseif ($user->role === 'Member') {
            $query->where('created_by', $user->id);
        }

        $urls = $query->orderBy('id', 'desc')->get();

            $head_name = in_array(auth()->user()->role, ['Admin']) ? 'Created By' : 'Company';
        echo "ID,Long URL,Short URL,Hits,{$head_name},Created At\n";
        foreach ($urls as $url) {
            $short_url = url('/s/' . $url->short_url);

            if (in_array(auth()->user()->role, ['Admin'])) {
                $created_by_orcompny = $url->creator->id == Auth::id() ? 'You' : $url->creator->name;
            } else {
                $created_by_orcompny = $url->company->company_name;
            }

            echo "{$url->id},{$url->long_url},{$short_url},{$url->hits},{$created_by_orcompny},{$url->created_at}\n";
        }
        $filename = "expotred_" . date('Ymd_His') . ".csv";
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename=' . $filename);
    }
}
