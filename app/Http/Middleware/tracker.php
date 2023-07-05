<?php

namespace App\Http\Middleware;

use App\Models\Shorturl;
use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class tracker
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

        // incriment click value of the URL

        $code = $request->route('any');


        $url = Shorturl::where('short_url',$code)->first();

        $url->clicks +=1 ;


        $url->save();


        // save the visitor

        $visitor = new Visitor();

        $visitor->url = $url->id ;

        $visitor->ip = $request->ip();

        $visitor->user_agent = $request->userAgent();

        $visitor->save();





        return $next($request);
    }
}
