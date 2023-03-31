<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $memberInfo = expireStatus(auth()->user()->id);
        if ($memberInfo && $memberInfo['status'] == false) {
            $view = view('dashboard.user.membership')->with(['membershipInfo' => $memberInfo]);
            return response($view);
        }
        return $next($request);
    }
}
