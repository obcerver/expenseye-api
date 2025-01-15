<?php

namespace App\Policies;

use App\Http\Requests\StoreExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExpensePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): Response
    {
        return $user->id === $category->user
            ? Response::allow()
            : Response::deny('You do not own this expenses');
    }

    public function store(User $user, StoreExpenseRequest $request): Response
    {
        $category = Category::find($request->category);
        
        return $user->id === $category->user
            ? Response::allow()
            : Response::deny('You do not own this category');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function modify(User $user, Expense $expense): Response
    {
        return $user->id === $expense->user
            ? Response::allow()
            : Response::deny('You do not own this expenses');
    }
}
