<?php
	class Tickets extends CI_Controller{
		//retrieve all tickets
		public function index(){
			$data['title'] = "Tickets";
			//retrieve assets
			$data['assets'] = $this->ITAsset_model->viewassets();
			//retrieve tickets
			$data['tickets'] = $this->Ticket_model->get_tickets();
			//retrieve assigned tickets that match user id.
			$data['assigned'] = $this->Ticket_model->getassignedtickets($this->session->userdata('user_id'));
			$this->load->view('templates/header');
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');
		}

		//retrieve all archived tickets (resolved).
		public function archive(){
			$data['title'] = "Archived Tickets";
			$archived ="archived";
			//retrieve assets
			$data['assets'] = $this->ITAsset_model->viewassets();
			//retrieve tickets
			$data['tickets'] = $this->Ticket_model->get_tickets($archived);
			//retrieve assigned tickets that match user id.
			$data['assigned'] = $this->Ticket_model->getassignedtickets($this->session->userdata('user_id'));
			$this->load->view('templates/header');
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');
		}
		//view sinle ticket
		public function view($id){
			//retrieve ticket
			$data['tickets'] = $this->Ticket_model->view_ticket($id);
			//retrieve assets for the ticket
			$data['campusassigneds'] = $this->Ticket_model->campusassigned($id);
			//retrieve assigned users to the ticket
			$data['usersassigneds'] = $this->User_model->assignedusers($id);
			//view assets linked to the ticket
			$data['assets'] = $this->ITAsset_model->view_assets_ticket($id);
			//retrieve comments linked to the ticket
			$data['comments'] = $this->Comment_model->getComments($id);

			$this->load->view('templates/header');
			$this->load->view('tickets/view', $data);
			$this->load->view('templates/footer');

		}
		
		//view all tickets assigned to logged in user through session data
		public function viewassigned($id){
			$data['title'] = "Tickets Assigned to you";
			//retrieve all assigned tickets that match the id.
			$data['tickets'] = $this->Ticket_model->getassignedtickets($id);
			//count for tickets to action call.
			$data['assigned'] = $this->Ticket_model->getassignedtickets($this->session->userdata('user_id'));

			$this->load->view('templates/header');
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');

		}
		//delete single ticket
		public function delete($id){
			//redirect if user is not admin
			if ($this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
			else
			{
			//delete linked ticket assets for the ticket
			$this->ITAsset_model->deleteticketassets($id);
			//delete linked comments for the ticket
			$this->Comment_model->deletecommentthread($id);
			//delete ticket
			$this->Ticket_model->deleteticket($id);
			redirect('tickets');
			}
		}
		//view ticket form for editing
		public function viewtoedit($id){
		//store ticket type from flash data
		$flash=$this->session->flashdata('type');

		//redirect if user is not admin or staff
		if ($this->session->userdata('Role')!='Staff' && $this->session->userdata('Role')!='Admin')
			{
				redirect('tickets');
			}
		else
			{
			//load campusassigned to fill form
			$data['campusassigneds'] = $this->Ticket_model->campusassigned($id);
			//load assigned users to fill form
			$data['assignedusers'] = $this->User_model->assignedusers($id);
			//load users to fill form select
			$data['users'] = $this->User_model->view_users();
			//load ticket information to fill form
			$data['tickets'] = $this->Ticket_model->view_ticket($id);
			//load affected assets to fill form
			$data['assets'] = $this->ITAsset_model->view_assets_ticket($id);
			//load all assets to fill form select
			$data['assetsrests'] = $this->ITAsset_model->viewassets();
			//$data['assetsrest'] = $this->ITAsset_model->view_other_assets_ticket($id);
			
			$data['title'] = "Edit user";
			//add flash data to data
			$data['type']=$flash;
			$this->load->view('templates/header');
			$this->load->view('tickets/edit', $data);
			$this->load->view('templates/footer');			

			}			
		}
		//edit single ticket
		public function editticket($id){
			//redirect if user is not admin or staff
			if ($this->session->userdata('Role')!='Admin' && $this->session->userdata('Role')!='Staff' )
			{
				redirect('tickets');
			}
			else
			{
			//if flashdata type contains general, send the form information to editG, otherwise to EditT.
			if ($this->session->flashdata('type')=="General"){
				$data['ticket'] = $this->Ticket_model->editG($id);
			}else{
				$data['ticket'] = $this->Ticket_model->editT($id);
			}			
			redirect('tickets');			
			}	
		}

		// technical or general page for creating ticket
		public function options(){
			$this->load->view('templates/header');
			$this->load->view('tickets/options');
			$this->load->view('templates/footer');

		}
		//create technical function
		public function createT(){			
			$data['title']='Create technical ticket';
			//load all assets
			$data['assets'] = $this->ITAsset_model->viewassets();
			//load all users
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
				//send form information to createT function.
				$this->Ticket_model->createT();
				redirect('tickets');
			}
		}
		//create technical function
		public function createG(){		
			$data['title']='Create General ticket';
			//retrieve all users
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
				//send format to create general function
				$this->Ticket_model->createG();

				redirect('tickets');
			}
		}
		//filter search
		public function search_category(){
			//retrieve category from select box, if value is All, load redirect to tickets.
		    $form_data = $this->input->post('category');
			if ($form_data =='All'){
				redirect('tickets');
			}else{
			//send form data for SQL query.
            $data['tickets'] = $this->Ticket_model->search_tickets_status($form_data);
			//retrieve assigned tickets for logged in user.
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
		//Search all tickets for a keyword
		public function search(){
		    $form_data = $this->input->post('keyword');
			//retrieve assigned tickets for logged in user.
			$data['assigned'] = $this->Ticket_model->getassignedtickets($this->session->userdata('user_id'));
			//send form data for SQL query to view all tickets that match variable.
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

		//view all technical tickets
		public function technical(){
		    $form_data = 'Technical';
			//retrieve assigned tickets for logged in user.
			$data['assigned'] = $this->Ticket_model->getassignedtickets($this->session->userdata('user_id'));
			//send form data for SQL query to view all Technical tickets.
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
			//retrieve assigned tickets for logged in user.
			$data['assigned'] = $this->Ticket_model->getassignedtickets($this->session->userdata('user_id'));
			//send form data for SQL query to view all General tickets.
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
