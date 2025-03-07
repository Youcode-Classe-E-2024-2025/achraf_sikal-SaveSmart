<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customCategory = Category::where('user_id', auth()->user()->id)->get();
        $defCategory = Category::where('user_id', null)->get();

        return view('transaction.index', compact('customCategory', 'defCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $incomingFields = $request->validate([
            'amount' => [
                'required',
                'numeric',
                'between:1,100000',
            ],
            'category_id' => [
                'required',
            ],
            'date' => [
                'required',
                'date',
            ],
            'description' => [],
        ], [
            'amount.required' => 'The amount is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.between' => 'The amount must be between 1 $ and 100,000 $.',
            'category.required' => 'The category is required.',
            'date.required' => 'The date is required.',
            'date.date' => 'The date format is invalid.',
        ]);
        $profileId = Session::get('profile')->id;
        $incomingFields['user_id'] = auth('')->user()->id;
        $incomingFields['profile_id'] = $profileId;
        $incomingFields['type'] = Category::find($incomingFields['category_id'])->type;
        Transaction::create($incomingFields);

        return redirect('/profile/'.$profileId);
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
    public function show(Transaction $transaction) {}

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

    public function showall()
    {
        if (Auth::check()) {
            $transactions = Transaction::where('user_id', auth()->user()->id)->with('profile')->paginate(10);

            return view('transaction.desplay', compact('transactions'));
        } else {
            return redirect('/login');
        }
    }
}
