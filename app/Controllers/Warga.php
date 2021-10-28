<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Modelwarga;
use App\Models\Modeltetangga;

class Warga extends BaseController {

    public function tetangga(){
        if(session()->get('level') <> 2){
            return redirect()->to('dashboard');
        }
        $data = [
            'title' => 'Data Rukun Warga'
        ];
        return view('auth/tetangga/index', $data);
    }

    public function gettetangga(){
        if($this->request->isAJAX()){
            $data = [
                'title' => 'Rukun Tetangga',
                'list' => $this->tetangga->orderBy('tetangga_id', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/tetangga/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtetangga()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Rukun Warga',
            ];
            $msg = [
                'data' => view('auth/tetangga/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Data Rukun Warga'
            ];
            $msg = [
                'data' => view('auth/tetangga/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function simpantetangga()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_tetangga' => [
                    'label' => 'Nama Rukun Tetangga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_tetangga' => $validation->getError('nama_tetangga'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_tetangga' => $this->request->getVar('nama_tetangga'),
                ];

                $this->tetangga->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapustetangga()
    {
        if ($this->request->isAJAX()) {

            $tetangga_id = $this->request->getVar('tetangga_id');

            $this->tetangga->delete($tetangga_id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function formedittetangga()
    {
        if ($this->request->isAJAX()) {
            $tetangga_id = $this->request->getVar('tetangga_id');
            $list =  $this->tetangga->find($tetangga_id);
            $data = [
                'title'         => 'Edit Rukun Warga',
                'tetangga_id'       => $list['tetangga_id'],
                'nama_tetangga'          => $list['nama_tetangga'],
            ];
            $msg = [
                'sukses' => view('auth/tetangga/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatetetangga()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_tetangga' => [
                    'label' => 'Nama Rukun Warga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_tetangga' => $validation->getError('nama_tetangga'),
                    ]
                ];
            } else {
                $updatedata = [
                    'nama_tetangga' => $this->request->getVar('nama_tetangga'),
                ];

                $tetangga_id = $this->request->getVar('tetangga_id');
                $this->tetangga->update($tetangga_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Rukun Tetangga
    
    public function index()
    {
        if (session()->get('level') <> 2) {
            return redirect()->to('/dashboard');
        }
        $data = [
            'title' => 'Rukun Tetangga',
        ];
        return view('auth/warga/index', $data);
    }

    public function getDataRW()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Data Rukun Tetangga',
                'list' => $this->warga->list()

            ];
            $msg = [
                'data' => view('auth/warga/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function getdatawarga()
    {
        $request = Services::request();
        $datamodel = $this->warga;
        if ($request->getMethod()) {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;

                $row = [];
                $edit = "<button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"edit('" . $list->warga_id . "')\">
                <i class=\"fa fa-edit\"></i>
            </button>";
                $hapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->warga_id . "')\">
                <i class=\"fa fa-trash\"></i>
            </button>";

                $row[] = "<input type=\"checkbox\" name=\"warga_id[]\" class=\"centangwargaid\" value=\"$list->warga_id\">";
                $row[] = $no;
                $row[] = $list->nama_warga;
                $row[] = $list->nama_tetangga;

                $row[] = $edit . " " . $hapus;
                $data[] = $row;
            }
            $output = [
                "recordTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];

            echo json_encode($output);
        }
    }

    public function formtambahwarga()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Data Rukun Tetangga',
                'tetangga' => $this->tetangga->orderBy('nama_tetangga', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/warga/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanwarga()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_warga' => [
                    'label' => 'Rukun Tetangga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tetangga_id' => [
                    'label' => 'Rukun Warga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_warga' => $validation->getError('nama_warga'),
                        'tetangga_id' => $validation->getError('tetangga_id'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_warga' => $this->request->getVar('nama_warga'),
                    'tetangga_id' => $this->request->getVar('tetangga_id'),
                ];

                $this->warga->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapuswarga()
    {
        if ($this->request->isAJAX()) {

            $warga_id = $this->request->getVar('warga_id');
            $this->warga->delete($warga_id);
            $msg = [
                'sukses' => 'Data Rukun Warga Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $warga_id = $this->request->getVar('warga_id');
            $jmldata = count($warga_id);
            for ($i = 0; $i < $jmldata; $i++) {
                $this->warga->delete($warga_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function formeditwarga()
    {
        if ($this->request->isAJAX()) {
            $warga_id = $this->request->getVar('warga_id');
            $list =  $this->warga->find($warga_id);
            $tetangga =  $this->tetangga->list();
            $data = [
                'title'         => 'Edit Rukun Tetangga',
                'tetangga'         => $tetangga,
                'warga_id'      => $list['warga_id'],
                'nama_warga'          => $list['nama_warga'],
                'tetangga_id'      => $list['tetangga_id'],
            ];
            $msg = [
                'sukses' => view('auth/warga/edit', $data)
            ];
            echo json_encode($msg);
        }
    }
}