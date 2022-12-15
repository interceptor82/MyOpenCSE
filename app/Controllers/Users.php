<?php

namespace App\Controllers;

helper('text');

use App\Models\UsersModel;
use App\Models\SettingsModel;
use App\Libraries\Csvreader;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use CodeIgniter\Encryption\Encryption;
use App\Models\UsersExt;

class Users extends BaseController {

    var $messages  = array();
    var $data      = array();
    var $file_name = null;

    public function __construct() {
        $validation          = \Config\Services::validation();
        $language            = \Config\Services::language();
        $this->session             = \Config\Services::session();
        if ($this->session->has('language')) $language->setLocale($this->session->get('language'));
        $this->UsersModel = new UsersExt();
        $this->users     = model('UserModel');
        $this->user = auth()->user();
        $this->SettingsModel = new SettingsModel();
        $this->encrypter = \Config\Services::encrypter();
        $this->uri = new \CodeIgniter\HTTP\URI();
    }

    public function index() {
        $uri = current_url(true);
        $data = [
            'title'=> lang('Users.title'),
            'navbar_title'      => array(lang('Home.list'), lang('Home.new'), lang('Home.import'), lang('Home.export')),
            'navbar_link'       => array(base_url() . '/public/users', base_url() . '/public/users/create', base_url() . '/public/users/import/13', base_url() . '/public/users/export'),
            'navbar_active'     => 0,
            
        ];
        $dataUsers = [
            'user' => $this->user,
            'datatable_headers' => [
                0 => lang('Users.first_name'), 1 => lang('Users.last_name'), 2 => lang('Users.mail'),
                3 => lang('Common.actions')
            ],
            'messages'          => $this->messages,
            'lang'              => $this->session->get('language'),
            'active'          => $uri->getSegment(1),
        ];
        return view('headers_view', $data)
                . view('users_view', $dataUsers)
                . view('footer_view');
    }

    public function create($user_id = null) {
        $uri = current_url(true);
        $user_fields = $this->UsersModel->get_users_fields();
        if (!is_null($user_id)) {
            $user_info = $this->users->find($user_id);
            foreach ($user_fields as $field) {
                $user[$field] = $user_info->$field;

                if ($user[$field] == null) $user[$field] = '';
            }
        } else {
            //set empty fields
            foreach ($user_fields as $field) {
                $user[$field] = '';
            }
            $user_id = null;
        }
        
        $data = [
            'title'=> lang('Users.title'),
            'navbar_title'      => array(lang('Home.list'), lang('Home.new'), lang('Home.import'), lang('Home.export')),
            'navbar_link'       => array(base_url() . '/public/users', base_url() . '/public/users/create', base_url() . '/public/users/import/13', base_url() . '/public/users/export'),
            'navbar_active'     => 0,
            
        ];
        
        return view('headers_view', $data)
                .view('users_new_view', [
            'navbar_title'    => array(lang('Common.list'), lang('Common.new'), lang('Common.import'), lang('Common.export')),
            'navbar_link'     => array(base_url() . '/public/users', base_url() . '/public/users/create', base_url() . '/public/users/import/' . $this->encrypter->encrypt(13), base_url() . '/public/users/export'),
            'navbar_active'   => 1,
            'navbar_actions'  => array(icon('hdd-fill', ' ' . lang('Common.save'), null, lang('Common.save'), 'success', 0, null, true, true)),
            'validation'      => $this->validator,
            'user'            => $this->user,
            'user_id'         => $user_id,
            'messages'        => $this->messages,
            'profile_options' => ['superadmin', 'admin', 'developer', 'user', 'beta'],
            'user_privileges' => $this->session->get('user_privilege'),
            'active'          => $uri->getSegment(BASE_URI),
            'lang'            => $this->session->get('language'),
        ])
                . view('footer_view');
    }

    public function import($file_type) {
        $uri = current_url(true);
        $file_type = decrypt_url($file_type);

        //preview file ?
        if (empty($this->data)) {
            $next_action_text = lang('Common.next');
            $next_action_icon = 'arrow-right-circle-fill';
        } else {
            $next_action_text = lang('Common.save_and_import');
            $next_action_icon = 'hdd-fill';
        }
        return view('users_import_view', [
            'navbar_title'    => array(lang('Common.list'), lang('Common.new'), lang('Common.import'), lang('Common.export')),
            'navbar_link'     => array(base_url() . '/public/users', base_url() . '/public/users/create', base_url() . '/public/users/import/' . encrypt_url($file_type), base_url() . '/public/users/export'),
            'navbar_active'   => 2,
            'navbar_actions'  => img_html($next_action_icon, ' ' . $next_action_text, null, $next_action_text, 'success', 0, null, true, true),
            'templates'       => $this->SettingsModel->get_template_list($file_type, $this->session->get('company_id'), true),
            'validation'      => $this->validator,
            'messages'        => $this->messages,
            'file_preview'    => $this->data,
            'file_name'       => $this->file_name,
            'type'            => $file_type,
            'user_privileges' => $this->session->get('user_privilege'),
            'active'          => $uri->getSegment(BASE_URI),
            'lang'            => $this->session->get('language'),
        ]);
    }

