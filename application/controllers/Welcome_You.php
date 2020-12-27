<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_You extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{   
        $this->load->library("Pdf");
        $this->load->model('Cashiermodel','Cashier');
        date_default_timezone_set('Asia/Kolkata');
        $invoice="BSMRSM0001";
        $data=$this->Cashier->getInvoiceData($invoice);
        $this->load->view('creation',compact('data'));
	}
	
	public function home_page()
	{   
		echo "hello";
	}
}
