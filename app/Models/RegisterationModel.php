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
        'mode',
        'mail_log',
        'event_id'
    ];

   

    public function getRegisteredUsers($id='')
    {
        if(empty($id)){
	    $builder = $this->table('event_registerations');
            $builder->select('event_registerations.*,events.title');
            $builder->join('events','events.id = event_registerations.event_id','left');
	     $builder->orderBy('event_registerations.id', 'DESC');
            return $query = $builder->get()->getResultArray();	
	}
        else
	{ 
          return $this->getWhere(array('id' => $id));
	} 
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

    public function getRegisterationByFilter($filter = array())
    {
        $builder = $this->table('event_registerations');
        $builder->select('event_registerations.*,events.title');
        $builder->join('events','events.id = event_registerations.event_id','left');
       

        if(!empty($filter['title']))
         $builder->like('events.title',$filter['title']);

        if(!empty($filter['email']))
         $builder->like('event_registerations.email',$filter['email']); 

        if(!empty($filter['phone']))
          $builder->like('event_registerations.phone',$filter['phone']);

        if(!empty($filter['mode']))
          $builder->like('event_registerations.mode',$filter['mode']);  
         
        $builder->orderBy('id', 'DESC');
      
        if((!empty($filter['limit']) || !empty($filter['start'])))
          $builder->limit($filter['limit'],$filter['start']);

        if(isset($filter['totalRows']) && ($filter['totalRows'] == 'yes'))
            return $builder->countAllResults();
        else 
            return $query = $builder->get();
    }
    
}