<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::withCount('users')
            ->withCount('urls')
            ->withSum('urls as hits_sum', 'hits')
            ->orderBy('id', 'desc')
            ->get();

        return view('company.index', compact('companies'));
    }


    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255|unique:companies,company_name',
        ]);


        Company::create([
            'company_name' => $request->company_name
        ]);

        return redirect()->route('company.index')->with('success', 'Company created successfully.');
    }
}
