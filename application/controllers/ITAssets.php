<?php 
	class ITAssets extends CI_Controller{
		public function viewassets(){
			$data['title'] = "Assets";
			$data['assets'] = $this->ITAsset_model->viewassets();

			$this->load->view('templates/header');
			$this->load->view('assets/view', $data);
			$this->load->view('templates/footer');
		}
		public function deleteasset($id){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			$data['assets'] = $this->ITAsset_model->delete_asset($id);
			redirect('tickets');
			}			
		}
		public function create(){		
			$data['title']='Create Asset';
			//form validation for sign up page
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('type','Type','required');
			$this->form_validation->set_rules('room','Room','required');

			if($this->form_validation->run()===FALSE){
				$this->load->view('templates/header');
				$this->load->view('assets/create', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				$this->ITAsset_model->create();

				redirect('tickets');
			}
		}
		public function viewasset($id){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			$data['assets'] = $this->ITAsset_model->view_asset($id);
			$data['title'] = "Edit Asset";
			$this->form_validation->set_rules('firstName', 'FirstName', 'required');
            $this->form_validation->set_rules('lastName', 'LastName', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('roles', 'Roles', 'required');
			$this->load->view('templates/header');
			$this->load->view('assets/edit', $data);
			$this->load->view('templates/footer');
			}			
		}
		public function edit(){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			$data['users'] = $this->ITAsset_model->edit_asset();
			redirect('tickets');
			}	
		}
}
