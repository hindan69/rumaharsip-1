<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class KotakPenyimpanan extends Controller
{
    protected $users;
    protected $logactivity;
    protected $kotakpenyimpanan;

    public function __construct()
    {
        $this->kotakpenyimpanan = new \App\Models\KotakPenyimpananModel();
        $this->users = new \App\Models\UsersModel();
        $this->logactivity = new \App\Models\LogActivityModel();
    }

    public function getNomorByTahun()
    {
        $tahun = $this->request->getGet('tahun');

        // Ambil nomor kotak terbesar
        $lastKotak = $this->kotakpenyimpanan->selectMax('no_kotak')->where('tahun', $tahun)->first();
        $nextNomorKotak = isset($lastKotak['no_kotak']) ? ((int)$lastKotak['no_kotak']) + 1 : 1;

        // Ambil nomor akhir terbesar
        $lastNomor = $this->kotakpenyimpanan->selectMax('no_akhir')->where('tahun', $tahun)->first();
        $nextNomorAkhir = isset($lastNomor['no_akhir']) ? ((int)$lastNomor['no_akhir']) + 1 : 1;

        return $this->response->setJSON([
            'next_nomor_kotak' => $nextNomorKotak,
            'next_nomor_akhir' => $nextNomorAkhir
        ]);
    }

    // public function getNomorKotakTerakhir()
    // {
    //     $tahun = $this->request->getGet('tahun');
    //     if (!$tahun) return $this->response->setJSON(['next_nomor_kotak' => 1]);

    //     $last = $this->kotakpenyimpanan
    //         ->where('tahun', $tahun)
    //         ->orderBy('no_kotak', 'DESC')
    //         ->first();

    //     $nextNomor = $last ? ((int)$last['no_kotak'] + 1) : 1;
    //     return $this->response->setJSON(['next_nomor_kotak' => $nextNomor]);
    // }

    // public function getNomorAkhirTerakhir()
    // {
    //     $tahun = $this->request->getGet('tahun');
    //     if (!$tahun) return $this->response->setJSON(['next_nomor_akhir' => 1]);

    //     $last = $this->kotakpenyimpanan
    //         ->where('tahun', $tahun)
    //         ->orderBy('no_akhir', 'DESC')
    //         ->first();

    //     $nextNomor = $last ? ((int)$last['no_akhir'] + 1) : 1;
    //     return $this->response->setJSON(['next_nomor_akhir' => $nextNomor]);
    // }

    public function simpanPesanNomor()
    {
        $dataUser = session()->get('userData');
        $id_user = session()->get('userData')['id'];

        $tahun = $this->request->getPost('tahun_box');
        $no_kotak = (int)$this->request->getPost('no_kotak');
        $no_awal = (int)$this->request->getPost('no_awal');
        $no_akhir = (int)$this->request->getPost('no_akhir');

        // Cek no_kotak tidak boleh duplikat di tahun yang sama
        $existsKotak = $this->kotakpenyimpanan->where('tahun', $tahun)
            ->where('no_kotak', $no_kotak)
            ->first();
        if ($existsKotak) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => "Nomor kotak $no_kotak sudah digunakan untuk tahun $tahun"
            ]);
        }

        // Cek no_awal - no_akhir tidak tumpang tindih di tahun yang sama
        $overlap = $this->kotakpenyimpanan->where('tahun', $tahun)
            ->groupStart()
            ->where("no_awal <=", $no_akhir)
            ->where("no_akhir >=", $no_awal)
            ->groupEnd()
            ->first();

        if ($overlap) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => "Range nomor urut $no_awal s.d $no_akhir bertabrakan dengan data yang sudah ada"
            ]);
        }

        $requestData = array_map(function ($v) {
            return is_string($v) ? strip_tags($v) : $v;
        }, $this->request->getPost());
        unset($requestData['created_at']);

        // Simpan nomor box pertama
        $this->kotakpenyimpanan->insert([
            'id_user'   => $id_user,
            'tahun'     => $tahun,
            'no_kotak'  => $no_kotak,
            'no_awal'   => $no_awal,
            'no_akhir'   => $no_akhir
        ]);

        $this->logactivity->insert([
            'id_user'        => $dataUser['id'],
            'role'           => $dataUser['role'],
            'ip_address'     => $this->request->getIPAddress(),
            'user_agent'     => $this->request->getUserAgent()->getAgentString(),
            'activity'       => 'Pesan Nomor Arsip Inaktif Berhasil',
            'module'         => 'KotakPenyimpanan',
            'method'         => __FUNCTION__,
            'url'            => $this->request->getUri()->getPath(),
            'request_data'   => json_encode($requestData),
            'response_status' => $this->response->getStatusCode()
        ]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Nomor berhasil dipesan']);
    }

    public function getNomorTersedia($no_kotak)
    {
        $data = $this->kotakpenyimpanan
            ->where('no_kotak', $no_kotak)
            ->select('no_urut, id_user')
            ->findAll();

        return $this->response->setJSON($data);
    }
}
