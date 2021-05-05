<?php
class Ticket_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }
	//view all tickets
	public function get_tickets(){
			$this->db->order_by("created_at", "DESC");
            $query = $this->db->get('tickets');
            return $query->result_array();    
	}
	public function count(){
			$query = $this->db->get('tickets')->num_rows();
	}
	//view specific ticket
	public function view_ticket($id){
		$query = $this->db->get_where('tickets', array('id' => $id));
		return $query->result_array();
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

		//count how many assets for loop.
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
				return $this->db->set($affected);
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
		return $this->db->insert('tickets', $data);		
	}


	public function search_tickets_status($keyword){	
	    //creating query with CI query builder, joining categories and posts table and building query that looks for a keyword
        //in posts body and title and comments name and body.
        $this->db->from('tickets');            
        $this->db->select('*');
        $this->db->or_like('tickets.status',$keyword);
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
}

