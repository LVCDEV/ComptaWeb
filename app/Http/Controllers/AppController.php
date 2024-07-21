<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchFilterRequest;
use App\Models\Account;
use App\Models\Admin\AccountType;
use App\Models\Admin\Amount;
use App\Models\Admin\Setting;
use App\Models\Admin\TransactionType;
use App\Models\Admin\User;
use App\Models\Transaction;
use Illuminate\View\View;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        if (auth()->user()->user_type_id !== 1)
        {
            $accounts = Account::where('user_id', auth()->user()->id)->with('amount', 'accountType')->get();
            $admin_user = false;
        }
        else
        {
            $accounts = Account::with('amount', 'accountType')->get();
            $admin_user = true;
        }
        return view('welcome', [
            'accounts' => $accounts,
            'settings' => Setting::all(),
            'accounttypes' => AccountType::all(),
            'admin_user' => $admin_user,
        ]);

    }

    public function search_account(SearchFilterRequest $request): View
    {
        $data = $request->validated();
        $attribute = 'account_id';
        $value = $data['account_id'];

        return view('transaction.index', [
            'transactions' => Transaction::where($attribute, $value)->paginate(25),
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'transactiontypes' => TransactionType::all(),
        ]);
    }

    public function search_transaction(SearchFilterRequest $request): View
    {
        $data = $request->validated();
        $attribute = 'transaction_type_id';
        $value = $data['transaction_type_id'];

        return view('transaction.index', [
            'transactions' => Transaction::where($attribute, $value)->paginate(25),
            'accounts' => Account::where('user_id', auth()->user()->id)->get(),
            'transactiontypes' => TransactionType::all(),
        ]);
    }
}
