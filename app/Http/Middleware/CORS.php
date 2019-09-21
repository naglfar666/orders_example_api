<?php
namespace App\Http\Middleware;

use Closure;

class CORS {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      if($request->getMethod() == "OPTIONS") {
        header('Content-Type: text/html; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        return response('OK', 200);
      }
      $response = $next($request);
      $response->header('Content-Type', 'text/html; charset=utf-8');
      $response->header('Access-Control-Allow-Origin', '*');
      $response->header('Access-Control-Allow-Headers', '*');
      $response->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS');
      return $response;
    }

}
?>
