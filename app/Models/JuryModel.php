<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class JuryModel extends Model{
    protected $table = 'jury_nominee';
    
    protected $allowedFields = [
        'jury_id',
        'nominee_id',
        'created_date',
        'created_id',
        'updated_id',
        'updated_date'
    ];

    public function getListsOfNominees($id='')
    {
        $builder = $this->table('jury_nominee');
        $builder->select('jury_nominee.created_date,users.firstname,users.lastname,users.phone,users.email,users.address,users.id');
        $builder->join('users', 'users.id = jury_nominee.nominee_id AND users.role="2"');
        $builder->where("jury_nominee.jury_id",$id);
        return $query = $builder->get();
    }

    public function checkIfAlreadyNominee($juryId,$nomineeId)
    {
        $builder = $this->table('jury_nominee');
        $builder->select('id,jury_id,nominee_id');
         $builder->where("nominee_id",$nomineeId);
        return $query = $builder->get()->getRowArray();
    }

   
}