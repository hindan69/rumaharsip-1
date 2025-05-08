<?php

namespace App\Controllers;

class TemplateSurat extends BaseController
{
    protected $logactivity;
    protected $templatesurat;
    protected $subkategori;

    public function __construct()
    {
        $this->logactivity = new \App\Models\LogActivityModel();
        $this->templatesurat = new \App\Models\TemplateSuratModel();
        $this->subkategori = new \App\Models\SubKategoriModel();
    }

    public function templateSurat()
    {
        $data = [
            'jenis_naskah' => $this->templatesurat->getTemplateSurat(),
        ];

        // dd($data);
        return view('LayananArsip/templatesurat', $data);
    }

    public function getTemplateBySubKategori()
    {
        if ($this->request->isAJAX()) {
            $id_sub_kategori = $this->request->getGet('id_sub_kategori');
            $data = $this->templatesurat
                ->where('id_sub_kategori', $id_sub_kategori)
                ->first();

            return $this->response->setJSON($data ?? []);
        }
    }

    public function simpanData()
    {
        $dataUser = session()->get('userData');
        $id_user = session()->get('userData')['id'];

        if ($this->request->isAJAX()) {
            $file = $this->request->getFile('path_file');
            $id_kategori = $this->request->getPost('id_kategori');
            $id_sub_kategori = $this->request->getPost('id_sub_kategori');
            $nama_template = $this->request->getPost('nama_template');
            $ukuran_file = $this->request->getPost('ukuran_file');

            $requestData = array_map(function ($v) {
                return is_string($v) ? strip_tags($v) : $v;
            }, $this->request->getPost());
            unset($requestData['created_at'], $requestData['created_by'], $requestData['modified_at'], $requestData['modified_by']);

            $existing = $this->templatesurat
                ->where('id_sub_kategori', $id_sub_kategori)
                ->first();

            $data = [
                'id_kategori'     => $id_kategori,
                'id_sub_kategori' => $id_sub_kategori,
                'nama_template'   => $nama_template,
                'ukuran_file'     => $ukuran_file,
                'modified_at'     => date('Y-m-d H:i:s'),
                'modified_by'     => $id_user,
            ];

            if ($file && $file->isValid()) {
                $ext = $file->getClientExtension();
                if (!in_array($ext, ['doc', 'docx'])) {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Hanya file .doc dan .docx yang diizinkan.',
                        'csrf_token' => csrf_hash()
                    ]);
                }

                $fileName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/template/', $fileName);
                $data['path_file'] = $fileName;
            }

            if ($existing) {
                $this->templatesurat->update($existing['id'], $data);

                $this->logactivity->insert([
                    'id_user'        => $dataUser['id'],
                    'role'           => $dataUser['role'],
                    'ip_address'     => $this->request->getIPAddress(),
                    'user_agent'     => $this->request->getUserAgent()->getAgentString(),
                    'activity'       => 'Ubah Template Surat Berhasil',
                    'module'         => 'TemplateSurat',
                    'method'         => __FUNCTION__,
                    'url'            => $this->request->getUri()->getPath(),
                    'request_data'   => json_encode($requestData),
                    'response_status' => $this->response->getStatusCode()
                ]);
            } else {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $id_user;
                $this->templatesurat->insert($data);

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
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Template berhasil disimpan.',
                'csrf_token' => csrf_hash()
            ]);
        }
    }

    public function logactivity()
    {
        $data = [
            'logactivity' => $this->logactivity->getActivity(),
        ];

        return view('logactivity', $data);
    }
}
