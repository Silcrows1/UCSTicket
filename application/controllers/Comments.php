<?php
	class Comments extends CI_Controller{

		//Create comment function
		public function create_comments($id = FALSE){
			//Set var to save ticket id.
			$data['id']=$id;
			$this->form_validation->set_rules('body','Body','required');
			$this->form_validation->set_rules('type', 'Type'.'required'); 

			if($this->form_validation->run()===FALSE){
				$this->load->view('templates/header');
				$this->load->view('comments/create', $data);
				$this->load->view('templates/footer');
			}
			else{
				//send data to create comment
				$this->Comment_model->createComment();
			
				redirect('tickets');
			}
		}
		//Delete comment thread function (mass delete comments when deleting a ticket)
		public function deletethread($id){
			//if user isnt an Admin, redirect to tickets.
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			//delete comment thread that matches ID.
			$data['ticket'] = $this->Comment_model->deletecommentthread($id);
			redirect('tickets');
			}	
		}
		//Delete single comment function
		public function delete($id){
			//if user isnt an Admin or staff, redirect to tickets (this allows for more roles to be created in the future).
			if ($this->session->userdata('Role')!='Admin' && $this->session->userdata('Role')!='Staff')
			{
				redirect('tickets');
			}
			else
			{
			//delete comment that matches the ID.
			$data['users'] = $this->Comment_model->deletecomment($id);
			redirect('tickets');
			}			
		}		

	}




