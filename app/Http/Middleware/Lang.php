<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Lang
{
    public function handle(Request $request, Closure $next)
    {
        $lang = $request->lang ?? "zh";
        if (!in_array($lang, ['en', 'zh'])) {
            $lang = "zh";
        }
        $request->lang = $lang;
        App::setLocale($lang);
        return $next($request);
    }
}
