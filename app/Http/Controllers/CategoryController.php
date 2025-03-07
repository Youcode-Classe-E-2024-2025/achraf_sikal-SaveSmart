<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $incomingFields = $request->validate([
            'name' => [
                'required',
                'min:3',
                'unique:categories,name',
            ],
            'type' => [
                'required',
            ],
            'id' => [
                'required',
            ],
        ], [
            'name.unique' => 'This category name is already taken. Please choose another one.',
            'name.required' => 'The category name is required.',
            'name.min' => 'The category name must be at least 3 characters long.',
        ]);
        $incomingFields['user_id'] = auth()->user()->id;
        Category::create($incomingFields);

        return redirect()->route('profile.show', $incomingFields['id'])->with('success', 'Catgory created successfully.');

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
    public function show(Category $category) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
