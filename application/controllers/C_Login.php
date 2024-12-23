<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // Load library email, session, dan database
        $this->load->library('email');
        $this->load->library('session');
        $this->load->database();
    }

    public function index() {
        if ($this->session->logged == 'y') {
            if ($this->session->level == 'Administrasi') {
                redirect('C_Administrasi');
            } else if ($this->session->level == 'Dokter') {
                redirect('C_Dokter');
            }
        } else {
            // Jika belum login, tampilkan halaman login
            $this->load->view('login');
        }
    }

    public function login() {
        $username = $this->input->post("uname");
        $password = $this->input->post("pass");
    
        // Menggunakan MD5 untuk hash password yang dimasukkan
        $password_hash = md5($password);
    
        // Login untuk dokter
        $this->db->where('namaDokter', $username);
        $this->db->where('password', $password_hash); // Bandingkan dengan MD5 hash
        $query = $this->db->get('dokter');
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $otp = rand(100000, 999999); // Generate OTP
    
            // Validasi email
            if (empty($row->email) || !filter_var($row->email, FILTER_VALIDATE_EMAIL)) {
                $this->session->set_flashdata('error', 'Email tidak valid.');
                redirect('C_Login');
            }
    
            // Simpan OTP ke session
            $this->session->set_userdata('otp', $otp);
    
            // Kirim OTP ke email
            if ($this->send_otp_email($row->email, $otp)) {
                $data = array(
                    'logged' => 'y',
                    'id_dokter' => $row->idDokter,
                    'username' => $row->namaDokter,
                    'nama' => $row->namaDokter,
                    'level' => 'Dokter',
                    'poli' => $row->kdPoli
                );
                $this->session->set_userdata($data);
                redirect('C_Login/verify_otp');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengirim OTP. Silakan coba lagi.');
                redirect('C_Login');
            }
        } else {
            // Login untuk administrasi
            $this->db->where('namaPetAdministrasi', $username);
            $this->db->where('password', $password_hash); // Bandingkan dengan MD5 hash
            $query2 = $this->db->get('petugasadministrasi');
    
            if ($query2->num_rows() > 0) {
                $row = $query2->row();
                $otp = rand(100000, 999999);
    
                // Validasi email
                if (empty($row->email) || !filter_var($row->email, FILTER_VALIDATE_EMAIL)) {
                    $this->session->set_flashdata('error', 'Email tidak valid.');
                    redirect('C_Login');
                }
    
                // Simpan OTP ke session
                $this->session->set_userdata('otp', $otp);
    
                // Kirim OTP ke email
                if ($this->send_otp_email($row->email, $otp)) {
                    $data = array(
                        'logged' => 'y',
                        'id_perawat' => $row->idPetAdministrasi,
                        'username' => $row->namaPetAdministrasi,
                        'nama' => $row->namaPetAdministrasi,
                        'jabatan' => $row->hakAkses,
                        'info' => $row->idPetAdministrasi,
                        'level' => 'Administrasi'
                    );
                    $this->session->set_userdata($data);
                    redirect('C_Login/verify_otp');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengirim OTP. Silakan coba lagi.');
                    redirect('C_Login');
                }
            } else {
                // Login gagal
                $this->session->set_flashdata('error', 'Login gagal. Username atau password salah.');
                redirect('C_Login');
            }
        }
    }
    

    public function verify_otp() {
        // Middleware: Pastikan pengguna sudah login dan belum memverifikasi OTP
        if (!$this->session->userdata('logged')) {
            redirect('C_Login');  // Jika pengguna tidak login, arahkan ke halaman login
        }
    
        if ($this->session->userdata('otp_verified')) {
            // Jika OTP sudah diverifikasi, arahkan ke dashboard sesuai level pengguna
            if ($this->session->userdata('level') == 'Dokter') {
                redirect('C_Dokter');
            } else {
                redirect('C_Administrasi');
            }
        }
    
        // Jika belum diverifikasi, tampilkan halaman verifikasi OTP
        $this->load->view('verify_otp');
    }
    
    

    public function verify_otp_action() {
        $input_otp = $this->input->post('otp');
    
        // Menonaktifkan caching pada halaman verifikasi OTP
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: 0');
    
        // Cek jika OTP sudah diverifikasi
        if ($this->session->userdata('otp_verified')) {
            if ($this->session->userdata('level') == 'Dokter') {
                redirect('C_Dokter');  // Arahkan ke dashboard Dokter
            } else {
                redirect('C_Administrasi');  // Arahkan ke dashboard Administrasi
            }
        }

        $input_otp = $this->input->post('otp');  // OTP yang dimasukkan oleh pengguna

        // Memeriksa OTP
        if ($input_otp == $this->session->userdata('otp')) {
            // Set OTP sudah diverifikasi
            $this->session->set_userdata('otp_verified', true);

            // Redirect ke dashboard sesuai level pengguna
            if ($this->session->userdata('level') == 'Dokter') {
                redirect('C_Dokter');
            } else {
                redirect('C_Administrasi');
            }
        } else {
            // Jika OTP salah, beri pesan error dan redirect kembali ke halaman verifikasi OTP
            $this->session->set_flashdata('error', 'OTP salah.');
            redirect('C_Login/verify_otp');
        }
    }
    

    private function send_otp_email($email, $otp) {
        // Konfigurasi email
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_user'] = 'hanunravi@gmail.com';
        $config['smtp_pass'] = 'fktmtugvkhmfnkpt';
        $config['smtp_port'] = 587;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";
        $config['smtp_crypto'] = 'tls';
        $config['smtp_timeout'] = 10;

        $this->email->initialize($config);
        $this->email->from('hanunravi@gmail.com', 'Brimedika');
        $this->email->to($email);
        $this->email->subject('Kode OTP Anda');
        $this->email->message('Kode OTP Anda adalah: ' . $otp);

        // Kirim email
        if ($this->email->send()) {
            log_message('info', 'OTP berhasil dikirim ke ' . $email);
            return true;
        } else {
            log_message('error', 'OTP gagal dikirim. Error: ' . $this->email->print_debugger());
            return false;
        }
    }

    public function logout() {
        // Hapus session
        $this->session->sess_destroy();
        redirect('C_Login');
    }
}
