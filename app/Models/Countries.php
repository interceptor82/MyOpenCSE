<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Countries extends Model
{

    protected $table            = DB_COUNTRIES;
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
    ];

    function get_countries()
    {
        return $this->orderBy('name_fr', 'ASC')->findAll();
    }

}
