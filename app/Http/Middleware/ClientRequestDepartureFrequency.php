<?php

namespace App\Http\Middleware;

use App\ClientRequest;
use Closure;
use Illuminate\Support\Facades\Auth;

class ClientRequestDepartureFrequency
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
        $lastClientRequest = ClientRequest::getLastRequest(Auth::user());

        if ($lastClientRequest && !$lastClientRequest->canSendRequest()) {
            $msg = 'You can add new request after 24 hours, ' . $lastClientRequest->getRemain() . ' remain';
            return Redirect('/')->withErrors($msg);
        }
        return $next($request);
    }
}
