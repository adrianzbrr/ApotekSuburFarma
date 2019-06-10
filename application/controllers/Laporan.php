<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model("laporan_model");
		$this->load->model("batch_model");
		$this->load->library('pdf');
	}
    
    public function index()
	{
		check_not_login();//memeriksa session, user telah login
		// load view laporan.php
		$data = array(
			'hbs'=> $this->laporan_model->getAllHabis()
	    );
        $this->load->view("laporan/listDefekta",$data);
	}

    public function expiredReport()
	{
		check_not_login();//memeriksa session, user telah login
		// load view laporan.php
		$data = array(
        	'kdl'=> $this->laporan_model->getAllKedaluwarsa()
	    );
        $this->load->view("laporan/listExpired",$data);
    }
    
	public function delete($id)
	{
		check_not_login();//memeriksa session, user telah login
		if (!isset($id)) show_404();
		$this->batch_model->makeZero($id);
        if ($this->laporan_model->out($id)) {
			$this->session->set_flashdata('danger', 'Produk berhasil dihapus');
            redirect($this->agent->referrer());
        }        
	}

	function print(){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'APOTEK SUBUR FARMA',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'LAPORAN DEFEKTA',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(50,6,'Nama Produk',1,0);
        $pdf->Cell(30,6,'Minimal Stok',1,0);
        $pdf->Cell(27,6,'Jumlah',1,1);
        $pdf->SetFont('Arial','',10);
        $hbs = $this->laporan_model->getAllHabis();
        foreach ($hbs as $row){
            $pdf->Cell(50,6,$row->namaProduk,1,0);
            $pdf->Cell(30,6,$row->minimalStok,1,0);
            $pdf->Cell(27,6,$row->jumlah,1,1);
        }
        $pdf->Output();
    }
}
