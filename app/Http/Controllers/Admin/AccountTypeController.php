<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountTypeFilterRequest;
use App\Models\Admin\AccountType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('admin.accounttype.index', [
            'accounttypes' => AccountType::paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $accounttype = new AccountType();
        return view('admin.accounttype.form', [
            'accounttype' => $accounttype,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountTypeFilterRequest $request) : RedirectResponse
    {
        AccountType::create($request->validated());

        return redirect()->route('admin.accounttypes.index')->with('success', 'Account Type Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountType $accounttype) : View
    {
        return view('admin.accounttype.form', [
            'accounttype' => $accounttype,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountTypeFilterRequest $request, AccountType $accounttype) : RedirectResponse
    {
        $accounttype->update($request->validated());

        return redirect()->route('admin.accounttypes.index')->with('success', 'Account Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountType $accounttype) : RedirectResponse
    {
        $accounttype->delete();
        return redirect()->route('admin.accounttypes.index')->with('success', 'Account Type Deleted Successfully');
    }
}
