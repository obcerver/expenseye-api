<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Http\Requests\StoreExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use App\Policies\CategoryPolicy;
use App\Policies\ExpensePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Category::class => ExpensePolicy::class,
        StoreExpenseRequest::class => ExpensePolicy::class,
        Expense::class => ExpensePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
