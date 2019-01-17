<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: UsersDisLikeKeywords.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (27/06/2017) 
 */

namespace App\Models;

class UsersDisLikeKeywords extends \Eloquent {
    public $timestamps = false;
    protected $table = 'users_dislike_keywords';
    protected $primaryKey = 'id';
}
