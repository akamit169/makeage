<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: Keyword.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (27/06/2017) 
 */

namespace App\Models;

class Keywords extends \Eloquent {

    protected $table = 'keywords';
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
