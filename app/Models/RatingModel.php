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
        'updated_id'
    ];

    public function getLists()
    {
        return $this->findAll();
    }

    public function getRatingData($jury_id='',$nominee_id='')
    {
        return $this->getWhere(array('jury_id' => $jury_id,'nominee_id' =>$nominee_id)); 
    }
}