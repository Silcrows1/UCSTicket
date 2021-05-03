<?php
	class Tickets extends CI_Controller{
		public function index(){
			$data['title'] = "Tickets";
			$data['assets'] = $this->ITAsset_model->viewassets();
			$data['tickets'] = $this->Ticket_model->get_tickets();

			$this->load->view('templates/header');
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');
		}

		public function view($id){
			$data['tickets'] = $this->Ticket_model->view_ticket($id);
			$data['assetsaffected'] = $this->ITAssets_model->view_ticket($id);
			$data['title'] = "test";
			$this->load->view('templates/header');
			$this->load->view('tickets/view', $data);
			$this->load->view('templates/footer');

		}

		public function options(){
			$this->load->view('templates/header');
			$this->load->view('tickets/options');
			$this->load->view('templates/footer');

		}
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

		
	}
