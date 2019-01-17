<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: BlockUser.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (6/09/2017) 
 */

namespace App\Models;

class BlockUser extends \Eloquent {

    protected $table = 'blocked_users';
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
