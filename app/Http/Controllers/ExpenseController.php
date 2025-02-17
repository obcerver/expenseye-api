<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Resources\ExpenseResource;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ExpenseCollection(Expense::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        Gate::authorize('store', $request);
        return new ExpenseResource($request->user()->expenses()->create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    /**
     * Display the specified resource by user id.
     */
    public function user(Request $request)
    {
        // Fetch expenses for the authenticated user and eager load the 'category' relationship
        $expenses = Expense::where('user', $request->user()->id)
            ->with('category') // Eager load category
            ->orderBy('issuedAt', 'desc') // Sort by issuedAt date (oldest first)
            ->get();

        // Return the expenses as a collection of ExpenseResource
        return ExpenseResource::collection($expenses);
    }

    /**
     * Display the specified resource by category id.
     */
    public function category(Category $category)
    {
        Gate::authorize('view', $category);
        return ExpenseResource::collection(Expense::where('category', $category->id)->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {   
        Gate::authorize('modify', $expense);
        $expense->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
    }
}
