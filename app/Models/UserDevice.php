<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: UserDevice.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (04/05/2017) 
 */

namespace App\Models;

class UserDevice extends \Eloquent {

    protected $table = 'user_tokens';
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
