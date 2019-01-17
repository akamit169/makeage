<?php

/*
 * Copyright 2016-2017 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: ApiAuth.php
 * CodeLibrary/Project: NA/DanceCards
 * Author:Amit kumar
 * CreatedOn: date (dd/mm/yyyy) 
*/

namespace App\Http\Middleware;
use Closure;

use App\Http\Controllers\BaseController;
use App\Models\User;
//use Illuminate\Support\Facades\Log;
class ApiAuth
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \Closure $next            
     * @return mixed
     */
    public function handle ($request, Closure $next)
    {
        /**
        * @todo: This code is used to log request headers
        */
        //Log::info("Request data " , ['request' => $request->header()]);
        $user = User::join('user_tokens','users.id', '=', 'user_tokens.user_id')
                ->where('user_tokens.user_token', '=', $request->header('userToken'))
                ->where('user_tokens.device_type', '=', $request->header('deviceType'))
                ->first();
        
        if (!$user) {
            $response['message'] = trans('messages.unauthorised');
            $response['success']= false;
            $response['status_code'] = \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED;
            $baseController = new BaseController();
            return $baseController->sendJsonResponse($response);
        }
    
        \Auth::loginUsingId($user->user_id);
        return $next($request);
    }
}