<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Sites extends Model
{

    protected $table            = DB_SITES;
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'name', 'address', 'address2', 'address3', 'zipcode', 'city', 'country'
    ];

    function get_sites(int $company_id): array
    {
        return $this->where('company_id', $company_id)->findAll();
    }

}
