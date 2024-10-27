<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Report;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        Gate::Define('admin', function (User $user) { //use on 'can'/'canany' blade
            return $user->role === 2;
        });

        view()->composer('layouts.partials.header', function ($view) {
            $view->with('reviewer_notif', Report::where('status', 'Submit')->count())
                ->with('approver_notif', Report::whereIn('status', ['Reviewed', 'Approved'])->count());
        });
    }
}
