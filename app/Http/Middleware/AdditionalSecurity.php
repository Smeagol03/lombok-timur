<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdditionalSecurity
{
    protected array $blockedPatterns = [
        '/<script[^>]*>.*?<\/script>/is',
        '/javascript:/i',
        '/on\w+\s*=\s*["\'][^"\']*["\']/i',
        '/<iframe/i',
        '/<object/i',
        '/<embed/i',
        '/expression\s*\(/i',
        '/vbscript:/i',
        '/data:\s*text\/html/i',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $input = json_encode($request->all());

        foreach ($this->blockedPatterns as $pattern) {
            if (preg_match($pattern, $input)) {
                Log::warning('Security: Suspicious input detected', [
                    'ip' => $request->ip(),
                    'url' => $request->url(),
                    'pattern' => $pattern,
                    'user_agent' => $request->userAgent(),
                ]);

                abort(403, 'Suspicious input detected.');
            }
        }

        $response = $next($request);

        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        if ($request->is('admin/*') || $request->is('filament/*')) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }

        return $response;
    }
}
