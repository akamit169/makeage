<?php

/*
 * Copyright 2016-2017 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: Clickjacking.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (03/05/2017) 
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class Clickjacking {

    public function handle(Request $request, \Closure $next) {
        return $next($request)->header('X-Frame-Options', 'DENY');
    }

}
