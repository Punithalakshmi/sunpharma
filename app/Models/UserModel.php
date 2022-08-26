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
        'created_date',
        'email',
        'phone',
        'role',
        'created_id',
        'updated_id',
        'updated_date',
        'dob',
        'address',
        'middlename'
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
                'login_name'        => $result->firstname,
                'login_email'       => $result->email,
                'isLoggedIn'      => TRUE,
                'role'           => $result->role
            ];
            return $data;
        } else {
            return 0;
        }
        
    }

    public function fLogin($username, $password) {
        $result = $this->db
                        ->table($this->table)
                        ->where(array("email" => $username, "password" => $password))
                        ->get()
                        ->getRow();
        if($result) {
            $data = [
                'login_id'          => $result->id,
                'login_name'        => $result->firstname,
                'login_email'       => $result->email,
                'isLoggedIn'      => TRUE,
                'role'           => $result->role
            ];
            return $data;
        } else {
            return 0;
        }
        
    }

    public function getListsOfUsers($id='')
    {
        if(empty($id))
         return $this->findAll();
        else 
          return $this->getWhere(array('id' => $id)); 
    }
}