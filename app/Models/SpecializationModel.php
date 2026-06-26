<?php

namespace App\Models;

use CodeIgniter\Model;

class SpecializationModel extends Model
{
    protected $table = 'specializations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
