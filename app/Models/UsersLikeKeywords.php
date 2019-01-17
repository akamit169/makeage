<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: UsersLikeKeywords.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (27/06/2017) 
 */

namespace App\Models;

class UsersLikeKeywords extends \Eloquent {
    public $timestamps = false;
    protected $table = 'users_like_keywords';
    protected $primaryKey = 'id';
}
