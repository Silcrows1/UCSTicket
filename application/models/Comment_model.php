<?php
	class Comment_model extends CI_Model{
		public function getComments($id){
			$this->db->select('*, comments.id as commentid');
			$this->db->join('users', 'users.id = comments.Staffid', 'left');
			$this->db->group_by('comments.id');
			$query = $this->db->get_where('comments', array('ticketid' => $id));
			return $query->result_array(); 
		}

		public function createComment(){	
		var_dump($id);
		$data = array(
			'ticketid' => $this->input->post('id'),
			'body' => $this->input->post('body'),
			'type' => $this->input->post('type'),
			'Staffid'=> $this->session->userdata['user_id'],
		);
		//insert ticket into database
		return $this->db->insert('comments', $data);		
		}

		public function deletecomment($id){
			$this->db->where('id', $id);
			$this->db->delete('comments');
			return true;

		}
	}
