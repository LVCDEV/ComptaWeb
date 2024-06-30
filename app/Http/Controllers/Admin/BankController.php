<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BankFilterRequest;
use App\Models\Admin\Bank;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('admin.bank.index', [
            'banks' => Bank::paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $bank = new Bank();
        return view('admin.bank.form', [
            'bank' => $bank,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BankFilterRequest $request) : RedirectResponse
    {
        $data = $request->validated();
        $bank = Bank::create($data);

        return redirect()->route('admin.banks.index')->with('success', 'Bank added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank) : View
    {
        return view('admin.bank.form', [
            'bank' => $bank,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Bank $bank, BankFilterRequest $request) : RedirectResponse
    {
        $data = $request->validated();
        $bank->update($data);

        return redirect()->route('admin.banks.index')->with('success', 'Bank updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank) : RedirectResponse
    {
        $bank->delete();
        return redirect()->route('admin.banks.index')->with('success', 'Bank deleted successfully');
    }
}
