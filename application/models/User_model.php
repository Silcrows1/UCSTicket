<?php
	class User_model extends CI_model{
		public function register($enc_password){
			$data = array(
				'FirstName' => $this->input->post('fname'),
				'LastName' => $this->input->post('lname'),
				'email' => $this->input->post('email'),
				'department' => $this->input->post('dept'),
				'password' => $enc_password
			);
			return $this->db->insert('users', $data);
		}
		//login User
		public function login($email, $password){
			//validate
			$this->db->where('email', $email);
			$this->db->where('password', $password);

			$result=$this->db->get('users');

			if($result->num_rows()==1){
				return $result->row(0);
			}
			else{
				return false;
			}
		}
		//check email is not already taken
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		public function view_users(){
			$userlist = $this->db->get('users');
			return $userlist->result_array();
		}
		public function view_user($id){
			$this->db->from('users');
			$this->db->where('users.id', $id);
			$userfind = $this->db->get();


			return $userfind->result_array();
		}
		public function delete_user($id){
			$this->db->where('id', $id);
			$this->db->delete('users');
			return true;
		}
		public function edit_user(){
			$data =array(
            'id' => $this->input->post('id'),
            'FirstName' => $this->input->post('firstName'),
            'LastName' => $this->input->post('lastName'),
			'department' => $this->input->post('department'),
            'Email'=> $this->input->post('email'),
			'roles'=> $this->input->post('roles')
			);
			//where id=db id, set(update) entry with new variables
			$this->db->where('id', $this->input->post('id'));
			$this->db->set($data);
			return $this->db->update('users', $data);
		}
		
	}
