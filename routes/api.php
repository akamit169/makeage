<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware'=>'XSS'], function () {

     Route::group(['prefix' => 'user'], function () {
        Route::post('registration', 'Service\UserController@postUserRegistration');
        Route::post('login', 'Service\UserController@postUserLogin');
        Route::post('otpVerification', 'Service\UserController@postOtpVerification');
        Route::post('resendOtp', 'Service\UserController@postResendOtp');
        Route::post('userLogin', 'Service\UserController@postUserLogin');
        Route::group(['middleware'=>'App\Http\Middleware\ApiAuth'],function(){
            Route::get('userLogout', 'Service\UserController@getUserLogout');
            Route::post('setupProfile', 'Service\UserController@setupProfile');
            Route::post('saveAvatar', 'Service\UserController@saveAvatar');
            Route::post('getProfile', 'Service\UserController@getUserProfile');
            Route::post('askQuestion', 'Service\UserController@askQuesiton');
            Route::post('postAnswer', 'Service\UserController@postAnswer');
            Route::post('keywords', 'Service\UserController@getKeywords');
            Route::post('searchUsers', 'Service\UserController@getSearchUsers');
            Route::post('sendFriendRequest', 'Service\UserController@postSendfriendRequest');
            Route::post('friendRequestAcceptRejectStatus', 'Service\UserController@postFriendRequestAcceptReject');
            Route::post('contactSyncing', 'Service\UserController@postContactSyncing');
            Route::get('friendRequestList', 'Service\UserController@getFriendRequestList');
            Route::post('ejabberdHistory', 'Service\UserController@postEjabberdHistory');
            Route::get('lastChatHistory', 'Service\UserController@getEjabberdLastChatHistory');
            Route::post('friendList', 'Service\UserController@postfriendList');
            Route::post('LikeUnlike', 'Service\UserController@postLikeDislike');
            Route::post('deleteChatHisotry', 'Service\UserController@postDeleteChatHistory');
            Route::post('reportUser', 'Service\UserController@postReportUser');
            Route::get('notificationList', 'Service\UserController@getNotificationList');
            Route::post('blockUser', 'Service\UserController@postBlockUser');
            Route::post('UnBlockUser', 'Service\UserController@postUnBlockUser');
            Route::get('blockUserList', 'Service\UserController@getBlockedUserList');
            Route::get('questionList', 'Service\UserController@getQuestionList');
            Route::post('searchFriend', 'Service\UserController@postSearchFriend');
            Route::post('chatNotification', 'Service\UserController@postChatNotification');
            Route::post('deleteBlockChat', 'Service\UserController@postDeleteBlockChat');
            Route::get('clearAllNotification', 'Service\UserController@getClearAllNotification');
            Route::post('notificationStatusUpdate', 'Service\UserController@postNotificationStatusUpdate');
            Route::post('lastChatNotificationUpdate', 'Service\UserController@postLastChatNotificationUpdate');
            Route::post('likePushNotification', 'Service\UserController@postLikeNotification');
            Route::post('assetsList', 'Service\UserController@postAssets');
            Route::get('anserListWithQuestion', 'Service\UserController@getAnswerWithQuestion');
            Route::post('updateDeviceToken', 'Service\UserController@postUpdateDeviceToken');
            Route::post('mutualFriendList', 'Service\UserController@postMutualFriendList');
            Route::post('sendAdminEmail', 'Service\UserController@postSendAdminEmail');
            Route::post('reportQuestionAnswer', 'Service\UserController@postReportQuestionAnswer');
            Route::get('publicFormQuestion', 'Service\UserController@getPublicFormQuestion');
            Route::post('feedQuestionWithAnser', 'Service\UserController@postPublicFeedQuestionWithAnser');
            Route::post('acceptDeclineQuestion', 'Service\UserController@postAcceptDeclineQuestion');
            Route::post('changePassword', 'Service\UserController@postChangePassword');
            
        });
         Route::post('forgotPassword', 'Service\UserController@postForgotPassword');

         Route::group(['middleware'=>'App\Http\Middleware\ApiAuth'],function(){
                Route::post('changePassword', 'Service\UserController@postChangePassword');
         });

     });
     Route::group(['prefix' => 'service'], function () {
         
     	Route::get('getServiceList', 'Service\ServiceController@getServicesList');
     });

    


});

