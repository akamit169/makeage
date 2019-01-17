<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: UserOtpRequest.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (11/05/2017) 
 */

namespace App\Http\Requests\Service;
use App\Http\Requests\BaseApiRequest;
use App\Models\UserDevice;

class UserOtpRequest extends BaseApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'mobileNumber' => 'required',
            'otp' => 'required',
            'deviceToken' => 'sometimes',
            'deviceType' => 'required:'.UserDevice::IS_IOS.''.UserDevice::IS_AND,
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'name.regex' => 'First Name should be in characters or digits.',
            ];
    }
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

}
