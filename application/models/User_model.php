<?php
	class User_model extends CI_model{
		//register user function
		public function register($enc_password){
			//store form data in an array
			$data = array(
				'FirstName' => $this->input->post('fname'),
				'LastName' => $this->input->post('lname'),
				'email' => $this->input->post('email'),
				'department' => $this->input->post('dept'),
				'password' => $enc_password
			);
			//insert data into a table
			return $this->db->insert('users', $data);
		}

		//login User function
		public function login($email, $password){
			//get all users that match the email and password provided
			$this->db->where('email', $email);
			$this->db->where('password', $password);
			$result=$this->db->get('users');

			//if only one result found, then return data for first entry.
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

		//view all users
		public function view_users(){
			$userlist = $this->db->get('users');
			return $userlist->result_array();
		}

		//view one user by ID.
		public function view_user($id){
			$this->db->from('users');
			$this->db->where('users.id', $id);
			$userfind = $this->db->get();

			return $userfind->result_array();
		}

		//find all users assigned to a ticket and retrieve user details.
		public function assignedusers($id){
			$this->db->from('ticketsassigned');
			$this->db->join('users', 'users.id = ticketsassigned.userid');
			$this->db->where('ticketsassigned.ticketid', $id);
			$userfind = $this->db->get();

			return $userfind->result_array();
		}

		//delete user by id
		public function delete_user($id){
			$this->db->where('id', $id);
			$this->db->delete('users');
			//delete tickets assigned when user is delete
			$this->db->where('userid', $id);
			$this->db->delete('ticketsassigned');
			
			return true;
		}

		//Edit user function
		public function edit_user($enc_password = NULL){
		//if no encoded password retrieved, store form data in an array without password
		if ($enc_password != NULL)
		{
			$data =array(
			'id' => $this->input->post('id'),
			'password' => $enc_password,
			'FirstName' => $this->input->post('firstName'),
			'LastName' => $this->input->post('lastName'),
			'department' => $this->input->post('department'),
			'Email'=> $this->input->post('email'),
			'roles'=> $this->input->post('roles')
			);			
		}
		//Store form data with encoded password
		else{
			$data =array(
            'id' => $this->input->post('id'),
            'FirstName' => $this->input->post('firstName'),
            'LastName' => $this->input->post('lastName'),
			'department' => $this->input->post('department'),
            'Email'=> $this->input->post('email'),
			'roles'=> $this->input->post('roles')
			);
		}			
		//update users table with new user information where id matches post id.
		$this->db->where('id', $this->input->post('id'));
		$this->db->set($data);
		return $this->db->update('users', $data);
		}

		//Search users with a keyword function
		public function search_users($keyword){			
            $this->db->from('users');            
            $this->db->select('*');
            $this->db->like('FirstName', $keyword);
            $this->db->or_like('LastName',$keyword);
            $this->db->or_like('roles',$keyword);
			$this->db->or_like('email',$keyword);
			$this->db->or_like('department',$keyword);
            $query = $this->db->get();
			$str = $this->db->last_query();
            return $query->result_array();			
        }		
	}
