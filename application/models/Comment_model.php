<?php
	class Comment_model extends CI_Model{
		//get comments and users for a single ticket.
		public function getComments($id){
			$this->db->select('*, comments.id as commentid');
			$this->db->join('users', 'users.id = comments.Staffid', 'left');
			$this->db->group_by('comments.id');
			$query = $this->db->get_where('comments', array('ticketid' => $id));
			return $query->result_array(); 
		}

		//create comment function
		public function createComment(){
		//store form information within an array
		$data = array(
			'ticketid' => $this->input->post('id'),
			'body' => $this->input->post('body'),
			'type' => $this->input->post('type'),
			'Staffid'=> $this->session->userdata['user_id'],
		);
		//if the comment type is a resolution, change the status to Closed and insert the comment
		if ($data['type']=="resolution"){
			
			$this->db->set('status', 'Closed');
			$this->db->where('id', $data['ticketid']);
			$this->db->update('tickets');
			return $this->db->insert('comments', $data);	
		}
		//Store a comment
		else{
			return $this->db->insert('comments', $data);	
		}
	}

		//delete single comment that matches the ID
		public function deletecomment($id){
			$this->db->where('id', $id);
			$this->db->delete('comments');
			return true;
		}
		
		//delete comments that share a ticketid.
		public function deletecommentthread($id){
			$this->db->where('ticketid', $id);
			$this->db->delete('comments');
			return true;
		}
	}
