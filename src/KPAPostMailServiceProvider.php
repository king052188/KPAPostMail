<?php

namespace king052188\KPAPostMail;

use Illuminate\Support\ServiceProvider;

class KPAPostMailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ .'/routes/routes.php';
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('king052188-kpapostmail', function() {
          return new KPAPostMail();
        });
    }
}
