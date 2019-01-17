<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: LikeDislikeRequest.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (22/06/2017) 
 */

namespace App\Http\Requests\Service;
use App\Http\Requests\BaseApiRequest;

class LikeDislikeRequest extends BaseApiRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
         'answerId'=>'required',
         'status' => 'required',
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
