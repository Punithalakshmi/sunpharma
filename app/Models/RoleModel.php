<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class RoleModel extends Model{
    protected $table = 'roles';
    
    protected $allowedFields = [
        'name',
        'created_date'
    ];

    public function getListsOfRoles()
    {
        return $this->findAll();
    }
}