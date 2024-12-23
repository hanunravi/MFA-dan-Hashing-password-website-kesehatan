<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Administrasi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('AdministrasiM', 'yeah');
	
		// Middleware: Cek session username
		if (!isset($_SESSION['username'])) {
			redirect('C_Login');
		}
	
		// Middleware: Cek level Administrasi
		if ($this->session->userdata('level') != 'Administrasi') {
			redirect('C_Login');
		}
	
		// Middleware: Cek verifikasi OTP
		if (!$this->session->userdata('otp_verified')) {
			redirect('C_Login/verify_otp'); // Arahkan ke halaman verifikasi OTP
		}
	}
	
	public function index()
	{
		$this->load->view('administrasi/home');
	}

	public function pasien(){
		$data['pasien'] = $this->yeah->listPasien();
		$this->load->view('administrasi/pasien',$data);	
	}

	public function addPasien(){
		$this->load->view('administrasi/tambah_pasien');	
	}
	public function editPasien(){
		$id = $this->uri->segment(3);
		$data['pasien'] = $this->yeah->geteditData('pasien',$id,'idPasien')->result();
		$this->load->view('administrasi/edit_pasien',$data);	
	}



	public function tambah(){
		$data = array(
		'namaPasien'=> html_escape($this->input->post('nama')),
		'umur' => html_escape($this->input->post('umur')),
		'jenisKelamin' => html_escape($this->input->post('jeniskel')),
		'alamat' => html_escape($this->input->post('alamat')),
		'noTelp' => html_escape($this->input->post('nomor')),
		'pekerjaan' =>  html_escape($this->input->post('pekerjaan')),
		);
		if($this->yeah->addData($data,'pasien')){
			$message = array('message'=>'Data Pasien berhasil ditambah', 'class'=>'alert alert-primary');
			$this->session->set_flashdata('item', $message);
		}else{
			$message = array('message'=>'Data Pasien gagal ditambahkan', 'class'=>'alert alert-danger');
			$this->session->set_flashdata('item', $message);			
		}
		redirect('C_Administrasi/pasien');

	}

	public function prosesEditP(){

		$data = array(
		'namaPasien'=> html_escape($this->input->post('nama')),
		'umur' => html_escape($this->input->post('umur')),
		'jenisKelamin' => html_escape($this->input->post('jeniskel')),
		'alamat' => html_escape($this->input->post('alamat')),
		'noTelp' => html_escape($this->input->post('nomor')),
		'pekerjaan' =>  html_escape($this->input->post('pekerjaan')),
		);
		$id = $this->input->post('idp');
		if($this->yeah->editData($data,'pasien',$id,'idPasien')){
			$message = array('message'=>'Data Pasien berhasil diubah', 'class'=>'alert alert-primary');
			$this->session->set_flashdata('item', $message);
		}else{
			$message = array('message'=>'Data Pasien gagal diubah', 'class'=>'alert alert-danger');
			$this->session->set_flashdata('item', $message);			
		}
		redirect('C_Administrasi/pasien');

	}


	public function hapusPasien(){
		$id=$this->uri->segment(3);
		$this->db->where('idPasien',$id);
		if(	$this->db->delete('pasien')){
			$message = array('message'=>'Data Pasien berhasil dihapus', 'class'=>'alert alert-warning');
			$this->session->set_flashdata('item', $message);
		}else{
			$message = array('message'=>'Data Pasien gagal dihapus', 'class'=>'alert alert-danger');
			$this->session->set_flashdata('item', $message);			
		}
		redirect('C_Administrasi/pasien');
	}

	public function daftar_berobat(){
		//$data['pasien'] = $this->yeah->listPasien();
		$this->load->view('administrasi/daftar_berobat');	
	}

	public function poliUmum(){
		$data['pasien'] = $this->yeah->listPasienUmum();
		$data['dftr'] = $this->yeah->daftarPasien();
		$this->load->view('administrasi/umum',$data);	
	}
	public function poliGigi(){
		$data['pasien'] = $this->yeah->listPasienGigi();
		$data['dftr'] = $this->yeah->daftarPasien();
		$this->load->view('administrasi/gigi',$data);	
	}

	public function tambahGigi(){
		$data = array(
		'idPasien'=> html_escape($this->input->post('idPasien')),
		'tglBerobat' => html_escape($this->input->post('tanggal')),
		'kdPoli' => '02'
		);
		if($this->yeah->addData($data,'daftar_berobat')){
			$message = array('message'=>'Data Pasien berhasil ditambah', 'class'=>'alert alert-primary');
			$this->session->set_flashdata('item', $message);
		}else{
			$message = array('message'=>'Data Pasien gagal ditambahkan', 'class'=>'alert alert-danger');
			$this->session->set_flashdata('item', $message);			
		}
		redirect('C_Administrasi/poliGigi');

	}
	public function tambahUmum(){
		$data = array(
		'idPasien'=> html_escape($this->input->post('idPasien')),
		'tglBerobat' => html_escape($this->input->post('tanggal')),
		'kdPoli' => '01'
		);
		if($this->yeah->addData($data,'daftar_berobat')){
			$message = array('message'=>'Data Pasien berhasil ditambah', 'class'=>'alert alert-primary');
			$this->session->set_flashdata('item', $message);
		}else{
			$message = array('message'=>'Data Pasien gagal ditambahkan', 'class'=>'alert alert-danger');
			$this->session->set_flashdata('item', $message);			
		}
		redirect('C_Administrasi/poliUmum');

	}
	public function hapusBerobat(){
		$id=$this->uri->segment(3);
		$this->db->where('idBerobat',$id);
	
		if(	$this->db->delete('daftar_berobat')){
			$message = array('message'=>'Data Pasien berhasil dihapus', 'class'=>'alert alert-warning');
			$this->session->set_flashdata('item', $message);
		}else{
			$message = array('message'=>'Data Pasien gagal ditambahkan', 'class'=>'alert alert-danger');
			$this->session->set_flashdata('item', $message);			
		}
		if($this->uri->segment(4) == 1){
		redirect('C_Administrasi/poliUmum');
		}else{
		redirect('C_Administrasi/poliGigi');
		}

	}
	public function pembayaran(){
		//$data['pasien'] = $this->yeah->listPasien();
		$this->load->view('administrasi/pembayaran');	
	}
	public function pembayaranUmum(){
		$data['tindakan'] = $this->yeah->listTindakanUmum();
		$data['dftr'] = $this->yeah->daftarPasienUmum();
		$this->load->view('administrasi/pembayaran_umum',$data);	
	}
	public function pembayaranGigi(){
		$data['tindakan'] = $this->yeah->listTindakanGigi();
		$data['dftr'] = $this->yeah->daftarPasienGigi();
		$this->load->view('administrasi/pembayaran_gigi',$data);	
	}
	public function tambahPembayaranUmum(){
		$t1 = html_escape($this->input->post('total'));
		$t2 = html_escape($this->input->post('total2'));
		$data = array(
		'idPasien'=> html_escape($this->input->post('idPasien')),
		'tglTransaksi' => html_escape($this->input->post('tanggal')),
		'totalTransaksi' => $t1+$t2,
		'idPetAdministrasi' => $this->session->userdata('id_perawat')
		);
		if($this->yeah->addData($data,'transaksi')){
			$message = array('message'=>'Data Transaksi berhasil ditambah', 'class'=>'alert alert-primary');
			$this->session->set_flashdata('item', $message);
		}else{
			$message = array('message'=>'Data Transaksi gagal ditambahkan', 'class'=>'alert alert-danger');
			$this->session->set_flashdata('item', $message);			
		}
		redirect('C_Administrasi/pembayaran');

	}
	public function tambahPembayaranGigi(){
		$t1 = html_escape($this->input->post('total'));
		$t2 = html_escape($this->input->post('total2'));
		$data = array(
		'idPasien'=> html_escape($this->input->post('idPasien')),
		'tglTransaksi' => html_escape($this->input->post('tanggal')),
		'totalTransaksi' => $t1+$t2,
		'idPetAdministrasi' => $this->session->userdata('id_perawat')
		);
		if($this->yeah->addData($data,'transaksi')){
			$message = array('message'=>'Data Transaksi berhasil ditambah', 'class'=>'alert alert-primary');
			$this->session->set_flashdata('item', $message);
		}else{
			$message = array('message'=>'Data Transaksi gagal ditambahkan', 'class'=>'alert alert-danger');
			$this->session->set_flashdata('item', $message);			
		}
		redirect('C_Administrasi/pembayaran');

	}



	/*	public function hapusRekam(){
		$id = $this->uri->segment(3);
		$id2 = $this->uri->segment(4);
		$this->db->where('noRM',$id);
		$this->db->delete('rekammedis');
		redirect('C_Administrasi/rekamMedis/'.$id2);
	}
public function rekamMedis(){
		$idpasien = $this->uri->segment(3);
		$data['rekam'] = $this->yeah->rekamMedis($idpasien);
		$this->load->view('administrasi/rekammedis',$data);	

	}
		public function editRekam(){
		$id = $this->uri->segment(3);
		$data['rekam'] = $this->yeah->geteditData('rekammedis',$id,'noRM')->result();
		$this->load->view('administrasi/edit_rekam',$data);	
	}
	public function addRekam(){
		$this->load->view('administrasi/tambah_rekam');	
	}
	public function tambah_rekam(){
		$data = array(
		'tglPemeriksaan'=> html_escape($this->input->post('tanggal')),
		'anamnesa' => html_escape($this->input->post('ana')),
		'diagnosa' => html_escape($this->input->post('diagnosa')),
		'terapi' => html_escape($this->input->post('terapi')),
		'ketTerapi' => html_escape($this->input->post('det')),
		'idPasien' =>  html_escape($this->input->post('id')),
		);
		if($this->yeah->addData($data,'rekammedis')){
			$message = array('message'=>'Data Rekam Medis berhasil ditambah', 'class'=>'alert alert-primary');
			$this->session->set_flashdata('item', $message);
		}else{
			$message = array('message'=>'Data Rekam Medis gagal ditambahkan', 'class'=>'alert alert-danger');
			$this->session->set_flashdata('item', $message);			
		}
		redirect('C_Administrasi/rekamMedis/'.html_escape($this->input->post('id')));

	} 
		public function prosesEditR(){

		$data = array(
		'tglPemeriksaan'=> html_escape($this->input->post('tanggal')),
		'anamnesa' => html_escape($this->input->post('ana')),
		'diagnosa' => html_escape($this->input->post('diagnosa')),
		'terapi' => html_escape($this->input->post('terapi')),
		'ketTerapi' => html_escape($this->input->post('detail')),
		'idPasien' =>  html_escape($this->input->post('idp')),
		);
		$id = $this->input->post('idr');
		$id2 = $this->input->post('idp');
		if($this->yeah->editData($data,'rekammedis',$id,'noRM')){
			$message = array('message'=>'Data Rekam Medis berhasil diubah', 'class'=>'alert alert-primary');
			$this->session->set_flashdata('item', $message);
		}else{
			$message = array('message'=>'Data  Rekam Medis gagal diubah', 'class'=>'alert alert-danger');
			$this->session->set_flashdata('item', $message);			
		}
		redirect('C_Administrasi/rekamMedis/'.$id2);

	}*/
}