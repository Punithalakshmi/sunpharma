<?php

if ( ! function_exists('multipleFileUpload'))
{
    function multipleFileUpload($fieldName='',$folderID='')
    {

        $request = \Config\Services::request();

        $uploadFolder = 'uploads/'.$folderID."/";

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
                $names = '';
                if(count($fileNames) > 0)
                  $names = implode(',',$fileNames);

                if($names!='')
                   return $names;
                else
                   return false;  
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


if ( ! function_exists('getFileObject'))
{
    function getFileObject($fieldName='')
    {
        $fileAp = new \CodeIgniter\Files\File($fieldName,true);
        return $fileAp;
    }
} 

if(!function_exists('fileNameUpdate')) {

    function fileNameUpdate($id = '',$fileNames='',$fieldName='')
    {
        $nominationModel = model('App\Models\NominationModel');

        $getAlreadyUploadedFiles = $nominationModel->getNominationFileData($id,$fieldName)->getRowArray();

        $fname = '';
        if(!empty($getAlreadyUploadedFiles[$fieldName])){
            $fname .= $getAlreadyUploadedFiles[$fieldName];
            $fname .= ',';
            $fname .= $fileNames;
        }
        else
        {
            $fname = $fileNames;
        }

        return $fname;
    }

}