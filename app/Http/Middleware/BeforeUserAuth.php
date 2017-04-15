<?php namespace App\Http\Middleware;

use Closure;

class BeforeUserAuth
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
	    if ((!\Auth::check()) && (!\Auth::viaRemember())){
            return redirect('auth/login');
        }

        if(\Session::get('rules') != '1'){
            $url = ltrim(rtrim(preg_replace('/[0-9]+/', '', \Request::getPathInfo()),'/'),'/');
            if(!in_array($url,\Session::get('whitelist'))){
                if(!in_array($url,\Session::get('rules'))){
                    return redirect('admin/error');
                }
            } 
        }

        

        
        return $next($request);
    }
}
