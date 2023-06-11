<?php

namespace App\Models;

use CodeIgniter\Model;

class FrequencyDataModel extends Model
{
    protected $table = 'frequency___data';
    protected $primaryKey = 'id';
    protected $allowedFields = ['proposeId', 'date', 'title', 'new_weight', 'new_money', 'new_heart_rate', 'is_deleted'];
}
