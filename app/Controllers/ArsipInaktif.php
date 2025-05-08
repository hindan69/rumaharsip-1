<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ArsipInaktif extends Controller
{
    protected $users;
    protected $logactivity;
    protected $kotakpenyimpanan;
    protected $klasifikasi;
    protected $arsipinaktif;

    public function __construct()
    {
        $this->users = new \App\Models\UsersModel();
        $this->logactivity = new \App\Models\LogActivityModel();
        $this->kotakpenyimpanan = new \App\Models\KotakPenyimpananModel();
        $this->klasifikasi = new \App\Models\KlasifikasiModel();
        $this->arsipinaktif = new \App\Models\ArsipInaktifModel();
    }

    public function getBoxesByYear($tahun)
    {
        $boxes = $this->kotakpenyimpanan
            ->select('id, no_kotak')
            ->where('tahun', $tahun)
            ->findAll();

        return $this->response->setJSON($boxes);
    }

    public function getInfoBox($boxId)
    {
        $box = $this->kotakpenyimpanan->find($boxId);

        if (!$box) {
            return $this->response->setJSON(['error' => 'Kotak tidak ditemukan'], 404);
        }

        $noAwal = $box['no_awal'];
        $noAkhir = $box['no_akhir'];

        // Ambil nomor urut yang sudah digunakan
        $usedNumbers = $this->arsipinaktif
            ->select('no_urut')
            ->where('id_box', $boxId)
            ->findColumn('no_urut') ?? [];

        // Cari nomor urut terkecil yang belum digunakan
        $available = null;
        for ($i = $noAwal; $i <= $noAkhir; $i++) {
            if (!in_array($i, $usedNumbers)) {
                $available = $i;
                break;
            }
        }

        if ($available === null) {
            return $this->response->setJSON([
                'status' => 'full',
                'no_kotak' => $box['no_kotak']
            ]);
        }

        return $this->response->setJSON([
            'status' => 'available',
            'no_kotak' => $box['no_kotak'],
            'nomor_urut_berikut' => $available,
            'no_awal' => $noAwal,
            'no_akhir' => $noAkhir,
        ]);
    }

    public function getOptions($type)
    {
        $tables = [
            'klasifikasi' => 'klasifikasi',
            'kelompok_arsip' => 'kelompok_arsip',
            'jenis_arsip' => 'jenis_arsip',
            'jenis_naskah' => 'jenis_naskah',
            'tingkat_perkembangan' => 'tingkat_perkembangan',
            'jumlah_halaman' => 'jumlah_halaman',
            'sifat_arsip' => 'sifat_arsip',
            'unit_pengelola' => 'unit_pengelola',
        ];

        if (!array_key_exists($type, $tables)) {
            return $this->response->setJSON([]);
        }

        $db = \Config\Database::connect();
        $builder = $db->table($tables[$type]);
        $data = $builder->get()->getResultArray();

        return $this->response->setJSON($data);
    }

    public function simpan()
    {
        $dataUser = session()->get('userData');
        $id_user = session()->get('userData')['id'];

        $validation = \Config\Services::validation();

        // Validasi input
        $rules = [
            'inaktif_tahun' => 'required|numeric',
            'inaktif_id_box' => 'permit_empty|numeric',
            'inaktif_no_urut' => 'permit_empty|numeric',
            'inaktif_id_klasifikasi_surat' => 'required|numeric',
            'inaktif_id_kelompok_arsip' => 'required|numeric',
            'inaktif_indeks_berkas' => 'required|string',
            'inaktif_no_arsip' => 'required|string',
            'inaktif_tgl_arsip' => 'required|valid_date',
            'inaktif_uraian_arsip' => 'required|string',
            'inaktif_id_jenis_arsip' => 'required|numeric',
            'inaktif_id_jenis_naskah' => 'required|numeric',
            'inaktif_id_tingkat_perkembangan' => 'required|numeric',
            'inaktif_id_jumlah_halaman' => 'required|numeric',
            'inaktif_id_sifat_arsip' => 'required|numeric',
            'inaktif_id_unit_pengelola' => 'required|numeric',
            'inaktif_retensi_arsip' => 'required|string',
            'inaktif_keterangan' => 'permit_empty|string',
            'inaktif_ba_rc_itjen' => 'permit_empty|string',
            'inaktif_ba_rc_kemenkes' => 'permit_empty|string',
            'path_arsip' => 'uploaded[path_arsip]|max_size[path_arsip,25600]|ext_in[path_arsip,pdf]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => $validation->getErrors(),
                'csrf_token' => csrf_hash(),
            ]);
        }

        $tahun = $this->request->getPost('inaktif_tahun');
        $id_box = $this->request->getPost('inaktif_id_box');
        $no_urut = $this->request->getPost('inaktif_no_urut');
        $id_klasifikasi_surat = $this->request->getPost('inaktif_id_klasifikasi_surat');
        $id_kelompok_arsip = $this->request->getPost('inaktif_id_kelompok_arsip');
        $indeks_berkas = $this->request->getPost('inaktif_indeks_berkas');
        $no_arsip = $this->request->getPost('inaktif_no_arsip');
        $tgl_arsip = $this->request->getPost('inaktif_tgl_arsip');
        $uraian_arsip = $this->request->getPost('inaktif_uraian_arsip');
        $id_jenis_arsip = $this->request->getPost('inaktif_id_jenis_arsip');
        $id_jenis_naskah = $this->request->getPost('inaktif_id_jenis_naskah');
        $id_tingkat_perkembangan = $this->request->getPost('inaktif_id_tingkat_perkembangan');
        $id_jumlah_halaman = $this->request->getPost('inaktif_id_jumlah_halaman');
        $id_sifat_arsip = $this->request->getPost('inaktif_id_sifat_arsip');
        $id_unit_pengelola = $this->request->getPost('inaktif_id_unit_pengelola');
        $file = $this->request->getFile('path_arsip');
        $retensi_arsip = $this->request->getPost('inaktif_retensi_arsip');
        $keterangan = $this->request->getPost('inaktif_keterangan');
        $ba_rc_itjen = $this->request->getPost('inaktif_ba_rc_itjen');
        $ba_rc_kemenkes = $this->request->getPost('inaktif_ba_rc_kemenkes');

        // Format nama file
        $newFileName = "{$tahun}_" . date('Ymd', strtotime($tgl_arsip)) . "_{$no_arsip}";
        $newFileName .= '.' . $file->getClientExtension();

        // Simpan file
        if ($file->isValid() && !$file->hasMoved()) {
            $newFileName = "{$tahun}_" . date('Ymd', strtotime($tgl_arsip)) . "_{$no_arsip}";
            $newFileName .= '.' . $file->getClientExtension();

            // Optional: Sanitasi nama file
            $newFileName = preg_replace('/[^a-zA-Z0-9_\.\-]/', '_', $newFileName);

            if (!$file->move(WRITEPATH . 'uploads/daftararsip', $newFileName)) {
                return $this->response->setJSON([
                    'status' => false,
                    'errors' => ['path_arsip' => 'Gagal memindahkan file.'],
                    'csrf_token' => csrf_hash(),
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => false,
                'errors' => ['path_arsip' => 'File tidak valid atau sudah dipindahkan.'],
                'csrf_token' => csrf_hash(),
            ]);
        }

        $requestData = array_map(function ($v) {
            return is_string($v) ? strip_tags($v) : $v;
        }, $this->request->getPost());
        // unset($requestData['created_at']);

        // Simpan ke database (buat model sendiri untuk ini)
        $data = [
            'tahun' => $tahun,
            'id_box' => $id_box,
            'no_urut' => $no_urut,
            'id_klasifikasi_surat' => $id_klasifikasi_surat,
            'id_kelompok_arsip' => $id_kelompok_arsip,
            'indeks_berkas' => $indeks_berkas,
            'no_arsip' => $no_arsip,
            'tgl_arsip' => $tgl_arsip,
            'uraian_arsip' => $uraian_arsip,
            'id_jenis_arsip' => $id_jenis_arsip,
            'id_jenis_naskah' => $id_jenis_naskah,
            'id_tingkat_perkembangan' => $id_tingkat_perkembangan,
            'id_jumlah_halaman' => $id_jumlah_halaman,
            'id_sifat_arsip' => $id_sifat_arsip,
            'id_unit_pengelola' => $id_unit_pengelola,
            'path_arsip' => $newFileName,
            'retensi_arsip' => $retensi_arsip,
            'keterangan' => $keterangan,
            'ba_rc_itjen' => $ba_rc_itjen,
            'ba_rc_kemenkes' => $ba_rc_kemenkes,
            'created_by' => $id_user,
        ];

        $idArsipInaktif = $this->arsipinaktif->insert($data);

        if (!$idArsipInaktif) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan data arsip inaktif.',
                'csrf_token' => csrf_hash(),
            ]);
        }

        $this->logactivity->insert([
            'id_user'        => $dataUser['id'],
            'role'           => $dataUser['role'],
            'ip_address'     => $this->request->getIPAddress(),
            'user_agent'     => $this->request->getUserAgent()->getAgentString(),
            'activity'       => 'Tambah Template Surat Berhasil',
            'module'         => 'TemplateSurat',
            'method'         => __FUNCTION__,
            'url'            => $this->request->getUri()->getPath(),
            'request_data'   => json_encode($requestData),
            'response_status' => $this->response->getStatusCode()
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Data arsip berhasil disimpan.',
            'csrf_token' => csrf_hash(),
        ]);
    }

    public function getRecentAllArsip()
    {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('arsip_inaktif');
            $builder->select('*');
            $builder->orderBy('created_at', 'DESC');
            $builder->limit(10);
            $query = $builder->get();
            $data = $query->getResult();

            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            log_message('error', 'Recent load error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setBody('Internal Server Error');
        }
    }
}
