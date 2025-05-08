<?php

namespace App\Controllers;


class Product extends BaseController
{
    protected $kategori;
    protected $product;
    protected $logproduct;
    protected $activity;

    public function __construct()
    {
        $this->kategori = new \App\Models\KategoriModel();
        $this->product = new \App\Models\ProdukModel();
        $this->logproduct = new \App\Models\LogProdukModel();
        $this->activity = new \App\Models\LogActivityModel();
    }

    public function index()
    {
        $data = [
            'kategori' => $this->kategori->getKategori(),
            'produk' => $this->product->getProduct(),
        ];
        return view('product', $data);
    }
    public function viewproduk()
    {
        $data = [
            'kategori' => $this->kategori->getKategori(),
            'produk' => $this->product->getProduct(),
        ];
        return view('viewproduk', $data);
    }

    public function tambahproduct()
    {

        $id_kategori = $this->request->getPost('kategori_id');
        $id_produk = $this->request->getPost('id');
        $nama_produk = $this->request->getPost('nama_produk');
        $jumlah = $this->request->getPost('jumlah');

        $data = [
            'kategori_id' => $id_kategori,
            'id' => $id_produk,
            'nama_produk' => $nama_produk,
            'jumlah' => $jumlah,
            'created_date' => date('Y-m-d H:i:s')
        ];
        $this->product->insert($data);

        $logproduk = [
            'id_produk' => $id_produk,
            'kategori_id' => $id_kategori,
            'nama_produk' => $nama_produk,
            'jumlah' => $jumlah,
        ];

        $this->logproduct->insert($logproduk);
        // dd($data, $logproduk);

        $this->activity->insert([
            'id_user' => session()->get('id'),
            'action' => 'Tambah Produk',
            'keterangan' => "$id_produk ; $nama_produk ; sebanyak ; $jumlah",
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString()
        ]);

        return redirect()->back()->with('success', 'Data produk berhasil ditambahkan.');
    }
    public function tambahjumlah()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required|numeric',
            'jumlah_baru' => 'required|numeric|min_length[1]'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->with('error', 'Gagal memperbarui stok, pastikan data valid.');
        }

        $id_produk = $this->request->getPost('id');
        $nama_produk = $this->request->getPost('nama_produk');
        $jumlah_baru = $this->request->getPost('jumlah_baru');
        $jumlah_lama = $this->request->getPost('jumlah_lama');

        // Ambil produk berdasarkan ID
        $produk = $this->product->find($id_produk);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Hitung stok baru
        $stok_baru = $produk['jumlah'] + $jumlah_baru;
        $kategori_id = $produk['kategori_id'];
        // Update stok di database
        $this->product->update($id_produk, ['jumlah' => $stok_baru]);

        $logproduk = [
            'id_produk' => $id_produk,
            'kategori_id' => $kategori_id,
            'nama_produk' => $nama_produk,
            'jumlah' => $jumlah_baru,
        ];

        $this->logproduct->insert($logproduk);

        // Catat log aktivitas
        $this->activity->insert([
            'id_user' => session()->get('id'),
            'action' => 'Update Stok',
            'keterangan' => "$jumlah_baru ; {$produk['nama_produk']} ; $jumlah_lama ; (Total: $stok_baru)",
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString()
        ]);

        return redirect()->back()->with('success', 'Stok berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->product->delete($id);

        $this->activity->insert([
            'id_user' => session()->get('id'),
            'action' => 'Delete Product',
            'keterangan' => "Menghapus Product dengan id $id",
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString()
        ]);

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
}
