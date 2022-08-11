<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserModel extends Model{
    protected $table = 'users';
    
    protected $allowedFields = [
        'username',
        'firstname',
        'password',
        'lastname',
        'created_date'
    ];

    public function Login($username, $password) {
        $result = $this->db
                        ->table($this->table)
                        ->where(array("username" => $username, "password" => $password))
                        ->get()
                        ->getRow();
        if($result) {
            $data = [
                'login_id'          => $result->id,
                'login_name'        => $result->username,
                'login_email'       => $result->firstname,
                'isLoggedIn'      => TRUE,
            ];
            return $data;
        } else {
            return 0;
        }
        
    }

    public function getListsOfUsers()
    {
        return $this->findAll();
    }
}