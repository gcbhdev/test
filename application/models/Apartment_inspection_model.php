<?php
class Facility_inspection_model extends CI_model{

    public function __construct() {
        parent::__construct();
		

	}
	
	public function total_apartment_inspections()
	{		
		$query = $this->db->query('SELECT count(*) as total FROM facility_inspection;');

		return $query->row()->total;
	}
	
	public function get_apartment_inspections($start, $length, $sort, $startDate, $endDate)
	{		
		$query = $this->db->query('SELECT f.id, `description` AS facility, `location`, quarter, event_date, shift, manager_signature_date, (SELECT count(*) FROM facility_inspection WHERE CAST(event_date as date) >= "'.$startDate.'" AND CAST(event_date as date) <= "'.$endDate.'") as v_count FROM facility_inspection f JOIN programs p ON f.facility = p.id WHERE CAST(event_date as date) >= "'.$startDate.'" AND CAST(event_date as date) <= "'.$endDate.'" ORDER by event_date DESC LIMIT '.$start.', '.$length.';');

		return $query;
	}

	public function get_apartment__inspection($id)
	{		
		$query = $this->db->query('SELECT  f.id, `description` AS facility, `location`, `quarter`, `event_date`, `shift`, `undmg_door`, `door_open`, `window_cracked`,`window_open`,`locks_have_keys`,`locks_present`,`run_faucets`,`flush_toilets`,`appliance_check`,`cold_fridge`,`run_heat`,`check_filter`,`check_blinds`,`test_washer`,`test_smoke_detectors`,`test_co`,`test_operation`,`bathroom_clean`,`ceiling_cracks`,`ceiling_water_damage`,`weird_smell`, `mice_or_bugs`, `defunct_machines`, `sidewalk_cracks`, `mail_box_key`, `door_fob` FROM facility_inspection f JOIN programs p ON f.facility = p.id WHERE f.id = '. $id .';');

		return $query;
	}	

	public function export_facility_inspections($start, $end)
	{		
		$query = $this->db->query('SELECT f.id, `description` AS facility, `location`, quarter, event_date, shift FROM facility_inspection f JOIN programs p ON f.facility = p.id WHERE CAST(event_date as date) >= "'.$start.'" AND CAST(event_date as date) <= "'.$end.'";');

		return $query;
	}

	public function sign_facility_inspection($id, $password, $corrective_action)
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
					'corrective_action' => $corrective_action,
					'manager_name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
					'manager_signature_date' => date("Y-m-d h:m:s")
				);

				$this->db->set($data);
				$this->db->where('id', $id);		
				$results = $this->db->update('facility_inspection');

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