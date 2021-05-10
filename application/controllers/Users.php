<?php
	Class Users extends CI_Controller{
		public function register(){
		//remove flash message
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
			//convert form post password to MD5 to compare against the database.
				$enc_password = md5($this->input->post('password'));

				//send form data and new converted password to register function
				$this->User_model->register($enc_password);

				redirect('users/login');
			}
		}

		//login user function
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

				//create variable for all replied that match email and password
				$user_id = $this->User_model->login($email, $password);
				
				//if user_ID contains one row, set data to user_array.
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

				//set user_data to session data
				$this->session->set_userdata($user_data);
				redirect('tickets');				
				}
				else{
				//flash data for login failed and redirect to login
				$this->session->set_flashdata('login_failed', 'Login is invalid');
				redirect('users/login');
				}
			}
		}

		//log out function
		public function logout(){
		//unset all data and redirect to login
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('email');
			$this->session->sess_destroy();
			redirect('users/login');
		}

		//check if email exists function
		public function check_email_exists($email){
			//create form validation if duplication email check returns true.
			$this->form_validation->set_message('check_email_exists','That email is already taken, please try logging in.');
			if($this->User_model->check_email_exists($email))
			{
				return true;
			}
			else{
				return false;
			}
		}

		//view all users function
		public function viewusers(){
			//check if user is an admin, if not, redirect.
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			//retrieve all users
			$data['users'] = $this->User_model->view_users();
			$data['title'] = "All users";
			$this->load->view('templates/header');
			$this->load->view('users/view', $data);
			$this->load->view('templates/footer');			
			}
		}
		//view a single for editing user
		public function viewuser($id){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			//retireve user details
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

		//delete single user
		public function deleteuser($id){
		//check if user is an admin, if not, redirect.
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			//delete user that matches the ID.
			$this->User_model->delete_user($id);
			redirect('tickets');
			}			
		}

		//edit user function
		public function edituser(){
		//check if user is an admin, if not, redirect.
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			//if a password in put in the form, convert the password to MD5. and send to edit user.
			if ($this->input->post('password') != NULL){
				$enc_password = md5($this->input->post('password'));
				$data['users'] = $this->User_model->edit_user($enc_password);
			}
			//Send basic information without MD5 password
			else{
				$data['users'] = $this->User_model->edit_user();
			}			
			redirect('tickets');
			}			
		}

		//search users functrion
		public function search(){
			//store search keyword 
            $form_data = $this->input->post('keyword');
			//send keyword to retrieve all users that match.
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
