<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: UserController.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (03/05/2017) 
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Providers\Admin\UserServiceProvider;
use Illuminate\Support\Facades\Request;

class UserController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.dashboard');
    }
    /**
     * used to get list of all  user list
     *
     * @return void
     */
    public function getUserList() {
        try {
        return view('admin.user.user_list');
        } catch (Exception $e) {
            Log::error(__CLASS__."::".__METHOD__.' ' . $e->getFile(). $e->getLine() . $e->getMessage());
            return Redirect::back();
        }
    }
    
    /**
     * function is used to get  user list
     * @return json
     */
    public function getUserListAjax() {
       
        try {
            if (Request::ajax()) {
                return UserServiceProvider::getUserList();
            } 
            abort(404);
        }  catch (Exception $e) {
            Log::error(__CLASS__."::".__METHOD__.' ' . $e->getFile(). $e->getLine() . $e->getMessage());
            abort(404);
        }
    }
    /**
     * used to get list of all  user Detail
     *
     * @return void
     */
    public function getUserDetails($id) {
       
        try {
            $response =  UserServiceProvider::getUserDetails($id);
            
            return view('admin.user.user_details')->with('userObj', $response['data']);
        } catch (Exception $e) {
            Log::error(__CLASS__."::".__METHOD__.' ' . $e->getFile(). $e->getLine() . $e->getMessage());
            return Redirect::back();
        }
    }
    
    /**
     * used to get list of all  report list
     *
     * @return void
     */
    public function getReportList() {
        try {
        return view('admin.user.user_report');
        } catch (Exception $e) {
            Log::error(__CLASS__."::".__METHOD__.' ' . $e->getFile(). $e->getLine() . $e->getMessage());
            return Redirect::back();
        }
    }
    
    /**
     * function is used to get  report list
     * @return json
     */
    public function getReportListAjax() {
       
        try {
            if (Request::ajax()) {
                
                return UserServiceProvider::getReportList();
            } 
            abort(404);
        }  catch (Exception $e) {
            Log::error(__CLASS__."::".__METHOD__.' ' . $e->getFile(). $e->getLine() . $e->getMessage());
            abort(404);
        }
    }
    
    
    /**
     * used to get list of all  report Detail
     *
     * @return void
     */
    public function getReportDetails($id) {
       
        try {
            $response =  UserServiceProvider::getReportDetails($id);
           
            return view('admin.user.report_details')->with('userObj', $response['data']);
        } catch (Exception $e) {
            Log::error(__CLASS__."::".__METHOD__.' ' . $e->getFile(). $e->getLine() . $e->getMessage());
            return Redirect::back();
        }
    }
    
    /**
     * used to get list of all  delete report Detail
     *
     * @return void
     */
    public function getDeleteReportedUser($id) {
        try {
            
            return view('admin.user.delete_reported_user')->with('userObj', $id);
        } catch (Exception $e) {
            Log::error(__CLASS__."::".__METHOD__.' ' . $e->getFile(). $e->getLine() . $e->getMessage());
            return Redirect::back();
        }
    }
    
    /**
     * used to get list of all  delete report Detail
     *
     * @return void
     */
    public function postDeleteReportedUser() {
        try {
            $response = UserServiceProvider::deleteUserWithReaon();
            if ($response['success'] == true) {
                return redirect('admin/user')->with('error_msg', $response['message']);;
            } else {
                return redirect()->back()->with('error_msg', $response['message']);
            }
        } catch (Exception $e) {
            Log::error(__CLASS__."::".__METHOD__.' ' . $e->getFile(). $e->getLine() . $e->getMessage());
            return Redirect::back();
        }
    }
}
