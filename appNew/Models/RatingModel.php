<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class RatingModel extends Model{
    protected $table = 'ratings';
    
    protected $allowedFields = [
        'rating',
        'comments',
        'jury_id',
        'nominee_id',
        'created_date',
        'updated_date',
        'created_id',
        'updated_id',
        'is_rate_submitted'
    ];

    public function getLists($id='')
    {
       if(empty($id))
          return $this->findAll();
       else 
          return $this->getWhere(array('id' => $id)); 
    }

    public function getRatingData($jury_id='',$nominee_id='')
    {
        $builder = $this->table('ratings');
        $builder->select('*');
        $builder->where("ratings.nominee_id",$nominee_id);
        $builder->where("ratings.jury_id",$jury_id);
        $builder->orderBy("ratings.id",'DESC');
        return $query = $builder->get();
    }

    public function getRatingByJury($nominee_id = '',$jury_id = '',$is_rate_submitted = '')
    {
        $builder = $this->table('ratings');
        $builder->select('ratings.*,users.firstname,users.lastname');
        $builder->join('users','users.id = ratings.jury_id AND users.role=1');
        $builder->where("ratings.nominee_id",$nominee_id);
        if(!empty($jury_id)) {
            $builder->where("ratings.jury_id",$jury_id);
        }
        if($is_rate_submitted == 'yes')
         $builder->where("ratings.is_rate_submitted",1);

        $builder->orderBy('id','DESC');
        return $query = $builder->get();
    }

    public function getNomineeAverageRating($nominee_id,$userID,$role)
    {
        $builder = $this->table('ratings');
        if($role==1)
           $builder->select('rating as avg_rating');
        else
           $builder->select('SUM(rating) as avg_rating');

        $builder->where("ratings.nominee_id",$nominee_id);
        $builder->where('ratings.is_rate_submitted',1);
        if($role==1)
           $builder->where('ratings.jury_id',$userID);
           
        return $query = $builder->get();
    }
}