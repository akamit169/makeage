<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: Ejabberd.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (31/07/2017) 
 */

namespace App\Models;

class Ejabberd extends \Eloquent {
    protected $connection = 'mysql2';
    protected $table = 'archive';
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
