<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation', 'notifications'));
		$this->load->model(array('forms_model', 'settings_model'));
		
	}

	public function index()
	{
		$this->load->view('forms');
	}

	public function rerp()
	{
		$data['programs'] = $this->forms_model->get_programs();

		$this->load->view('forms/rerp', $data);
	}

	public function ficr()
	{
		$data['programs'] = $this->forms_model->get_programs();

		$this->load->view('forms/ficr', $data);
	}

	public function add_rerp()
	{
		$pData = $_POST['pData'];
		
		$this->forms_model->add('emergency_response_plan', $pData);

		$this->notify('Report Of Emergency Response Plan', $pData['program'], $pData['completed_by']);

	}	
	
	public function add_ficr()
	{
		$pData = $_POST['pData'];
		
		$this->forms_model->add('facility_inspection', $pData);

		$this->notify('Facility Inspection Report', $pData['facility'], $pData['completed_by']);

	}

	private function notify($form, $program_id, $name)
	{
		$program = $this->db->query('SELECT `description` FROM programs WHERE id = '.$program_id.';');

		$data_array = array(
			'$form' => $form,
			'$program' => $program->row()->description,
			'$name' => $name
		);

		$query = $this->db->query('SELECT email FROM users WHERE id IN (SELECT `user_id` FROM notifications where program_id = '.$program_id.');');

		foreach($query->result_array() as $r) {
			$emails[] = $r['email'];
		}

		$mail = new Notifications();
		$mail->send_mail($emails, 'noreply.mail@ascendwds.com', 'New Form Submission', [], [], '', [], 'new_form', '', $data_array);
	}

	public function test()
	{
		$this->notify('Facility Inspection Report', '16', 'Jay Joseph');
	}
}
