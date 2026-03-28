<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureRateLimiting();

        View::composer('*', function ($view) {
            try {
                $setting = Setting::getInstance();
                $view->with('setting', $setting);
            } catch (\Exception $e) {
                $view->with('setting', null);
            }
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('public', function (Request $request) {
            return Limit::perMinute(120)
                ->by($request->ip())
                ->response(function (Request $request, array $headers) {
                    return response('Too many requests. Please try again later.', 429, $headers);
                });
        });

        RateLimiter::for('search', function (Request $request) {
            $key = 'search:'.$request->ip();

            return Limit::perMinute(30)
                ->by($key)
                ->response(function (Request $request, array $headers) {
                    return response('Too many search requests. Please wait a moment.', 429, $headers);
                });
        });

        RateLimiter::for('contact', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->ip())
                ->response(function (Request $request, array $headers) {
                    return response('Too many submissions. Please try again later.', 429, $headers);
                });
        });

        RateLimiter::for('filament', function (Request $request) {
            return Limit::perMinute(60)
                ->by($request->user()?->id ?: $request->ip())
                ->response(function (Request $request, array $headers) {
                    return response('Too many admin requests. Please slow down.', 429, $headers);
                });
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->ip())
                ->response(function (Request $request, array $headers) {
                    return response('Too many login attempts. Please try again later.', 429, $headers);
                });
        });
    }
}
