<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
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

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function modify(User $user, Category $category): Response
    {
        return $user->id === $category->user
            ? Response::allow()
            : Response::deny('You do not own this expenses');
    }
}
