<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
	
		parent:: __construct();	
		
		
	}
    
	public function index()
	{

		
		$data['user'] = $this->db->get_where('users', ['email' =>
		$this->session->userdata('email')])->row_array();
		if ($data['user'] != null){
		$data['title'] = 'Halaman Home';
		$this->load->view('templates/header', $data);
		$this->load->view('home/index', $data);
		$this->load->view('templates/footer');

	
		} else {

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
            Please register to login</div>');

            redirect('auth');

		}

	}
	



}
