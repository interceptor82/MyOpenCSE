<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class SettingsModel extends Model {

    protected $table              = 'users';
    protected $primaryKey         = 'id';
    protected $returnType         = 'object';
    protected $useSoftDeletes     = false;
    protected $allowedFields      = ['name_fr, reference'];
    protected $useTimestamps      = false;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $deletedField       = 'deleted_at';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function set_products_template_fields($data) {
        $builder = $this->db->table(DB_TEMPLATE_FIELDS);
        $builder->insertBatch($data);
    }

    function set_products_template($data) {
        $builder = $this->db->table(DB_PRODUCTS_TEMPLATE);
        $builder->insert($data);
        return $this->db->insertID();
    }

    function get_template_fields($template_id, $field_position = null) {
        $builder = $this->db->table(DB_TEMPLATE_FIELDS);
        $builder->where('template_id', $template_id);
        if (!is_null($field_position)) $builder->where('position', $field_position);
        $builder->orderBy('position');
        return $builder->get();
    }

    function get_products_template_fields_with_names($template_id, $template_type) {
        $builder = $this->db->table(DB_TEMPLATE_FIELDS . ' TF');
        $builder->join(DB_TEMPLATES_IMPORT_EXPORT_FIELDS . ' IEF', 'IEF.field_id = TF.field_id');
        $builder->where('TF.template_id', $template_id);
        $builder->where('IEF.template_type', $template_type);
        $builder->orderBy('TF.position');
        return $builder->get();
    }

    function get_template_import_export_fields($type, $return_table = false, $lang = null) {
        $builder = $this->db->table(DB_TEMPLATES_IMPORT_EXPORT_FIELDS);
        $builder->orderBy('field_id');
        $builder->where('template_type', $type);
        $query   = $builder->get();

        if ($return_table == true) {
            $fields_name = array();
            foreach ($query->getResult() as $row) {
                if (is_null($lang)) {
                    $field_lang = 'field_value';
                } else {
                    $field_lang = 'field_name_' . $lang;
                }

                $fields_name[$row->field_id] = $row->$field_lang;
            }
            return $fields_name;
        } else {
            return $query;
        }
    }

    function get_products_template_fields_by_id($id = null) {
        $builder = $this->db->table(DB_TEMPLATE_FIELDS);
        if (!is_null($id)) $builder->where('id', $id);
        return $builder->get();
    }

    function update_field_position($position, $id, $template_id) {
        $builder = $this->db->table(DB_TEMPLATE_FIELDS);
        $builder->set('position', $position);
        $builder->where('id', $id);

        $builder->update();

        $builder = $this->db->table(DB_TEMPLATE_FIELDS);
        $builder->set('position', 'position + 1', false);
        $builder->where('position >', $position);
        $builder->where('template_id', $template_id);

        $builder->update();

        return $this->db->affectedRows();
    }

    function delete_template_field($id, $sortable, $position) {
        $builder = $this->db->table(DB_TEMPLATE_FIELDS);
        $builder->where('id', $id);
        $builder->delete();

        $builder->set('sortable', 'sortable - 1', false);
        $builder->where('sortable >', $sortable);
        $builder->update();
    }

    function update_template_positions($position, $id) {
        $builder = $this->db->table(DB_TEMPLATE_FIELDS);

        $builder->set('position', $position);
        $builder->where('id', $id);
        $builder->update();
    }

    function delete_template_fields($template_id) {
        $builder = $this->db->table(DB_TEMPLATE_FIELDS);
        $builder->where('template_id', $template_id);
        $builder->delete();
    }

    function get_template_list($template_type, $company_id, $return_list = false) {
        $builder = $this->db->table(DB_PRODUCTS_TEMPLATE);
        $builder->distinct('template_id');
        $builder->select('id, template_type, template_name');
        $builder->where('template_type', $template_type);
        $builder->where('company_id', $company_id);
        $builder->orderBy('id', 'asc');
        $query   = $builder->get();

        if ($return_list == true) {
            $tab = array();
            foreach ($query->getResult() as $row) {
                $tab[$row->id] = $row->template_name;
            }
            return $tab;
        } else {
            return $query;
        }
    }

    function get_templates_list($type, $company_id, $lang) {
        $builder = $this->db->table(DB_PRODUCTS_TEMPLATE . ' PT');
        $builder->select('PT.id, template_type, template_name, default_template, name_' . $lang);
        $builder->join(DB_TEMPLATE_TYPE_LIST . ' TT', 'TT.id = PT.template_type');
        $builder->where('PT.template_type', $type);
        $builder->where('company_id', $company_id);
        $builder->orderBy('id', 'asc');
        return $builder->get();
    }

    function get_profiles_list($company_id, $lang) {
        $builder = $this->db->table(DB_PROFILES . ' P');
        $builder->select('P.id, count(U.profile_id) as profile_num, P.company_id, P.label_' . $lang);
        $builder->join(DB_USERS . ' U', 'P.id = U.profile_id', 'LEFT OUTER');
        $builder->where('(P.company_id = "' . $company_id . '" OR P.company_id = 0)');
        $builder->orderBy('P.label_' . $lang, 'asc');
        $builder->groupBy(['P.id']);
        return $builder->get();
    }

    function get_modules_list($lang) {
        $builder = $this->db->table(DB_MODULES . ' M');
        $builder->select('M.id, M.label_' . $lang);
        $builder->orderBy('M.label_' . $lang, 'asc');
        return $builder->get();
    }

    function get_profile_modules($profile_id, $module_id = null) {
        $builder = $this->db->table(DB_PROFILE_MODULES);
        $builder->where('profile_id', $profile_id);
        if (isset($module_id)) $builder->where('module_id', $module_id);
        return $builder->get();
    }

    function get_users_profiles($company_id, $profile_id) {
        $builder = $this->db->table(DB_USERS);
        $builder->where('profile_id', $profile_id);
        $builder->where('company_id', $company_id);
    }

    function get_template($template_name, $company_id, $template_type) {
        $builder = $this->db->table(DB_PRODUCTS_TEMPLATE);
        $builder->where('template_name', $template_name);
        $builder->where('company_id', $company_id);
        $builder->where('template_type', $template_type);
        return $builder->get();
    }

    function get_default_template($company_id, $template_type) {
        $builder = $this->db->table(DB_PRODUCTS_TEMPLATE);
        $builder->where('template_type', $template_type);
        $builder->where('company_id', $company_id);
        $builder->where('default_template', 1);
        return $builder->get();
    }

    function get_template_by_id($template_id) {
        $builder = $this->db->table(DB_PRODUCTS_TEMPLATE);
        $builder->where('id', $template_id);
        return $builder->get();
    }

    function delete_template($template_id, $company_id) {
        $builder = $this->db->table(DB_TEMPLATE_FIELDS);
        $builder->where('id', $template_id);
        $builder->delete();

        $builder = $this->db->table(DB_PRODUCTS_TEMPLATE);
        $builder->where('id', $template_id);
        $builder->where('company_id', $company_id);
        $builder->delete();
    }

    function update_template($data, $company_id, $template_id = null, $template_type = null) {
        $builder = $this->db->table(DB_PRODUCTS_TEMPLATE);
        if (!is_null($template_id)) $builder->where('id', $template_id);
        if (!is_null($template_type)) $builder->where('template_type', $template_type);
        $builder->where('company_id', $company_id);
        $builder->update($data);
    }

    function getDatatableWarehouses($start, $length, $order, $dir, $company_id, $filter = null, $columns_valid = null) {
        $builder = $this->db->table(DB_WAREHOUSES);
        $builder->where('company_id', $company_id);
        if ($filter != null) {
            foreach ($filter as $champ => $valeur) {
                $builder->like($champ, $valeur);
            }
        }
        if ($order != null) {
            $builder->orderBy($order, $dir);
        }
        $builder->limit($length, $start);
        return $builder->get();
    }

    function getTotalDatatableWarehouses($company_id, $filter = null) {
        $builder = $this->db->table(DB_WAREHOUSES);
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

    function getDatatableLocations($start, $length, $order, $dir, $company_id, $lang, $filter = null, $columns_valid = null) {
        $builder = $this->db->table(DB_WAREHOUSES . ' W');
        $builder->select('L.id, L.warehouse_id, L.address_type_id, L.address, L.note, A.name_' . $lang . ', W.name');
        $builder->join(DB_LOCATIONS . ' L', 'L.warehouse_id = W.id');
        $builder->join(DB_ADDRESS_TYPE . ' A', 'A.id = L.address_type_id');
        $builder->where('W.company_id', $company_id);
        if ($filter != null) {
            foreach ($filter as $champ => $valeur) {
                $builder->like($champ, $valeur);
            }
        }
        if ($order != null) {
            $builder->orderBy($order, $dir);
        }
        $builder->limit($length, $start);
        return $builder->get();
    }

    function getTotalDatatableLocations($company_id, $filter = null) {
        $builder = $this->db->table(DB_WAREHOUSES . ' W');
        $builder->join(DB_LOCATIONS . ' L', 'L.warehouse_id = W.id');
        $builder->join(DB_ADDRESS_TYPE . ' A', 'A.id = L.address_type_id');
        $builder->select("COUNT(*) as num");
        $builder->where('W.company_id', $company_id);
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

    function set_warehouse($data) {
        $builder = $this->db->table(DB_WAREHOUSES);
        $builder->insert($data);
    }

    function get_countries() {
        $builder = $this->db->table(DB_COUNTRIES);
        return $builder->get();
    }

    function get_country($country_id, $lang = 'en') {
        $builder = $this->db->table(DB_COUNTRIES);
        $builder->where('code', $country_id);
        $query   = $builder->get();
        $name    = 'name_' . $lang;
        if ($query->resultID->num_rows > 0) {
            return $query->getRow(0)->$name;
        } else {
            return $country_id;
        }
    }

    function delete_warehouse($id, $company_id) {
        $builder = $this->db->table(DB_WAREHOUSES);
        $builder->where('company_id', $company_id);
        $builder->where('id', $id);
        $builder->delete();
    }

    function delete_profile($id, $company_id) {
        $builder = $this->db->table(DB_PROFILES);
        $builder->where('company_id', $company_id);
        $builder->where('id', $id);
        $builder->delete();
    }

    function delete_tax($id, $company_id) {
        $builder = $this->db->table(DB_TAXES);
        $builder->where('company_id', $company_id);
        $builder->where('id', $id);
        $builder->delete();
    }

    function delete_location($id) {
        $builder = $this->db->table(DB_LOCATIONS);
        $builder->where('id', $id);
        $builder->delete();
    }

    function get_address_type_list($lang) {
        $builder = $this->db->table(DB_ADDRESS_TYPE);
        $query   = $builder->get();

        foreach ($query->getResult() as $row) {
            $name           = 'name_' . $lang;
            $list[$row->id] = $row->$name;
        }
        return $list;
    }

    function get_address_type($lang, $name) {
        $name_lang = 'name_' . $lang;
        $builder   = $this->db->table(DB_ADDRESS_TYPE);
        $builder->where($name_lang, $name);
        $query     = $builder->get();

        return $query;
    }

    function get_warehouse($company_id, $warehouse_name) {
        $builder = $this->db->table(DB_WAREHOUSES);
        $builder->where('company_id', $company_id);
        $builder->where('name', $warehouse_name);
        return $builder->get();
    }

    function get_warehouse_list($company_id) {
        $builder = $this->db->table(DB_WAREHOUSES);
        $builder->where('company_id', $company_id);
        $query   = $builder->get();

        $list[0] = lang('Settings.warehouse_select');
        foreach ($query->getResult() as $row) {
            $list[$row->id] = $row->name;
        }
        return $list;
    }

    function get_location_list($company_id) {
        $builder = $this->db->table(DB_WAREHOUSES . ' W');
        $builder->join(DB_LOCATIONS . ' L', 'L.warehouse_id = W.id');
        $builder->where('company_id', $company_id);
        $query   = $builder->get();

        $list[0] = lang('Settings.location_select');
        foreach ($query->getResult() as $row) {
            $list[$row->id] = $row->name;
        }
        return $list;
    }

    function set_location($data) {
        $builder = $this->db->table(DB_LOCATIONS);
        $builder->insert($data);
    }

    function set_profile($data) {
        $builder = $this->db->table(DB_PROFILES);
        $builder->insert($data);
    }

    function set_profile_module($data) {
        $builder = $this->db->table(DB_PROFILE_MODULES);
        $builder->insert($data);
    }

    function delete_module($profile_id) {
        $builder = $this->db->table(DB_PROFILE_MODULES);
        $builder->where('profile_id', $profile_id);
        $builder->delete();
    }

    function get_locations($company_id, $search_item = null, $language = 'en') {
        $lang = 'name_'.$language;
        $builder = $this->db->table(DB_WAREHOUSES . ' W');
        $builder->select('L.id, L.note, L.address, W.name, A.'.$lang.' as location_type');
        $builder->join(DB_LOCATIONS . ' L', 'L.warehouse_id = W.id');
        $builder->join(DB_ADDRESS_TYPE . ' A', 'L.address_type_id = A.id');
        $builder->where('company_id', $company_id);
        if (!is_null($search_item)) $builder->like('L.address', $search_item);
        return $builder->get();
    }

    function get_settings($name, $company_id) {
        $builder = $this->db->table(DB_SETTINGS);
        $builder->where('company_id', $company_id);
        $builder->where('name', $name);
        return $builder->get();
    }

    function update_settings($value, $company_id, $name) {
        $builder = $this->db->table(DB_SETTINGS);
        $builder->set('value', $value);
        $builder->where('name', $name);
        $builder->where('company_id', $company_id);
        $builder->update();
    }

    function set_settings($data) {
        $builder = $this->db->table(DB_SETTINGS);
        $builder->insertBatch($data);
    }

    function set_tax($data) {
        $builder = $this->db->table(DB_TAXES);
        $builder->insert($data);
    }

    function get_company($company_id) {
        $builder = $this->db->table(DB_COMPANY);
        $builder->where('id', $company_id);
        return $builder->get();
    }

    function update_company($company_id, $data) {
        $builder = $this->db->table(DB_COMPANY);
        $builder->where('id', $company_id);
        $builder->update($data);
    }

    function get_taxes($company_id, $keyword = null, $list = null) {
        $builder = $this->db->table(DB_TAXES);
        $builder->where('company_id', $company_id);
        if (!is_null($keyword)) $builder->like('name', $keyword);
        if (!is_null($keyword)) $builder->orLike('value', $keyword);
        $builder->orderBy('name');
        $query   = $builder->get();

        if (is_null($list)) {
            return $query;
        } else {
            $tab[0] = '-->';
            foreach ($query->getResult() as $row) {
                $tab[$row->id] = $row->value;
            }
            return $tab;
        }
    }

    function get_tax($company_id, $tax_name) {
        $builder = $this->db->table(DB_TAXES);
        $builder->where('company_id', $company_id);
        $builder->like('name', $tax_name);
        return $builder->get();
    }

    function get_tax_by_id($tax_id) {
        $builder = $this->db->table(DB_TAXES);
        $builder->where('id', $tax_id);
        return $builder->get();
    }

}
