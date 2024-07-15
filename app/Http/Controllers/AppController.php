<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Admin\Amount;
use App\Models\Admin\Setting;
use Illuminate\View\View;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('welcome', [
            'accounts' => Account::all(),
            'amounts' => Amount::all(),
            'settings' => Setting::all(),
        ]);
    }
}
