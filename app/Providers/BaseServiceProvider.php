<?php

/*
 * Copyright 2016-2017 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: BaseServiceProvider.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (30/03/2017)
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * BaseServiceProvider works as a base class for all user defined providers
 */
class BaseServiceProvider extends ServiceProvider {

    /**
     * The default response format returned by a service
     *
     * @var array
     * message key conatins success/error message
     * success key conatains true/false
     * errors key conatains array of key-value validation errors for each input field in json, if validation fails
     * status_code key conatains HTTP STATUS CODE based on respose
     */
    protected static $data = [
        'message' => '',
        'success' => true,
        'errors' => [],
        'status_code' => \Symfony\Component\HttpFoundation\Response::HTTP_OK
    ];
    protected static $mail_data = [
        'view' => '',
        'data' => [],
        'user' => [],
    ];
    protected static $mailData = [
        'view' => '',
        'data' => [],
        'user' => [],
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
    /**
     * ExceptionError any application services.
     *
     * @return void
     */
    public static function setExceptionError(\Exception $e) {

        \Log::error("There is some exception in " . $e->getFile() . " on line no: " . $e->getLine() . " Message: " . $e->getMessage());

        static::$data['success'] = false;
        static::$data['status_code'] = \Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR;
        static::$data['message'] = trans('messages.exception_msg');
    }
    /**
     * ValidationError any application services.
     *
     * @return void
     */
    public static function setValidationError($message) {
        static::$data['success'] = false;
        static::$data['status_code'] = \Symfony\Component\HttpFoundation\Response::HTTP_BAD_REQUEST;
        static::$data['message'] = $message;
    }

}
