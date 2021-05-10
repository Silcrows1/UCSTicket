<?php
	class Pages extends CI_Controller{
		//set home page
		public function view($page ='home'){
		//if attempting to view a page in pages that doesnt exist, show 404 error.
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}

			$data['title'] = ucfirst($page);

			//remove login failed flash data when loading home page.
			unset($_SESSION['login_failed']);
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}
