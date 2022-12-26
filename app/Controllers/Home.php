<?php

namespace App\Controllers;

use CodeIgniter\Shield\Entities\User;
use App\Models\UsersExt;

class Home extends BaseController
{

    public function __construct()
    {
        $this->session   = \Config\Services::session();
        $this->messages  = [];
        $this->users     = model('UserModel');
        $this->userModel = new UsersExt();
    }

    public function index()
    {

        $data = [
            'title'    => lang('welcome'),
            'messages' => null
        ];
        return view('headers_view', $data)
                . view('login_view')
                . view('footer_view');
    }

    public function home()
    {

        $this->complete_registration();
        $data     = [
            'title'    => lang('welcome'),
            'messages' => null,
        ];
        $dataHome = [
            'user'         => auth()->user(),
            'active'       => 'home',
            'navbar_title' => []
        ];
        return view('headers_view', $data)
                . view('home_view', $dataHome)
                . view('footer_view');
    }

    public function complete_registration()
    {
        $user = auth()->user();

        // Create company if not exists
        if ($this->userModel->find($user->id)->company_id == 0) {
            $dataCpny   = [
                'name' => lang('Users.my_company')
            ];
            $company_id = $this->userModel->set_company($dataCpny);

            $user->fill([
                'company_id' => $company_id,
            ]);
            $this->userModel->save($user);
        }
        return redirect()->to('/');
    }

}
