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
        'middlename',
        'category'
    ];

    public function getListsOfNominees($id='')
    {
        if(empty($id)){
            $builder = $this->table('users');
            $builder->select('users.*,category.name as category_name,nominee_details.registration_no,nominations.title,awards_creation_category.name as main_category_name');
            $builder->join('nominee_details', 'nominee_details.nominee_id = users.id');
            $builder->join('category', 'category.id = nominee_details.category_id');
            $builder->join('nominations','nominations.id = users.award_id AND nominations.status=1');
            $builder->join('awards_creation_category','awards_creation_category.id=nominations.main_category_id');
            $builder->where("users.role",'2');
            return $query = $builder->get();
        }
        else
        { 
          return $this->getWhere(array('id' => $id));
        }   
    }

    public function getJuryName($id='')
    {
        $builder = $this->table('users');
        $builder->select('users.firstname,users.lastname');
        $builder->join('jury_nominee', 'jury_nominee.jury_id = users.id AND users.role="1"');
        $builder->where("jury_nominee.jury_id",$id);
        return $query = $builder->get();
    }

    public function getJuryLists()
    {
        return $this->getWhere(array("role" => '1'));
    }

    public function getNomineeLists()
    {
        $builder = $this->table('users');
        $builder->select('*');
        $builder->where("role",2);
	$builder->where("users.status",'Approved');
        return $builder->countAllResults();
    }

    public function getNomineeInfo($id='')
    {
        $builder = $this->table('users');
        $builder->select('users.*,nominee_details.*,users.id as user_id');
        $builder->join('nominee_details', 'nominee_details.nominee_id = users.id AND users.role="2"');
        $builder->where("nominee_details.nominee_id",$id);
        return $query = $builder->get();
    }

    public function getNomineeListsByCustomFilter($filter = array())
    {

        $builder = $this->table('users');
        $builder->select('users.*,category.name as category_name,nominee_details.registration_no,nominations.title,awards_creation_category.name as main_category_name,nominee_details.is_submitted,nominee_details.nomination_year,nominee_details.is_carry_forwarded,category.main_category_id');
        $builder->join('nominee_details', 'nominee_details.nominee_id = users.id');
        $builder->join('category', 'category.id = nominee_details.category_id');
        $builder->join('nominations','nominations.id = users.award_id');
        $builder->join('awards_creation_category','awards_creation_category.id=nominations.main_category_id');
        $builder->where("users.role",'2');
	//$builder->where("users.status",'Approved');

        if(!empty($filter['title']))
         $builder->like('nominations.title',$filter['title']);

        if(!empty($filter['status']))
         $builder->where('users.status',$filter['status']); 

        if(!empty($filter['email']))
         $builder->like('users.email',$filter['email']);
         
        if(!empty($filter['firstname']))
         $builder->like('users.firstname',$filter['firstname']);

        if(!empty($filter['year']))
          $builder->like('nominee_details.nomination_year',$filter['year']);

       if(!empty($filter['main_category_id']))
          $builder->like('category.main_category_id',$filter['main_category_id']); 
         
            $builder->orderBy('id', 'DESC');

	//  $builder->orderBy('registration_no', 'ASC');

        
        if((!empty($filter['limit']) || !empty($filter['start'])))
          $builder->limit($filter['limit'],$filter['start']);

        if(isset($filter['totalRows']) && ($filter['totalRows'] == 'yes'))
            return $builder->countAllResults();
        else 
            return $query = $builder->get();

    }
     
    public function getNominationsLists($filter = array())
    {
        $builder = $this->table('users');
        $builder->select('users.*,nominee_details.*,users.id as user_id,category.name as category_name');
        $builder->join('nominee_details', 'nominee_details.nominee_id = users.id AND users.role="2"');
        $builder->join('category','category.id=nominee_details.category_id');

        if(!empty($filter['year']))
            $builder->where("nominee_details.nomination_year",$filter['year']);	
		

        if(!empty($filter['main_category_id']))
            $builder->where("category.main_category_id",$filter['main_category_id']); 
	
	if(!empty($filter['submitted']))
            $builder->where("nominee_details.is_submitted",$filter['submitted']); 

	 if(!empty($filter['status']))
            $builder->where("users.status",$filter['status']);    
            
        return $query = $builder->get();
    }


    public function getNominationsListss($filter = array())
    {
        $builder = $this->table('users');
        $builder->select('users.*,nominee_details.*,users.id as user_id,category.name as category_name');
        $builder->join('nominee_details', 'nominee_details.nominee_id = users.id AND users.role="2"');
        $builder->join('category','category.id=nominee_details.category_id');


        if(!empty($filter['main_category_id']))
            $builder->where("category.main_category_id",$filter['main_category_id']); 
	

            $builder->where("nominee_details.is_submitted",$filter['submitted']); 
		
	    $builder->where("nominee_details.nomination_year",'2024');
	    $builder->where("users.status","Approved");   
            
        return $query = $builder->get();
     }



    public function getTotalApprovedNomineesCount($category="1")
    {
	$builder = $this->table('users');
        $builder->select('users.*');
        $builder->join('nominee_details','nominee_details.nominee_id = users.id AND users.role="2"');
	        $builder->join('category','category.id=nominee_details.category_id');
	$builder->where("nominee_details.is_submitted",1); 
	
	$builder->where("users.status",'Approved');
	//$builder->where("category.main_category_id",$category);
         $builder->where("nominee_details.nomination_year",'2024');
	return $query = $builder->get();
    }	

    public function getTotalRejectedNomineesCount($category="1")
    {
	$builder = $this->table('users');
        $builder->select('users.*');
        $builder->join('nominee_details','nominee_details.nominee_id = users.id AND users.role="2"');
	        $builder->join('category','category.id=nominee_details.category_id');
	$builder->where("nominee_details.is_submitted",0);
		
	$builder->where("users.status",'Approved');
		//$builder->where("category.main_category_id",$category);
	 $builder->where("nominee_details.nomination_year",'2024');
	return $query = $builder->get();
    }	

    public function getTotalApprovedNomineesListsCt()
    {
	$builder = $this->table('users');
        $builder->select('users.*');
        $builder->join('nominee_details','nominee_details.nominee_id = users.id AND users.role="2"');
	        
	//$builder->where("nominee_details.is_submitted",1); 
	
	$builder->where("users.status",'Approved');
	// $builder->where("users.active",1);
        $builder->where("nominee_details.nomination_year",'2024');
	return $query = $builder->countAllResults();
    }	

    public function getTotalRejectedNomineesListsCt()
    {
	$builder = $this->table('users');
        $builder->select('users.*');
        $builder->join('nominee_details','nominee_details.nominee_id = users.id AND users.role="2"');
	   
	//$builder->where("nominee_details.is_submitted",0);
		
	$builder->where("users.status",'Disapproved');
        $builder->where("users.is_rejected",1);
        $builder->where("users.active",0);
        $builder->where("nominee_details.nomination_year",'2024');
	return $query = $builder->countAllResults();
    }
    public function getTotalApprovalPendingListsCt()
    {
	$builder = $this->table('users');
        $builder->select('users.*');
        $builder->join('nominee_details','nominee_details.nominee_id = users.id AND users.role="2"');
	   
			
	$builder->where("users.status",'Disapproved');
        $builder->where("users.is_rejected",0);
        $builder->where("users.active",0);
        $builder->where("nominee_details.nomination_year",'2024');
	return $query = $builder->countAllResults();
    }	
}