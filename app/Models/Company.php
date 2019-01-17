<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: Company.php
 * CodeLibrary/Project: oms
 * Author: Amit
 * CreatedOn: date (25/08/2017) 
 */

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Company extends Authenticatable
{
    use Notifiable;

    protected $table = 'company';
    protected $primaryKey = 'id';
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'created_at'
    ];
    
    
}
