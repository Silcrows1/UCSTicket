<?php

	class Pagination extends CI_Controller{

			function index(){
				$this->load->library('pagination');
				$config['base_url'] = site_url('tickets/index');
				$config['total_rows'] = $this->Ticket_model->Count();
				$this->pagination->initialize($config);
				$config['per_page']=3;
				$config['uri_segment'] = 3;

			}
	}
