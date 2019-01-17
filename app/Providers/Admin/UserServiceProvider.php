<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: UserServiceProvider.php
 * CodeLibrary/Project: oms
 * Author: Amit kumar
 * CreatedOn: date (02/05/2017) 
 */

namespace App\Providers\Admin;

use App\Models\User;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Utilities\Mail;
use App\Providers\BaseServiceProvider;
use DateTime;
use Illuminate\Support\Facades\Input;

/**
 * UserServiceProvider class conatains methods for user management
 */
class UserServiceProvider extends BaseServiceProvider {

    /**
     * Change user password
     *
     * @param type $data
     * @return type
     */
    public static function changePassword($data) {
        try {
            $user = Auth::user();

            if (!\Hash::check($data['old_password'], $user->password)) {
                static::$data['message'] = trans('messages.incorrect_old_password');
                static::$data['success'] = false;
                static::$data['status_code'] = \Symfony\Component\HttpFoundation\Response::HTTP_BAD_REQUEST;
                return static::$data;
            }

            $user->password = \Hash::make($data['password']);
            $user->save();

            static::$data['success'] = true;
            static::$data['message'] = trans('messages.password_changed');
        } catch (\Exception $e) {

            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * Send temporaryPassword
     * 
     * @param type $data
     * @return type
     */
    public static function temporaryPassword($data) {
        try {
            $user = User::where('email', '=', $data['email'])->where('role', '=', $data['role'])->first();
            if ($user) {
                 
                    $password = str_random(8);
                    $hashedPassword = \Hash::make($password);
                   
                    static::$mailData['view'] = 'email.admin.reset_password';
                    static::$mailData['data'] = array('password' => $password);
                    static::$mailData['user'] = $user;
                    static::$mailData['subject'] = config('constants.SUBJECT.admin_forgot_password');

                    $mail = new Mail();
                    $status = $mail->sendMail(static::$mailData);

                        if ($status) {
                            
                            $user->password = $hashedPassword;
                            $user->save();
                            static::$data['success'] = true;
                            static::$data['message'] = trans('messages.forgot_password_email');
                        }        
                    } else {
                        static::$data['success'] = false;
                        static::$data['message'] = trans('messages.user_not_exist');
                    }
        } catch (\Exception $e) {

            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * getDateTimeToUtc .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function getDateTimeToUtc($data) {
        $dt = new DateTime($data, new \DateTimeZone('GMT'));
        $dt->setTimezone(new \DateTimeZone('UTC'));
        return $dt->format('Y-m-d H:i:s');
    }

    /**
     * getDateTimeToUtc .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function getDateTimeToLocalTimeZone($data, $timeZone) {

        $dt = new DateTime($data, new \DateTimeZone('UTC'));
        $dt->setTimezone(new \DateTimeZone($timeZone));
        return $dt->format('Y-m-d H:i:s');
    }
    
     /**
     * function is used to get user list
     * @return type
     */
    public static function getUserList() {
        $userModel = new User();
        $data = array();
        $search = '';
        $input = Input::all();
        if (isset($input['search']['value'])) {
            $search = $input['search']['value'];
        }
        if (!$search) {
            $results = $userModel->getUserList(array('limit' => $input['length'], 'offset' => $input['start']));
        } else {
            $results = $userModel->getUserList(array('q' => $search, 'limit' => $input['length'], 'offset' => $input['start']));
        }
        $i=1;
        foreach ($results['result'] as $result) {
            $data[] = array(
                        $i,
                        $result->mobile_number,
                        $result->email,
                        ucwords($result->name),
                        ucwords($result->avatar_name),
                        $result->id,
            );
            $i++;
        }
        return array('data' => $data, 'recordsTotal' => $results['count'], "recordsFiltered" => $results['count']);
    }
   /**
     * used to get list of all  user Detail by id
     *
     * @return void
     */
     public static function getUserDetails($id) {
         try {
            $query = User::where(function($query) use($id){
                $query->where('users.role', '!=', User::IS_ADMIN)
                      ->where('users.id', '=', $id);  
            });
                
                    $query->where('users.status', User::IS_ACTIVE);
                    $query->select('users.*');
                    $users = $query->orderBy('users.id', 'ASC')->first();
            
            static::$data['data'] = $users;
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.record_listed');
        } catch (\Exception $e) {
            static::setExceptionError($e);
        }

        return static::$data;
    }
    
    
    /**
     * function is used to get user list
     * @return type
     */
    public static function getReportList() {
        $reportModel = new Report();
        $data = array();
        $search = '';
        $input = Input::all();
        if (isset($input['search']['value'])) {
            $search = $input['search']['value'];
        }
        if (!$search) {
            $results = $reportModel->getReportList(array('limit' => $input['length'], 'offset' => $input['start']));
        } else {
            $results = $reportModel->getReprotList(array('q' => $search, 'limit' => $input['length'], 'offset' => $input['start']));
        }
        $i=1;
        foreach ($results['result'] as $result) {
            $data[] = array(
                        $i,
                        ucwords($result->name),
                        ucwords($result->avatar_name),
                        $result->user_id,
                        ucwords($result->reported_for),
                        $result->report_for,
                        ucwords($result->report_content),
                        $result->id,
                        date('Y-m-d', strtotime($result->created_at)),
             );
            $i++;
        }
        return array('data' => $data, 'recordsTotal' => $results['count'], "recordsFiltered" => $results['count']);
    }
    
    /**
     * used to get list of all  Report Detail by id
     *
     * @return void
     */
     public static function getReportDetails($id) {
         try {
           
            $reports = Report::where('reports.id',$id)
                    ->join('users as use', function($join) {
                        $join ->on('reports.user_id', 'use.id');
                      })
                    ->join('users as user', function($join) {
                        $join ->on('reports.report_for', 'user.id');
                      })  
                    ->select('reports.*','use.name','use.avatar_name','use.id as user_id','user.name as reported_for','user.id as reported_user_id','user.status as reported_user_status')
                    ->first();
            
            static::$data['data'] = $reports;
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.record_listed');
        } catch (\Exception $e) {
            static::setExceptionError($e);
        }

        return static::$data;
    }
    
    /**
     * function is used to get user list
     * @return type
     */
    public static function deleteUserWithReaon() {
        $input = Input::all();
        $status = User::where('id', '=', $input['user_id'])
                        ->update([
                            'status' => 3,
                ]);
        if ($status) {
                            static::$data['success'] = true;
                            static::$data['message'] = trans('messages.user_blocked');
                                
                    } else {
                        static::$data['success'] = false;
                        static::$data['message'] = trans('messages.user_not_exist');
                    }
         return static::$data;
        /*
         * 
         * @todo, we will uncomment this code when we send email
         */
        /*if ($user) {
                 
                    $password = str_random(8);
                    $hashedPassword = \Hash::make($password);
                    static::$mailData['view'] = 'email.admin.delete_user';
                    static::$mailData['data'] = array('password' => $reason);
                    static::$mailData['user'] = $user;
                    static::$mailData['subject'] = config('constants.SUBJECT.admin_forgot_password');

                    $mail = new Mail();
                    $status = $mail->sendMail(static::$mailData);

                        if ($status) {
                            
                            $user->password = $hashedPassword;
                            $user->save();
                            static::$data['success'] = true;
                            static::$data['message'] = trans('messages.forgot_password_email');
                        }        
                    } else {
                        static::$data['success'] = false;
                        static::$data['message'] = trans('messages.user_not_exist');
                    }
         * 
         */
       
    }
    
}
