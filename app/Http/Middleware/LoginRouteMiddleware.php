<?php

namespace App\Http\Middleware;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginRouteMiddleware {

    public function handle($request, $next) {
        // save logs to DB
        $response = $next($request);


        $res = json_decode($response->content(), true);
        if (isset($res['status']) && $res['status']) {
            $user = $res['data'];
            // get country from api free
            $details = json_decode(file_get_contents("http://ipinfo.io/{$request->ip()}/json"));
            \DB::table('user_logs')->insert(
                    [
                        'user_id' => $user['id'],
                        'ip' => $request->ip(),
                        'country' => $details->country ?? null,
                        'device' => $request->header('User-Agent'),
                        'system' => $request->header('User-Agent'),
                        'created_at' =>date('Y-m-d', time())
                    ]
            );
        }
        return $response;
    }

//      public function terminate($request, $response)
//    {
//        // Store the session data...
//    }
}
