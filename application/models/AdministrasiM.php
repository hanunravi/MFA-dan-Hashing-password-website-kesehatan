<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdministrasiM extends CI_Model {

    public function listPasien()
	{
		$data = $this->db->get('pasien');

		return $data->result();
	}
    public function listPasienUmum()
	{
		
		$data = $this->db->query("SELECT * FROM pasien join daftar_berobat using(idPasien) WHERE kdPoli ='01'");

		return $data->result();
	}
    public function daftarPasien()
	{
		$data = $this->db->query("SELECT t1.*
		FROM pasien t1
		LEFT JOIN daftar_berobat t2 ON t2.idPasien = t1.idPasien
		WHERE t2.idPasien IS NULL");

		return $data->result();
	}
    public function listPasienGigi()
	{
		$data = $this->db->query("SELECT * FROM pasien join daftar_berobat using(idPasien) WHERE kdPoli ='02'");

		return $data->result();
	}
	public function geteditData($table,$id,$where)
	{
		 $this->db->where($where,$id);
	     return $this->db->get($table);
	}
	public function rekamMedis($id)
	{
		$data = $this->db->get_where('rekammedis',array('idPasien'=> $id));

		return $data->result();
	}
	public function addData($data,$table){
		return $this->db->insert($table,$data);


	}
	public function editData($data,$table,$id,$where){
			$this->db->where($where,$id);
		return $this->db->update($table,$data);


	}
	    public function daftarPasienUmum()
	{
		$data = $this->db->query("SELECT * FROM daftar_berobat join pasien using(idPasien) WHERE kdPoli ='01'");

		return $data->result();
	}
	public function listTindakanUmum()
	{
		
		$data = $this->db->query("SELECT * FROM tindakan WHERE kdPoli ='01'");

		return $data->result();
	}
	    public function daftarPasienGigi()
	{
		$data = $this->db->query("SELECT * FROM daftar_berobat join pasien using(idPasien) WHERE kdPoli ='02'");

		return $data->result();
	}
	public function listTindakanGigi()
	{
		
		$data = $this->db->query("SELECT * FROM tindakan WHERE kdPoli ='02'");

		return $data->result();
	}
}

