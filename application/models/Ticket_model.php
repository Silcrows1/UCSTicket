<?php
class Ticket_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }
	//view all tickets function
	public function get_tickets($archived = false){
		if ($archived == FALSE){
			$this->db->order_by("created_at", "DESC");
            $query = $this->db->get_where('tickets', array('status' => 'Open'));
            return $query->result_array();  
			}
			else {
			$this->db->order_by("created_at", "DESC");
			$query = $this->db->get_where('tickets', array('status' => 'Closed'));
			return $query->result_array();
			}
	}
	//get assigned tickets to each user
	public function getassignedtickets($id){
		$this->db->order_by("created_at", "DESC");
		$this->db->select('*');
		$this->db->join('tickets', 'tickets.id = ticketsassigned.ticketid ');
		$this->db->where('tickets.status !=', 'Closed');
        $query = $this->db->get_where('ticketsassigned', array('userid' => $id));
        return $query->result_array();  			
	}
	//count total tickets
	public function count(){
		$query = $this->db->get('tickets')->num_rows();
	}
	//view specific ticket
	public function view_ticket($id){
		$this->db->select("*, users.id AS 'userid', tickets.id as 'ticketid'");
		$this->db->join('users', 'users.id = tickets.user_id');
		$query = $this->db->get_where('tickets', array('tickets.id' => $id));
		return $query->result_array();
	}
	//Edit technical tickets
	public function editT($id){
	
		//get new array details
		$data = array(
			'title' => $this->input->post('title'),
			'body' => $this->input->post('description'),
			'raisedBy' => $this->input->post('raisedby'),
			'user_id'=> $this->session->userdata['user_id'],
			'ticketType' => 'Technical',
		);
		//find ticket and insert new details into database
		$this->db->where('tickets.id', $id);
		$this->db->update('tickets', $data);

		//retrieve ticket details to get ticket id.
		$this->db->from('tickets');
		$this->db->select('tickets.id');
		$this->db->where('tickets.title', $data['title']);
        $this->db->where('tickets.body', $data['body']);
		$this->db->where('tickets.user_id', $data['user_id']);
		$query = $this->db->get();

		$datanew = $query->result_array();
		$data = array_column($datanew, 'id');

		//retrieve asset types id from createT.
		$values[] = $this->input->post('assettype');

		//remove old assets
		$this->db->from('assetsaffected');
		$this->db->select('*');
		$this->db->where('assetsaffected.ticketid', $id);
		$this->db->delete('assetsaffected');

		//count how many assets for loop if variable is not null.
		if ($_POST['assettype']!=NULL){
			$length = count($_POST['assettype']);
			var_dump($length);
			//combine ticket id with assetit for assetsaffected.
				for($i=0; $i < $length; $i++){		
					$affected = array(
						'ticketid' => $data[0],
						'assetid' => $values[0][$i],				
					);			

					$this->db->insert('assetsaffected', $affected);
				}			
					$this->db->set($affected);
		}
		
		//retrieve users to assign to from createT.
		$assigned[] = $this->input->post('assigned');
		var_dump($assigned);
		//if ticket isnt assigned a user, then do not enter an entry in ticketassigned
		$this->db->from('ticketsassigned');
		$this->db->select('*');
		$this->db->where('ticketsassigned.ticketid', $id);
		$this->db->delete('ticketsassigned');
		
		$length = count($_POST['assigned']);

		if ($_POST['assigned']!=NULL)
		{
			$length = count($_POST['assigned']);
			var_dump($length);{
			//combine ticket id with userid for ticketsassigned.
				for($i=0; $i < $length; $i++){		
					$assignedtickets = array(
						'ticketid' => $data[0],
						'userid' => $assigned[0][$i],				
					);	
					$this->db->insert('ticketsassigned', $assignedtickets);
				}	
				$this->db->set($assignedtickets);
		}	
		
		//retrieve users to assign to from createT.
		$campusassigned[] = $this->input->post('campus');

		//if ticket isnt assigned a campus, then do not enter a campus
		$this->db->from('campusassigned');
		$this->db->select('*');
		$this->db->where('campusassigned.ticketid', $id);
		$this->db->delete('campusassigned');

		if ($this->input->post('campus')!= NULL){

			$campus[] = $this->input->post('campus');
			$length = count($_POST['campus']);

			//combine ticket id with userid for ticketsassigned.
			for($i=0; $i < $length; $i++){		
				$assignedcampus = array(
					'ticketid' => $data[0],
					'campus' => $campus[0][$i],				
				);	
				$this->db->insert('campusassigned', $assignedcampus);
			}	
			$this->db->set($assignedcampus);
		}
	}
	}

		//EDIT FUNCTION
		public function editG($id){
	
		//get new array details
		$data = array(
			'title' => $this->input->post('title'),
			'body' => $this->input->post('description'),
			'raisedBy' => $this->input->post('raisedby'),
			'user_id'=> $this->session->userdata['user_id'],
			'ticketType' => 'General',
		);
		//find ticket and insert new details into database
		$this->db->where('tickets.id', $id);
		$this->db->update('tickets', $data);

		//retrieve ticket details to get ticket id.
		$this->db->from('tickets');
		$this->db->select('tickets.id');
		$this->db->where('tickets.title', $data['title']);
        $this->db->where('tickets.body', $data['body']);
		$this->db->where('tickets.user_id', $data['user_id']);
		$query = $this->db->get();

		$datanew = $query->result_array();
		$data = array_column($datanew, 'id');

		//retrieve asset types id from createT.
		$values[] = $this->input->post('assettype');

		
		
		//retrieve users to assign to from createT.
		$assigned[] = $this->input->post('assigned');
		var_dump($assigned);
		//if ticket isnt assigned a user, then do not enter an entry in ticketassigned
		$this->db->from('ticketsassigned');
		$this->db->select('*');
		$this->db->where('ticketsassigned.ticketid', $id);
		$this->db->delete('ticketsassigned');
		
		$length = count($_POST['assigned']);

		if ($_POST['assigned']!=NULL)
		{
			$length = count($_POST['assigned']);
			var_dump($length);{
			//combine ticket id with userid for ticketsassigned.
				for($i=0; $i < $length; $i++){		
					$assignedtickets = array(
						'ticketid' => $data[0],
						'userid' => $assigned[0][$i],				
					);	
					$this->db->insert('ticketsassigned', $assignedtickets);
				}	
				$this->db->set($assignedtickets);
		}	
		
		//retrieve users to assign to from createT.
		$campusassigned[] = $this->input->post('campus');

		//if ticket isnt assigned a campus, then do not enter a campus
		$this->db->from('campusassigned');
		$this->db->select('*');
		$this->db->where('campusassigned.ticketid', $id);
		$this->db->delete('campusassigned');

		if ($this->input->post('campus')!= NULL){

			$campus[] = $this->input->post('campus');
			$length = count($_POST['campus']);

			//combine ticket id with userid for ticketsassigned.
			for($i=0; $i < $length; $i++){		
				$assignedcampus = array(
					'ticketid' => $data[0],
					'campus' => $campus[0][$i],				
				);	
				$this->db->insert('campusassigned', $assignedcampus);
			}	
			$this->db->set($assignedcampus);
		}
	}
	}


		//create technical ticket		
		public function createT(){
	
		$data = array(
			'title' => $this->input->post('title'),
			'body' => $this->input->post('description'),
			'raisedBy' => $this->input->post('raisedby'),
			'user_id'=> $this->session->userdata['user_id'],
			'ticketType' => 'Technical',
		);
		//insert ticket into database
		$this->db->insert('tickets', $data);

		//retrieve ticket details to get ticket id.
		$id = $this->db->insert_id();
		$this->db->from('tickets');
		$this->db->select('tickets.id');
		$this->db->where('tickets.id', $id);

		$query = $this->db->get();

		$datanew = $query->result_array();
		$data = array_column($datanew, 'id');

		//if no asset type selected, then do not enter an entry in assetsaffected.
		$this->db->from('assetsaffected');
		$this->db->select('*');
		$this->db->where('assetsaffected.ticketid', $id);
		$this->db->delete('assetsaffected');

		if ($this->input->post('assettype')!= NULL){
			$values[] = $this->input->post('assettype');
			$length = count($_POST['assettype']);

			//combine ticket id with assetit for assetsaffected.
				for($i=0; $i < $length; $i++){		
					$affected = array(
						'ticketid' => $data[0],
						'assetid' => $values[0][$i],				
					);
					//insert arrays for assets affected
					$this->db->insert('assetsaffected', $affected);
				}	
		}
	
		//if ticket isnt assigned a user, then do not enter an entry in ticketassigned

		if ($this->input->post('assigned')!= NULL){

			$assigned[] = $this->input->post('assigned');
			$length = count($_POST['assigned']);

			//combine ticket id with userid for ticketsassigned.
			for($i=0; $i < $length; $i++){		
				$assignedtickets = array(
					'ticketid' => $data[0],
					'userid' => $assigned[0][$i],				
				);	
				$this->db->insert('ticketsassigned', $assignedtickets);
			}	
		}
		
		//if ticket isnt assigned a campus, then do not enter a campus


		if ($this->input->post('campus')!= NULL){

			$campus[] = $this->input->post('campus');
			$length = count($_POST['campus']);

			//combine ticket id with userid for ticketsassigned.
			for($i=0; $i < $length; $i++){		
				$assignedcampus = array(
					'ticketid' => $data[0],
					'campus' => $campus[0][$i],				
				);	
				$this->db->insert('campusassigned', $assignedcampus);
			}	
		}
				
	}
	public function createG(){	
				
		$data = array(
			'title' => $this->input->post('title'),
			'body' => $this->input->post('description'),
			'raisedBy' => $this->input->post('raisedby'),
			'user_id'=> $this->session->userdata['user_id'],
			'ticketType' => 'General',
		);
		//insert ticket into database
		$this->db->insert('tickets', $data);

		//retrieve ticket details to get ticket id.
		$id = $this->db->insert_id();
		$this->db->from('tickets');
		$this->db->select('tickets.id');
		$this->db->where('tickets.id', $id);

		$query = $this->db->get();

		$datanew = $query->result_array();
		$data = array_column($datanew, 'id');

			
		//if ticket isnt assigned a user, then do not enter an entry in ticketassigned

		if ($this->input->post('assigned')!= NULL){

			$assigned[] = $this->input->post('assigned');
			$length = count($_POST['assigned']);

			//combine ticket id with userid for ticketsassigned.
			for($i=0; $i < $length; $i++){		
				$assignedtickets = array(
					'ticketid' => $data[0],
					'userid' => $assigned[0][$i],				
				);	
				$this->db->insert('ticketsassigned', $assignedtickets);
			}	
		}
		
		//if ticket isnt assigned a campus, then do not enter a campus


		if ($this->input->post('campus')!= NULL){

			$campus[] = $this->input->post('campus');
			$length = count($_POST['campus']);

			//combine ticket id with userid for ticketsassigned.
			for($i=0; $i < $length; $i++){		
				$assignedcampus = array(
					'ticketid' => $data[0],
					'campus' => $campus[0][$i],				
				);	
				$this->db->insert('campusassigned', $assignedcampus);
			}	
		}
		}


	public function search_tickets_status($keyword){	
	    //creating query with CI query builder, joining categories and posts table and building query that looks for a keyword
        //in posts body and title and comments name and body.
        $this->db->from('tickets');            
        $this->db->select('tickets.id, tickets.created_at, tickets.user_id, tickets.raisedBy, tickets.title, tickets.status, tickets.body, tickets.ticketType');
		$this->db->join('campusassigned', 'campusassigned.ticketid = tickets.id');
        $this->db->WHERE('campusassigned.campus',$keyword);
		$this->db->WHERE('tickets.status !=','Closed');
		$this->db->order_by("created_at", "DESC");
        $query = $this->db->get();

        return $query->result_array();			
    }
		
	public function search_tickets($keyword){	
	    //creating query with CI query builder, joining categories and posts table and building query that looks for a keyword
        //in posts body and title and comments name and body.
        $this->db->from('tickets');            
        $this->db->select('*');
        $this->db->like('tickets.title', $keyword);
        $this->db->or_like('tickets.body',$keyword);
		$this->db->or_like('tickets.raisedBy',$keyword);
        $this->db->or_like('tickets.status',$keyword);
        $query = $this->db->get();
        return $query->result_array();			
    }
		
	public function search_tickets_type($keyword){	
	    //creating query with CI query builder, joining categories and posts table and building query that looks for a keyword
        //in posts body and title and comments name and body.
        $this->db->from('tickets');            
        $this->db->select('*');
        $this->db->where('tickets.ticketType',$keyword);
        $query = $this->db->get();
        return $query->result_array();			
		}

	public function deleteticket($id){
		$this->db->where('id', $id);
		$this->db->delete('tickets');
		return true;
	}

	public function campusassigned($id){
		$this->db->from('campusassigned');
		$this->db->where('campusassigned.ticketid', $id);
		$userfind = $this->db->get();

		return $userfind->result_array();
	}
	
}

