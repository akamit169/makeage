<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: ResetPasswordRequest.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (03/05/2017) 
 */

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
           'password' => 'required|string|min:6|max:20|confirmed',
           'password_confirmation' => 'required'
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
