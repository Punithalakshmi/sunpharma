<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class WorkshopModel extends Model{
    protected $table = 'events';
    
    protected $allowedFields = [
        'title',
        'subject',
        'category',
        'description',
        'start_date',
        'end_date',
        'created_date',
        'updated_date',
        'created_id',
        'updated_id',
        'registration_link',
        'document',
        'year',
        'banner_image',
        'thumb_image',
        'status'
    ];

    public function getLists($id='')
    {
        if(empty($id))
        return $this->findAll();
       else 
         return $this->getWhere(array('id' => $id)); 
    }

    public function getEventTypes()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('event_type');
        $builder->select('event_type.*');
        return $query = $builder->get();
    }

    public function getActiveEvents()
    {
         return $this->getWhere(array('status' => 1)); 
    }

}