<?php

/*
 * Copyright 2018 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: UserRegistrationRequest.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (03/05/2017) 
 */

namespace App\Http\Requests\Service;
use App\Http\Requests\BaseApiRequest;
use App\Models\UserDevice;

class UserRegistrationRequest extends BaseApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|string|max:200|regex:/(?=.*[a-zA-Z0-9])/',
            'email' => 'required|unique:users,email',
            'mobile' => 'required|unique:users,mobile_number',
            'password' => 'required',
            'aadhar' => 'required',
            'address' => 'required',
            'companyName' => 'sometimes',
            'fax' => 'sometimes',
            'companyAddress' => 'sometimes',
            'registrationNo' => 'sometimes',
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
