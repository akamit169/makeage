<?php

/*
 * Copyright 2016-2017 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: UserLoginRequest.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (17/10/2017) 
 */

namespace App\Http\Requests\Service;
use App\Http\Requests\BaseApiRequest;
use App\Models\UserDevice;

class UserLoginRequest extends BaseApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required',
            'password' => 'required',
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
