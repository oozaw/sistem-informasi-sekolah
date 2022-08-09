<?php

namespace App\Providers;

use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        // membagikan data user yg login ke semua view
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('user', Auth::user());
            } else {
                $view->with('user', null);
            }
        });

        // membagikan data notifikasi prestasi yang piagamnya belum lengkap
        View::composer('*', function ($view) {
            $emptyPiagam = Prestasi::getEmptyPiagam();
            $view->with('piagamKosong', $emptyPiagam);
        });

        // Gate
        Gate::define('admin', function (User $user) {
            return $user->role == 1;
        });

        Gate::define('guru', function (User $user) {
            return $user->role == 2;
        });

        Gate::define('tata-usaha', function (User $user) {
            return $user->role == 3 || $user->role == 1;
        });

        Gate::define('kepsek', function (User $user) {
            return $user->role == 4;
        });
    }
}