<?php 
namespace Config;

class CustomValidation{

    public function validusername(string $str, ?string &$error = null): bool
    {

          $usernamePreg = "/^[a-zA-Z0-9]+$/";

          if( (preg_match($usernamePreg,$str))) {
                return true;
          }

          $error = "Please enter valid username";

          return false;

    }

    public function checkUniqueEmail($str, string $passValue, array $postData): bool
    {
     
        $userModel = model('App\Models\UserModel');

        $getUniqueData = $userModel->getWhere(array("email" => $str,"award_id" => $passValue, "role" => 2))->getRowArray();

         if(is_array($getUniqueData) && count($getUniqueData) > 0){
            return false;
         }
         return true;

    }

    public function checkUniqueEmailForRegisteration($str, string $passValue, array $postData): bool
    {
     
        $registerModel = model('App\Models\RegisterationModel');

        $getUniqueData = $registerModel->getWhere(array("email" => $str,"event_id" => $passValue))->getRowArray();

         if(is_array($getUniqueData) && count($getUniqueData) > 0){
            return false;
         }
         return true;

    }


    public function checkUniqueEmailForExceptNominee($str, string $passValue, array $postData): bool
    {
     
        $userModel = model('App\Models\UserModel');

        $getUniqueData = $userModel->getWhere(array("email" => $str,"id!=" => $passValue))->getRowArray();

         if(is_array($getUniqueData) && count($getUniqueData) > 0){
            return false;
         }
         return true;

    }

    public function checkRegistrationModeLimit($str, string $passValue, array $postData): bool
    {
      
      $registerModel = model('App\Models\RegisterationModel');
      $eventModel    = model('App\Models\WorkshopModel');

         if($str == 'Onsite'){
            $getUniqueData = $registerModel->getWhere(array("mode" => $str,"event_id" => $passValue))->getResultArray();
            
            //get user limit value
            $limit = $eventModel->getWhere(array("id" => $passValue))->getRowArray();

            if(is_array($getUniqueData) && count($getUniqueData) >= $limit['onsite_user_limit'] ){
               return false;
            }
            return true;
         }
         else{
               return true;
         }	
  
    } 

    public function checkUniqueUsernameForRole($str, string $passValue, array $postData): bool
    {
     
        $userModel = model('App\Models\UserModel');

        $getUniqueData = $userModel->getWhere(array("username" => $str, "id!=" => $passValue, "role" => $postData['user_role']))->getRowArray();

         if(is_array($getUniqueData) && count($getUniqueData) > 0){
            return false;
         }
         return true;

    }


    public function checkUniqueEmailForRole($str, string $passValue, array $postData): bool
    {
     
        $userModel = model('App\Models\UserModel');

        $getUniqueData = $userModel->getWhere(array("email" => $str,"id!=" => $passValue, "role" => $postData['user_role']))->getRowArray();

         if(is_array($getUniqueData) && count($getUniqueData) > 0){
            return false;
         }
         return true;

    }
  

}