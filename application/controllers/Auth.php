<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
	
        parent:: __construct();	
        $this->load->library('form_validation');
		
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


                $this->form_validation->set_rules('email','Email','trim|required|valid_email');
                $this->form_validation->set_rules('pwd','Password','trim|required');

                if( $this->form_validation->run() == false){

                    $data['judul'] = 'Halaman Login';
                    $this->load->view('auth/header', $data);
                    $this->load->view('auth/login', $data);
                    $this->load->view('auth/footer');
                    
                }else {

                $this->_login();

                }
        }
        
    }


    private function _login(){

        $email = $this->input->post('email');
        $password = $this->input->post('pwd');

        $user = $this->db->get_where('users', ['email'=>$email])->row_array();
       
        if($user != null){

            if ($user['is_active'] == 1 ) {

                if (password_verify($password, $user['password'])){

                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);

                    redirect ('home');

                }else {
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Wrong Password!</div>');

                    redirect('auth');

                }

            }

     
             
         } else {
 
             $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
             Email is not registered!</div>');
 
             redirect('auth');
 
         
        }

    }

    
    public function registration($nama='')
    {

        $this->form_validation->set_rules('name','Name','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]',[
            'is_unique' => 'This email has already registered'
        ]);
        $this->form_validation->set_rules('pwd','Password','required|trim|min_length[6]|matches[pwd1]');
        $this->form_validation->set_rules('pwd1','Password','required|trim|matches[pwd]');

        if( $this->form_validation->run() == false) {

            
            $data['judul'] = 'Halaman Register';
            $this->load->view('auth/header', $data);
            $this->load->view('auth/registration');
            $this->load->view('auth/footer');

        } else {

            $data = [
                  'name' => $this->input->post('name'),
                  'email'=> $this->input->post('email'),
                  'image_url' => 'default.jpg',
                  'password' => password_hash($this->input->post('pwd'), PASSWORD_DEFAULT),
                  'role_id' =>'1',
                  'is_active' =>'1',
                  'date_created' => time()

            ];
              $this->db->insert('users', $data);
              $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
              Congratulation! your acount has been created. Please Login</div>');

              redirect('auth');
        }

    }

    public function logout () 
    {

        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
        You have been logged out </div>');

        redirect('auth');

    }
	
}
