<?php 
	class ITAssets extends CI_Controller{
		//View all assets function
		public function viewassets(){

			$data['title'] = "Assets";
			//request all assets
			$data['assets'] = $this->ITAsset_model->viewassets();

			$this->load->view('templates/header');
			$this->load->view('assets/view', $data);
			$this->load->view('templates/footer');			
		}
		//delete single asset
		public function deleteasset($id){
			//check user is an admin
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			//delete asset that matches the id.
			$this->ITAsset_model->delete_asset($id);
			redirect('tickets');
			}			
		}
		//create asset function
		public function create(){		
			$data['title']='Create Asset';
			//form validation for create asset page
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('type','Type','required');
			$this->form_validation->set_rules('room','Room','required');

			if($this->form_validation->run()===FALSE){
				$this->load->view('templates/header');
				$this->load->view('assets/create', $data);
				$this->load->view('templates/footer');
			}
			else{
				//create asset in model
				$this->ITAsset_model->create();

				redirect('tickets');
			}
		}
		//view single asset function (used for edits)
		public function viewasset($id){
			//if user isnt an admin, redirect.
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			//retrieve asset information and send to asset edit form.
			$data['assets'] = $this->ITAsset_model->view_asset($id);
			$data['title'] = "Edit Asset";
			//form validation for edit asset page
			$this->form_validation->set_rules('firstName', 'FirstName', 'required');
            $this->form_validation->set_rules('lastName', 'LastName', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('roles', 'Roles', 'required');
			$this->load->view('templates/header');
			$this->load->view('assets/edit', $data);
			$this->load->view('templates/footer');
			}			
		}
		//edit asset function 
		public function edit(){
			//if user isnt an admin, redirect.
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			//send form information to asset model to complete edit.
			$data['assets'] = $this->ITAsset_model->edit_asset();
			redirect('tickets');
			}	
		}
		//search assets function        
        public function search(){
			//retrieve keyword
            $form_data = $this->input->post('keyword');
			//send keyword to search function
            $data['assets'] = $this->ITAsset_model->search_assets($form_data);
            //if the data post return is empty, redirect to posts.
            if(empty($data['assets'])){
                redirect('tickets');
            }   
            //load page with data
			$data['title']= 'Assets Found';
            $this->load->view('templates/header');
			$this->load->view('assets/view', $data);
			$this->load->view('templates/footer');

        }
}
