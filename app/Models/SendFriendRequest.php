<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: SendFriendRequest.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (12/07/2017) 
 */

namespace App\Models;

class SendFriendRequest extends \Eloquent {

    protected $table = 'friends';
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
