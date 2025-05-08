<?php

namespace App\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth extends BaseController
{
    protected $users;
    protected $logactivity;

    public function __construct()
    {
        $this->users = new \App\Models\UsersModel();
        $this->logactivity = new \App\Models\LogActivityModel();
        helper('jwt_helper'); // Load helper JWT
    }

    public function refreshCsrfToken()
    {
        return $this->response->setJSON(['csrf_token' => csrf_hash()]);
    }
    public function login()
    {
        if (session()->get('userData')) {
            return redirect()->to(base_url('/dashboard'));
        }
        return view('Auth/login');
    }

    public function submitlogin()
    {
        if (session()->get('userData')) {
            return redirect()->to(base_url('/dashboard'));
        }

        $rules = [
            'NIP' => 'required',
            'password' => 'required'
        ];

        // Aturan validasi
        $rules = [
            'NIP' => [
                'label' => 'NIP',
                'rules' => 'required|alpha_numeric|max_length[20]',
                'errors' => [
                    'required' => 'NIP wajib diisi.',
                    'alpha_numeric' => 'NIP hanya boleh berisi huruf dan angka.',
                    'max_length' => 'NIP maksimal 20 karakter.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                    'max_length' => 'Password maksimal 100 karakter.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'NIP dan Password wajib diisi.');
            return redirect()->back()->withInput();
        }

        // Ambil dan bersihkan input
        $NIP = strip_tags($this->request->getVar('NIP'));
        $password = strip_tags($this->request->getVar('password'));

        $dataUser = $this->users->where('NIP', $NIP)->first();

        if (!$dataUser || !password_verify($password, $dataUser['password'])) {
            // Log login gagal
            $requestData = array_map(function ($v) {
                return is_string($v) ? strip_tags($v) : $v;
            }, $this->request->getPost());
            unset($requestData['password']);

            $this->logactivity->insert([
                'id_user'        => $dataUser['id'] ?? null,
                'role'           => $dataUser['role'] ?? null,
                'ip_address'     => $this->request->getIPAddress(),
                'user_agent'     => $this->request->getUserAgent()->getAgentString(),
                'activity'       => 'Login Gagal',
                'module'         => 'Auth',
                'method'         => __FUNCTION__,
                'url'            => $this->request->getUri()->getPath(),
                'request_data'   => json_encode($requestData),
                'response_status' => $this->response->getStatusCode()
            ]);

            session()->setFlashdata('error', 'NIP atau Password salah.');
            return redirect()->back()->withInput();
        }

        $userData = [
            'id'      => $dataUser['id'],
            'nama'    => $dataUser['nama'],
            'NIP'     => $dataUser['NIP'],
            'role'    => $dataUser['role'],
            'jabatan' => $dataUser['jabatan']
        ];

        $token = generateJWT($userData);

        session()->set('userData', $userData);
        session()->set('token', $token);

        $requestData = array_map(function ($v) {
            return is_string($v) ? strip_tags($v) : $v;
        }, $this->request->getPost());
        unset($requestData['password']);

        $this->logactivity->insert([
            'id_user'        => $dataUser['id'],
            'role'           => $dataUser['role'],
            'ip_address'     => $this->request->getIPAddress(),
            'user_agent'     => $this->request->getUserAgent()->getAgentString(),
            'activity'       => 'Login Berhasil',
            'module'         => 'Auth',
            'method'         => __FUNCTION__,
            'url'            => $this->request->getUri()->getPath(),
            'request_data'   => json_encode($requestData),
            'response_status' => $this->response->getStatusCode()
        ]);

        switch ($dataUser['role']) {
            case 1:
                return redirect()->to(base_url('dashboard'));
            case 2:
            case 3:
            case 4:
            case 5:
            case 9:
                return redirect()->to(base_url('product'));
                return redirect()->to(base_url('kategori'));
            case 8:
                return redirect()->to(base_url('surattugas'));
            case 11:
            case 12:
                return redirect()->to(base_url('transaksiacc'));
            default:
                return redirect()->to(base_url('/login'))->with('error', 'Role tidak dikenali.');
        }
    }

    public function logout()
    {
        $dataUser = session()->get('userData');

        // Cek apakah user sudah login
        if (!session()->get('userData')) {
            return redirect()->to(base_url('/login'));
        }

        // Log aktivitas logout
        $this->logactivity->insert([
            'id_user'        => $dataUser['id'],
            'role'           => $dataUser['role'],
            'ip_address'     => $this->request->getIPAddress(),
            'user_agent'     => $this->request->getUserAgent()->getAgentString(),
            'activity'       => 'Logout',
            'module'         => 'Auth',
            'method'         => __FUNCTION__,
            'url'            => $this->request->getUri()->getPath(),
            'request_data'   => json_encode([]),
            'response_status' => $this->response->getStatusCode()
        ]);

        // Hapus session termasuk token JWT
        session()->remove(['id', 'nama', 'NIP', 'role', 'jabatan', 'logged_in', 'token']);
        session()->destroy();

        // Redirect ke halaman login
        return redirect()->to(base_url('login'));
    }

    // Fungsi untuk generate JWT
    private function generateJWT($userData)
    {
        $key = "your_secret_key"; // Gantilah dengan secret key yang aman
        $payload = [
            'iss' => base_url(),
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24 * 90), // 3 bulan
            'data' => $userData
        ];

        return JWT::encode($payload, $key, 'HS256');
    }
}
