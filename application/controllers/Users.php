<?php
	Class Users extends CI_Controller{
		public function register(){
		unset($_SESSION['login_failed']);
			$data['title']='Sign Up';
			//form validation for sign up page
			$this->form_validation->set_rules('fname','FName','required');
			$this->form_validation->set_rules('lname','LName','required');
			$this->form_validation->set_rules('email','Email','required|callback_check_email_exists');
			$this->form_validation->set_rules('dept','Department','required');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('password2','Confirm Password','required', 'matches[password]');

			if($this->form_validation->run()===FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			}
			else{
			//password encryption
				$enc_password = md5($this->input->post('password'));

				$this->User_model->register($enc_password);

				redirect('users/login');
			}
		}
		//login user
		public function login(){
			$data['title']='Sign In';
			//form validation for sign up page
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');

			if($this->form_validation->run()===FALSE){
				$this->session->sess_destroy();
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			}
			else{
				//get the email
				$email=$this->input->post('email');
				//get the password and convert to md5 to compare
				$password=md5($this->input->post('password'));

				//log in user
				$user_id = $this->User_model->login($email, $password);
				
				if($user_id){
				//create session
				unset($_SESSION['login_failed']);
				unset($_SESSION['user_id']);
				$user_data = array(
					'user_id' => $user_id->id,
					'FirstName' => $user_id->FirstName,
					'LastName' => $user_id->LastName,
					'Dept' => $user_id->department,
					'Role' => $user_id->roles,
					'logged_in' => true,
				);

				$this->session->set_userdata($user_data);
				redirect('tickets');				
				}
				else{
				$this->session->set_flashdata('login_failed', 'Login is invalid');
				redirect('users/login');
				}
			}
		}

		public function logout(){
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('email');

			redirect('users/login');
		}
		//check if email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists','That email is already taken, please try logging in again');
			if($this->User_model->check_email_exists($email))
			{
				return true;
			}
			else{
				return false;
			}
		}

		public function viewusers(){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			$data['users'] = $this->User_model->view_users();
			$data['title'] = "test";
			$this->load->view('templates/header');
			$this->load->view('users/view', $data);
			$this->load->view('templates/footer');			
			}
		}

		public function viewuser($id){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			$data['users'] = $this->User_model->view_user($id);
			$data['title'] = "Edit user";
			$this->form_validation->set_rules('firstName', 'FirstName', 'required');
            $this->form_validation->set_rules('lastName', 'LastName', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('roles', 'Roles', 'required');
			$this->load->view('templates/header');
			$this->load->view('users/edit', $data);
			$this->load->view('templates/footer');
			}			
		}

		public function deleteuser($id){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			$data['users'] = $this->User_model->delete_user($id);
			redirect('tickets');
			}			
		}
			public function edituser(){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			$data['users'] = $this->User_model->edit_user();
			redirect('tickets');
			}			
		}
		public function search(){
            $form_data = $this->input->post('keyword');
            $data['users'] = $this->User_model->search_users($form_data);
            //if the data post is empty, redirect to posts.
            if(empty($data['users'])){
                redirect('tickets');
            }   
            //load page with data
			$data['title']= 'Users Found';
            $this->load->view('templates/header');
			$this->load->view('users/view', $data);
			$this->load->view('templates/footer');

        }
	}
