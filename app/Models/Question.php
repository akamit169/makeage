<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: Quesiton.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (23/06/2017) 
 */

namespace App\Models;

class Question extends \Eloquent {

    protected $table = 'questions';
    protected $primaryKey = 'id';

    const IS_IOS = 1;
    const IS_AND = 2;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
