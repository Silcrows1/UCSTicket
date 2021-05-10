<?php
	class Comments extends CI_Controller{

		public function get_comments($id){
			$data['title'] = "Comments";
			$data['assets'] = $this->Comment_model->viewcomments();

			$this->load->view('templates/header');
			$this->load->view('assets/view', $data);
			$this->load->view('templates/footer');
		}

		public function create_comments($id = FALSE){	
			$data['id']=$id;
			$this->form_validation->set_rules('body','Body','required');
			$this->form_validation->set_rules('type', 'Type'.'required'); 

			if($this->form_validation->run()===FALSE){
				$this->load->view('templates/header');
				$this->load->view('comments/create', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				$this->Comment_model->createComment();
			
				redirect('tickets');
			}
		}

		public function deletethread($id){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			$data['ticket'] = $this->Comment_model->deletecommentthread($id);
			redirect('tickets');
			}	
		}
		public function delete($id){
			if ($this->session->userdata('Role')!='Admin' && $this->session->userdata('Role')!='Staff')
			{
				redirect('tickets');
			}
			else
			{
			$data['users'] = $this->Comment_model->deletecomment($id);
			redirect('tickets');
			}			
		}		

	}




