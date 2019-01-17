<?php
/*
 * Copyright 2018 OMS infoservices. 
 * All rights reserved.
 * File: FileUpload.php
 * CodeLibrary/Project: oms
 * Author:Amit kumar
 * CreatedOn: date (12/05/2017) 
*/

namespace App\Utilities;

class FileUpload {

    
    /**
     * upload File to S3
     * @param type $inputFile
     * @param string $filePath
     * @param type $mediaName
     * @return boolean
     */
    public function uploadFileToS3($inputFile, $filePath) {

        $fileName = time() . uniqid() . '.' . $inputFile->getClientOriginalExtension();

        $filePath = $filePath.$fileName;

        $status = \Storage::disk('s3')->put($filePath, file_get_contents($inputFile), 'public');


        if ($status) {
            return $fileName;
        }
        
        return false;
    }
   

}