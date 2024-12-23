<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HashData extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database
    }

    public function index() {
        // Ambil semua data dokter dari database
        $query = $this->db->get('dokter'); // Ambil semua data dari tabel 'dokter'
        $users = $query->result();

        foreach ($users as $user) {
            // Hash password lama menggunakan bcrypt
            if (!password_get_info($user->password)['algo']) { // Cek jika belum di-hash
                $hashed_password = password_hash($user->password, PASSWORD_BCRYPT);

                // Update password ke database berdasarkan kolom 'idDokter'
                $this->db->where('idDokter', $user->idDokter);
                $this->db->update('dokter', ['password' => $hashed_password]);

                echo "Password untuk dokter dengan ID {$user->idDokter} telah di-hash.<br>";
            }
        }

        echo "Proses hashing selesai.";
    }
}
