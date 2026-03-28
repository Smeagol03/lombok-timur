<?php

namespace App\Providers;

use App\Helpers\HtmlSanitizer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HtmlSanitizerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HtmlSanitizer::class);
    }

    public function boot(): void
    {
        Blade::directive('sanitized', function ($expression) {
            return "<?php echo app(App\Helpers\HtmlSanitizer::class)->sanitize($expression); ?>";
        });
    }
}
