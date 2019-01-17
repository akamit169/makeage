<?php

return [
    'api_status' => array(
        'ok' => 200,
        'exception' => 520,
        'info_missing' => 449,
        'invalid_request' =>  400,
        'login_timeout' => 440,
        'not_found' => 404,
        'unauthorized' => 401,
        'server_error' => 500,
        'tech_error'=>606,
    ),
    'user_type' => array(
        'super_admin' => 1,
        'salesman' => 2,
        'production' => 3
    ),
    'profile_type' => array(
        'private' => 0,
        'public' => 1
    ),
    'user_status' => array(
        'inactive' => 0,
        'active' => 1,
        'blocked' => 2
    ),
    'date_format' => [
        'client' => 'MMM YYYY',
        'client_parsed' => 'YYYY-MM-DD',
        'server' => 'M Y',
    ],
    'social_type' => array(
        'facebook' => 1,
        'linkedin' => 2
    ),
    'device_type' => array(
        'ios' => 1,
        'other' => 2
    ),
    'organisation_name' => 'oms',
    'SUBJECT' => array(
        'admin_forgot_password' => 'Admin Forgot Password'
    ),
    'post' => array(
        'no' => 0,
        'yes' => 1
    ),
    'record_per_page' => env('RECORD_PER_PAGE', 10),
    'bool_arr' => array(
        'no' => 0,
        'yes' => 1
    ),
    'feed_type' => array(
        'profile' => 1,
        'feed' => 2,
        'tag_feed' => 3,
    ),
    'file_size' => array(
        'image_min' => 0.1,        //in kilobytes
        'image_max' => 5120,        //in kilobytes
    ),
    'organisation_name' => 'OMS',
    'verify_email' => 'api/v1/verify-email/',
    'file_width' => array(
        'min_resize_width' => 250        
    ),
];