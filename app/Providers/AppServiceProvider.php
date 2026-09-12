<?php

namespace App\Providers;

use App\Services\SettingService;
use App\Services\TranslationService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingService::class);
        $this->app->singleton(TranslationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->directives();
    }

    private function directives()
    {
        Blade::directive('t', function ($expression) {
            return "<?php echo app('" . TranslationService::class . "')->get({$expression}); ?>";
        });



        Blade::directive('setting', function ($expression) {
            return "<?php echo app(\App\Services\SettingService::class)->get($expression); ?>";
        });

        Blade::if('settingAvailable', function (string $key): bool {
            $value = app(SettingService::class)->get($key);

            return $value !== null && $value !== '' && $value !== '#';
        });

        Blade::directive('settingAsset', function ($expression) {
            return "<?php echo asset('images/' . app('" . SettingService::class . "')->get($expression)); ?>";
        });

        Blade::directive('asset', function ($expression) {
            return "<?php echo asset($expression); ?>";
        });

        Blade::directive('route', function ($expression) {
            return "<?php echo route($expression); ?>";
        });
    }
}
