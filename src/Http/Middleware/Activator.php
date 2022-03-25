<?php

namespace Nirapodsoft\Installer\Http\Middleware;

use Closure;
use Nirapodsoft\Installer\Helpers\CoreRepository;

class Activator{
    public function handle($request, Closure $next)
    {
        if(!CoreRepository::analysis()){
            abort(404);
        }
        return $next($request);
    }
}