<?php
class Inspection_model extends CI_model{

    public function __construct() {
        parent::__construct();
		

	}
	
	public function total_pre_inspections()
	{		
		$query = $this->db->query('SELECT count(*) as total FROM inspection_logs WHERE inspection_type = "Pre-trip Inspection";');

		return $query->row()->total;
	}	

	public function total_post_inspections()
	{		
		$query = $this->db->query('SELECT count(*) as total FROM inspection_logs WHERE inspection_type = "Post-trip Inspection";');

		return $query->row()->total;
	}	
	
	public function get_inspections($start, $length, $sort, $startDate, $endDate)
	{		
		$query = $this->db->query('SELECT id, unit_id, inspection_date, mileage, inspection_type, `status`, driver_name, manager_name, manager_signature_date, (SELECT count(*) FROM inspection_logs WHERE CAST(inspection_date as date) >= "'.$startDate.'" AND CAST(inspection_date as date) <= "'.$endDate.'") as v_count FROM inspection_logs WHERE CAST(inspection_date as date) >= "'.$startDate.'" AND CAST(inspection_date as date) <= "'.$endDate.'" ORDER by inspection_date DESC LIMIT '.$start.', '.$length.';');

		return $query;
	}

	public function get_inspection($id)
	{		
		$query = $this->db->query('SELECT * FROM inspection_logs WHERE id = '. $id .';');

		return $query;
	}	

	public function export_inspections($start, $end)
	{		
		$query = $this->db->query('SELECT id, unit_id, inspection_date, mileage, inspection_type, case when `status` = 1 then "Passed" else "Failed" end as `status`, driver_name, manager_name, manager_signature_date FROM inspection_logs WHERE CAST(inspection_date as date) >= "'.$start.'" AND CAST(inspection_date as date) <= "'.$end.'";');

		return $query;
	}

	public function sign_inspection($id, $password)
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
					'manager_name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
					'manager_signature_date' => date("Y-m-d h:m:s")
				);

				$this->db->set($data);
				$this->db->where('id', $id);		
				$results = $this->db->update('inspection_logs');

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
