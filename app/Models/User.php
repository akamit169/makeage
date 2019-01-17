<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: User.php
 * CodeLibrary/Project: oms
 * Author: Amit
 * CreatedOn: date (25/08/2017) 
 */

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    const IS_ADMIN = 1;
    const IS_SALES = 2;
    const IS_PRODUCTION_USER = 3;
    const IS_APPROVED = 1;
    const IS_DISAPPROVED = 2;
    const IS_ACTIVE = 2;
    const IS_INACTIVE = 1;
    const GENDER = ['MALE' => 1, 'FEMALE' => 2, 'OTHER' => 3];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at','deleted_at', 'created_at'
    ];
    
    
    /**
     * function is used to fetch customer detail
     * @param int $userId
     * @return Object
     */
    public static function fetchCustomerDetail($userId) {
        
        $userObj = User::where('user.id', $userId)
                        ->select('user.*')
                        ->first();
        return $userObj;
    }
    /**
     * function is used to get  password decrypt
     * @param array $data
     * @return type
     */
    public function getEjabberdPasswordAttribute($value) {
        return empty($value) ? $value : decrypt($value);
    }
    /**
     * function is used to date of birth formate
     * @param array $data
     * @return type
     */
    public function getDateOfBirthAttribute($value)
    {
        
        if($value=="0000-00-00"){
            $value='';
        }
        return $value;
    }
    /**
     * function is used to get  user list
     * @param array $data
     * @return type
     */
    public function getUserList($data=array()) {
        $totalResult = DB::table($this->table)
                    ->where('users.role', '!=', User::IS_ADMIN)
                    ->where('users.role', '=',  User::IS_USER)
                    ->where('users.status', User::IS_ACTIVE)
                    ->select($this->table.'.*');
        $searchQuery = '';
        if (isset($data['q'])) {
            $searchQuery = $data['q'];
        }
        
        if ($data) {
            if (isset($searchQuery) && !empty($searchQuery)) {
                $totalResult->where(function($query) use($searchQuery) {
                        $query->orWhere($this->table.'.email', 'like', '%' . $searchQuery . '%');
                        $query->orWhere($this->table.'.name', 'like', '%' . $searchQuery . '%');
                        $query->orWhere($this->table.'.mobile_number', 'like', '%' . $searchQuery . '%');
                        $query->orWhere($this->table.'.avatar_name', 'like', '%' . $searchQuery . '%');
                        
                    });
            }
            $resultCount = $totalResult->get();
            $totalResult->orderby($this->table.'.id', 'desc');
            $result = $totalResult->skip($data['offset'])->take($data['limit'])->get();
        } else {
            $result = $totalResult->get();
            $resultCount = $result;
        }
        $resultCount = count($resultCount);
        return array('count' => $resultCount, 'result' => $result);
    }
    
}
