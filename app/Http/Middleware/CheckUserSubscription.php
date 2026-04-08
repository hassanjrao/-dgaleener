<?php

namespace App\Http\Middleware;

use Closure;

use URL;

class CheckUserSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->hasValidSubscription()) {
            return $next($request);
        }

        return redirect(\URL::route('app.dashboard'))
                    ->with('message.fail', 'Your subscription has expired or invalid. Please renew your subscription to continue our services. Renew here, '.URL::route('app.pricing').'.');
    }
}
