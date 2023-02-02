<?php

namespace Cis\CisAccess\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Define Area Middleware
|--------------------------------------------------------------------------
|
| With the define aerea middleware you can define a middleware for your
| routes with an area parameter
|
*/
class DefineArea
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param $areaSlug
     * @return mixed
     */

    public function handle(Request $request, Closure $next, $areaSlug)
    {
        if(!auth()->user()->hasAccess($areaSlug)) {
            abort(403);
        }

        return $next($request);
    }
}
