<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: Answer.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (27/06/2017) 
 */

namespace App\Models;

class Answer extends \Eloquent {

    protected $table = 'answers';
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
