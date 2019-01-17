<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: LoginUserRequest.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (03/05/2017) 
 */

namespace App\Http\Requests;

class LoginUserRequest extends BaseApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required|email|max:200',
            'password' => 'required|max:12|min:4',
            'deviceType' => 'required|max:200',
            'deviceToken' => 'required|max:200'
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
