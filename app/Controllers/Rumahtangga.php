<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Modelrumahtangga;
use App\Models\Modelmaster;
class Rumahtangga extends BaseController{
    public function index()
    {
        // if (session()->get('level') <> 2) {
        //     return redirect()->to('/dashboard');
        // }
        $data = [
            'title' => 'Data Tempat Rumah Tangga',
        ];
        return view('auth/rumahtangga/index', $data);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Data Tempat Rumah Tangga',
                'list' => $this->rumahtangga->list()

            ];
            $msg = [
                'data' => view('auth/rumahtangga/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function getdatarumahtangga()
    {
        $request = Services::request();
        $datamodel = $this->rumahtangga;
        if ($request->getMethod()) {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;

                $row = [];
                $edit = "<button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"edit('" . $list->rumahtangga_id . "')\">
                <i class=\"fa fa-edit\"></i>
            </button>";
                $hapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->rumahtangga_id . "')\">
                <i class=\"fa fa-trash\"></i>
            </button>";

                // $row[] = "<input type=\"checkbox\" name=\"makanan_id[]\" class=\"centangmakananid\" value=\"$list->makanan_id\">";
                $row[] = $no;
                $row[] = $list->nama_tempat;
                $row[] = $list->alamat_tempat;
                $row[] = $list->tanggal;
                $row[] = $list->dispenser;
                $row[] = $list->bak_mandi;
                $row[] = $list->kolam_ikan;
                $row[] = $list->cucian_piring;
                $row[] = $list->pot_tanaman;
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

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Data Rumah Tangga',
            ];
            $msg = [
                'data' => view('auth/rumahtangga/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_tempat' => [
                    'label' => 'Nama Tempat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat_tempat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tanggal' => [
                    'label' => 'Tanggal Periksa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'dispenser' => [
                    'label' => 'Data Dispenser',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'bak_mandi' => [
                    'label' => 'Data Bak Mandi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kolam_ikan' => [
                    'label' => 'Data Kolam Ikan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'cucian_piring' => [
                    'label' => 'Data Cucian Piring',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pot_tanaman' => [
                    'label' => 'Data Pot Tanaman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
                
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_tempat' => $validation->getError('nama_tempat'),
                        'alamat_tempat' => $validation->getError('alamat_tempat'),
                        'tanggal' => $validation->getError('tanggal'),
                        'dispenser' => $validation->getError('dispenser'),
                        'bak_mandi' => $validation->getError('bak_mandi'),
                        'kolam_ikan' => $validation->getError('kolam_ikan'),
                        'cucian_piring' => $validation->getError('cucian_piring'),
                        'pot_tanaman' => $validation->getError('pot_tanaman'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_tempat' => $this->request->getVar('nama_tempat'),
                    'alamat_tempat' => $this->request->getVar('alamat_tempat'),
                    'tanggal' => $this->request->getVar('tanggal'),
                    'dispenser' => $this->request->getVar('dispenser'),
                    'bak_mandi' => $this->request->getVar('bak_mandi'),
                    'kolam_ikan' => $this->request->getVar('kolam_ikan'),
                    'cucian_piring' => $this->request->getVar('cucian_piring'),
                    'pot_tanaman' => $this->request->getVar('pot_tanaman'),
                ];

                $this->rumahtangga->insert($simpandata);
                $this->master->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $rumahtangga_id = $this->request->getVar('rumahtangga_id');
            $list =  $this->rumahtangga->find($rumahtangga_id);
            $data = [
                'title'         => 'Edit Data Rumah Tangga',
                'rumahtangga_id'      => $list['rumahtangga_id'],
                'nama_tempat'           => $list['nama_tempat'],
                'alamat_tempat'          => $list['alamat_tempat'],
                'tanggal'      => $list['tanggal'],
                'dispenser'        => $list['dispenser'],
                'bak_mandi'     => $list['bak_mandi'],
                'kolam_ikan'     => $list['kolam_ikan'],
                'cucian_piring'        => $list['cucian_piring'],
                'pot_tanaman'        => $list['pot_tanaman'],
            ];
            $msg = [
                'sukses' => view('auth/rumahtangga/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_tempat' => [
                    'label' => 'Nama Tempat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat_tempat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tanggal' => [
                    'label' => 'Tanggal Periksa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'dispenser' => [
                    'label' => 'Data Dispenser',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'bak_mandi' => [
                    'label' => 'Data Bak Mandi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kolam_ikan' => [
                    'label' => 'Data Kolam Ikan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'cucian_piring' => [
                    'label' => 'Data Cucian Piring',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pot_tanaman' => [
                    'label' => 'Data Pot Tanaman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
                
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_tempat' => $validation->getError('nama_tempat'),
                        'alamat_tempat' => $validation->getError('alamat_tempat'),
                        'tanggal' => $validation->getError('tanggal'),
                        'dispenser' => $validation->getError('dispenser'),
                        'bak_mandi' => $validation->getError('bak_mandi'),
                        'kolam_ikan' => $validation->getError('kolam_ikan'),
                        'cucian_piring' => $validation->getError('cucian_piring'),
                        'pot_tanaman' => $validation->getError('pot_tanaman'),
                    ]
                ];
            } else {
                $updatedata = [
                    'nama_tempat' => $this->request->getVar('nama_tempat'),
                    'alamat_tempat' => $this->request->getVar('alamat_tempat'),
                    'tanggal' => $this->request->getVar('tanggal'),
                    'dispenser' => $this->request->getVar('dispenser'),
                    'bak_mandi' => $this->request->getVar('bak_mandi'),
                    'kolam_ikan' => $this->request->getVar('kolam_ikan'),
                    'cucian_piring' => $this->request->getVar('cucian_piring'),
                    'pot_tanaman' => $this->request->getVar('pot_tanaman'),
                ];

                $rumahtangga_id = $this->request->getVar('rumahtangga_id');
                $this->rumahtangga->update($rumahtangga_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $rumahtangga_id = $this->request->getVar('rumahtangga_id');
            //check
            $cekdata = $this->rumahtangga->find($rumahtangga_id);

            $this->rumahtangga->delete($rumahtangga_id);
            $msg = [
                'sukses' => 'Data tempat rumahtangga Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $rumahtangga_id = $this->request->getVar('rumahtangga_id');
            $jmldata = count($rumahtangga_id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->rumahtangga->find($rumahtangga_id[$i]);
                $this->staf->delete($staf_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }
}