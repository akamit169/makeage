<?php

/*
 * Copyright 2016-2017 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: ExportReportController.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (03/05/2017) 
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XSS {

    /**
     * @param Request $request
     * @param Closure $next
     * @return type
     */
    public function handle(Request $request, Closure $next) {
        $input = $request->all();
        array_walk_recursive($input, function(&$input) {
            $input = strip_tags($input);
        });

        $request->merge($input);
        return $next($request);
    }

}
