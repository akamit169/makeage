<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: Notification.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (31/08/2017) 
 */

namespace App\Models;

class Notification extends \Eloquent {

    protected $table = 'notifications';
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
