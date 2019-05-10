<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->model("jenis_model");
        $this->load->model("bentuk_model");
        $this->load->model("rak_model");
        $this->load->model("batch_model");
        $this->load->model("satuan_model");
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }

    public function index()
    {
        check_not_login();//memeriksa session, user telah login
        $data["produk"] = $this->produk_model->getAll();
        $this->load->view("produk/list", $data);
    }

    public function getLaporan($id)
    {
        check_not_login();//memeriksa session, user telah login
        $data["laporan"] = $this->produk_model->getLaporan($id);
        $data["produk"] = $this->produk_model->getById($id);
        $this->load->view("produk/listBatch", $data);
    }

    public function add()
    {
        check_not_login();//memeriksa session, user telah login
        $produk = $this->produk_model;
        $data = array(
            'jenis' => $this->jenis_model->getAll(),
            'bentuk' => $this->bentuk_model->getAll(),
            'rak' => $this->rak_model->getAll(),
            'satuan' => $this->satuan_model->getAll()
        );
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());
        if ($validation->run()) {
            $post = $this->input->post();
            $checkNama = $this->produk_model->getNumRow($post["namaProduk"]);
            if($checkNama == 0){
                $produk->save();
                $this->session->set_flashdata('success', 'Produk berhasil disimpan');
                redirect(site_url('produk'));   
            }else{
                echo "<script> 
					alert('Nama Produk Sudah Terdaftar');
					window.location='".site_url('produk/add')."';
					</script>";
            }
        }
        $this->load->view("produk/new_form", $data);
    }

    public function edit($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) redirect('produk');
        $produk = $this->produk_model;
        $nama= $this->produk_model->getById($id);
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());
        if ($validation->run()) {
            $post = $this->input->post();
            $checkNama = $this->produk_model->getNumRow($post["namaProduk"]);
            if($checkNama == 0){
                $produk->update();
                $this->session->set_flashdata('warning', 'Produk berhasil diperbaharui');
                redirect(site_url('produk'));  
            }if($checkNama != 0 && $post["namaProduk"] == $nama->namaProduk){
                $produk->update();
                $this->session->set_flashdata('warning', 'Produk berhasil diperbaharui');
                redirect(site_url('produk'));  
            }else{
                echo "<script> 
					alert('Nama Produk Sudah Terdaftar');
					window.location='".site_url('produk')."';
					</script>";
            }
            
        }

        $data = array(
            'produk' => $this->produk_model->getById($id),
            'jenis' => $this->jenis_model->getAll(),
            'bentuk' => $this->bentuk_model->getAll(),
            'rak' => $this->rak_model->getAll(),
            'satuan' => $this->satuan_model->getAll()
        );
        if (!$data["produk"]) show_404();

        $this->load->view("produk/edit_form", $data);
    }

    public function delete($id = null)
    {
        check_not_login();//memeriksa session, user telah login
        if (!isset($id)) show_404();

        if ($this->produk_model->delete($id)) {
            $this->session->set_flashdata('danger', 'Produk berhasil dihapus');
            redirect(site_url('produk'));
        }
    }
    function print($id){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'APOTEK SUBUR FARMA',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'LAPORAN STOK PRODUK',0,1,'C');
        $pdf->Cell(190,7,date('y-m-d'),0,1,'C');
        $pdf->Cell(190,3,'NAMA PRODUK :',0,1);
        $nama = $this->produk_model->getById($id);
        $pdf->Cell(190,7,$nama->namaProduk,0,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(50,6,'Tanggal',1,0);
        $pdf->Cell(40,6,'Jenis',1,0);
        $pdf->Cell(20,6,'No Batch',1,0);
        $pdf->Cell(30,6,'Kedaluwarsa',1,0);
        $pdf->Cell(20,6,'Jumlah',1,0);
        $pdf->Cell(20,6,'Sisa',1,1);
        $pdf->SetFont('Arial','',10);
        $produk= $this->produk_model->getLaporan($id);
        foreach ($produk as $row){
            $pdf->Cell(50,6,$row->tanggalLaporan,1,0);
            if($row->jenisLaporan==0){
                $pdf->Cell(40,6,'MASUK',1,0);
            }else{
                $pdf->Cell(40,6,'KELUAR',1,0);
            }
            $pdf->Cell(20,6,$row->noBatch,1,0);
            $pdf->Cell(30,6,$row->tanggalKedaluwarsa,1,0);
            $pdf->Cell(20,6,$row->jumlahBeli,1,0);
            $pdf->Cell(20,6,$row->sisa,1,1);
           
        }
        $pdf->Output();
    }
}
