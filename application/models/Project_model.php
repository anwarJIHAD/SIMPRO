<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Project_model extends CI_Model
{
	public $table = 'tb_project';
	public $id = 'tb_project.id_project';
	public function __construct()
	{
		parent::__construct();
	}
	public function get($keyword = null)
	{
		$this->db->select('*');
		$this->db->from('tb_project');
		if (!empty($keyword)) {
			$this->db->like('namaaplikasi', $keyword);
		}
		$this->db->order_by('last_updated_time', 'desc');
		return $this->db->get()->result_array();
	}
	public function getDone($keyword = null)
	{
		$this->db->select('*');
		$this->db->from('tb_project');
		$this->db->where('progresmigrasi', '5');
		if (!empty($keyword)) {
			$this->db->like('namaaplikasi', $keyword);
		}
		$this->db->order_by('last_updated_time', 'desc');
		return $this->db->get()->result_array();
	}
	public function getUndone($keyword = null)
	{
		$this->db->select('*');
		$this->db->from('tb_project');
		$this->db->where_not_in('progresmigrasi', '5');
		if (!empty($keyword)) {
			$this->db->like('namaaplikasi', $keyword);
		}
		$this->db->order_by('last_updated_time', 'desc');
		return $this->db->get()->result_array();
	}
	public function gethistory($keyword = null)
	{
		$this->db->select('*');
		$this->db->from('tb_project');
		$this->db->where('progresmigrasi', '5');
		if (!empty($keyword)) {
			$this->db->like('namaaplikasi', $keyword);
		}
		$this->db->order_by('last_updated_time', 'desc');
		return $this->db->get()->result_array();
	}
	public function getBy()
	{
		$this->db->from($this->table);
		$this->db->where('id_project', $this->session->userdata('id_project'));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getByprov()
	{
		$this->db->select('u.*,i.nama_instansi as nama_instansi,');
		$this->db->from('user u');
		$this->db->join('instansi i', 'u.id_instansi = i.id_instansi');
		$this->db->where('NIK', $this->session->userdata('NIK'));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getprov()
	{
		$this->db->select('p.*,i.singkatan as singkatan,');
		$this->db->from('user p');
		$this->db->join('instansi i', 'p.id_instansi = i.id_instansi');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getById($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_project', $id);
		$query = $this->db->get();
		$this->db->get_where($this->table, ["id_project" => $id])->row();
		return $query->row_array();

	}

	function hitung()
	{
		// $this->db->query("SELECT (SUM(progresbrd)/SUM(bobot) *100)/100 from table_project)");

		// return $this->db->get()->result();
	}
	
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}
	public function searchRecord($key)
	{
		$this->db->select('p.*,u.nama as nama,');
		$this->db->from('tb_project p');
		$this->db->like('nama', $key);
		$this->db->or_like('project', $key);
		$this->db->or_like('newcr', $key);
		return $this->db->get()->result();
		// $query = $this->db->get();

		// if($query->num_rows()>0){
		//   return $query->result();

	}
	public function getProject($keyword)
	{
		if (!$keyword) {
			return null;
		}
		$this->db->like('namaproject', $keyword);
		$this->db->or_like('project', $keyword);
		$this->db->or_like('status', $keyword);
		$this->db->or_like('newcr', $keyword);
		$this->db->or_like('pic', $keyword);
		$query = $this->db->get('tb_project p');
		//print_r($query->result_array());die();
		return $query->result();

	}

	function ubah($data, $id)
	{
		$this->db->where('id_project', $id);
		$this->db->update('tb_project', $data);
		return TRUE;
	}


	public function progresproject()
	{
		$this->db->from($this->table);
		$query = $this->db->get();
		$query = $this->db->query("SELECT * from tb_project  where progresmigrasi <= 4  ");
		return $query->num_rows();
	}
	public function doneproject()
	{
		$this->db->from($this->table);
		$query = $this->db->get();
		$query = $this->db->query("SELECT * from tb_project  where progresmigrasi = 5  ");
		return $query->num_rows();
	}
	public function all()
	{
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function status()
	{
		$this->db->from($this->table);
		$query = $this->db->get();
		$query = $this->db->query("SELECT * from tb_project  where progresbrd = 5  ");
		$s = "BRD";
		return $s;
	}
	
	public function getjenispro($id)
	{
		$this->db->select('p.*,j.namajenisproject as jenisproject,');
		$this->db->from('tb_project p');
		$this->db->join('jenisproject j', 'p.jenisproject = j.id_jenisproject');
		$this->db->where('p.id_project', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function getjenisapp($id)
	{
		$this->db->select('p.*,j.namajenisaplikasi as jenisaplikasi,');
		$this->db->from('tb_project p');
		$this->db->join('jenisaplikasi j', 'p.jenisaplikasi = j.id_jenisaplikasi');
		$this->db->where('p.id_project', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getBobot($id)
    {
        $query = 'SELECT sum(bobotdev) as bobotdev FROM `tb_project` WHERE id_project = "'.$id.'"';
        return $this->db->query($query)->row_array();
    }
}