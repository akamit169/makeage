<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: Assets.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (04/10/2017) 
 */

namespace App\Models;

class Asset extends \Eloquent {

    protected $table = 'assets';
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
