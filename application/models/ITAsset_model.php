<?php
class ITAsset_model extends CI_model{

		//view all assets 
		public function viewassets(){
			$query = $this->db->get('assets');
			return $query->result_array();    
		}

		//count assets
		public function assetcount(){
			$query = $this->db->get('assets')->num_rows();		  
		}

		//delete asset that matches the ID.
		public function delete_asset($id){
			$this->db->where('id', $id);
			$this->db->delete('assets');
			return true;
		}

		//delete all assets from assetsaffected table that match the ticket id.
		public function deleteticketassets($id){
			$this->db->where('ticketid', $id);
			$this->db->delete('assetsaffected');
			return true;
		}

		//create asset function
		public function create(){
			$data = array(
				'AssetName' => $this->input->post('name'),
				'AssetType' => $this->input->post('type'),
				'AssetRoom' => $this->input->post('room'),
			);
			return $this->db->insert('assets', $data);
		}

		//view single asset that matches the id.
		public function view_asset($id){
			$this->db->from('assets');
			$this->db->where('assets.id', $id);
			$assetfind = $this->db->get();
			return $assetfind->result_array();
		}

		//edit asset function.
		public function edit_asset(){
			$data =array(
            'AssetName' => $this->input->post('AssetName'),
            'AssetType' => $this->input->post('AssetType'),
            'AssetRoom' => $this->input->post('AssetRoom'),
			);
			//Update asset where id matches form id.
			$this->db->where('id', $this->input->post('id'));
			$this->db->set($data);
			return $this->db->update('assets', $data);
		}

		//search assets function
		public function search_assets($keyword){	
           //search assets where the keyword is contained within Name, Type or Room.
		    $this->db->from('assets');            
            $this->db->select('*');
            $this->db->like('assets.AssetName', $keyword);
            $this->db->or_like('assets.AssetType',$keyword);
            $this->db->or_like('assets.AssetRoom',$keyword);
            $query = $this->db->get();
			$str = $this->db->last_query();
            return $query->result_array();			
        }

		//view assets affect for a single ticket.
		public function view_assets_ticket($id){
			//Join assets affected with Assets and retrieve where ID matches.
			$this->db->join('assets', 'assets.id = assetsaffected.assetid','left');
			$this->db->select('*');
			$query=$this->db->get_where('assetsaffected', array('assetsaffected.ticketid' => $id));
            return $query->result_array();
		}
	}
