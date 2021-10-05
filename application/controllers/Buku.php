<?php defined('BASEPATH') or exit ('No direct script accsess allowed');

class Buku extends CI_controller
{
    function _construct(){
        parent::__construct();
        // cek login
        if($this->session->userdata('status') !="login"){
            $alert=$this->session->set_flashdata('alert','Anda belum login');
            redirect(base_url());
        }
    }
    function index(){
        $data['anggota'] = $this->M_perpus->get_data('anggota')->result();
        $data['buku'] = $this->M_perpus->get_data('buku')->result();
        $data['header'] = 'Katalog Buku';
    }
    public function katalog_detail(){
        $id = $this->uri->segment(3);
        $buku = $this->db->query('select*from buku b, kategori k where b.id_kategori=k.id_kategori and b.id_buku='.$id)->result();

        foreach ($buku as $fields) {
            $data['judul'] = $fields->judul_buku;
            $data['pengarang'] = $fields->pengarang;
            $data['penerbit'] = $fields->penerbit;
            $data['kategori'] = $fields->kategori;
            $data['tahun'] = $fields->tahun;
            $data['isbn'] = $fields->isbn;
            $data['gambar'] = $fields->gambar;
            $data['id'] = $id;
        }
        $this->load->view('desain');
        $this->load->view('toplayout');
        $this->load->view('detail_buku',$data);
    }
}
?>