<?php
class ITAsset_model extends CI_model{
		public function viewassets(){
				$query = $this->db->get('assets');
				return $query->result_array();    
		}
		public function delete_asset($id){
			$this->db->where('id', $id);
			$this->db->delete('assets');
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
	}
