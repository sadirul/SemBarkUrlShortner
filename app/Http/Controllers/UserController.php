<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $query = User::with('company')
            ->orderBy('id', 'desc')
            ->where('id', '!=', Auth::id());

        if (Auth::user()->role != 'SuperAdmin') {
            $query->where('company_id', Auth::user()->company_id);
        }

        $admins = $query->get();

        return view('admin.index', compact('admins'));
    }


    public function create()
    {
        $companies = Company::orderBy('company_name')->get();
        return view('admin.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $isSuperadmin = Auth::user()->role === 'SuperAdmin';

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
            'role' => $isSuperadmin ? 'nullable' : 'required|in:Admin,Member',
            'company_id' => $isSuperadmin
                ? 'required|exists:companies,id'
                : 'nullable'
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password' => Hash::make($request->password),
            'role' => $isSuperadmin ? 'Admin' : $request->role,
            'company_id' => $isSuperadmin
                ? $request->company_id
                : Auth::user()->company_id,
        ]);

        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }
}
