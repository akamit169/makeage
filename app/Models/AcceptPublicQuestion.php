<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: AcceptPublicQuestion.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (04/11/2017) 
 */

namespace App\Models;

class AcceptPublicQuestion extends \Eloquent {

    protected $table = 'accept_public_question';
    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
