<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: UserResendOtpRequest.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (31/05/2017) 
 */

namespace App\Http\Requests\Service;
use App\Http\Requests\BaseApiRequest;
use App\Models\UserDevice;

class UserResendOtpRequest extends BaseApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'mobileNumber' => 'required',
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
