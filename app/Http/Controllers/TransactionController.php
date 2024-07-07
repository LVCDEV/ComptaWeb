<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchFilterRequest;
use App\Http\Requests\TransactionFilterRequest;
use App\Http\Requests\TransfertFilterRequest;
use App\Models\Account;
use App\Models\Admin\TransactionType;
use App\Models\Admin\User;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function search(SearchFilterRequest $request): View
    {
        $data = $request->validated();
        if (empty($data['account_id'])) {
            $attribute = 'transaction_type_id';
            $value = $data['transaction_type_id'];
        }
        else
        {
            $attribute = 'account_id';
            $value = $data['account_id'];
        }

        return view('transaction.index', [
            'transactions' => Transaction::where($attribute, $value)->paginate(25),
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'transactiontypes' => TransactionType::all(),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('transaction.index', [
            'transactions' => Transaction::where('user_id', auth()->user()->id)->paginate(25),
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'transactiontypes' => TransactionType::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_transfert(): View
    {
        $transaction = new Transaction();
        return view('transaction.form_transfert', [
            'transaction' => $transaction,
            'transactiontypes' => TransactionType::all(),
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionFilterRequest $request): RedirectResponse
    {
        Transaction::create($request->validated());
        return redirect(route('app.transactions.index', [
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'transactiontypes' => TransactionType::all(),
        ]))->with('success', 'Transaction created successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $transaction = new Transaction();
        return view('transaction.form', [
            'transaction' => $transaction,
            'transactiontypes' => TransactionType::all(),
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'users' => User::all(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_transfert(TransfertFilterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $dest = $data['beneficiary'];
        $expe = $data['account_id'];
        $amount = $data['amount'];
        Transaction::create($data);
        $data['account_id'] = $dest;
        $data['beneficiary'] = $expe;
        $data['amount'] = $amount * -1;
        Transaction::create($data);
        return redirect(route('app.transactions.index', [
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'transactiontypes' => TransactionType::all(),
        ]))->with('success', 'Transaction created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction): View
    {
        return view('transaction.form', [
            'transaction' => $transaction,
            'transactiontypes' => TransactionType::all(),
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'users' => User::all(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionFilterRequest $request, Transaction $transaction): RedirectResponse
    {
        $transaction->update($request->validated());
        return redirect(route('app.transactions.index', [
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'transactiontypes' => TransactionType::all(),
        ]))->with('success', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction): RedirectResponse
    {
        $transaction->delete();
        return redirect(route('app.transactions.index', [
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'transactiontypes' => TransactionType::all(),
        ]))->with('success', 'Transaction deleted successfully');
    }
}
