<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation'));
		$this->load->model('logs_model');
		$this->load->model('inspection_model');
		$this->load->model('service_orders_model');
		$this->load->model('emergency_response_model');
		$this->load->model('facility_inspection_model');

		if (!$this->session->userdata('user_id'))
		{
			// redirect them to the login page
			redirect('/auth/login', 'refresh');
		}		
	}
	
	public function index()
	{
		$data['total_logs'] = $this->logs_model->total_logs();
		$data['total_pre_inspections'] = $this->inspection_model->total_pre_inspections();
		$data['total_post_inspections'] = $this->inspection_model->total_post_inspections();
		$data['total_service_orders'] = $this->service_orders_model->total_service_orders();
		$data['total_emergency_responses'] = $this->emergency_response_model->total_emergency_responses();
		$data['total_facility_inspections'] = $this->facility_inspection_model->total_facility_inspections();

		$this->load->view('dashboard', $data);
	}

	
}

?>