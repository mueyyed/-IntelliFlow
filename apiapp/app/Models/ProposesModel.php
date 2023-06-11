<?php namespace App\Models;

use CodeIgniter\Model;

class ProposesModel extends Model
{
    protected $table = 'proposes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'type', 'weight', 'length', 'age',
        'salary', 'frequencyType', 'heartRate', 'startDate', 'endDate', 'goal',
        'prize', 'userId',  'isDone','is_deleted'];
}
