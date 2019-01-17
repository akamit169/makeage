<?php

/*
 * Copyright 2016-2017 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: UpdateUserAcrStatus.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (03/05/2017) 
 */

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAcrStatusRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules() {
        return [
            'id' => 'required',
            'status' => 'required'
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