    public function add() {
        if (!$this->validate([
                    'first_name' => ['label' => lang('Users.first_name'), 'rules' => "max_length[100]"],
                    'last_name'  => ['label' => lang('Users.last_name'), 'rules' => "required|max_length[100]"],
                    'mail'       => ['label' => lang('Users.mail'), 'rules' => "required|valid_email|max_length[60]"],
                    'password'   => ['label' => lang('Users.password'), 'rules' => "permit_empty"],
                    'profile_id' => ['label' => lang('Users.profile'), 'rules' => "required"],
                ])) {
            return $this->create();
        } else {
            try {
                //activation key
                $key = bin2hex(Encryption::createKey(32));

                $user_id               = $this->request->getPost('user_id');
                $data_user             = [
                    'first_name'      => $this->request->getPost('first_name'),
                    'last_name'       => $this->request->getPost('last_name'),
                    'mail'            => $this->request->getPost('mail'),
                    'id'              => $this->request->getPost('user_id'),
                    'status_code'     => 30,
                    'profile_id'      => $this->request->getPost('profile_id'),
                    'company_id'      => $this->session->get('company_id'),
                    'activation_key'  => $key,
                    'activation_date' => date('Y-m-d H:i:s'),
                ];
                $data_user['password'] = password_hash(bin2hex(Encryption::createKey(16)), PASSWORD_ARGON2I); //useless but better than null
                if (empty($user_id)) {
                    //add user
                    $user_id = $this->UsersModel->set_user($data_user);

                    //send mail activation
                    $email = \Config\Services::email();

                    $email->setFrom('support@myminierp.com', 'MyMiniERP');
                    $email->setTo($this->request->getPost('mail'));
                    $email->setSubject(lang('Login.mail_activation_subject'));
                    $email->setMessage(lang('Login.mail_activation_message') . '<a href="' . base_url() . '/public/login/activate_user/' . $key . '">' . base_url() . '/public/login/activate_user/' . $key . '</a><br /><br />' . lang('Login.mail_activation_message2'));

                    $email->send();

                    $this->messages['success'] = lang('Users.activation_mail_sent');
                } else {
                    //update user
                    $this->UsersModel->update_user($data_user, $user_id, $this->session->get('company_id'));
                    $this->messages['success'] = lang('Common.saved_changes');
                }
            } catch (Exception $ex) {
                $this->messages['danger'] = lang('Users.user_creation_error') . $e->getMessage();
            }
            return $this->create($user_id);
        }
    }

    public function datatable_users() {
// Datatables Variables
        $requestData = $_REQUEST;
        $draw        = intval($requestData["draw"]);
        $start       = intval($requestData["start"]);
        $length      = intval($requestData['length']);
        $order       = $requestData["order"];

        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "asc";
        }

        for ($i = 0; $i <= 3; $i++) {
            $columns_valid[$i] = $requestData['columns'][$i]['name'];
        }

        $columns_valid2 = array(
            0 => 'first_name',
            1 => 'last_name',
            2 => 'secret',
            3 => 'actions'
        );

        if (!isset($columns_valid[$col])) {
            $order = null;
        } else {
            $order = $columns_valid[$col];
        }

        $filter = null;
        $tab    = array();
        foreach ($requestData['columns'] as $column_nb => $column_name) {
            $tab[$column_nb] = $requestData['columns'][$column_nb]['name'];
        }
        foreach ($columns_valid as $column_nb => $column_name) {
//            echo var_dump($_REQUEST);

            if ($column_nb < 3) {
                $num = array_search($column_name, $columns_valid);
                if (!empty($requestData['columns'][$num]['search']['value'])) {
                    $filter[$columns_valid2[$column_nb]] = $requestData['columns'][$num]['search']['value'];
                }
            }
        }
        $total_users = $this->UsersModel->getTotalDatatableUsers($this->users->find($this->user->id)->company_id, $filter);

        if ($length == -1) $length = $total_users;
        $users  = $this->UsersModel->getDatatableUsers($start, $length, $order, $dir, $this->users->find($this->user->id)->company_id);

