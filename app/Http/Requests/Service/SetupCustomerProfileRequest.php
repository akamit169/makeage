<?php

/*
 * Copyright 2016-2017 Appster Information Pvt. Ltd. 
 * All rights reserved.
 * File: SetupCustomerProfileRequest.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (13/04/2017) 
 */

namespace App\Http\Requests\Service;
use App\Http\Requests\BaseApiRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SetupCustomerProfileRequest extends BaseApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
       $user = Auth::user();
       return [
         'email' => 'sometimes',
         'stateName' => 'sometimes',
         'countryName' => 'sometimes',
         'gender' => 'sometimes|in:'.implode(',',User::GENDER),
         'dateOfBirth' => 'sometimes|date_format:Y-m-d',
         'relationShipStatus' => 'sometimes',
         'like' => 'sometimes',
         'disLike' => 'sometimes',
         'userBio' => 'sometimes',
         'avatar_name' => ['sometimes',Rule::unique('users')->ignore($user->id)],
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
