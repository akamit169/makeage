<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: AssetsCategory.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (09/10/2017) 
 */

namespace App\Models;

class AssetCategory extends \Eloquent {

    protected $table = 'asset_category';
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
