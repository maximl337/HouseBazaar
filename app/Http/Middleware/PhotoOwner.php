<?php

namespace App\Http\Middleware;

use Closure;
use App\Photo;

class PhotoOwner
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

        try {

            if($request->user() != Photo::find($request->id)->owner()) {

                if($request->ajax()) {

                    return response()->json([
                            'error' => 'Unauthorized access',
                            'status' => '403'
                        ], 403);

                } else {

                    flash('Not allowed', 'Unauthorized access!', 'error');

                    return redirect()->back();

                }
                
            }

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            if($request->ajax()) {

                    return response()->json([
                            'error' => 'Photo not found',
                            'status' => '403'
                        ], 403);

                } else {

                    flash('Error', 'Photo not found!', 'error');

                    return redirect()->back();

                }

        }
        

        return $next($request);
    }
}
