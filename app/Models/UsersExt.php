<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Model;

class UsersExt extends UserModel
{

    protected $returnType    = \CodeIgniter\Shield\Entities\User::class;
    protected $allowedFields = [
        'company_id'
    ];

    function getDatatableUsers($start, $length, $order, $dir, $company_id, $filter = null)
    {
        $this->join(DB_AUTH_IDENTITIES.' AI', 'AI.user_id = '.DB_USERS.'.id');
        $this->where('company_id', $company_id);
        if ($filter != null) {
            foreach ($filter as $champ => $valeur) {
                $this->like($champ, $valeur);
            }
        }
        if ($order != null) {
            $this->orderBy($order, $dir);
        }
        return $this->findAll($length, $start);
    }

    function getTotalDatatableUsers($company_id, $filter = null)
    {
        $builder = $this->db->table(DB_USERS);
        $builder->select("COUNT(*) as num");
        $builder->where('company_id', $company_id);
        if ($filter != null) {
            foreach ($filter as $field => $value) {
                $builder->like($field, $value);
            }
        }
        $query  = $builder->get();
        $result = $query->getRow();
        if (isset($result)) return $result->num;
        return 0;
    }

    function set_user($data)
    {
        $builder = $this->db->table(DB_USERS);

        $builder->insert($data);
        return $this->db->insertID();
    }

    function delete_user_modules($id)
    {
        $builder = $this->db->table(DB_USERS_MODULES);
        $builder->where('user_id', $id);
        $builder->delete();
    }

    function update_order_products($data, $product_id, $order_id)
    {
        $builder = $this->db->table(DB_ORDERS_PRODUCTS);
        $builder->where('order_id', $order_id);
        $builder->where('product_id', $product_id);
        $builder->update($data);
    }

//    function update_user($data, $user_id) {
//        $builder = $this->db->table(DB_USERS);
//        $builder->where('id', $user_id);
//        $builder->update($data);
//        return $this->db->affectedRows();
//    }

    function delete_order($id)
    {
        $builder = $this->db->table(DB_ORDERS);
        $builder->where('id', $id);
        $builder->delete();
    }

    function get_users_fields()
    {
        return $this->db->getFieldNames(DB_USERS);
    }

//    function get_user_by_id($id){
//        $builder = $this->db->table(DB_USERS.' U');
//        $builder->where('id', $id);
//        return $builder->get();
//    }
//    function get_users($company_id, $profile_id=null){
//        $builder = $this->db->table(DB_USERS.' U');
//        $builder->select('U.id, U.first_name, U.last_name, U.mail, US.label_en, US.label_fr, P.label_en, P.label_fr, US.label_en, US.label_fr');
//        $builder->join(DB_PROFILES.' P', 'P.id = U.profile_id');
//        $builder->join(DB_USERS_STATUS.' US', 'US.code = U.status_code');
//        $builder->where('U.company_id', $company_id);
//        if(!is_null($profile_id)) $builder->where('U.profile_id', $profile_id);
//        return $builder->get();
//    }
//    
//    function get_user2($user_id, $company_id){
//        $builder = $this->db->table(DB_USERS . ' U');
//        $builder->join(DB_USERS_STATUS . ' US', 'US.id = U.status_code', 'LEFT OUTER');
//        $builder->where('U.company_id', $company_id);
//        $builder->where('U.id', $user_id);
//        return $builder->get();
//    }

    function get_user3($reset_key, $mail = null)
    {
        $builder = $this->db->table(DB_USERS);
        $builder->where('reset_pwd_key', $reset_key);
        if (!is_null($mail)) $builder->where('mail', $mail);
        return $builder->get();
    }

    function get_user_status_list($lang)
    {
        $builder = $this->db->table(DB_USERS_STATUS);
        $query   = $builder->get();

        //language
        $label = 'label_' . $lang;
        foreach ($query->getResult() as $row) {
            $tab[$row->code] = $row->$label;
        }
        return $tab;
    }
    

    function set_company($data)
    {
        $builder = $this->db->table(DB_COMPANY);

        $builder->insert($data);
        return $this->db->insertID();
    }

    //retrieve activation link to activate user account
    function get_activation_link($activation_key)
    {
        $builder = $this->db->table(DB_USERS . ' U');
        $builder->select('*', false);
        $builder->select('U.id as user_id', false);
        $builder->where('U.activation_key', $activation_key);
        $builder->where('TIMESTAMPDIFF(HOUR, "' . date('Y-m-d H:i:s') . '", U.activation_date) <', 24, false);
        $builder->where('U.status_code', 30);
        return $builder->get();
    }

}
