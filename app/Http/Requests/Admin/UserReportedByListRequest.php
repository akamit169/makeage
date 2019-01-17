<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: UserReportedByListRequest.php
 * CodeLibrary/Project: oms
 * Author:Amit kumar ]
 * CreatedOn: date (17/04/2017)
 */

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserReportedByListRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'id' => 'required|integer|exists:users,id'
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
