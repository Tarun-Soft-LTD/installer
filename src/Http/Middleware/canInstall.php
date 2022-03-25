<?php

namespace NirapodSoft\Installer\Http\Middleware;

use Closure;

class canInstall 
{
    public function handle($request, Closure $next)
    {
        if($this->alreadyInstalled()){
            abort(404);
        }
        return $next($request);
    }
    
    /**
     * If application is already installed.
     *
     * @return boolean
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }
}