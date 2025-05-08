<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\RESTful\ResourceController;

class Kategori extends BaseController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new \App\Models\KategoriModel();
    }

    public function index()
    {
        $data = [
            'kategori' => $this->kategori->getKategori(),
        ];
        return view('kategori', $data);
    }

    public function tambahkategori()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required|is_unique[kategori.id]',
            'kategori' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan data, pastikan semua field diisi dengan benar.'
            ]);
        }

        $data = [
            'id' => $this->request->getPost('id'),
            'kategori' => $this->request->getPost('kategori'),
        ];

        $this->kategori->insert($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data kategori berhasil ditambahkan.'
        ]);
    }
    public function hapusKategori()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            // Periksa apakah ID valid
            $kategori = $this->kategori->find($id);
            if (!$kategori) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Kategori tidak ditemukan.'
                ]);
            }

            // Hapus dari database
            $this->kategori->delete($id);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Kategori berhasil dihapus.'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Permintaan tidak valid.'
        ]);
    }
}
