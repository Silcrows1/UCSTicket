<?php
	class Tickets extends CI_Controller{
		//retrieve all tickets
		public function index(){
			$data['title'] = "Tickets";
			$data['assets'] = $this->ITAsset_model->viewassets();
			$data['tickets'] = $this->Ticket_model->get_tickets();
			$data['assigned'] = $this->Ticket_model->getassignedtickets($this->session->userdata('user_id'));

			$this->load->view('templates/header');
			//$this->load->view('templates/search');  //testing only allowing search from main index.
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');
		}

		//retrieve all tickets where status != Active.
		public function archive(){
			$data['title'] = "Archived Tickets";
			$archived ="archived";
			$data['assets'] = $this->ITAsset_model->viewassets();
			$data['tickets'] = $this->Ticket_model->get_tickets($archived);
			$data['assigned'] = $this->Ticket_model->getassignedtickets($this->session->userdata('user_id'));

			$this->load->view('templates/header');
			//$this->load->view('templates/search');  //testing only allowing search from main index.
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');
		}

		public function view($id){
			//retrieve ticket

			$data['tickets'] = $this->Ticket_model->view_ticket($id);
			//retrieve assets for the ticket
			$data['campusassigneds'] = $this->Ticket_model->campusassigned($id);
			$data['usersassigneds'] = $this->User_model->assignedusers($id);
			$data['assets'] = $this->ITAsset_model->view_assets_ticket($id);
			$data['comments'] = $this->Comment_model->getComments($id);
			$data['title'] = "test";
			$this->load->view('templates/header');
			$this->load->view('tickets/view', $data);
			$this->load->view('templates/footer');

		}
		
		public function viewassigned($id){
			$data['title'] = "Tickets Assigned to you";
			$data['tickets'] = $this->Ticket_model->getassignedtickets($id);
			$data['assigned'] = $this->Ticket_model->getassignedtickets($this->session->userdata('user_id'));

			$this->load->view('templates/header');
			//$this->load->view('templates/search');  //testing only allowing search from main index.
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');

		}

		public function delete($id){
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			$this->ITAsset_model->deleteticketassets($id);
			$this->Comment_model->deletecommentthread($id);
			$this->Ticket_model->deleteticket($id);
			redirect('tickets');
			}
		}

		public function viewtoedit($id){

		$flash=$this->session->flashdata('type');


		if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
		else
			{
			$data['campusassigneds'] = $this->Ticket_model->campusassigned($id);
			$data['assignedusers'] = $this->User_model->assignedusers($id);
			$data['users'] = $this->User_model->view_users();
			$data['tickets'] = $this->Ticket_model->view_ticket($id);
			$data['assets'] = $this->ITAsset_model->view_assets_ticket($id);
			$data['assetsrests'] = $this->ITAsset_model->viewassets();
			//$data['assetsrest'] = $this->ITAsset_model->view_other_assets_ticket($id);
			
			$data['title'] = "Edit user";
			$data['type']=$flash;
			$this->load->view('templates/header');
			$this->load->view('tickets/edit', $data);
			$this->load->view('templates/footer');			

			}			
		}
		public function editticket($id){

			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			
			if ($this->session->flashdata('type')=="General"){
				$data['ticket'] = $this->Ticket_model->editG($id);
			}else{
				$data['ticket'] = $this->Ticket_model->editT($id);
			}
			
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
			$data['users'] = $this->User_model->view_users();
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
			$data['users'] = $this->User_model->view_users();
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
		//filter search
		public function search_category(){
		    $form_data = $this->input->post('category');
			if ($form_data =='None'){
				redirect('tickets');
			}else{
            $data['tickets'] = $this->Ticket_model->search_tickets_status($form_data);
			$data['assigned'] = $this->Ticket_model->getassignedtickets($this->session->userdata('user_id'));
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
