<?php
/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: UserController.php
 * CodeLibrary/Project: oms
 * Author: Amit
 * CreatedOn: date (30/05/2017) 
 */

namespace App\Http\Controllers\Service;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Service\UserRegistrationRequest;
use App\Http\Requests\Service\UserOtpRequest;
use App\Http\Requests\Service\UserResendOtpRequest;
use App\Http\Requests\Service\SetupCustomerProfileRequest;
use App\Http\Requests\Service\SaveAvatarProfileRequest;
use App\Http\Requests\Service\UserProfileRequest;
use App\Http\Requests\Service\AskQuestionRequest;
use App\Http\Requests\Service\UserAnswerRequest;
use App\Http\Requests\Service\KeywordsRequest;
use App\Http\Requests\Service\SearchUsersRequest;
use App\Http\Requests\Service\SendFriendRequest;
use App\Http\Requests\Service\FriendRequestStatusRequest;
use App\Http\Requests\Service\ContactSyncingRequest;
use App\Http\Requests\Service\EjabberHistoryRequest;
use App\Http\Requests\Service\LikeDislikeRequest;
use App\Http\Requests\Service\ReportQuestionAnswerRequest;
use App\Http\Requests\Service\UserLoginRequest;
use App\Http\Requests\Service\ChangePasswordRequest;

use App\Providers\UserServiceProvider;
use Illuminate\Http\Request;

class UserController extends BaseController {

    /**
     * function is used to register , login user
     * @param UerRegistrationRequest $request
     * @return type
     */
    public function postUserRegistration(UserRegistrationRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::registerUser($input);
        return $this->sendJsonResponse($response);
    }
    /**
     * function is used to login , login user
     * @param UerRegistrationRequest $request
     * @return type
     */
    public function postUserLogin(UserLoginRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::userLogin($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to otp verifiaciton
     * @param UserOtpRequest $request
     * @return type
     */
    public function postOtpVerification(UserOtpRequest $request) {

        $input = $request->all();
        $response = UserServiceProvider::verificationOtp($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to resend otp
     * @param UserResendOtpRequest $request
     * @return type
     */
    public function postResendOtp(UserResendOtpRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::resendOtp($input);
        return $this->sendJsonResponse($response);
    }

    /*
     * function is used to logout user 
     */

    public function getUserLogout() {
        $response = UserServiceProvider::logoutAppUser();
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to set up customer profile
     * @return type
     */
    public function setupProfile(SetupCustomerProfileRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::setupCustomerProfile($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to save avatar
     * @return type
     */
    public function saveAvatar(SaveAvatarProfileRequest $request) {

        $input = $request->all();
        $response = UserServiceProvider::saveAvatarProfile($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to get user profile
     * @return type
     */
    public function getUserProfile(UserProfileRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::getUserProfile($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to ask question
     * @return type
     */
    public function askQuesiton(AskQuestionRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::postQuestion($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to post answer
     * @return type
     */
    public function postAnswer(UserAnswerRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::postAnswer($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to get Keywords
     * @return type
     */
    public function getKeywords(KeywordsRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::keywords($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to get SendfriendRequest
     * @return type
     */
    public function postSendfriendRequest(SendFriendRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::sendFriendRequest($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to get SearchUsers
     * @return type
     */
    public function getSearchUsers(SearchUsersRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::globalSearchUsers($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to get FriendRequestAcceptReject
     * @return type
     */
    public function postFriendRequestAcceptReject(FriendRequestStatusRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::friendRequestStatusUpdate($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to post ContactSyncing
     * @return type
     */
    public function postContactSyncing(ContactSyncingRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::contactSyncing($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to get FriendRequestList
     * @return type
     */
    public function getFriendRequestList(Request $request) {
        $input = $request->all();
        $response = UserServiceProvider::friendRequestList($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to get EjabberdHistory
     * @return type
     */
    public function postEjabberdHistory(EjabberHistoryRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::ejabberdHistory($input);
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to get ejabberd
     * @return type
     */
    public function getEjabberdLastChatHistory() {
        $response = UserServiceProvider::ejabberdLastChatHistory();
        return $this->sendJsonResponse($response);
    }

    /**
     * function is used to get friend list
     * @return type
     */
    public function postFriendList(Request $request) {
        $input = $request->all();
        $response = UserServiceProvider::friendList($input);
        return $this->sendJsonResponse($response);
    }
    /**
     * function is used to get LikeDislike
     * @return type
     */
    public function postLikeDislike(LikeDislikeRequest $request) {
        $input = $request->all();
        $response = UserServiceProvider::likeDislike($input);
        return $this->sendJsonResponse($response);
    }
    
    
    /**
     * function is used to get assets
     * @return type
     */
    public function postUpdateDeviceToken(Request $request){
        $input = $request->all();
        $response = UserServiceProvider::updateDeviceToken($input);
        return $this->sendJsonResponse($response);
    }
    
    
    /**
     * function is used to get mutual friends list
     * @return type
     */
    public function postMutualFriendList(Request $request){
        $input = $request->all();
        $response = UserServiceProvider::mutualFriendList($input);
        return $this->sendJsonResponse($response);
    }
    /**
     * function is used to get mutual friends list
     * @return type
     */
    public function postSendAdminEmail(Request $request){
        $input = $request->all();
        $response = UserServiceProvider::sendAdminEmail($input);
        return $this->sendJsonResponse($response);
    }
    /**
     * function is used to get ReportAuser
     * @return type
     */
    public function postReportQuestionAnswer(ReportQuestionAnswerRequest $request) {
       
        $input = $request->all();
        $response = UserServiceProvider::reportQuestionAnswer($input);
        return $this->sendJsonResponse($response);
    }
    
    
    /**
     * function is used to accept and decline question 
     * @return type
     */
    public function postChangePassword(ChangePasswordRequest $request) {
        
        $input = $request->all();
        $response = UserServiceProvider::changePassword($input);
        return $this->sendJsonResponse($response);
    }
}
