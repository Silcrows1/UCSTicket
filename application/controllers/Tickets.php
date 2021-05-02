<?php
	class Tickets extends CI_Controller{
		public function index(){
			$data['title'] = "Tickets";

			$data['tickets'] = $this->Ticket_model->get_tickets();

			$this->load->view('templates/header');
			$this->load->view('tickets/index', $data);
			$this->load->view('templates/footer');
		}

		public function view($id){
			$data['tickets'] = $this->Ticket_model->view_ticket($id);
			$data['title'] = "test";
			$this->load->view('templates/header');
			$this->load->view('tickets/view', $data);
			$this->load->view('templates/footer');

		}
	}
