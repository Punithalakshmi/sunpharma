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

}