<?php

/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: NotificationServiceProvider.php
 * CodeLibrary/Project: oms
 * Author: Amit
 * CreatedOn: date (25/04/2017) 
 */

namespace App\Providers;
/**
 * NotificationServiceProvider class conatains methods for user management
 */
class NotificationServiceProvider extends BaseServiceProvider {    
/**
     * send Push IOS
     * @param type $deviceIdentifier
     * @param type $message
     * @param type $params
     * @return boolean
     */
     
    public static function sendPushIOS($deviceIdentifier, $message, $params = false) { 
       
        if (!$deviceIdentifier || strlen($deviceIdentifier) < 22) {
            return;
        }

        if (env('APP_ENV') == 'local') {
            $config = config('push_notification.apple.sandbox');
        } else {
            $config = config('push_notification.apple.production');
        }

    


        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $config['pem_file']);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $config['passphrase']);

        $err = null;
        $errstr = "";

        // Open a connection to the APNS server
        $fp = stream_socket_client(
                $config['url'], $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);


        if (!$fp) {
            return false;
        }



        $body['aps'] = array(
            'alert' => $message,
            'data' => $params['data'],
            'sound' => 'AlertSound.mp3',
            'badge' => $params['badge']
        );
        // Encode the payload as JSON
        $payload = json_encode($body);


        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceIdentifier) . pack('n', strlen($payload)) . $payload;
        // Send it to the server
        fwrite($fp, $msg, strlen($msg));


        fclose($fp);
    }
}
    