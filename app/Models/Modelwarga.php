<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Modelwarga extends Model
{
    protected $table      = 'warga';
    protected $primaryKey = 'warga_id';
    protected $allowedFields = ['nama_warga', 'tetangga_id'];
    protected $column_order = array(null, null, 'nama_warga', 'tetangga_id', null);
    protected $column_search = array('nama_warga', 'nama');
    protected $order = array('nama_warga' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    //backend
    function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        // $this->request = $request;

        $this->dt = $this->db->table($this->table)->select('*')->join('tetangga', 'tetangga.tetangga_id=warga.tetangga_id');
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
        return $this->table('warga')
            ->join('tetangga', 'tetangga.tetangga_id = warga.tetangga_id')
            ->orderBy('warga_id', 'ASC')
            ->get()->getResultArray();
    }

    public function gettetangga()
    {
        return $this->table('warga')
            ->join('tetangga', 'tetangga.tetangga_id = warga.tetangga_id')
            ->like('nama_tetangga', 'XII')
            ->orderBy('warga_id', 'ASC')
            ->get()->getResultArray();
    }
}
