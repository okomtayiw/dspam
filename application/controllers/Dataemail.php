<?php

class Dataemail extends CI_Controller {
   public function __construct()
   {
       parent:: __construct();
       $this->load->model('Dataemail_model');      
   }

   public function index(){

    $data['user'] = $this->db->get_where('users', ['email' =>
    $this->session->userdata('email')])->row_array();
    if ($data['user'] != null){
    $data ['title'] = 'Halaman Data Email';
    $data ['email'] = $this->Dataemail_model->getAllemail();
    $this->load->view('templates/header', $data);
    $this->load->view('email/index', $data);
    $this->load->view('templates/footer');
    } else {

    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
    Please register to login</div>');

    redirect('auth');
    }

   }

   public function insertEmail(){
    
    $date = date('Y-m-d', strtotime('now'));
    $data = array (
          'name_email' => $_POST ['name_email'],
          'password' => $_POST ['password'],
          'email_recovery' => $_POST ['email_recovery'],
          'date_insert' => $date

    );
     
    $this->db->insert('tbl_email', $data);
		redirect('dataemail');


   }


   public function update_email()
	{

		$id = $_POST['idEmail'];
        $email = $_POST['name_email'];
        $password = $_POST['password'];
        $email_rec = $_POST['email_recovery'];

	

		$data = array(
			'name_email' => $email,
			'password' => $password,
			'email_recovery' => $email_rec
		);
		
		$this->db->where('id_email', $id);
		$this->db->update('tbl_email', $data);

		redirect('dataemail');
	}

   public function delete_email(){
	$id = $_GET['idEmail'];
	$this->Dataemail_model->deleteEmail($id);
	
	redirect ('dataemail');
		
	}

}


?>

