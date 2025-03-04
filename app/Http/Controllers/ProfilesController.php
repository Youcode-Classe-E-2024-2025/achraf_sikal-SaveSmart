<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Profiles;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\ExpectsHigherOrderMessage;
use Illuminate\Support\Facades\Session;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profiles::where('user_id', auth()->user()->id)->get();
        return view("profile.index", compact("profiles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $incomingFields = $request->validate([
            'profile_name' => [
                'required',
                'min:3',
                'unique:profiles,name'
            ]
        ], [
            'name.unique' => 'This profile name is already taken. Please choose another one.',
            'name.required' => 'The profile name is required.',
            'name.min' => 'The profile name must be at least 3 characters long.'
        ]);
        $incomingFields['name'] = $incomingFields['profile_name'];
        $incomingFields['user_id'] = auth()->user()->id;
        Profiles::create($incomingFields);
        return redirect()->route('profile.index')->with('success', 'Profile created successfully.');
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
    public function show(Profiles $profile)
    {
        if (Auth::check()) {
            $transactions = Transaction::where('user_id', auth()->user()->id)->with('profile')->take(3)->get();
            $categories = Category::where('user_id', auth()->user()->id)->get();
            $user = auth()->user();
            $profileTransactions = Profiles::where('id', $profile->id)->with('transaction')->first();
            Session::put('profile', $profile);
            return view('profile.dash',compact('user','profile', 'transactions', 'categories','profileTransactions'));
        }
        else {
            return redirect('/login');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profiles $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profiles $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profiles $profiles)
    {
        //
    }
}
