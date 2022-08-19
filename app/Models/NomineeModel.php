<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class NomineeModel extends Model{
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

    public function getListsOfNominees($id='')
    {
        if(empty($id))
         return $this->getWhere(array("role" => '2'));
        else 
          return $this->getWhere(array('id' => $id)); 
    }

    public function getJuryLists()
    {
        return $this->getWhere(array("role" => '1'));
    }
}