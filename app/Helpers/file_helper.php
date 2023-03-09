<?php

if ( ! function_exists('multipleFileUpload'))
{
    function multipleFileUpload($fieldName='',$folderID='')
    {

        $request = \Config\Services::request();

        $uploadFolder = '/uploads/'.$folderID."/";

        $fileNames = array();

        if($request->getFileMultiple($fieldName))
        {
                $files = $request->getFileMultiple($fieldName);
    
                foreach ($files as $file) {
                    if ($file->isValid() && ! $file->hasMoved()) {
                        $newName  = $file->getRandomName();
                        $filename = $file->getClientName();
                        $file->move($uploadFolder,$filename);
                        $fileNames[] = $filename;
                    }  
                }
                $names = implode(',',$fileNames);
                return $names;
        }
    }
}       

if ( ! function_exists('singleFileUpload'))
{
    function singleFileUpload($fieldName='',$folderID='')
    {
        $request = \Config\Services::request();

        $uploadFolder = '/uploads/'.$folderID."/";

        if($request->getFile($fieldName))
        {
            $file = $request->getFile($fieldName);
 
            if ($file->isValid() && ! $file->hasMoved()) {
                $newName  = $file->getRandomName();
                $filename = $file->getClientName();
                $file->move($uploadFolder,$filename);
            }  
            return $filename;
        }
    }
} 