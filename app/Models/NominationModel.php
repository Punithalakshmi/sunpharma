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
        'course_name',
        'first_employment_name_of_institution_location',
        'first_employment_designation',
        'first_employment_year_of_joining',
        'first_medical_degree_name_of_degree',
        'first_medical_degree_year_of_award',
        'first_medical_degree_institution',
        'highest_medical_degree_name',
        'highest_medical_degree_year',
        'highest_medical_degree_institution',
        'first_degree_marksheet',
        'highest_degree_marksheet',
        'fellowship_research_experience',
        'fellowship_research_publications',
        'fellowship_research_awards_and_recognitions',
        'fellowship_scientific_research_projects',
        'fellowship_name_of_institution_research_work',
        'fellowship_name_of_the_supervisor',
        'fellowship_name_of_institution',
        'fellowship_supervisor_department',
        'fellowship_description_of_research',
	'minimum_qualification',
	'is_carry_forwarded'
    ];


    public function getNominationData($id='')
    {
        return $this->getWhere(array('nominee_id' => $id)); 
    }


    public function getNominationFileData($id = "",$field='')
    {
        $builder = $this->table('nominee_details');
        $builder->select('*');
        $builder->where("nominee_id",$id);
        return $query = $builder->get();
    }

}