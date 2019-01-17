<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: Answer.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (18/08/2017) 
 */

namespace App\Models;

class AnswerLiked extends \Eloquent {

    protected $table = 'answer_liked';
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
