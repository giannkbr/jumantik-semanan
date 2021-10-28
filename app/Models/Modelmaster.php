<?php

namespace App\Models;
use CodeIgniter\Model;

class Modelmaster extends Model {
    
    protected $table = 'master';
    protected $primaryKey = 'master_id';
    protected $allowedFields = ['nama_tempat', 'alamat_tempat', 'tanggal', 'dispenser', 'bak_mandi', 'kolam_ikan', 'cucian_piring', 'pot_tanaman'];
    protected $column_order = array('nama_tempat', 'alamat_tempat', 'tanggal', 'dispenser', 'bak_mandi', 'kolam_ikan', 'cucian_piring', 'pot_tanaman', null);
    protected $column_search = array('nama_tempat');
    protected $order = array('nama_tempat' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        // $this->request = $request;

        $this->dt = $this->db->table($this->table)->select('*');
    }

    private function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if (isset($_POST['search']['value'])) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $_POST['search']('value'));
                } else {
                    $this->dt->orLike($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->dt->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if (isset($_POST['length' != -1]))
            $this->dt->limit($_POST['length'], $_POST['start']);
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }

    public function list()
    {
        return $this->table('master')
            ->orderBy('master_id', 'ASC')
            ->get()->getResultArray();
    }

}