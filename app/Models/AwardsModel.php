<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class AwardsModel extends Model{
    protected $table = 'category';
    
    protected $allowedFields = [
        'rating',
        'nominee_id',
        'created_date',
        'created_id',
        'updated_id',
        'updated_date',
        'jury_id',
        'comments',
        'name'
    ];

    public function getLists($category='',$main_category_id='')
    {
        
        $builder = $this->table('category');
        $builder->select('SUM(ratings.rating) as average_rating,category.name as category_name,category.main_category_id,users.firstname,users.dob,users.id,GROUP_CONCAT(ratings.jury_id SEPARATOR ", ") as jury,ratings.nominee_id,users.category,nominee_details.registration_no');
        $builder->join('nominee_details', 'nominee_details.category_id = category.id');
        $builder->join('users', 'users.id = nominee_details.nominee_id AND users.role="2" AND users.status="Approved"');
        $builder->join('ratings', 'ratings.nominee_id = users.id');

        if(!empty($category))
          $builder->where("nominee_details.category_id",$category);

        if(!empty($main_category_id))
          $builder->where("category.main_category_id",$main_category_id);

        $builder->where("ratings.is_rate_submitted","1");
        $builder->orderBy("average_rating","DESC");
        $builder->groupBy("ratings.nominee_id");
        return $query = $builder->get();
    }

    
    public function getLatestWinnersofScienceScholarAwards()
    {

        $builder = $this->table('category');
        $builder->select('SUM(ratings.rating) as average_rating,users.firstname,users.dob,users.id,GROUP_CONCAT(ratings.jury_id SEPARATOR ", ") as jury,users.address,ratings.nominee_id,users.category');
        $builder->join('nominee_details', 'nominee_details.category_id = category.id');
        $builder->join('users', 'users.id = nominee_details.nominee_id AND users.role="2" AND users.status="Approved"');
        $builder->join('ratings', 'ratings.nominee_id = users.id');
       
        $builder->whereIn("nominee_details.category_id",array("4","5"));
           
        $builder->where("ratings.is_rate_submitted","1");
        $builder->orderBy("average_rating","DESC");
        $builder->groupBy("ratings.nominee_id");
        $builder->limit(5);
        return $query = $builder->get();

    }
    
    public function getLatestWinnersofResearchAwards()
    {
        $builder = $this->table('category');
        $builder->select('SUM(ratings.rating) as average_rating,users.firstname,users.dob,users.id,GROUP_CONCAT(ratings.jury_id SEPARATOR ", ") as jury,users.address,ratings.nominee_id,users.category');
        $builder->join('nominee_details', 'nominee_details.category_id = category.id');
        $builder->join('users', 'users.id = nominee_details.nominee_id AND users.role="2" AND users.status="Approved"');
        $builder->join('ratings', 'ratings.nominee_id = users.id');
        $builder->whereIn("nominee_details.category_id",array("1","2","3"));
        $builder->where("ratings.is_rate_submitted","1");
        $builder->orderBy("average_rating","DESC");
        $builder->groupBy("ratings.nominee_id");
        $builder->limit(5);
        return $query = $builder->get();
    }

    
   
}