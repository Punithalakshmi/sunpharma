<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class NominationModel extends Model{
    protected $table = 'nominee_details';
    
    protected $allowedFields = [
        'nominee_id',
        'category_id',
        'citizenship',
        'nomination_type',
        'ongoing_course',
        'is_completed_a_research_project',
        'designation',
        'residence_address',
        'nominator_photo',
        'nominator_name',
        'nominator_email',
        'nominator_phone',
        'nominator_designation',
        'nominator_address',
        'justification_letter_filename',
        'passport_filename',
        'created_id',
        'updated_id',
        'created_date',
        'updated_date'
    ];


    public function getNominationData($id='')
    {
        return $this->getWhere(array('nominee_id' => $id)); 
    }

}