        $data = array();
//data values
        $js   = 'onclick="return(confirm(\'' . lang('Users.really_delete') . '\'));"';
//        foreach ($users->getResult() as $key => $row) {
        foreach($users as $key => $row) {
//each column
            for ($i = 0; $i < 4; $i++) {
                if ($tab[$i] == 'actions') {
                    $row->{$tab[$i]} = '<div class="btn-group">' .
                            icon('hand-index', ' ' . lang('Common.actions'), null, null, 'info', 0, null, false, false, 'sm', null, 'bi bi', null, 'class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"') .
                            '<div class="dropdown-menu dropdown-menu-secondary">
                                ' . anchor(base_url() . "/users/edit/" . bin2hex($this->encrypter->encrypt($row->user_id)), icon('pencil', null, null, null, 'warning') . ' ' . lang('Common.edit'), 'class="dropdown-item"') . '
                                ' . anchor(base_url() . "/users/delete_user/" . bin2hex($this->encrypter->encrypt($row->user_id)), icon('trash', null, null, null, 'danger') . ' ' . lang("Common.delete"), 'class="dropdown-item"') . '
                                </div>
                            </div>';
                }
                $data[$key][$i] = $row->{$tab[$i]};
            }
        }

        $output = array(
            "draw"            => $draw,
            "recordsTotal"    => $total_users,
            "recordsFiltered" => $total_users,
            "data"            => $data
        );
        echo json_encode($output);
        exit();
    }

    public function import_file_preview() {
        require_once APPPATH . 'ThirdParty/spout-3.1.0/src/Spout/Autoloader/autoload.php';
        if ($this->request->getPost('proceed_import')) {
            return $this->import_file();
        } else {
            $file = $this->request->getFile('users_file');
            if (!$file->isValid()) {
                $this->messages['success'] = $file->getErrorString() . '(' . $file->getError() . ')';
            } else {
                //create company folder
                if (!is_dir(WRITEPATH . 'uploads/' . $this->session->get('company_id'))) {
                    mkdir(WRITEPATH . 'uploads/' . $this->session->get('company_id'));
                }
                //create TEMP folder
                if (!is_dir(WRITEPATH . 'uploads/' . $this->session->get('company_id') . '/TEMP')) {
                    mkdir(WRITEPATH . 'uploads/' . $this->session->get('company_id') . '/TEMP');
                }

                //create Orders folder
                if (!is_dir(WRITEPATH . 'uploads/' . $this->session->get('company_id') . '/users')) {
                    mkdir(WRITEPATH . 'uploads/' . $this->session->get('company_id') . '/users');
                }

                //file new name
                $newName  = 'users_' . $file->getRandomName();
                $file->move(WRITEPATH . 'uploads/' . $this->session->get('company_id') . '/TEMP', $newName);
                $filePath = WRITEPATH . 'uploads/' . $this->session->get('company_id') . '/TEMP/' . $newName;

                //get template infos
                $template        = $this->SettingsModel->get_template_by_id($this->request->getPost('template_name'));
                $template_fields = $this->SettingsModel->get_template_fields($this->request->getPost('template_name'));

                if (strtolower($file->getExtension()) == 'csv') {
                    $csvreader = new Csvreader();
                    $csvData   = $csvreader->parse_file($filePath, $template->getRow(0)->field_separator);
                } else { //slsx file
                    $reader = ReaderEntityFactory::createReaderFromFile($filePath);
                    $reader->open($filePath);
                    foreach ($reader->getSheetIterator() as $sheet) {
                        foreach ($sheet->getRowIterator() as $row) {
                            //create data
                            $csvData[] = $row->getCells();
                        }
                    }
                }

                $headers_line = false;

                //retrieve fields name
                $fields_name = $this->SettingsModel->get_template_import_export_fields($this->request->getPost('template_type'), true, $this->session->get('language'));

                //parse file
                foreach ($csvData as $key => $field) {
                    if (($template->getRow(0)->headers == 1 && $key > 0) || ($template->getRow(0)->headers == 0)) {
                        foreach ($template_fields->getResult() as $row) {
                            //headers
                            if ($headers_line == false) {
                                if (isset($field[$row->position - 1])) $this->data[$key - 1][$row->field_id] = $fields_name[$row->field_id];
                            }
                            if (isset($field[$row->position - 1])) $this->data[$key][$row->field_id] = $field[$row->position - 1];
                        }
                        $headers_line = true;
                    }
                    if ($key == 5) break;
                }
                $this->file_name = $file->getClientName();
                $this->session->set('new_import_filename', $newName);
            }
            return $this->import(encrypt_url(13));
        }
    }

    public function import_file() {
//move from TEMP to final
        $file = WRITEPATH . 'uploads/' . $this->session->get('company_id') . '/TEMP/' . $this->session->get('new_import_filename');
        rename($file, WRITEPATH . 'uploads/' . $this->session->get('company_id') . '/users/' . $this->session->get('new_import_filename'));

        $filePath = WRITEPATH . 'uploads/' . $this->session->get('company_id') . '/users/' . $this->session->get('new_import_filename');

//get templates infos
        $template               = $this->SettingsModel->get_template_by_id($this->request->getPost('template_name'));
        $template_fields        = $this->SettingsModel->get_products_template_fields_with_names($this->request->getPost('template_name'), $this->request->getPost('template_type'));
        $template_import_fields = $this->SettingsModel->get_template_import_export_fields($this->request->getPost('template_type'), true);
        $ext                    = pathinfo($file, PATHINFO_EXTENSION);
        if (strtolower($ext) == 'csv') {
            $csvreader = new Csvreader();
            $csvData   = $csvreader->parse_file($filePath, $template->getRow(0)->field_separator);
        } else { //xlsx file
            $reader = ReaderEntityFactory::createReaderFromFile($filePath);
            $reader->open($filePath);
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    //create data
                    $csvData[] = $row->getCells();
                }
            }
            $reader->close();
        }
        //parse file
        foreach ($csvData as $key => $field) {
            if (($template->getRow(0)->headers == 1 && $key > 0) || ($template->getRow(0)->headers == 0)) { //skip headers line
                foreach ($template_fields->getResult() as $row) {
                    //orders columns
                    if ($row->table_name == 'users') {
                        if (isset($field[$row->position - 1])) $dataUsers[$key][$template_import_fields[$row->field_id]] = $field[$row->position - 1];
                    }
                }

                //activation key
                $key                                = bin2hex(Encryption::createKey(32));
                //other fields
                $dataUsers[$key]['company_id']      = $this->session->get('company_id');
                $dataUsers[$key]['status_code']     = 30;
                $dataUsers[$key]['profile_id']      = 1;
                $dataUsers[$key]['password']        = password_hash(random_string('alnum', 10), PASSWORD_ARGON2I);
                $dataUsers[$key]['activation_key']  = $key;
                $dataUsers[$key]['activation_date'] = date('Y-m-d H:i:s');
                $mailingUsers[$key]                 = [$dataUsers[$key]['mail'], $dataUsers[$key]['password']];
            }
        }
        $this->db->transStart();
        //insert the users
        if (!empty($dataUsers)) {
            foreach ($dataUsers as $key => $data) {
                $this->UsersModel->set_user($data);

                //send mail activation
                $email = \Config\Services::email();

                $email->setFrom('webmaster@myminierp.com', 'MyMiniERP');
                $email->setTo($mailingUsers[$key][0]);
                $email->setSubject(lang('Users.account_created'));
                $email->setMessage(lang('Login.mail_activation_message') . base_url() . '/public/login/activate_user/' . $key . '<br /><br />' . lang('Login.mail_activation_message2') . $mailingUsers[$key][1] . lang('mail_activation_message3'));
                $email->send();
            }
        }

        $this->db->transComplete();

//delete file
        unlink($filePath);

        return $this->index();
    }

    public function export() {
        $users    = $this->UsersModel->get_users($this->session->get('company_id'));
        $template = $this->SettingsModel->get_default_template($this->session->get('company_id'), 12);
        if ($template->resultID->num_rows > 0) {
            $template_fields = $this->SettingsModel->get_products_template_fields_with_names($template->getRow(0)->id, 12);

            $headers = [];
            $fields  = [];
            foreach ($template_fields->getResult() as $row) {
                $field_name              = 'field_name_' . $this->session->get('language');
                $headers[$row->position] = $row->$field_name;
                $fields[$row->position]  = $row->field_value;
            }
            $filename = 'Users.' . $template->getRow(0)->file_format;

            return excel_export($this->response, $users, $headers, $fields, $filename, $this->session->get('language'));
        } else {
            $this->messages['danger'] = lang('Common.no_template');
            return $this->index();
        }
    }

    function edit($user_id) {
        $this->mode = 'edit';
        return $this->create($this->encrypter->decrypt(hex2bin($user_id)));
    }

    function delete_user($user_id) {
        $users = model('UserModel');
$users->delete($user_id, true);

        return redirect()->to('/users');
    }

}
