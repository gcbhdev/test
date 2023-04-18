<?php
class Emergency_response_model extends CI_model{

    public function __construct() {
        parent::__construct();
		

	}
	
	public function total_emergency_responses()
	{		
		$query = $this->db->query('SELECT count(*) as total FROM emergency_response_plan;');

		return $query->row()->total;
	}
	
	public function get_emergency_responses($start, $length, $sort, $startDate, $endDate)
	{		
		$query = $this->db->query('SELECT e.id, quarter, `description` AS program, `location`, event_date, event_time, shift, actual_or_drill, manager_signature_date, (SELECT count(*) FROM emergency_response_plan WHERE CAST(event_date as date) >= "'.$startDate.'" AND CAST(event_date as date) <= "'.$endDate.'") as v_count FROM emergency_response_plan e JOIN programs p ON e.program = p.id WHERE CAST(event_date as date) >= "'.$startDate.'" AND CAST(event_date as date) <= "'.$endDate.'" ORDER by event_date DESC LIMIT '.$start.', '.$length.';');

		return $query;
	}

	public function get_emergency_response($id)
	{		
		$query = $this->db->query('SELECT e.id, quarter, `description` AS program, `location`, `day_of_week`, `event_date`, `event_time`, `shift`, `actual_or_drill`, `type_of_emergency`, `notified_how`, `other`, `all_notified`, `not_all_notified_why`, `fd_pf_called`, `no_fd_pf_called_why`, `safe_accounted`, `not_safe_accounted_explain`, `how_many_minutes`, `doors_closed`, `doors_not_closed_why`, `problems`, `yes_problems_explain`, `details`, `completed_by`, `signature`, `improvements`, `formal_debriefing`, `formal_debriefing_details`, `manager_name`, `manager_signature_date` FROM emergency_response_plan e JOIN programs p ON e.program = p.id WHERE e.id = '. $id .';');

		return $query;
	}	

	public function export_emergency_responses($start, $end)
	{		
		$query = $this->db->query('SELECT e.id, quarter, `description` AS program, `location`, event_date, event_time, shift, actual_or_drill FROM emergency_response_plan e JOIN programs p ON e.program = p.id WHERE CAST(event_date as date) >= "'.$start.'" AND CAST(event_date as date) <= "'.$end.'";');

		return $query;
	}

	public function sign_emergency_response($id, $password, $improvements, $formal_debriefing, $formal_debriefing_details)
	{

		if (empty($password))
		{

			return FALSE;
		}

		$query = $this->db->query('SELECT id, password, active FROM users where id = '.$this->session->userdata('user_id').';');
		
						/*$this->identity_column . ', email, id, first_name, last_name, password, active, last_login')
						  ->where($this->identity_column, $this->session->userdata('user_id'))
						  ->limit(1)
						  ->order_by('id', 'desc')
						  ->get($this->tables['users']);*/


		if ($query->num_rows() === 1)
		{
			$user = $query->row();

			if ($this->verify_password($password, $user->password, $this->session->userdata('user_id')))
			{
				if ($user->active == 0)
				{
					return FALSE;
				}

				$data = array(
					'improvements' => $improvements,
					'formal_debriefing' => $formal_debriefing,
					'formal_debriefing_details' => $formal_debriefing_details,
					'manager_name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
					'manager_signature_date' => date("Y-m-d h:m:s")
				);

				$this->db->set($data);
				$this->db->where('id', $id);		
				$results = $this->db->update('emergency_response_plan');

				return TRUE;
			}
		}

		return FALSE;
	}

	public function verify_password($password, $hash_password_db, $identity = NULL)
	{
		// Check for empty id or password, or password containing null char, or password above limit
		// Null char may pose issue: http://php.net/manual/en/function.password-hash.php#118603
		// Long password may pose DOS issue (note: strlen gives size in bytes and not in multibyte symbol)
		if (empty($password) || empty($hash_password_db))
		{
			return FALSE;
		}

		// password_hash always starts with $
		if (strpos($hash_password_db, '$') === 0)
		{
			return password_verify($password, $hash_password_db);
		}
		else
		{
			// Handle legacy SHA1 @TODO to delete in later revision
			return $this->_password_verify_sha1_legacy($identity, $password, $hash_password_db);
		}
	}

}


?>
