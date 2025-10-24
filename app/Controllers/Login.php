<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;

class Login extends BaseController
{
    protected $LoginModel;

    public function __construct()
    {
        $this->LoginModel = new LoginModel();
    }

    public function login()
    {
        $data = [
            'judul' => 'Login'
        ];
        return view('v_login', $data);
    }

    public function cekLogin()
    {
        if ($this->validate([
            'username' => 'required',
            'password' => 'required',
        ])) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->LoginModel->login($username);

            if ($user !== null && isset($user['password']) && password_verify($password, $user['password'])) {
                session()->set([
                    'log' => true,
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                ]);
                return redirect()->to(base_url('dashboard'));
            } else {
                session()->setFlashdata('pesan', 'Username atau Password salah.');
                return redirect()->to(base_url('login'))->withInput();
            }
        } else {
            return redirect()->to(base_url('login'))->withInput();
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
