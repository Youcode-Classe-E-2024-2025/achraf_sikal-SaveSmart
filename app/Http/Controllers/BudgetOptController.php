<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\budgetOpt;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BudgetOptController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.auth');
        $this->middleware(function ($request, $next) {
            $userId = Auth::user()->id;
            $transaction = Transaction::where("user_id", $userId)->with('category')->get();
            ///////////// needs //////////////
            $needs = $transaction->filter(function ($transaction) {
                return in_array($transaction->category->name, ['Food', 'Healthcare', 'Rent', 'Education']);
            })->sum('amount');

            ///////////// wants //////////////
            $wants = $transaction->filter(function ($transaction) {
                return !in_array($transaction->category->name, ['Food', 'Healthcare', 'Rent', 'Education', 'Salary']);
            })->sum('amount');


            ///////// total income //////////
            $income = User::with('transaction')->find($userId)->transaction->where('type','income')->sum('amount');
            $existingRecord = BudgetOpt::where('user_id', $userId)->first();
            (!$existingRecord) ? BudgetOpt::create(['user_id' => $userId]) : false;
            $existingRecord ? BudgetOpt::where('user_id', $userId)->update(['income'=> $income,'wants'=> $wants,'needs'=> $needs]) : false;
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgetOpt = BudgetOpt::where("user_id",auth()->user()->id)->orderBy("created_at","desc")->first();
        return view("budget.index", compact("budgetOpt"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(budgetOpt $budgetOpt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(budgetOpt $budgetOpt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, budgetOpt $budgetOpt)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(budgetOpt $budgetOpt)
    {
        //
    }
}
