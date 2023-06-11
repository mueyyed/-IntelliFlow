<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportItemModel extends Model
{
    protected $table = 'report_item';
    protected $primaryKey = 'id';
    protected $allowedFields = ['reportId', 'date', 'title', 'new_weight', 'new_money', 'new_heart_rate', 'is_deleted'];
}
