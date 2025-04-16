<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class ActionModel extends Model{
    protected $table = 'action_logs';
    
    protected $allowedFields = [
        'action_id',
        'action_name',
        'message',
        'created_id',
        'created_date'
    ];

    public function getListsOfLogs()
    {
        return $this->findAll();
    }
}