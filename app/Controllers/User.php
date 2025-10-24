<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserProfile;

class User extends BaseController
{
    protected $UserProfile;

    public function __construct()
    {
        $this->UserProfile = new UserProfile();
    }

    public function index()
    {
        $data = [
            'judul' => 'Manajemen User',
            'menu'  => 'user',
            'page'  => 'admin/user',
            'user'  => $this->UserProfile->AllData(),
        ];
        return view('v_templete', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Input User',
            'menu'  => 'user',
            'page'  => 'admin/insert',
        ];
        return view('v_templete', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama User Wajib Diisi!'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'foto' => [
                'label' => 'Foto Profil',
                'rules' => 'permit_empty|is_image[foto]|max_size[foto,2048]',
                'errors' => [
                    'is_image' => '{field} harus berupa gambar.',
                    'max_size' => '{field} maksimal 2MB.'
                ]
            ],
        ])) {
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => sha1($this->request->getPost('password')), // Hash password
                'nama'     => $this->request->getPost('nama'),
                'role'     => $this->request->getPost('role'),
            ];

            $foto = $this->request->getFile('foto');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                $foto->move('uploads', $newName); // disimpan di public/uploads
                $data['foto'] = $newName;
            }

            $this->UserProfile->InsertData($data);
            session()->setFlashdata('insert', 'Data User Berhasil Ditambahkan!');
            return redirect()->to('User');
        } else {
            return redirect()->to(base_url('User/Input'))->withInput();
        }
    }

    public function Profil($id)
    {
        $data = [
            'judul' => 'Profil Setting',
            'menu'  => 'profil',
            'page'  => 'admin/v_userprofile',
            'user'  => $this->UserProfile->DetailData($id),
        ];
        return view('v_templete', $data);
    }

    public function UpdateData($id)
    {
        if ($this->validate([
            // 'username' => [
            //     'label' => 'Username',
            //     'rules' => 'required',
            //     'errors' => ['required' => '{field} Wajib Diisi!']
            // ],
            // 'role' => [
            //     'label' => 'Role',
            //     'rules' => 'required',
            //     'errors' => ['required' => '{field} Wajib Diisi!']
            // ],
            // 'password' => [
            //     'label' => 'Password',
            //     'rules' => 'permit_empty|min_length[6]',
            //     'errors' => [
            //         'min_length' => '{field} minimal 6 karakter.',
            //     ]
            // ],
            'foto' => [
                'label' => 'Foto Profil',
                'rules' => 'permit_empty|is_image[foto]|max_size[foto,2048]',
                'errors' => [
                    'is_image' => '{field} harus berupa gambar.',
                    'max_size' => '{field} maksimal 2MB.'
                ]
            ],
        ])) {
            $user = $this->UserProfile->DetailData($id);
            $password = $this->request->getPost('password');
            $hashed_password = !empty($password) ? sha1($password) : $user['password'];

            $data = [
                'id'       => $id,
                'username' => $this->request->getPost('username'),
                'nama'    => $this->request->getPost('nama'),
                'password' => $hashed_password,
                'role'     => $this->request->getPost('role'),
            ];

            $foto = $this->request->getFile('foto');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                $foto->move('uploads', $newName);
                $data['foto'] = $newName;
            }

            $this->UserProfile->UpdateData($data);
            session()->setFlashdata('update', 'Data User Berhasil Diupdate!');
            return redirect()->to('user/profil/' . $id);
        } else {
            return redirect()->to(base_url('user/profil/' . $id))->withInput();
        }
    }

    public function DeleteData($id)
    {
        $data = ['id' => $id];
        $this->UserProfile->DeleteData($data);
        session()->setFlashdata('delete', 'Data User Berhasil Dihapus!');
        return redirect()->to('User');
    }
}
