<?php
class ITAsset_model extends CI_model{
		public function viewassets(){
				$query = $this->db->get('assets');
				return $query->result_array();    
		}
		public function assetcount(){
		$query = $this->db->get('assets')->num_rows();
		  
		}
		public function delete_asset($id){
			$this->db->where('id', $id);
			$this->db->delete('assets');
			return true;
		}
		public function deleteticketassets($id){
			$this->db->where('ticketid', $id);
			$this->db->delete('assetsaffected');
			return true;
		}
		public function create(){
			$data = array(
				'AssetName' => $this->input->post('name'),
				'AssetType' => $this->input->post('type'),
				'AssetRoom' => $this->input->post('room'),
			);
			return $this->db->insert('assets', $data);
		}
		public function view_asset($id){
			$this->db->from('assets');
			$this->db->where('assets.id', $id);
			$assetfind = $this->db->get();
			return $assetfind->result_array();
		}
		public function edit_asset(){
			$data =array(
            'AssetName' => $this->input->post('AssetName'),
            'AssetType' => $this->input->post('AssetType'),
            'AssetRoom' => $this->input->post('AssetRoom'),
			);
			//where id=db id, set(update) entry with new variables
			$this->db->where('id', $this->input->post('id'));
			$this->db->set($data);
			return $this->db->update('assets', $data);
		}
		public function search_assets($keyword){			
            //creating query with CI query builder, joining categories and posts table and building query that looks for a keyword
            //in posts body and title and comments name and body.
            $this->db->from('assets');            
            $this->db->select('*');
            $this->db->like('assets.AssetName', $keyword);
            $this->db->or_like('assets.AssetType',$keyword);
            $this->db->or_like('assets.AssetRoom',$keyword);
            $query = $this->db->get();
			$str = $this->db->last_query();
            return $query->result_array();			
        }
		public function view_assets_ticket($id){

			$this->db->join('assets', 'assets.id = assetsaffected.assetid','left');
			$this->db->select('*');
			$query=$this->db->get_where('assetsaffected', array('assetsaffected.ticketid' => $id));
            return $query->result_array();
		}
		public function view_other_assets_ticket($id){
		$this->db->select('*');
		$this->db->from('assetsaffected');
		$this->db->join('assets', 'assets.id = assetsaffected.assetid');
		$this->db->where('assets.id =', $id);
		$query =$this->db->get();
		$query->result_array();	


		return $query->result_array();	

		 $str = $this->db->last_query();
		 print_r($str);
		return $query->result_array();
		}
	}
