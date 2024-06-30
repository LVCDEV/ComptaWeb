<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionFilterRequest;
use App\Models\Account;
use App\Models\Admin\TransactionType;
use App\Models\Admin\User;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('transaction.index', [
            'transactions' => Transaction::paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $transaction = new Transaction();
        return view('transaction.form', [
            'transaction' => $transaction,
            'transactiontypes' => TransactionType::all(),
            'accounts' => Account::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionFilterRequest $request) : RedirectResponse
    {
        Transaction::create($request->validated());
        return redirect(route('app.transactions.index'))->with('success', 'Transaction created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction) : View
    {
        return view('transaction.form', [
            'transaction' => $transaction,
            'transactiontypes' => TransactionType::all(),
            'accounts' => Account::all(),
            'users' => User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionFilterRequest $request, Transaction $transaction) : RedirectResponse
    {
        $transaction->update($request->validated());
        return redirect(route('app.transactions.index'))->with('success', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction) : RedirectResponse
    {
        $transaction->delete();
        return redirect(route('app.transactions.index'))->with('success', 'Transaction deleted successfully');
    }
}
