<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation'));
		$this->load->model('settings_model');

		if (!$this->session->userdata('user_id'))
		{
			// redirect them to the login page
			redirect('/auth/login', 'refresh');
		}		
	}
	
	public function index()
	{
		$data['service_order_notifications'] = $this->settings_model->service_order_notifications();
		$data['programs'] = $this->settings_model->get_programs();

		$this->load->view('settings', $data);
	}

	public function update_notifications()
	{
		$service_order_notifications = $_POST['service_order_notifications'];
		$programs = $_POST['programs'];
		
		$this->settings_model->update_notifications($service_order_notifications);

		$this->settings_model->remove_notifications();
		if($programs != "")
		{
			for($i = 0; $i < count($programs); $i++)
			{
				$this->settings_model->add_notifications($programs[$i]);
			}
		}
	}

	public function test()
	{
		$this->load->library('notifications');

		$mail = new Notifications();
		$mail->send_mail(['javaunjoseph@gmail.com'], 'noreply@dacco.org', 'New Service Ticket', [], [], '', [], 'new_ticket', '', []);


	}

	
}

?>