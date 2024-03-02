<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class ContactModel extends Model{
    protected $table = 'contact';
    
    protected $allowedFields = [
        'name',
        'email',
        'message',
        'created_date',
        'updated_date'
    ];

    public function getLists()
    {
        return $this->findAll();
    }
}