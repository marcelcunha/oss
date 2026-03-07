<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());

        TallStackUi::customize()->card()->block('footer.wrapper')->append('flex justify-end gap-2');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
