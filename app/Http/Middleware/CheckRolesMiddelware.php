<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheckRolesMiddelware
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
        
        
        if (!Auth::user())
        {
            return redirect()->route('login');
        }
        elseif(DB::table('users')->find(Auth::user()->id)->active != 1)
        {
            return redirect()->route('login');
        }
        else{
            
            $role = DB::table('users')->where('id', Auth::user()->id)->first()->role;
            if(!$role){
                return redirect()->back();
            }
            else{
                switch($role){
                    case '2':
                        return $next($request);
                        break;
                   
                    case '1':
                        return redirect()->back();
                        break;
                    
                    default:
                        return redirect()->back();
                        break;
                }
            }
        }
        return redirect()->back();
    }
}
