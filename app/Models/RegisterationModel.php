<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class RegisterationModel extends Model{
    protected $table = 'event_registerations';
    
    protected $allowedFields = [
        'firstname',
        'lastname',
        'created_date',
        'email',
        'phone',
        'created_id',
        'updated_id',
        'updated_date',
        'address',
        'registeration_no',
        'is_mail_sent',
        'mode'
    ];

   

    public function getRegisteredUsers($id='')
    {
        if(empty($id))
         return $this->findAll();
        else 
          return $this->getWhere(array('id' => $id)); 
    }
    
    public function CountAll()
    {
         $db = \Config\Database::connect();
         $builder = $db->table('event_registerations');
         return $builder->countAll();
    }
   

    public function getEventUserLists()
    {
        return $this->getWhere(array('is_mail_sent' => 0)); 
    }
    
}