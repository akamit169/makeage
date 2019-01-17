<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: LoginUserRequest.php
 * CodeLibrary/Project: oms
 * Author: Amit
 * CreatedOn: date (25/04/2017) 
 */

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest {
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required|email|max:50',
            'password' => 'required|min:6|max:20'
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
