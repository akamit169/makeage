<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: Report.php
 * CodeLibrary/Project: oms
 * Author: Amit
 * CreatedOn: date (24/08/2017) 
 */

namespace App\Models;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Report extends Authenticatable
{

    protected $table = 'reports';
    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'created_at'
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
     * function is used to get  user list
     * @param array $data
     * @return type
     */
    public function getReportList($data=array()) {
        $totalResult = DB::table($this->table)
                    ->join('users as use', function($join) {
                        $join ->on('reports.user_id', 'use.id');
                      })
                    ->join('users as user', function($join) {
                        $join ->on('reports.report_for', 'user.id');
                      })    
                    ->select($this->table.'.*','use.name','use.avatar_name','user.name as reported_for','user.id as reported_user_id');
        $searchQuery = '';
        if (isset($data['q'])) {
            $searchQuery = $data['q'];
        }
        
        if ($data) {
            if (isset($searchQuery) && !empty($searchQuery)) {
                $totalResult->where(function($query) use($searchQuery) {
                    
                        $query->orWhere($this->table.'.report_content', 'like', '%' . $searchQuery . '%');
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
