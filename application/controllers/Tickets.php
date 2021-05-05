<?php
	class Tickets extends CI_Controller{
		public function index(){
			$data['title'] = "Tickets";
			$data['assets'] = $this->ITAsset_model->viewassets();
			$data['tickets'] = $this->Ticket_model->get_tickets();

			$this->load->view('templates/header');
			//$this->load->view('templates/search');  //testing only allowing search from main index.
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');
		}

		public function view($id){
			//retrieve ticket
			$data['tickets'] = $this->Ticket_model->view_ticket($id);
			//retrieve assets for the ticket
			$data['assets'] = $this->ITAsset_model->view_assets_ticket($id);
			$data['comments'] = $this->Comment_model->getComments($id);
			$data['title'] = "test";
			$this->load->view('templates/header');
			$this->load->view('tickets/view', $data);
			$this->load->view('templates/footer');

		}
		public function delete($id){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			$this->Comment_model->deletecommentthread($id);
			$this->Ticket_model->deleteticket($id);
			redirect('tickets');
			}		

		}
		// technical or general page
		public function options(){
			$this->load->view('templates/header');
			$this->load->view('tickets/options');
			$this->load->view('templates/footer');

		}
		//create technical function
		public function createT(){		
			$data['title']='Create technical ticket';
			$data['assets'] = $this->ITAsset_model->viewassets();
			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('raisedby','Raised By Name','required');
			$this->form_validation->set_rules('description','Description','required');

			if($this->form_validation->run()===FALSE){
				$this->load->view('templates/header');
				$this->load->view('tickets/technicalcreate', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				$this->Ticket_model->createT();

				redirect('tickets');
			}
		}
		public function createG(){		
			$data['title']='Create General ticket';
			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('raisedby','Raised By Name','required');
			$this->form_validation->set_rules('description','Description','required');

			if($this->form_validation->run()===FALSE){
				$this->load->view('templates/header');
				$this->load->view('tickets/generalcreate', $data);
				$this->load->view('templates/footer');
			}
			else{
				
				$this->Ticket_model->createG();

				redirect('tickets');
			}
		}
		public function search_category(){
		    $form_data = $this->input->post('category');
			if ($form_data =='None'){
				redirect('tickets');
			}else{
            $data['tickets'] = $this->Ticket_model->search_tickets_status($form_data);
            //if the data post is empty, redirect to posts.
            if(empty($data['tickets'])){
                redirect('tickets');
             }   
            //load page with data
			$data['title']= $form_data;
            $this->load->view('templates/header');
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');
			}
        }

		public function search(){
		    $form_data = $this->input->post('keyword');
            $data['tickets'] = $this->Ticket_model->search_tickets($form_data);
            //if the data post is empty, redirect to posts.
            if(empty($data['tickets'])){
                redirect('tickets');
             }   
            //load page with data
			$data['title']= 'Tickets Found';
            $this->load->view('templates/header');
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');

        }
		public function technical(){
		    $form_data = 'Technical';
            $data['tickets'] = $this->Ticket_model->search_tickets_type($form_data);
           //if the data post is empty, redirect to posts.
            if(empty($data['tickets'])){
                redirect('tickets');
             }   
            //load page with data
			$data['title']= 'Technical Tickets';
            $this->load->view('templates/header');
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');

        }
		public function general(){
		    $form_data = 'General';
            $data['tickets'] = $this->Ticket_model->search_tickets_type($form_data);
            //if the data post is empty, redirect to posts.
            if(empty($data['tickets'])){
                redirect('tickets');
             }   
            //load page with data
			$data['title']= 'General Tickets';
            $this->load->view('templates/header');
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');

        }

		
	}
