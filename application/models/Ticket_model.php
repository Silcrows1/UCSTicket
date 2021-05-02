<?php
class Ticket_model extends CI_model{
    public function __construct(){
        $this->load->database();
    }
	public function get_tickets(){
			$this->db->order_by('id');
            $query = $this->db->get('tickets');
            return $query->result_array();    
	}

	public function view_ticket($id){
		$query = $this->db->get_where('tickets', array('id' => $id));
		return $query->result_array();
	}

	}
