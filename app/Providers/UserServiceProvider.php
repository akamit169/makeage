<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: UserServiceProvider.php
 * CodeLibrary/Project: oms
 * Author: Amit
 * CreatedOn: date (25/04/2017) 
 */

namespace App\Providers;

use App\Models\User;
use App\Models\Company;
use App\Models\Answer;
use App\Models\Keywords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SendFriendRequest;
use App\Models\Ejabberd;
use App\Models\AnswerLiked;
use App\Models\Notification;
use App\Models\Report;
use App\Providers\NotificationServiceProvider;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Utilities\Mail;
use App\Models\ReportQuestion;
use App\Models\AcceptPublicQuestion;

/**
 * UserServiceProvider class conatains methods for user management
 */
class UserServiceProvider extends BaseServiceProvider {

    /**
     * function is used to register customer
     * @param array $data
     * @return json
     */
    public static function registerUser($data) {
        try {
           
            $user = User::where('email', $data['email'])->first();
            if ($user) {
                static::$data['success'] = true;
                static::$data['data']['users'] = Auth::user();
                static::$data['message'] = trans('messages.customer.otp_success');
                return static::$data;
            } else {
                $passwordHas = \Hash::make($data['password']);
                //create new customer's data
                
                $user = new User();
                $company = new Company();
                
                //Save Company data
                if(isset($data['companyName'])){
                $company->company_name = $data['companyName'];
                $company->fax = $data['fax'];
                $company->address = $data['companyAddress'];
                $company->registration_number = $data['registrationNo'];
                $company->save();
                $insertedCompanyId = $company->id;
                $user->company_id = $insertedCompanyId;
                }
                //User data save
                
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->mobile_number = $data['mobile'];
                $user->aadhar_number = $data['aadhar'];
                $user->address = $data['address'];
                $user->password = $passwordHas;
                $user->role = User::IS_ADMIN;
                $user->is_verified = '1';
                $user->status = User::IS_ACTIVE;
                $user->save();
                $insertedId = $user->id;
                $user->save();
                
                $loginToken = static::appUserLogin($data);
                $userData = Auth::user();
                $CompanyData = Company::where('id', '=', $userData['company_id'])
                    ->first();
            }
            if ($loginToken) {
                static::$data['success'] = true;
                static::$data['data']['users'] = Auth::user();
                static::$data['data']['company'] = $CompanyData;
                static::$data['accessToken'] = $loginToken;
                static::$data['message'] = trans('messages.user_registered');
            } else {
                static::$data['success'] = false;
                static::$data['accessToken'] = '';
                if (empty(static::$data['message'])) {
                    static::$data['message'] = trans('messages.customer.registration_failure');
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * function is used to ejabber registraion
     * @param array $data
     * @return json
     */
    public static function userLogin($data) {
        try {
            $user = User::where('email', '=', $data['email'])
                    ->orWhere('mobile_number', '=', $data['email'])
                    ->first();
            if ($user and \Hash::check($data['password'], $user->password)) {
                $loginToken = static::appUserLoginWithEmailMobil($data);
                $userData = Auth::user();
                $CompanyData = Company::where('id', '=', $userData['company_id'])
                    ->first();
                if ($loginToken) { //if login token exist then return it with success status
                    static::$data['success'] = true;
                    static::$data['data']['users'] = Auth::user();
                    static::$data['data']['company'] = $CompanyData;
                    static::$data['accessToken'] = $loginToken;
                    static::$data['message'] = trans('messages.login_success');
                }
            } else {

                static::$data['success'] = false;
                static::$data['accessToken'] = '';
                static::$data['message'] = trans('messages.invalid_login_credentials');
            }
        } catch (\Exception $e) {
            static::setExceptionError($e);
        }

        return static::$data;
    }

   

    /**
     * function is used to log-in app user
     * @param array $arrData
     */
    public static function appUserLogin($arrData) {
        $userObj = User::where('email', $arrData['email'])->first();

        if ($userObj) {
            $userDeviceObj = \App\Models\UserDevice::where('user_id', $userObj->id)->first();

            $token = md5(uniqid(mt_rand(), true)) . time();

            if ($userDeviceObj) {
                $userDeviceObj->user_token = $token;
                $userDeviceObj->device_token = isset($arrData['deviceToken']) ? $arrData['deviceToken'] : '';
                $userDeviceObj->device_type = $arrData['deviceType'];
                $status = $userDeviceObj->save();
            } else {

                //log-in newly created user by generating user token
                $userDeviceObj = new \App\Models\UserDevice();
                $userDeviceObj->user_id = $userObj->id;
                $userDeviceObj->user_token = $token;
                $userDeviceObj->device_token = isset($arrData['deviceToken']) ? $arrData['deviceToken'] : '';
                $userDeviceObj->device_type = $arrData['deviceType'];
                $status = $userDeviceObj->save();
            }
        }
        if ($status) {
            Auth::loginUsingId($userObj->id);
            return $token;
        } else {
            return $status;
        }
    }
/**
     * function is used to log-in app user
     * @param array $arrData
     */
    public static function appUserLoginWithEmailMobil($arrData) {
        
        $userObj = User::where('email', $arrData['email'])
                ->orWhere('mobile_number', '=', $arrData['email'])->first();

        if ($userObj) {
            $userDeviceObj = \App\Models\UserDevice::where('user_id', $userObj->id)->first();

            $token = md5(uniqid(mt_rand(), true)) . time();

            if ($userDeviceObj) {
                $userDeviceObj->user_token = $token;
                $userDeviceObj->device_token = isset($arrData['deviceToken']) ? $arrData['deviceToken'] : '';
                $userDeviceObj->device_type = $arrData['deviceType'];
                $status = $userDeviceObj->save();
            } else {

                //log-in newly created user by generating user token
                $userDeviceObj = new \App\Models\UserDevice();
                $userDeviceObj->user_id = $userObj->id;
                $userDeviceObj->user_token = $token;
                $userDeviceObj->device_token = isset($arrData['deviceToken']) ? $arrData['deviceToken'] : '';
                $userDeviceObj->device_type = $arrData['deviceType'];
                $status = $userDeviceObj->save();
            }
        }
        if ($status) {
            Auth::loginUsingId($userObj->id);
            return $token;
        } else {
            return $status;
        }
    }
    /**
     * 
     * @param array $data
     * @return array
     */
    public static function setupCustomerProfile($data) {
        try {
            $user = Auth::user();
            $user->email = isset($data['email']) ? $data['email'] : '';
            $user->state_name = isset($data['stateName']) ? $data['stateName'] : '';
            $user->country_name = isset($data['countryName']) ? $data['countryName'] : '';
            $user->gender = isset($data['gender']) ? $data['gender'] : '';
            $user->date_of_birth = isset($data['dateOfBirth']) ? $data['dateOfBirth'] : 'NULL';
            $user->relationship_status = isset($data['relationShipStatus']) ? $data['relationShipStatus'] : '';
            $user->user_bio = isset($data['userBio']) ? $data['userBio'] : '';
            $user->like = isset($data['like']) ? $data['like'] : '';
            $user->dislike = isset($data['disLike']) ? $data['disLike'] : '';
            $user->avatar_name = isset($data['avatar_name']) ? $data['avatar_name'] : '';
            $user->save();

            static::$data['message'] = trans('messages.update_successful');
            $userData = Auth::user()->where('users.id', Auth::id())->select('users.*')->first();
            static::$data['data']['users'] = $userData;
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * Change user login
     *
     * @param type $data
     * @return type
     */
    public static function loginUser($data, $rememberMe = false) {
        try {
            $user = User::where('email', $data['email'])->where('role', '2')->first();
            if ($user && \Hash::check($data['password'], $user->password)) {
                 if ($user->status == User::IS_INACTIVE) {
                    static::$data['message'] = trans('messages.account_suspended');
                    static::$data['success'] = false;
                } else {

                    Auth::loginUsingId($user->id, $rememberMe);
                    $user->save();
                    static::$data['success'] = true;
                    static::$data['message'] = trans('messages.login_success');
                }
            } else {
                 static::$data['success'] = false;
                static::$data['message'] = trans('messages.invalid_login_credentials');
            }
        } catch (\Exception $e) {

            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function saveAvatarProfile($data) {
        try {

            DB::beginTransaction();
            $user = Auth::user();
            $user->avatar_data = isset($data['avatarData']) ? $data['avatarData'] : '';
            $user->save();
            $userData = User::find(Auth::id());
            static::$data['message'] = trans('messages.update_successful');
            static::$data['data']['users'] = $userData;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function getUserProfile($data) {
        try {
            if (count($data) > 0 && $data['userId']) {
                $forUserId = $data['userId'];
                $userId = Auth::id();

                $exitBlockList = BlockUser::where('user_id', $forUserId)
                        ->where('blocked_user_id', $userId)
                        ->exists();
                if ($exitBlockList != 1) {
                    $queryData = User::where('users.id', $forUserId)
                            ->leftJoin('friends as frd', function($join) use ($userId) {
                                $join->on('frd.user_id', DB::raw($userId))
                                ->on('users.id', 'frd.friend_user_id')
                                ->orOn(function ($query) use ($userId) {
                                    $query->on('users.id', 'frd.user_id')
                                    ->on('frd.friend_user_id', DB::raw($userId));
                                });
                            })
                            ->leftJoin('blocked_users as bl_us', function($join) use ($userId) {
                                $join->on('bl_us.user_id', DB::raw($userId))
                                ->on('users.id', 'bl_us.blocked_user_id')
                                ->orOn(function ($query) use ($userId) {
                                    $query->on('users.id', 'bl_us.user_id')
                                    ->on('bl_us.blocked_user_id', DB::raw($userId));
                                });
                            })
                            ->select('users.*', 'frd.user_id as requestedBy', 'frd.status as requestStatus', DB::RAW("IF((bl_us.user_id = $userId || bl_us.blocked_user_id = $userId),bl_us.user_id,NULL) as blocked_by"))
                            ->where('users.status', '2');
                    $userData = $queryData->first();
                    static::$data['message'] = trans('messages.record_fetched');
                    static::$data['data']['users'] = $userData;
                } else {
                    static::$data['success'] = false;
                    static::$data['message'] = trans('messages.user_blocked');
                }
            } else {
                $userId = Auth::id();
                $userData = User::find($userId);
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['data']['users'] = $userData;
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function postQuestion($data) {
        try {

            DB::beginTransaction();
            $userQuestionObj = new \App\Models\Question();
            $userQuestionObj->question = isset($data['question']) ? $data['question'] : '';
            $userQuestionObj->type = isset($data['type']) ? $data['type'] : '';
            $userQuestionObj->question_by = Auth::id();
            $userQuestionObj->question_for = isset($data['questionFor']) ? $data['questionFor'] : '';
            $userQuestionObj->status = 1;
            $userQuestionObj->save();
            $insertedId = $userQuestionObj->id;
            //Using for the notification
            if ($data['type'] != '' && $data['type'] == '3' && isset($data['questionFor'])) {

                $notification = new Notification();
                $notification->user_id = Auth::id();
                $notification->receiver_id = $data['questionFor'];
                $notification->action_type = 'newquestion';
                $notification->content = '#user has asked you a question.';
                $notification->question_id = $insertedId;
                $notification->is_read = 0;
                $notification->save();
            }
            if ($data['type'] != '' && $data['type'] == '2' && isset($data['questionFor'])) {
                 $checkExist = AcceptPublicQuestion::where('user_id', '=', Auth::id())
                         ->where('asked_for_user_id', $data['questionFor'])
                        ->first();
                if($checkExist ==''){
                    $acceptPublicQuestion = new AcceptPublicQuestion();
                    $acceptPublicQuestion->user_id = Auth::id();
                    $acceptPublicQuestion->asked_for_user_id = $data['questionFor'];
                    $acceptPublicQuestion->save();
                }
                
                $notification = new Notification();
                $notification->user_id = Auth::id();
                $notification->receiver_id = $data['questionFor'];
                $notification->action_type = 'accept_decline_newquestion';
                $notification->content = '#user has asked you a question.';
                $notification->question_id = $insertedId;
                $notification->is_read = 0;
                $notification->save();
                
                $questionForId = $data['questionFor'];
                $query = User::where('users.id', '=', Auth::id())
                        ->leftJoin('accept_public_question as apq', function($join) use($questionForId) {
                    $join->on('apq.asked_for_user_id', '=', DB::raw($questionForId))
                    ->on('users.id', 'apq.user_id');
                });
                $query->select('users.id', 'users.mobile_number as mobileNumber', 'users.mobile_otp as mobileOtp', 'users.otp_expiration_at as otpExpirationAt', 'users.mobile_number as mobileNumber', 'users.email', 'users.name', 'users.password', 'users.avatar_name as avatarName', 'users.avatar_data as avatarData', 'users.user_bio as userBio', 'users.like', 'dislike', 'users.relationship_status as relationshipStatus', 'users.gender', 'users.date_of_birth as dateOfBirth', 'users.country_name as countryName', 'users.state_name as stateName', 'users.average_ratting as averageRatting', 'users.chat_status as chatStatus', 'users.ejabberd_id as ejabberdId', 'users.ejabberd_password as ejabberdPassword', 'users.role', 'users.status', 'users.is_verified as isVerified', 'users.total_like_count as totalLikeCount', 'apq.status as acceptDeclineStatus');
                $userData = $query->first();
                $queryNew = User::where('users.id', '=', $data['questionFor'])
                        ->leftJoin('user_tokens as token', function($join) {
                    $join->on('users.id', 'token.user_id');
                });
                $queryNew->select('users.*', 'token.device_token', 'token.user_token', 'token.device_type');
                $anserData = $queryNew->first();

                if ($anserData['user_token']) {
                    $deviceIdentifier = $anserData['device_token'];
                    $message = $userData['name'] . ' has asked a Question';
                    static::$data['user'] = $userData;
                    $params['data'] = static::$data['user'];
                    $params['badge'] = '1';
                    NotificationServiceProvider::sendPushIOS($deviceIdentifier, $message, $params);
                }
            }
            unset(static::$data['user']);
            static::$data['message'] = trans('messages.question');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function postAnswer($data) {
        try {

            //$answer = Answer::where('question_id', $data['questionId'])->first();
            $question = Question::where('id', $data['questionId'])->first();
            $answer = Answer::where('question_id', $data['questionId'])->first();
            if ($question['type'] == 2) {
                DB::beginTransaction();
                $userAnswerObj = new Answer();
                $userAnswerObj->answer = isset($data['answer']) ? $data['answer'] : '';
                $userAnswerObj->question_id = isset($data['questionId']) ? $data['questionId'] : '';
                $userAnswerObj->answer_type = isset($data['answerType']) ? $data['answerType'] : '';
                $userAnswerObj->user_id = Auth::id();
                $userAnswerObj->save();
                $insertedId = $userAnswerObj->id;

                $questionData = Question::where('id', $data['questionId'])->first();
                $notification = new Notification();
                $notification->user_id = Auth::id();
                $notification->receiver_id = $questionData['question_by'];
                $notification->action_type = 'newAnswer_public';
                $notification->content = '#user has answered your question';
                $notification->question_id = $data['questionId'];
                $notification->answer_id = $insertedId;
                $notification->is_read = 0;
                $notification->save();
                static::$data['message'] = trans('messages.record_added');
                DB::commit();
            } elseif ($answer == '' && $question['type'] == 3) {
                DB::beginTransaction();
                $userAnswerObj = new Answer();
                $userAnswerObj->answer = isset($data['answer']) ? $data['answer'] : '';
                $userAnswerObj->question_id = isset($data['questionId']) ? $data['questionId'] : '';
                $userAnswerObj->answer_type = isset($data['answerType']) ? $data['answerType'] : '';
                $userAnswerObj->user_id = Auth::id();
                $userAnswerObj->save();
                $insertedId = $userAnswerObj->id;

                $questionData = Question::where('id', $data['questionId'])->first();
                $notification = new Notification();
                $notification->user_id = $questionData['question_for'];
                $notification->receiver_id = $questionData['question_by'];
                $notification->action_type = 'newAnswer';
                $notification->content = '#user has answered your question';
                $notification->question_id = $data['questionId'];
                $notification->answer_id = $insertedId;
                $notification->is_read = 0;
                $notification->save();
                static::$data['message'] = trans('messages.record_added');
                DB::commit();
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.answer_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function keywords($data) {
        try {
            $searchQuery = strtolower($data['interestKey']);
            $keywords = Keywords::where('name', 'like', $searchQuery . '%')->select('keywords.id', 'keywords.name')->get();
            if (count($keywords) >= 1) {
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['data']['users'] = $keywords;
            } else {
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function globalSearchUsers($data) {
        try {
            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            $userId = Auth::id();
            $searchQuery = $data['keyword'];
            $queryData = User::where('users.id', '!=', $userId)
                    ->where(function ($query) use ($searchQuery) {
                        $query->orWhere('users.name', 'like', $searchQuery . '%')
                        ->orWhere('users.avatar_name', 'like', $searchQuery . '%');
                    })
                    ->whereNotIn('users.id', function($q)use ($userId) {
                        $q->select('user_id')
                        ->where('blocked_users.blocked_user_id', $userId)
                        ->from('blocked_users');
                    })
                    ->leftJoin('friends as frd', function($join) use ($userId) {
                        $join->on('frd.user_id', DB::raw($userId))
                        ->on('users.id', 'frd.friend_user_id')
                        ->orOn(function ($query) use ($userId) {
                            $query->on('users.id', 'frd.user_id')
                            ->on('frd.friend_user_id', DB::raw($userId));
                        });
                    })
                    ->select('users.*', DB::RAW("IF((frd.user_id = $userId || frd.friend_user_id = $userId),frd.user_id,NULL) as requestedBy"), DB::RAW("IF((frd.user_id = $userId || frd.friend_user_id = $userId),frd.status,NULL) as requestStatus"))
                    ->where('users.role', '!=', '2')
                    ->where('users.avatar_name', '!=', '')
                    ->where('users.status', '2')
                    ->groupBy('users.id')
                    ->orderBy('frd.status', 'DESC')
                    ->orderBy('users.name', 'ASC');
            $total = count($queryData->get());
            $keywords = $queryData->skip($start)->take($perPage)->get();
            if (count($keywords) >= 1) {
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['perPage'] = $perPage;
                static::$data['total'] = $total;
                static::$data['data']['users'] = $keywords;
            } else {
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function sendFriendRequest($data) {
        try {
            $userId = Auth::id();
            $userArr = array($userId, $data['userFor']);
            $friend = new SendFriendRequest();
            $notification = new Notification();

            $exitBlockList = BlockUser::whereIn('user_id', $userArr)
                    ->whereIn('blocked_user_id', $userArr)
                    ->exists();
            if ($exitBlockList != 1) {
                $exitFriend = SendFriendRequest::whereIn('user_id', $userArr)
                        ->whereIn('friend_user_id', $userArr)
                        ->exists();

                if ($exitFriend != 1) {
                    $friend->user_id = $userId;
                    $friend->friend_user_id = $data['userFor'];
                    $friend->status = 0;
                    $friend->save();

                    //Using for the notification
                    $notification->user_id = $userId;
                    $notification->receiver_id = $data['userFor'];
                    $notification->action_type = 'friendRequest';
                    $notification->content = 'You have recive a friend request from #user';
                    $notification->is_read = 0;
                    $notification->save();

                    static::$data['message'] = trans('messages.request_send');
                    DB::commit();
                } else {
                    static::$data['message'] = trans('messages.request_exists');
                }
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.user_blocked');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function friendRequestStatusUpdate($data) {
        try {
            $userId = Auth::id();
            $userArr = array($userId, $data['userFor']);

            if ($data['requestStatus'] == '2') {
                SendFriendRequest::whereIn('user_id', $userArr)
                        ->whereIn('friend_user_id', $userArr)
                        ->delete();
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.update_successful');
            } else {
                $exitBlockList = BlockUser::whereIn('user_id', $userArr)
                        ->whereIn('blocked_user_id', $userArr)
                        ->exists();
                if ($exitBlockList != 1) {
                    SendFriendRequest::whereIn('user_id', $userArr)
                            ->whereIn('friend_user_id', $userArr)
                            ->update([
                                'status' => $data['requestStatus'],
                    ]);


                    //Using for the notification
                    $notification = new Notification();
                    $notification->user_id = $userId;
                    $notification->receiver_id = $data['userFor'];
                    $notification->action_type = 'AcceptedfriendRquest';
                    $notification->content = '#user has accepted your friend request';
                    $notification->is_read = 0;
                    $notification->save();
                    static::$data['success'] = true;
                    static::$data['message'] = trans('messages.update_successful');
                } else {
                    static::$data['success'] = false;
                    static::$data['message'] = trans('messages.user_blocked');
                }
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function contactSyncing($data) {
        try {
            $userId = Auth::id();
            $contactData = explode(',', $data['contactData']);
            // Using for the array in small package
            if (count($contactData) >= 1 && count($contactData) <= 60) {
                $chunkedContactData = array_chunk($contactData, 10);
                $response = [];
                foreach ($chunkedContactData as $newContactData) {
                    foreach ($newContactData as $lastData) {
                        $lastSeven[] = substr($lastData, -7);
                    }
                    $user = User::where('mobile_number', 'like', '%' . $lastSeven[0])->select('users.*');
                    array_shift($lastSeven);
                    foreach ($lastSeven as $contact) {
                        $user->orWhere('mobile_number', 'like', '%' . $contact);
                    }
                    $user->leftJoin('friends as frd', function($join) use ($userId) {
                                $join->on('frd.user_id', '=', DB::raw($userId))
                                ->on('users.id', '=', 'frd.friend_user_id')
                                ->orOn(function ($query) use ($userId) {
                                    $query->on('users.id', '=', 'frd.user_id')
                                    ->on('frd.friend_user_id', '=', DB::raw($userId));
                                });
                            })
                            ->select('users.*', DB::RAW("IF((frd.user_id = $userId || frd.friend_user_id = $userId),frd.user_id,NULL) as requestedBy"), DB::RAW("IF((frd.user_id = $userId || frd.friend_user_id = $userId),frd.status,NULL) as requestStatus"))
                            ->where('users.id', '!=', $userId)
                            ->where('users.role', '!=', '2')
                            ->where('users.status', '=', '2')
                            ->groupBy('users.id')
                            ->orderBy('frd.status', 'DESC');
                    $results = $user->get()->toArray();
                    $response += $results;
                }

                if (count($response) >= 1) {
                    static::$data['success'] = true;
                    static::$data['message'] = trans('messages.record_fetched');
                    static::$data['data']['users'] = $response;
                } else {
                    static::$data['success'] = false;
                    static::$data['message'] = trans('messages.record_not_exist');
                }
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.limit_exceeded');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function friendRequestList($data) {
        try {
            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            $userId = Auth::id();
            $query = SendFriendRequest::where('friends.status', '=', 0)
                    ->where(function ($query) use ($userId) {
                        $query->orWhere('friends.friend_user_id', '=', $userId);
                    })
                    ->join('users', function($join) use ($userId) {
                        $join->on('friends.user_id', '=', 'users.id')
                        ->orOn('friends.friend_user_id', '=', 'users.id')
                        ->where('users.id', '!=', $userId);
                    })
                    ->select('users.*', 'friends.user_id as requestedBy', 'friends.status as requestStatus')
                    ->where('friends.status', '=', 0)
                    ->where('users.id', '!=', $userId);
            $total = count($query->get());
            $requestList = $query->skip($start)->take($perPage)->get();
            DB::commit();
            if (count($requestList) >= 1) {
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['perPage'] = $perPage;
                static::$data['total'] = $total;
                static::$data['data']['users'] = $requestList;
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function ejabberdHistory($data) {
        try {

            $perPage = 40;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            $user = Auth::user();
            $userEjabberdName = $user->ejabberd_id . '@localhost';
            $userId = Auth::id();
            $pearId = $data['ejabberdId'];
            $friendId = explode("@", $pearId);
            $query = Ejabberd::where('username', '=', $friendId[0])
                    ->where('bare_peer', '=', $userEjabberdName)
                    ->select('archive.id', 'archive.xml', 'archive.timestamp')
                    ->orderBy('created_at', 'DESC');

            $total = count($query->get());
            $ejabberdData = $query->skip($start)->take($perPage)->get();
            $ejabberdId = strtok($pearId, '@');

            $friendData = User::where('ejabberd_id', $friendId)
                    ->first();
            $userArr = array($userId, $friendData['id']);
            $exitFriend = SendFriendRequest::whereIn('user_id', $userArr)
                    ->whereIn('friend_user_id', $userArr)
                    ->exists();

            if ($exitFriend == '1') {
                $isFriend = $exitFriend;
            } else {
                $isFriend = false;
            }
            $frndId = $friendData['id'];
            $query = BlockUser::where('blocked_users.user_id', $userId)
                    ->where(function ($query) use ($frndId) {
                        $query->where('blocked_users.blocked_user_id', $frndId);
                    })
                    ->orWhere(function ($query) use ($frndId, $userId) {
                        $query->where('blocked_users.blocked_user_id', $userId)
                        ->where('blocked_users.user_id', $frndId);
                    })
                    ->select('blocked_users.*');
            $blockedData = $query->get();
            if (count($blockedData)) {
                $isBlockedId = 'null';
                $hasBlockedId = 'null';
                foreach ($blockedData as $data) {

                    if ($data['user_id'] == $userId) {
                        $isBlockedId = $data['user_id'];
                    }
                    if ($data['user_id'] != $userId) {

                        $hasBlockedId = $data['user_id'];
                    }
                }
            } else {
                $isBlockedId = 'null';
                $hasBlockedId = 'null';
            }

            if (count($ejabberdData) < 1) {
                $ejabberdData = [];
            }
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.record_fetched');
            static::$data['perPage'] = $perPage;

            static::$data['total'] = $total;
            static::$data['data']['history'] = $ejabberdData;
            static::$data['data']['friendEjabberdId'] = $ejabberdId;
            static::$data['data']['blockedByMe'] = $isBlockedId;
            static::$data['data']['blockedMe'] = $hasBlockedId;
            static::$data['data']['isFriend'] = $isFriend;
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function ejabberdLastChatHistory() {
        try {
            $user = Auth::user();
            $userId = Auth::id();
            $ejabberdId = $user->ejabberd_id . '@localhost';



            $ejabberdData = Ejabberd::whereIn('timestamp', function($query) use($ejabberdId) {
                        $query->selectRaw('max(timestamp)')
                        ->from('archive')
                        ->where('bare_peer', $ejabberdId)
                        ->groupBy('username');
                    })->orderBy('timestamp', 'desc')
                    ->get();
            if (count($ejabberdData) >= 1) {
                foreach ($ejabberdData as $dataResult) {
                    $data = (explode("@", $dataResult['bare_peer']));
                    $ejabberName[] = $dataResult['username'];
                }
                $placeholders = implode(',', array_fill(0, count($ejabberName), '?'));
                $queryData = User::whereIn('users.ejabberd_id', $ejabberName)
                        ->leftJoin('blocked_users as bl_us', function($join)use ($userId) {
                            $join->on('bl_us.user_id', DB::raw($userId))
                            ->on('users.id', 'bl_us.blocked_user_id');
                        })
                        ->select('users.*', 'bl_us.user_id as blockedByMe')
                        ->orderByRaw("field(users.ejabberd_id,{$placeholders})", $ejabberName);

                $queryRes = $queryData->get();
            }
            if (count($ejabberdData) >= 1) {
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['data']['chat'] = $ejabberdData;
                static::$data['data']['users'] = $queryRes;
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function friendList($data) {
        try {
            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            if (isset($data) && !empty($data['friendId'])) {
                $userId = $data['friendId'];
            } else {
                $userId = Auth::id();
            }
            $query = SendFriendRequest::where('friends.status', 1)
                    ->where(function ($query) use ($userId) {
                        $query->orWhere('friends.user_id', $userId)
                        ->orWhere('friends.friend_user_id', $userId);
                    })
                    ->join('users', function($join) use ($userId) {
                        $join->on('friends.user_id', 'users.id')
                        ->orOn('friends.friend_user_id', 'users.id')
                        ->where('users.id', '!=', $userId);
                    })
                    ->leftJoin('blocked_users as bl_us', function($join) use ($userId) {
                        $join->on('bl_us.user_id', DB::raw($userId))
                        ->on('users.id', 'bl_us.blocked_user_id')
                        ->orOn(function ($query) use ($userId) {
                            $query->on('users.id', 'bl_us.user_id')
                            ->on('bl_us.blocked_user_id', DB::raw($userId));
                        });
                    })
                    ->select('users.*', 'friends.user_id as requestedBy', 'friends.status as requestStatus', DB::RAW("IF((bl_us.user_id = $userId || bl_us.blocked_user_id = $userId),bl_us.user_id,NULL) as blocked_by"))
                    ->where('users.id', '!=', $userId)
                    ->groupBy('users.id');
            $total = count($query->get());
            $friendList = $query->skip($start)->take($perPage)->get();
            DB::commit();
            if (count($friendList) >= 1) {

                static::$data['success'] = true;
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['perPage'] = $perPage;
                static::$data['total'] = $total;
                static::$data['data']['users'] = $friendList;
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function likeDislike($data) {
        try {
            $userId = Auth::id();

            $query = Answer::where('answers.id', $data['answerId'])
                    ->leftJoin('user_tokens as token', function($join) {
                $join->on('answers.user_id', 'token.user_id');
            });
            $query->select('answers.*', 'token.device_token', 'token.user_token', 'token.device_type');
            $anserData = $query->first();

            $user = User::where('id', '=', $anserData['user_id'])
                    ->first();
            $totalCount = $user->total_like_count;

            $liked = new AnswerLiked();
            if ($data['status'] == '1') {
                AnswerLiked::where('answer_id', $data['answerId'])
                        ->where('user_id', $userId)
                        ->delete();
                $liked->answer_id = $data['answerId'];
                $liked->user_id = $userId;
                $liked->save();
                $currentCount = $totalCount + 1;
                User::where('id', '=', $anserData['user_id'])
                        ->update([
                            'total_like_count' => $currentCount,
                ]);
                $userData = User::where('id', '=', $userId)
                        ->select('id', 'mobile_number as mobileNumber', 'mobile_otp as mobileOtp', 'otp_expiration_at as otpExpirationAt', 'mobile_number as mobileNumber', 'email', 'name', 'password', 'avatar_name as avatarName', 'avatar_data as avatarData', 'user_bio as userBio', 'like', 'dislike', 'relationship_status as relationshipStatus', 'gender', 'date_of_birth as dateOfBirth', 'country_name as countryName', 'state_name as stateName', 'average_ratting as averageRatting', 'chat_status as chatStatus', 'ejabberd_id as ejabberdId', 'ejabberd_password as ejabberdPassword', 'role', 'status', 'is_verified as isVerified', 'total_like_count as totalLikeCount')
                        ->first();

                if ($anserData['user_token']) {
                    $deviceIdentifier = $anserData['device_token'];
                    $message = $userData['name'] . ' has liked your answer';
                    static::$data['user'] = $userData;
                    $params['data'] = static::$data['user'];
                    $params['badge'] = '1';
                    NotificationServiceProvider::sendPushIOS($deviceIdentifier, $message, $params);
                }
            } else {
                AnswerLiked::where('answer_id', $data['answerId'])
                        ->where('user_id', $userId)
                        ->delete();
                $currentCount = $totalCount - 1;
                User::where('id', '=', $anserData['user_id'])
                        ->update([
                            'total_like_count' => $currentCount,
                ]);
            }
            unset(static::$data['user']);
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.update_successful');
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }
        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function deleteChatHistory($data) {
        try {
            $user = Auth::user();
            $ejabberdId = $user->ejabberd_id . '@localhost';
            $bareId = $data['ejabberId'];
            $friendId = explode("@", $bareId);
            Ejabberd::where('username', $friendId[0])
                    ->where('bare_peer', $ejabberdId)
                    ->delete();

            static::$data['success'] = true;
            static::$data['message'] = trans('messages.update_successful');
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function reportUser($data) {
        try {
            DB::beginTransaction();
            $report = new Report();
            $report->user_id = Auth::id();
            $report->report_for = isset($data['reportFor']) ? $data['reportFor'] : '';
            $report->report_content = isset($data['reportContent']) ? $data['reportContent'] : '';
            $report->save();
            static::$data['message'] = trans('messages.update_successful');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function notificationList($data) {
        try {
            $userId = Auth::id();
            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            $query = Notification::where('notifications.action_type', '!=', 'friendRequest')
                    ->join('users as user', function($join) {
                        $join->on('notifications.user_id', 'user.id');
                    })
                    ->leftJoin('questions', function($join) {
                        $join->on('notifications.question_id', 'questions.id');
                    })
                    ->leftJoin('answers', function($join) {
                        $join->on('notifications.answer_id', 'answers.id');
                    })
                    ->leftJoin('answer_liked as like', function($join) {
                        $join->on('answers.id', 'like.answer_id')
                        ->on('notifications.receiver_id', 'like.user_id');
                    })
                    ->select('notifications.id', 'notifications.is_read', 'notifications.question_id', 'notifications.action_type', 'notifications.content', 'user.name as senderName', 'user.id as senderId', 'user.avatar_data', 'user.gender', 'user.avatar_name', 'user.ejabberd_id', 'notifications.created_at as createdAt', 'questions.question', 'answers.answer', 'answers.id as answer_id', 'like.user_id as likid')
                    ->where('notifications.receiver_id', Auth::id())
                    ->orderBy('notifications.id', 'DESC');

            $total = count($query->get());
            $notificationList = $query->skip($start)->take($perPage)->get();

            $query = SendFriendRequest::where('friends.status', 0)
                    ->join('users', function($join) {
                        $join->on('friends.user_id', 'users.id');
                    })
                    ->select('users.*', 'friends.id as friendRequestId', 'friends.user_id as requestedBy', 'friends.status as requestStatus', 'friends.created_at as createdAt')
                    ->where('friends.friend_user_id', $userId)
                    ->where('friends.clear_status', '0')
                    ->orderBy('friends.id', 'DESC');
            $friendRequestList = $query->take('2')->get();
            DB::commit();
            if (count($notificationList) >= 1 || count($friendRequestList) >= 1) {

                static::$data['success'] = true;
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['perPage'] = $perPage;
                static::$data['total'] = $total;
                static::$data['data']['friendRequest'] = $friendRequestList;
                static::$data['data']['users'] = $notificationList;
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function blockedUser($data) {
        try {
            DB::beginTransaction();

            $checExist = BlockUser::where('user_id', Auth::id())
                    ->where('blocked_user_id', $data['BlockedUserId'])
                    ->first();

            if ($checExist) {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.already_blocked');
            } else {
                $blockObj = new BlockUser();
                $blockObj->user_id = Auth::id();
                $blockObj->blocked_user_id = $data['BlockedUserId'];

                $blockObj->save();
                $userId = Auth::id();
                $userArr = array($userId, $data['BlockedUserId']);
                SendFriendRequest::whereIn('user_id', $userArr)
                        ->whereIn('friend_user_id', $userArr)
                        ->delete();
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.blocked_user');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function unBlockedUser($data) {
        try {
            $checExist = BlockUser::where('user_id', Auth::id())
                    ->where('blocked_user_id', $data['BlockedUserId'])
                    ->first();
            if ($checExist) {
                BlockUser::where('user_id', Auth::id())
                        ->where('blocked_user_id', $data['BlockedUserId'])
                        ->delete();
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.Unblocked_user');
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function blockedUserList($data) {
        try {
            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            $query = BlockUser::where('user_id', Auth::id())
                    ->join('users as user', function($join) {
                        $join->on('blocked_users.blocked_user_id', 'user.id');
                    })
                    ->select('user.*');
            $total = count($query->get());
            $blockUserList = $query->skip($start)->take($perPage)->get();

            if ($blockUserList) {
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['perPage'] = $perPage;
                static::$data['total'] = $total;
                static::$data['data']['users'] = $blockUserList;
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function questionList($data) {
        try {
            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            $query = Question::where('question_by', Auth::id())
                    ->leftJoin('answers as ans', function($join) {
                        $join->on('questions.id', 'ans.question_id');
                    })
                    ->leftJoin('users', function($join) {
                        $join->on('ans.user_id', 'users.id');
                    })
                    ->leftJoin('answer_liked as like', function($join) {
                        $join->on('ans.id', 'like.answer_id')
                        ->on('ans.user_id', 'like.user_id');
                    })
                    ->select('questions.id', 'questions.question', 'questions.type', 'questions.created_at as questionCreatedAt', 'ans.answer', 'ans.id as answerId', 'ans.user_id as answerGivenBy', 'ans.created_at as answerCreatedAt', 'users.name as answerByName', 'users.avatar_name as answeravatarName', 'users.avatar_data as avatarData', 'users.gender as AvatarGender', 'like.user_id as likid', DB::RAW("IF(like.user_id !='',count(like.id),NULL) as likeCount"))
                    ->groupBy('questions.id')
                    ->orderBy('questions.id', 'DESC');
            $total = count($query->get());
            $questionList = $query->skip($start)->take($perPage)->get();
            if ($questionList) {
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['perPage'] = $perPage;
                static::$data['total'] = $total;
                static::$data['data']['questions'] = $questionList;
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function friendSearch($data) {
        try {
            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            $userId = Auth::id();
            $searchQuery = $data['keyword'];
            $queryData = User::where('users.id', '!=', $userId)
                    ->where(function ($query) use ($searchQuery) {
                        $query->orWhere('users.name', 'like', $searchQuery . '%')
                        ->orWhere('users.avatar_name', 'like', $searchQuery . '%');
                    })
                    ->leftJoin('friends as frd', function($join) use ($userId) {
                        $join->on('frd.user_id', DB::raw($userId))
                        ->on('users.id', 'frd.friend_user_id')
                        ->orOn(function ($query) use ($userId) {
                            $query->on('users.id', 'frd.user_id')
                            ->on('frd.friend_user_id', DB::raw($userId));
                        });
                    })
                    ->select('users.*')
                    ->where('users.role', '!=', '2')
                    ->where('users.status', '2')
                    ->where('frd.status', '1')
                    ->groupBy('users.id')
                    ->orderBy('users.name', 'ASC');
            $total = count($queryData->get());
            $keywords = $queryData->skip($start)->take($perPage)->get();
            if (count($keywords) >= 1) {
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['perPage'] = $perPage;
                static::$data['total'] = $total;
                static::$data['data']['users'] = $keywords;
            } else {
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function deleteBlockChat($data) {
        try {
            $user = Auth::user();
            $friendEjabberdId = $data['ejabberdId'];
            $blockString = '^_B_L_O_C_K_^';
            Ejabberd::where('username', $user->ejabberd_id)
                    ->where('bare_peer', $friendEjabberdId)
                    ->where('txt', $blockString)
                    ->delete();
            // reverse delete change beer pear and username

            $userEjabberId = $user->ejabberd_id . '@localhost';
            $friendEjabberdId = explode('@', $friendEjabberdId);
            Ejabberd::where('username', $friendEjabberdId[0])
                    ->where('bare_peer', $userEjabberId)
                    ->where('txt', $blockString)
                    ->delete();
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.update_successful');
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function clearAllNotification() {
        try {
            $userId = Auth::id();
            Notification::where('receiver_id', $userId)
                    ->delete();
            SendFriendRequest::where('friend_user_id', '=', $userId)
                    ->update([
                        'clear_status' => '1',
            ]);
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.update_successful');
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function notificationStatusUpdate($data) {
        try {
            $userId = Auth::id();
            if ($data['notificationType'] != 'friendRequest') {
                Notification::where('receiver_id', '=', $userId)
                        ->where('id', $data['notificationId'])
                        ->update([
                            'is_read' => '1',
                ]);
            } else {
                SendFriendRequest::where('friend_user_id', '=', $userId)
                        ->update([
                            'clear_status' => '1',
                ]);
            }
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.update_successful');
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function lastChatNotificationUpdate($data) {
        try {
            $userId = Auth::id();
            Notification::where('user_id', $userId)
                    ->where('receiver_id', $data['messageReciverId'])
                    ->where('action_type', 'chat')
                    ->delete();
            $notification = new Notification();
            $notification->user_id = $userId;
            $notification->receiver_id = $data['messageReciverId'];
            $notification->action_type = 'chat';
            $notification->content = '#user has sent you a message.';
            $notification->is_read = 0;
            $notification->save();
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.update_successful');
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function deleteBlockedChat() {
        try {
            $blockString = '^_B_L_O_C_K_^';
            Ejabberd::where('txt', $blockString)
                    ->delete();
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function answerListWithQuesiton($data) {
        try {
            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);

            $userId = Auth::id();
            $query = Answer::where('answers.user_id', Auth::id())
                    ->leftJoin('questions', function($join) {
                        $join->on('answers.question_id', 'questions.id');
                    })
                    ->leftJoin('users', function($join) {
                        $join->on('questions.question_by', 'users.id');
                    })
                    ->leftJoin('answer_liked as like', function($join) {
                        $join->on('answers.id', 'like.answer_id');
                    })
                    ->leftJoin('friends as frd', function($join) use ($userId) {
                        $join->on('frd.user_id', DB::raw($userId))
                        ->on('users.id', 'frd.friend_user_id')
                        ->orOn(function ($query) use ($userId) {
                            $query->on('users.id', 'frd.user_id')
                            ->on('frd.friend_user_id', DB::raw($userId));
                        });
                    })
                    ->select('questions.id as questionId', 'questions.question', 'questions.type', 'questions.created_at as questionCreatedAt', 'answers.answer', 'answers.id as answerId', 'answers.answer_type as answerType', 'answers.created_at as answerCreatedAt', 'like.user_id as likid', 'users.id as userId', 'users.name as userName', 'users.avatar_name as userAvatarName', 'users.gender as userGender', 'users.avatar_data as userAvatarData', 'frd.user_id as requestedBy', 'frd.status as requestStatus')
                    ->groupBy('answers.id')
                    ->orderBy('answers.id', 'DESC');
            $total = count($query->get());
            $answerList = $query->skip($start)->take($perPage)->get();
            if ($answerList) {
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['perPage'] = $perPage;
                static::$data['total'] = $total;
                static::$data['data']['answer'] = $answerList;
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * function is used to logout app user
     * @return type
     */
    public static function logoutAppUser() {
        try {
            //logging out user by deleting its object from device token
            $status = \App\Models\UserDevice::where('user_id', Auth::id())->delete();
            if ($status) {
                self::$data['success'] = true;
                self::$data['message'] = trans('messages.logout');
            } else {
                self::$data['success'] = false;
                self::$data['message'] = trans('messages.logout');
            }
        } catch (\Exception $e) {
            self::setExceptionError($e);
        }
        return self::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function sendLikeNotification() {
        try {
            //aap engineer k sath plan kr skte ho  
            $userId = Auth::id();
            $deviceIdentifier = 'AFFC4FAC40C1D2FBFF9A66105DC11FE8269AA8EF2AB88E5D26D85188E5EC82F4';
            $message = 'Just check';
            $params = $userId;
            NotificationServiceProvider::sendPushIOS($deviceIdentifier, $message, $params = false);
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.update_successful');
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function getAssets($data) {
        try {
            $gender = $data['gender'];
            $query = Asset::join('asset_category as cat', function($join) use($gender) {
                        $join->on('cat.gender_type', DB::raw($gender))
                        ->on('assets.asset_category_id', 'cat.id');
                    })
                    ->join('asset_category as subcat', function($join) use($gender) {
                        $join->on('subcat.gender_type', DB::raw($gender))
                        ->on('assets.asset_subcategory_id', 'subcat.id');
                    })
                    ->select('assets.id', 'assets.name', 'assets.asset_image', 'assets.itune_asset_id', 'assets.asset_type', 'assets.sub_categroy_index as assetIndex', 'cat.name as categoryName', 'subcat.name as subCategoryName')
                    ->groupBy('assets.id')
                    ->orderBy('assets.id', 'asc');

            $assetsList = $query->get();

            if ($assetsList) {
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['data']['asset'] = $assetsList;
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function updateDeviceToken($data) {
        try {
            \App\Models\UserDevice::where('user_id', '=', Auth::id())
                    ->update([
                        'device_token' => $data['deviceToken'],
            ]);
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.update_successful');
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function mutualFriendList($data) {
        try {
            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            $friendUserId = $data['friendId'];
            $userId = Auth::id();
            $userArr = array($friendUserId, $userId);

            $queryFirst = SendFriendRequest::where('friends.status', 1)
                    ->where('friends.friend_user_id', $userId)
                    ->select('friends.user_id');
            $query = SendFriendRequest::where('friends.status', 1)
                    ->where('friends.user_id', $userId)
                    ->union($queryFirst)
                    ->select('friends.friend_user_id');
            $firstArray = $query->get()->toArray();
            $firstResult = '';
            if ($firstArray) {
                foreach ($firstArray as $data1) {
                    $firstResult[] = $data1['friend_user_id'];
                }
            }
            $query2 = SendFriendRequest::where('friends.status', 1)
                    ->where('friends.friend_user_id', $friendUserId)
                    ->select('friends.user_id');
            $query = SendFriendRequest::where('friends.status', 1)
                    ->where('friends.user_id', $friendUserId)
                    ->union($query2)
                    ->select('friends.friend_user_id');
            $sechondArray = $query->get()->toArray();
            $secondResult = '';
            if ($sechondArray) {
                foreach ($sechondArray as $data2) {
                    $secondResult[] = $data2['friend_user_id'];
                }
            }
            if ($firstResult != '' && $secondResult != '') {
                $result = array_intersect($firstResult, $secondResult);
                $total = count($result);
                $queryData = User::whereIn('users.id', $result)
                        ->select('users.*')
                        ->where('users.status', '2');
                $totalArray = $queryData->get();
                $totalArrayCount = count($totalArray);

                if ($totalArrayCount == 0) {

                    static::$data['success'] = false;
                    static::$data['message'] = trans('messages.record_not_exist');
                } else {
                    static::$data['success'] = true;
                    static::$data['message'] = trans('messages.record_fetched');
                    static::$data['perPage'] = $perPage;
                    static::$data['total'] = $total;
                    static::$data['data']['users'] = $totalArray;
                }
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }
        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */

    /**
     * Send temporaryPassword
     * 
     * @param type $data
     * @return type
     */
    public static function sendAdminEmail($data) {
        try {
            $userId = Auth::id();
            $user = User::where('id', $userId)->select('name', 'email')->first()->toArray();

            $userEmail = $user['email'];
            if ($userEmail) {
                $userName = $user['name'];
                $subject = $data['messageSubject'];
                $messageData = $data['message'];
                $adminDetail = User::where('id', 1)->where('role', 2)->select('name', 'email')->first()->toArray();

                $adminEmail = $adminDetail['email'];

                if ($user) {
                    $status = \Mail::send('email.user.feedback_email', ['name' => ucwords('Admin'), 'username' => $userName, 'messageData' => ucwords($messageData), 'org_name' => config('constants.ORG_NAME')], function($message) use ($user, $adminEmail, $userEmail, $subject) {
                                $message->to($adminEmail, ucwords('admin'))->subject(ucwords($subject));
                                $message->from($userEmail);
                            });


                    static::$data['success'] = true;
                    static::$data['message'] = trans('messages.admin_mail_sucess');
                }
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.emailnot_exist');
            }
        } catch (\Exception $e) {

            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function reportQuestionAnswer($data) {
        try {
            DB::beginTransaction();
            $report = new ReportQuestion();
            $report->user_id = Auth::id();
            $report->question_id = isset($data['reportedQuestionId']) ? $data['reportedQuestionId'] : '';
            $report->answer_id = isset($data['reportedAnswerId']) ? $data['reportedAnswerId'] : '';
            $report->report_content = isset($data['reportedAnswerId']) ? $data['reportedAnswerId'] : '';
            $report->save();
            static::$data['message'] = trans('messages.update_successful');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function publicFormQuestion($data) {
        try {
            $userId = Auth::id();
            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            $query = Question::where('type', 2)
                    ->leftJoin('users', function($join) {
                        $join->on('questions.question_by', 'users.id');
                    })
                    ->whereNotIn('users.id', function($q)use ($userId) {
                        $q->select('user_id')
                        ->where('blocked_users.blocked_user_id', $userId)
                        ->from('blocked_users');
                    })
                    ->select('questions.id as questionsId', 'questions.question', 'questions.type', 'questions.created_at as questionCreatedAt', 'users.name as questionCreatedByName', 'users.avatar_data as questionCreatedByAvatarData', 'users.avatar_name as questionCreatedByAvatarName', 'users.gender as ByAvatarGender', 'users.id as questionCreatedByUserId')
                    ->groupBy('questions.id')
                    ->orderBy('questions.id', 'DESC');
            $total = count($query->get());
            $questionList = $query->skip($start)->take($perPage)->get();
            //echo '<pre>'; print_R($questionList);die;
            if ($questionList) {
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['perPage'] = $perPage;
                static::$data['total'] = $total;
                static::$data['data']['questions'] = $questionList;
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function feedQuestionWithAnser($data) {
        try {
            $userId = Auth::id();
            $question = Question::where('id', $data['questionId'])->first();

            $perPage = 30;
            $page = isset($data['page']) ? $data['page'] : 1;
            $start = $perPage * ($page - 1);
            if ($userId == $question['question_by']) {


                $query = Answer::where('answers.question_id', $data['questionId'])
                        ->leftJoin('users', function($join) {
                            $join->on('answers.user_id', 'users.id');
                        })
                        ->leftJoin('answer_liked as like', function($join) {
                            $join->on('answers.id', 'like.answer_id');
                        })
                        ->leftJoin('friends as frd', function($join) use ($userId) {
                            $join->on('frd.user_id', DB::raw($userId))
                            ->on('users.id', 'frd.friend_user_id')
                            ->orOn(function ($query) use ($userId) {
                                $query->on('users.id', 'frd.user_id')
                                ->on('frd.friend_user_id', DB::raw($userId));
                            });
                        })
                        ->select('answers.answer', 'answers.id as answerId', 'answers.answer_type as answerType', 'answers.created_at as answerCreatedAt', 'like.user_id as likid', 'users.id as userId', 'users.name as userName', 'users.avatar_name as userAvatarName', 'users.gender as userGender', 'users.avatar_data as userAvatarData', 'frd.user_id as requestedBy', 'frd.status as requestStatus', DB::RAW("IF(like.user_id !='',count(like.id),NULL) as likeCount"))
                        ->groupBy('answers.id')
                        ->orderBy('answers.id', 'DESC');
                $total = count($query->get());
                $answerList = $query->skip($start)->take($perPage)->get();
                $question = Question::where('id', $data['questionId'])->get();
            } else {
                $query = Answer::where('answers.question_id', $data['questionId'])
                        ->leftJoin('users', function($join) {
                            $join->on('answers.user_id', 'users.id');
                        })
                        ->leftJoin('answer_liked as like', function($join) {
                            $join->on('answers.id', 'like.answer_id');
                        })
                        ->leftJoin('friends as frd', function($join) use ($userId) {
                            $join->on('frd.user_id', DB::raw($userId))
                            ->on('users.id', 'frd.friend_user_id')
                            ->orOn(function ($query) use ($userId) {
                                $query->on('users.id', 'frd.user_id')
                                ->on('frd.friend_user_id', DB::raw($userId));
                            });
                        })
                        ->select('answers.answer', 'answers.id as answerId', 'answers.answer_type as answerType', 'answers.created_at as answerCreatedAt', 'like.user_id as likid', 'users.id as userId', 'users.name as userName', 'users.avatar_name as userAvatarName', 'users.gender as userGender', 'users.avatar_data as userAvatarData', 'frd.user_id as requestedBy', 'frd.status as requestStatus', DB::RAW("IF(like.user_id !='',count(like.id),NULL) as likeCount"))
                        ->where('answers.answer_type', 1)
                        ->groupBy('answers.id')
                        ->orderBy('answers.id', 'DESC');
                $total = count($query->get());
                $answerList = $query->skip($start)->take($perPage)->get();
                $question = Question::where('id', $data['questionId'])->get();
            }
            if ($question) {
                static::$data['success'] = true;
                static::$data['message'] = trans('messages.record_fetched');
                static::$data['perPage'] = $perPage;
                static::$data['total'] = $total;
                static::$data['data']['questions'] = $question;
                static::$data['data']['answer'] = $answerList;
            } else {
                static::$data['success'] = false;
                static::$data['message'] = trans('messages.record_not_exist');
            }
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }

        return static::$data;
    }
    
    /**
     * 
     * @param array $data
     * @return array
     */
    public static function acceptDeclineQuestion($data) {
        try {
            $userId = Auth::id();
            if ($data['status'] == '1') {
                AcceptPublicQuestion::where('user_id', '=', $userId)
                            ->where('asked_for_user_id', '=', $data['requestFor'])
                            ->update([
                                'status' => 1,
                    ]);
               
            } else {
                AcceptPublicQuestion::where('user_id', '=', $userId)
                            ->where('asked_for_user_id', '=', $data['requestFor'])
                        ->delete();
            }
            static::$data['success'] = true;
            static::$data['message'] = trans('messages.update_successful');
        } catch (\Exception $e) {
            DB::rollback();
            static::setExceptionError($e);
        }
        return static::$data;
    }
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
                echo 'sdf';die;
                static::$data['message'] = trans('messages.incorrect_old_password');
                static::$data['success'] = false;
                static::$data['status_code'] = \Symfony\Component\HttpFoundation\Response::HTTP_BAD_REQUEST;
                return static::$data;
            }
            echo 'sdf';die;
            $user->password = \Hash::make($data['password']);
            $user->save();

            static::$data['success'] = true;
            static::$data['message'] = trans('messages.password_changed');
        } catch (\Exception $e) {

            static::setExceptionError($e);
        }

        return static::$data;
    }
}
