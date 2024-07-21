<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountFilterRequest;
use App\Models\Account;
use App\Models\Admin\AccountType;
use App\Models\Admin\Amount;
use App\Models\Admin\Bank;
use App\Models\Admin\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('account.index', [
            'accounts' => Account::where('user_id', auth()->user()->id)->with('amount', 'accountType')->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $account = new Account();
        return view('account.form', [
            'account' => $account,
            'accounttypes' => AccountType::all(),
            'users' => User::all(),
            'banks' => Bank::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountFilterRequest $request) : RedirectResponse
    {

        $account = Account::create($request->validated());
        Amount::create([
            'account_id' => $account->id,
            'value' => $account->balance,
        ]);

        return redirect(route('app.accounts.index'))->with('success', 'Account created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account) : View
    {
        return view('account.show', [
            'account' => $account,
            'bank' => $account->bank,
            'user' => $account->user,
            'accounttype' => $account->accountType,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account) : View
    {
        return view('account.form', [
            'account' => $account,
            'accounttypes' => AccountType::all(),
            'users' => User::all(),
            'banks' => Bank::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountFilterRequest $request, Account $account) : RedirectResponse
    {
        $account->update($request->validated());

        return redirect(route('app.accounts.index'))->with('success', 'Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account) : RedirectResponse
    {
        $account->delete();
        return redirect(route('app.accounts.index'))->with('success', 'Account deleted successfully');
    }
}
