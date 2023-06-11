<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportsModel extends Model
{
    protected $table = 'reports';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title','proposeId','requestedByUser','date','status',
        'proposeType','weight','length','age','salary','frequencyType','heartRate',
        'proposeStartDate','proposeEndDate','goal','prize','proposeStatus'];
}
