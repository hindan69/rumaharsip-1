<?php

namespace App\Controllers;


class Transaksi extends BaseController
{
    protected $kategori;
    protected $product;
    protected $transaksi;
    protected $activity;
    protected $notifikasi;

    public function __construct()
    {
        $this->kategori = new \App\Models\KategoriModel();
        $this->product = new \App\Models\ProdukModel();
        $this->transaksi = new \App\Models\TransaksiModel();
        $this->activity = new \App\Models\LogActivityModel();
        $this->notifikasi = new \App\Models\NotifikasiModel();
    }

    public function index()
    {
        if (!$userData = session()->get('userData')) {
            return redirect()->to('/login')->with('error', 'Session telah habis, silakan login kembali.');
        }

        $id_user = $userData['id'];
        // dd($id_user);
        $data = [
            'produk' => $this->product->getProduct(),
            'id_user' => $userData['id'],
            'role' => $userData['role'],
            'transaksibyid' => $this->transaksi->getTransaksibyid($id_user),
            'notifikasibyid' => $this->notifikasi->getNotifikasiById($id_user),
        ];

        return view('transaksi', $data);
    }
    public function transaksiacc()
    {
        if (!$userData = session()->get('userData')) {
            return redirect()->to('/login')->with('error', 'Session telah habis, silakan login kembali.');
        }

        // $id_user = $userData['id'];
        // dd($id_user);
        $data = [
            'produk' => $this->product->getProduct(),
            'id_user' => $userData['id'],
            'role' => $userData['role'],
            'transaksi' => $this->transaksi->getTransaksi(),
        ];

        return view('transaksiacc', $data);
    }

    public function submitpermintaan()
    {
        $userData = session()->get('userData');
        $id_user = $userData['id'];

        $product_id = $this->request->getPost('product_id');
        $jumlah = $this->request->getPost('jumlah');

        if (!$product_id || !$jumlah || $jumlah <= 0) {
            return redirect()->back()->with('error', 'Harap isi semua data dengan benar.');
        }

        $produkModel = new \App\Models\ProdukModel();
        $produk = $produkModel->find($product_id);

        if (!$produk || $produk['jumlah'] < $jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        $this->transaksi->insert([
            'id_user' => $id_user,
            'id_product' => $product_id,
            'jumlah' => $jumlah,
            'status' => 0,
            'created_date' => date('Y-m-d H:i:s'),
            'is_deleted' => 0,
            // 'keterangan' => 'Permintaan baru'
        ]);
        // dd($product_id);
        return redirect()->back()->with('success', 'Permintaan berhasil diajukan.');
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

        // Catat ke log aktivitas
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
        $jumlah_baru = $this->request->getPost('jumlah_baru');
        $jumlah_lama = $this->request->getPost('jumlah_lama');

        // Ambil produk berdasarkan ID
        $produk = $this->product->find($id_produk);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $stok_baru = $produk['jumlah'] + $jumlah_baru;

        // Update stok di database
        $this->product->update($id_produk, ['jumlah' => $stok_baru]);



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

    public function submitacc()
    {

        $userData = session()->get('userData');

        $id = $this->request->getPost('id_transaksi');
        $id_user = $this->request->getPost('id_user');
        $username = $userData['NIP'];

        $updateData = [];

        if ($username === 'p_bmn_1' || $username === 'p_bmn_2') {
            $updateData = ['status' => 1];
        } elseif ($username === 'v_bmn') {
            $updateData = ['status' => 2];
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $update = $this->transaksi->where('id', $id)->set($updateData)->update();

        // dd($update, $username);
        $activityData = [
            'id_user' => session()->get('id'),
            'action' => 'Acc Permintaan',
            'keterangan' => "$username Menyetujui Permintaan dengan id ; $id ;",
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString()
        ];

        $this->activity->insert($activityData);


        $notifikasiData = [
            'id_user' => $id_user,
            'id_transaksi' => $id,
            'status' => 1,
        ];

        $this->notifikasi->insert($notifikasiData);

        if ($update) {
            return redirect()->back()->with('success', 'Dokumen berhasil disetujui!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui dokumen.');
        }
    }
    public function submitacc2()
    {

        $userData = session()->get('userData');

        $id = $this->request->getPost('id_transaksi');
        $id_product = $this->request->getPost('id_product');
        $jumlah_stock = $this->request->getPost('jumlah_stock');
        $jumlah = (int) $this->request->getPost('jumlah');
        $jumlah_baru = ($jumlah_stock - $jumlah);
        $username = $userData['NIP'];
        $updateData = [];
        if ($username === 'p_bmn_1' || $username === 'p_bmn_2') {
            $updateData = ['status' => 1];
        } elseif ($username === 'v_bmn') {
            $updateData = ['status' => 2];
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $updateTransaksi = $this->transaksi->where('id', $id)->set($updateData)->update();
        $updateProduct = $this->product->where('id', $id_product)->set(['jumlah' => $jumlah_baru])->update();

        // dd($updateTransaksi, $updateProduct);
        $activityData = [
            'id_user' => session()->get('id'),
            'action' => 'Verif Permintaan',
            'keterangan' => "$username Menyetujui Permintaan dengan id ; $id ;",
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString()
        ];

        $this->activity->insert($activityData);

        if ($updateTransaksi && $updateProduct) {
            return redirect()->back()->with('success', 'Permintaan berhasil disetujui!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui pwemintaan.');
        }
    }

    public function rejectTransaksi()
    {
        if ($this->request->getMethod() === 'post') {
            $id_transaksi = $this->request->getPost('id_transaksi');
            $keterangan = $this->request->getPost('keterangan');

            $update = $this->transaksi->update($id_transaksi, [
                'status' => 3, // Status Ditolak
                'keterangan' => $keterangan
            ]);

            if ($update) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false]);
            }
        }
    }
}
