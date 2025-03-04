<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customCategory = Category::where('user_id',auth()->user()->id)->get();
        $defCategory = Category::where('user_id',null)->get();
        return view("transaction.index", compact("customCategory","defCategory"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $incomingFields = $request->validate([
            'type' => [
                'required',
                'in:expense,income'
            ],
            'amount' => [
                'required',
                'numeric',
                'between:1,100000'
            ],
            'category_id' => [
                'required'
            ],
            'date' => [
                'required',
                'date'
            ],
            'description'=>[]
        ], [
            'type.required' => 'The transaction type is required.',
            'type.in' => 'The transaction type must be either "expense" or "income".',
            'amount.required' => 'The amount is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.between' => 'The amount must be between 1 $ and 100,000 $.',
            'category.required' => 'The category is required.',
            'date.required' => 'The date is required.',
            'date.date' => 'The date format is invalid.'
        ]);
        $incomingFields['user_id'] = auth('')->user()->id;
        $incomingFields['profile_id'] = Session::get('profile')->id;
        Transaction::create($incomingFields);
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
    public function show(Transaction $transaction)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
