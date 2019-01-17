<?php
/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: BaseController.php
 * CodeLibrary/Project: oms
 * Author: Amit
 * CreatedOn: date (25/04/2017) 
 */

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

class BaseController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        
    }

    public function sendJsonResponse($response) {
        return \Illuminate\Support\Facades\Response::json($this->convertToCamelCase($response), $response['status_code'])->header('Content-Type', "application/json");
    }

    /**
     * Convert to Camel Case
     *
     * Converts array keys to camelCase, recursively.
     * @param  array  $array Original array
     * @return array
     */
    protected function convertToCamelCase($array) {
        $convertedArray = [];
        foreach ($array as $oldKey => $value) {
            if (is_array($value)) {
                $value = $this->convertToCamelCase($value);
            } else if (is_object($value)) {
                if ($value instanceof Model || method_exists($value, 'toArray')) {
                    $value = $value->toArray();
                } else {
                    $value = (array) $value;
                }

                $value = $this->convertToCamelCase($value);
            }
            $convertedArray[camel_case($oldKey)] = $value;
        }

        return $convertedArray;
    }

}
