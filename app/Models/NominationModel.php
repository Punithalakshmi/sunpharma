<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class NominationModel extends Model{
    protected $table = 'nominee_details';
    
    protected $allowedFields = [
        'nominee_id',
        'category_id',
        'category',
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
        'complete_bio_data',
        'best_papers',
        'statement_of_research_achievements',
        'signed_details',
        'specific_publications',
        'signed_statement',
        'citation',
        'created_id',
        'updated_id',
        'created_date',
        'updated_date',
        'supervisor_certifying',
        'excellence_research_work',
        'lists_of_publications',
        'statement_of_applicant',
        'ethical_clearance',
        'statement_of_duly_signed_by_nominee',
        'aggregate_marks',
        'year_of_passing',
        'number_of_attempts',
        'age_proof',
        'declaration_candidate',
        'is_submitted',
        'registration_no',
        'nomination_year',
        'course_name'
    ];


    public function getNominationData($id='')
    {
        return $this->getWhere(array('nominee_id' => $id)); 
    }

}