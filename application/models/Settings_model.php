<?php
class Settings_model extends CI_model{

    public function __construct() {
        parent::__construct();
		

	}
	
	public function service_order_notifications()
	{		
		$query = $this->db->query('SELECT service_order_notifications FROM users where id = '.$this->session->userdata('user_id').';');

		return $query->row()->service_order_notifications;
	}

	public function update_notifications($service_order_notifications)
	{		
        $data = array(
			'service_order_notifications' => $service_order_notifications
		);

		$this->db->set($data);
		$this->db->where('id', $this->session->userdata('user_id'));		
		$this->db->update('users');

	}

	public function get_programs()
	{		
		$query = $this->db->query('SELECT p.id, `description`, program_id FROM programs p LEFT JOIN notifications n on n.program_id = p.id and user_id = '.$this->session->userdata('user_id').' where active = 1;');

		return $query->result_array();
	}

	public function add_notifications($programs)
	{
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'program_id' => $programs
		);
		 
		$this->db->insert('notifications', $data);
	}	
	
	public function remove_notifications()
	{
		$this->db->delete('notifications', array('user_id' => $this->session->userdata('user_id')));
	}	
	

}


?>
