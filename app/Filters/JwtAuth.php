<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

helper('jwt_helper'); // Pastikan helper JWT dimuat

class JwtAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $token = session()->get('token'); // Ambil token dari session

        if (!$token) {
            session()->setFlashdata('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
            return redirect()->to(base_url('')); // Redirect ke halaman login
        }

        $userData = validateJWT($token); // Validasi token

        if (!$userData) {
            session()->setFlashdata('error', 'Token tidak valid. Silakan login kembali.');
            session()->destroy(); // Hapus sesi agar benar-benar logout
            return redirect()->to(base_url('')); // Redirect ke halaman login
        }

        // Set user data kembali ke session
        session()->set($userData);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah response
    }
}
