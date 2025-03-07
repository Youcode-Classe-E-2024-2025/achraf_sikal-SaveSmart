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
            $userId = Auth::id();
            $this->calculateAndSaveBudget($userId);
            return $next($request);
        });
    }

    /**
     * Display the budget optimization page.
     */
    public function index()
    {
        $budgetOpt = BudgetOpt::where("user_id", auth()->id())->latest()->first();
        return view("budget.index", compact("budgetOpt"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Logic for saving budget customization (if needed)
    }

    /**
     * Update budget optimization data.
     */
    public function update(array $data, BudgetOpt $budgetOpt)
    {
        $budgetOpt->update($data);
    }

    /**
     * Delete a budget optimization record.
     */
    public function destroy(BudgetOpt $budgetOpt)
    {
        $budgetOpt->delete();
        return redirect()->route('budget.index')->with('success', 'Budget record deleted.');
    }

    /**
     * Calculate and save budget categories for a user.
     */
    private function calculateAndSaveBudget($userId)
    {
        // Fetch all transactions with categories
        $transactions = Transaction::where("user_id", $userId)->with('category')->get();

        // Needs Calculation
        $needs = $this->calculateNeeds($transactions);

        // Wants Calculation
        $wants = $this->calculateWants($transactions);

        // Income Calculation
        $income = $this->calculateIncome($userId);

        $savings = $this->calculateSavings($transactions);

        // Save or update budget data
        $existingRecord = BudgetOpt::where('user_id', $userId)->first();

        if (!$existingRecord) {
            BudgetOpt::create([
                'user_id' => $userId,
                'income'  => $income,
                'needs'   => $needs,
                'wants'   => $wants,
                'savings' => $savings,
            ]);
        } else {
            $existingRecord->update([
                'income'  => $income,
                'needs'   => $needs,
                'wants'   => $wants,
                'savings' => $savings,
            ]);
        }
    }

    /**
     * Calculate total "Needs" transactions.
     */
    private function calculateNeeds($transactions)
    {
        return $transactions->filter(function ($transaction) {
            return in_array($transaction->category->name, ['Food', 'Healthcare', 'Rent', 'Education']);
        })->sum('amount');
    }

    /**
     * Calculate total "Wants" transactions.
     */
    private function calculateWants($transactions)
    {
        return $transactions->filter(function ($transaction) {
            return !in_array($transaction->category->name, ['Food', 'Healthcare', 'Rent', 'Education', 'Salary', 'Savings']);
        })->sum('amount');
    }

    private function calculateSavings($transactions)
    {
        return $transactions->whereIn('category.name', ['Savings'])->sum('amount');
    }
    /**
     * Calculate total Income.
     */
    private function calculateIncome($userId)
    {
        return Transaction::where("user_id", $userId)
        ->where('type', 'income')->sum('amount');
    }
}
