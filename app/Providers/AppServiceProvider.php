<?php

namespace App\Providers;

use App\Models\CRM\Contact;
use App\Observers\CRM\ContactObserver;
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
        Contact::observe([
            ContactObserver::class
        ]);
    }
}
