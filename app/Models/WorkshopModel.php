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
        'status',
        'agenda',
        'onsite_user_limit'
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

    public function getEventsByFilter($filter)
    {
        $builder = $this->table('events');
        $builder->select('events.*');
        
        if(!empty($filter['title']))
         $builder->like('events.title',$filter['title']);

        if(!empty($filter['subject']))
         $builder->like('events.subject',$filter['subject']); 

         $status = (isset($filter['status']) && ($filter['status'] == 'active'))?1:0;
         
        if(!empty($filter['status']))
         $builder->like('events.status',$status);
         
        $builder->orderBy('id','DESC');
        
        if((!empty($filter['limit']) || !empty($filter['start'])))
          $builder->limit($filter['limit'],$filter['start']);

        if(isset($filter['totalRows']) && ($filter['totalRows'] == 'yes'))
            return $builder->countAllResults();
        else 
            return $query = $builder->get();
    }

    public function getEventLists()
    {
        return $this->table('events')->countAll();
    }

}