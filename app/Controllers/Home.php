<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $activity;

    public function __construct()
    {
        $this->activity = new \App\Models\LogActivityModel();
    }


    public function dashboard()
    {
        $data = [
            // 'logactivity' => $this->activity->getActivity(),
        ];

        return view('dashboard', $data);
    }
    public function tambaharsip()
    {
        $data = [
            // 'logactivity' => $this->activity->getActivity(),
        ];

        return view('DataArsip/tambahdataarsip', $data);
    }
    public function tambahkategori()
    {
        $data = [
            // 'logactivity' => $this->activity->getActivity(),
        ];

        return view('LayananArsip/tambahkategori', $data);
    }

    public function logactivity()
    {
        $data = [
            'logactivity' => $this->activity->getActivity(),
        ];

        return view('logactivity', $data);
    }
}
