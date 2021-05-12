<?php
class Ticket_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }

	//view all tickets function
	public function get_tickets($archived = false){
		//if not looked for archived, retrieve all open tickets
		if ($archived == FALSE){
			$this->db->order_by("created_at", "DESC");
            $query = $this->db->get_where('tickets', array('status' => 'Open'));
            return $query->result_array();  
			}
			//retrieve all closed tickets
			else {
			$this->db->order_by("created_at", "DESC");
			$query = $this->db->get_where('tickets', array('status' => 'Closed'));
			return $query->result_array();
			}
	}

	//Get assigned tickets to each user
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

	//view specific ticket by ID
	public function view_ticket($id){
		$this->db->select("*, users.id AS 'userid', tickets.id as 'ticketid'");
		$this->db->join('users', 'users.id = tickets.user_id');
		$query = $this->db->get_where('tickets', array('tickets.id' => $id));

		if ($query->num_rows()==0){
			$this->db->select("*, users.id AS 'userid', tickets.id as 'ticketid'");
			//If user isnt found, set to admin user.
			//user.id 15 is the current admin id and should be changed.
			$this->db->join('users', 'users.id = 15');
			$query = $this->db->get_where('tickets', array('tickets.id' => $id));
			return $query->result_array();
		}
		else{
		return $query->result_array();
		}
	}

	//Edit technicaltickets
	public function editT($id){	
		//get new array details
		$data = array(
			'title' => $this->input->post('title'),
			'body' => $this->input->post('description'),
			'raisedBy' => $this->input->post('raisedby'),
			'ticketType' => 'Technical',
		);
		//find ticket and insert new details into database
		$this->db->where('tickets.id', $id);
		$this->db->update('tickets', $data);
		//Store ID details of the last updated entry
		$data = $id;
		//retrieve asset types id from createT into an array.
		$values[] = $this->input->post('assettype');
		//remove old assets that match the ticketid.
		$this->db->from('assetsaffected');
		$this->db->select('*');
		$this->db->where('assetsaffected.ticketid', $id);
		$this->db->delete('assetsaffected');
		//count how many assets for loop if variable is not null.
		if ($_POST['assettype']!=NULL){
			$length = count($_POST['assettype']);
			//combine ticket id with assetit for assetsaffected.
				for($i=0; $i < $length; $i++){		
					$affected = array(
						'ticketid' => $data,
						'assetid' => $values[0][$i],				
					);			
					//insert each entry into assetsaffected
					$this->db->insert('assetsaffected', $affected);
				}	
					//set all new entries
					$this->db->set($affected);
		}
		
		//retrieve users to assign to from createT into an array.
		$assigned[] = $this->input->post('assigned');
		//delete all ticketsassigned for this ticket
		$this->db->from('ticketsassigned');
		$this->db->select('*');
		$this->db->where('ticketsassigned.ticketid', $id);
		$this->db->delete('ticketsassigned');
		//Count length of users assigned.
		$length = count($_POST['assigned']);
		//count how many assets for loop if variable is not null.
		if ($_POST['assigned']!=NULL)
		{
			$length = count($_POST['assigned']);
			//combine ticket id with userid for ticketsassigned.
				for($i=0; $i < $length; $i++){		
					$assignedtickets = array(
						'ticketid' => $data,
						'userid' => $assigned[0][$i],				
					);	
					//insert each entry into assetsaffected
					$this->db->insert('ticketsassigned', $assignedtickets);
				}
				//set all new entries
				$this->db->set($assignedtickets);
		}			
		//retrieve users to assign to from createT.
		$campusassigned[] = $this->input->post('campus');
		//delete all campusassigned for this ticket
		$this->db->from('campusassigned');
		$this->db->select('*');
		$this->db->where('campusassigned.ticketid', $id);
		$this->db->delete('campusassigned');
		//count how many assets for loop if variable is not null.
		if ($this->input->post('campus')!= NULL){
			$campus[] = $this->input->post('campus');
			$length = count($_POST['campus']);
			//combine ticket id with campus for campusassigned.
			for($i=0; $i < $length; $i++){		
				$assignedcampus = array(
					'ticketid' => $data,
					'campus' => $campus[0][$i],				
				);
				//insert each entry into assetsaffected
				$this->db->insert('campusassigned', $assignedcampus);
			}
			//set all new entries
			$this->db->set($assignedcampus);
		}
	}
	

		//EDIT FUNCTION
		public function editG($id){
	
			//get new array details
			$data = array(
				'title' => $this->input->post('title'),
				'body' => $this->input->post('description'),
				'raisedBy' => $this->input->post('raisedby'),
				'ticketType' => 'General',
			);
			//find ticket and insert new details into database
			$this->db->where('tickets.id', $id);
			$this->db->update('tickets', $data);
			//Store ID details of the last updated entry
			$data = $id;
			//retrieve asset types id from createG into an array.
			$values[] = $this->input->post('assettype');		
			//retrieve users to assign to from createT.
			$assigned[] = $this->input->post('assigned');
			//if no user is assigned after the edit, delete previous entries.
			$this->db->from('ticketsassigned');
			$this->db->select('*');
			$this->db->where('ticketsassigned.ticketid', $id);
			$this->db->delete('ticketsassigned');
			//count how many users assigned for loop if variable is not null.
			$length = count($_POST['assigned']);
			if ($_POST['assigned']!=NULL)
			{
				$length = count($_POST['assigned']);
				//combine ticket id with userid for ticketsassigned.
					for($i=0; $i < $length; $i++){		
						$assignedtickets = array(
							'ticketid' => $data,
							'userid' => $assigned[0][$i],				
						);
						//insert each entry into ticketsassigned
						$this->db->insert('ticketsassigned', $assignedtickets);
					}
					//set all new entries
			}	
		
			//retrieve campuses to assign to from createT.
			$campusassigned[] = $this->input->post('campus');
			//if ticket isnt assigned a campus, then remove any previous linked
			$this->db->from('campusassigned');
			$this->db->select('*');
			$this->db->where('campusassigned.ticketid', $id);
			$this->db->delete('campusassigned');
			//count how many assets for loop if variable is not null.
				if ($this->input->post('campus')!= NULL){
					$campus[] = $this->input->post('campus');
					$length = count($_POST['campus']);
					//combine ticket id with campus for campusassigned.
					for($i=0; $i < $length; $i++){		
						$assignedcampus = array(
							'ticketid' => $data,
							'campus' => $campus[0][$i],				
						);
						//insert each entry into campusaffected
						$this->db->insert('campusassigned', $assignedcampus);
					}
					//set all new entries
					$this->db->set($assignedcampus);
				}
			}
				

		//create technical ticket		
		public function createT()
		{
			//store form data in an array.
			$data = array(
				'title' => $this->input->post('title'),
				'body' => $this->input->post('description'),
				'raisedBy' => $this->input->post('raisedby'),
				'user_id'=> $this->session->userdata['user_id'],
				'ticketType' => 'Technical',
			);
			//insert ticket into database
			$this->db->insert('tickets', $data);
			//retrieve ticket id of inserted ticket.
			$data2 = $this->db->insert_id(); 
			//delete all previous assetsaffected that were linked.
			$this->db->from('assetsaffected');
			$this->db->select('*');
			$this->db->where('assetsaffected.ticketid', $data2);
			$this->db->delete('assetsaffected');
			//count how many assets for loop if variable is not null.
			if ($this->input->post('assettype')!= NULL)
			{
				$values[] = $this->input->post('assettype');
				$length = count($_POST['assettype']);
				//combine ticket id with assetit for assetsaffected.
					for($i=0; $i < $length; $i++)
					{		
						$affected = array(
							'ticketid' => $data2,
							'assetid' => $values[0][$i],				
						);
						//insert arrays for assets affected
						$this->db->insert('assetsaffected', $affected);
					}
			}	
			//count how many users assigned for loop if variable is not null.
			if ($this->input->post('assigned')!= NULL){
				$assigned[] = $this->input->post('assigned');
				$length = count($_POST['assigned']);
				var_dump($assigned);
				var_dump($data2);
				//combine ticket id with userid for ticketsassigned.
				for($i=0; $i < $length; $i++){		
					$assignedtickets = array(
						'ticketid' => $data2,
						'userid' => $assigned[0][$i],				
					);	
					var_dump($assignedtickets);
					//insert each entry into assetsaffected
					$this->db->insert('ticketsassigned', $assignedtickets);
				}
				//set all new entries
			}		
			//count how many campus are assigned to the ticket for loop if variable is not null.
			if ($this->input->post('campus')!= NULL){
				$campus[] = $this->input->post('campus');
				$length = count($_POST['campus']);
				//combine ticket id with userid for ticketsassigned.
				for($i=0; $i < $length; $i++){		
					$assignedcampus = array(
						'ticketid' => $data2,
						'campus' => $campus[0][$i],				
					);
					//insert each entry into campusassigned
					$this->db->insert('campusassigned', $assignedcampus);
				}
				//set all new entries
			}				
		}

	public function createG(){	
		//load form data into an array		
		$data = array(
			'title' => $this->input->post('title'),
			'body' => $this->input->post('description'),
			'raisedBy' => $this->input->post('raisedby'),
			'user_id'=> $this->session->userdata['user_id'],
			'ticketType' => 'General',
		);
		//insert ticket into database
		$this->db->insert('tickets', $data);
		//retrieve ticket id of inserted ticket.
		$data = $this->db->insert_id(); 			
		//count how many users are assigned to the ticket for loop if variable is not null.
		if ($this->input->post('assigned')!= NULL){
			$assigned[] = $this->input->post('assigned');
			$length = count($_POST['assigned']);
			//combine ticket id with userid for ticketsassigned.
			for($i=0; $i < $length; $i++){		
				$assignedtickets = array(
					'ticketid' => $data,
					'userid' => $assigned[0][$i],				
				);
				//insert each entry into ticketsassigned
				$this->db->insert('ticketsassigned', $assignedtickets);
			}
			//set all new entries
		}	
		//count how many campus are assigned to the ticket for loop if variable is not null.
		if ($this->input->post('campus')!= NULL){
			$campus[] = $this->input->post('campus');
			$length = count($_POST['campus']);
			//combine ticket id with userid for ticketsassigned.
			for($i=0; $i < $length; $i++){		
				$assignedcampus = array(
					'ticketid' => $data,
					'campus' => $campus[0][$i],				
				);	
				//insert each entry into campusassigned
				$this->db->insert('campusassigned', $assignedcampus);
			}	
		}
		}

	//search all tickets with a status keyword function
	public function search_tickets_status($keyword){	
        $this->db->from('tickets');            
        $this->db->select('tickets.id, tickets.created_at, tickets.user_id, tickets.raisedBy, tickets.title, tickets.status, tickets.body, tickets.ticketType');
		$this->db->join('campusassigned', 'campusassigned.ticketid = tickets.id');
        $this->db->WHERE('campusassigned.campus',$keyword);
		$this->db->WHERE('tickets.status !=','Closed');
		$this->db->order_by("created_at", "DESC");
        $query = $this->db->get();

        return $query->result_array();			
    }

	//search all tickets with keyword function		
	public function search_tickets($keyword){	
        $this->db->from('tickets');            
        $this->db->select('*');
        $this->db->like('tickets.title', $keyword);
        $this->db->or_like('tickets.body',$keyword);
		$this->db->or_like('tickets.raisedBy',$keyword);
        $this->db->or_like('tickets.status',$keyword);
        $query = $this->db->get();
        return $query->result_array();			
    }

	//search all tickets by type keyword function	
	public function search_tickets_type($keyword){	
        $this->db->from('tickets');            
        $this->db->select('*');
        $this->db->where('tickets.ticketType',$keyword);
        $query = $this->db->get();
        return $query->result_array();			
		}

	//delete ticket that matches the id.
	public function deleteticket($id){
		$this->db->where('id', $id);
		$this->db->delete('tickets');
		return true;
	}

	//get ticket from campusassigned that matches the ID.
	public function campusassigned($id){
		$this->db->from('campusassigned');
		$this->db->where('campusassigned.ticketid', $id);
		$userfind = $this->db->get();

		return $userfind->result_array();
	}
	
}

