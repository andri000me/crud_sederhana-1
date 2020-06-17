<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
        $this->db->order_by('id', 'desc');
        $data['products'] = $this->db->get('produk')->result();
		$this->load->view('home', $data);
    }
    
    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if($this->form_validation->run() === false){
            $this->index();
        }else{
            $data = [
                'nama_produk' => $this->input->post('nama'),
                'keterangan' => $this->input->post('keterangan'),
                'harga' => $this->input->post('harga'),
                'jumlah' => $this->input->post('jumlah')
            ];

            $this->db->insert('produk', $data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan');
            redirect('/');
        }
    }

    public function ubah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        if($this->form_validation->run() === false){
            $this->index();
        }else{
            $data = [
                'nama_produk' => $this->input->post('nama'),
                'keterangan' => $this->input->post('keterangan'),
                'harga' => $this->input->post('harga'),
                'jumlah' => $this->input->post('jumlah')
            ]; 
            $this->db->where('id', $this->input->post('id'));
            $this->db->set($data);
            $this->db->update('produk');
            $this->session->set_flashdata('pesan', 'Data berhasil diubah');
            redirect('/');
        }
    }

    public function hapus($id){
        $this->db->where('id', $id);
        $this->db->delete('produk');
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus');
        redirect('/');
    }

}
