<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Property;

class PropertyOwner
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
        $property = Property::where([
                'id' => $request->id,
                'user_id' => $request->user()->id
            ])->exists();

        if(!$property) {

            if($request->ajax()) {

                return response()->json([
                        'error' => 'Unauthorized access',
                        'status' => '403'
                    ], 403);

            } else {

                flash()->overlay("Error", "Unauthorized access", 'error');

                return redirect()->back();

            }
            
        }

        return $next($request);
    }
}
