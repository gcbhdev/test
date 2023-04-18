<?php
class Tracking_sheet_model extends CI_model{

    public function __construct() {
        parent::__construct();
		

	}

	public function get_audit_logs($id)
	{		
		$query = $this->db->query('SELECT CONCAT(first_name, \' \', last_name) as employee_name, `action`, comments, a.created_on FROM audit_logs a JOIN users u on u.id = a.user_id WHERE tracking_sheet_id = '.$id.' ORDER BY a.created_on;');
		
		return $query->result_array();
	}

	public function get_tracking_sheet_status($id)
	{		
		$query = $this->db->query('SELECT tracking_sheet_status FROM tracking_sheet WHERE id = '.$id.';');
		
		return $query->row()->tracking_sheet_status;
	}		

	public function view_tracking_sheet($id)
	{		
		$query = $this->db->query('SELECT ts.id AS tracking_sheet_id, CONCAT(first_name, \' \', last_name) as employee_name, employee_no, `description` FROM `users` u JOIN tracking_sheet ts ON ts.user_id = u.id JOIN programs p ON p.id = ts.program_id WHERE ts.id = '.$id.';');
		
		return $query;
	}	

	public function get_travel_logs($start, $length)
	{		
		$sql = 'SELECT st.id AS tracking_sheet_id, CONCAT(first_name, " ", last_name) AS employee_name, p.description, tracking_sheet_status, SUM(meals) + SUM(lodging) + SUM(mileage)*0.40 + SUM(other_trans_amount) AS amount, (SELECT count(*) FROM tracking_sheet WHERE user_id = '.$this->session->userdata('user_id').') as v_count FROM tracking_sheet st JOIN users u ON st.user_id = u.id LEFT JOIN programs p ON p.id = st.program_id LEFT JOIN tracking_sheet_details tsd ON tsd.tracking_sheet_id = st.id WHERE user_id = '.$this->session->userdata('user_id').' GROUP BY st.id, first_name, last_name, p.description ORDER by st.id DESC LIMIT '.$start.', '.$length.';';

		log_message('error', $sql);

		$query = $this->db->query('SELECT st.id AS tracking_sheet_id, CONCAT(first_name, " ", last_name) AS employee_name, p.description, tracking_sheet_status, SUM(meals) + SUM(lodging) + SUM(mileage)*0.40 + SUM(other_trans_amount) AS amount, (SELECT count(*) FROM tracking_sheet WHERE user_id = '.$this->session->userdata('user_id').') as v_count FROM tracking_sheet st JOIN users u ON st.user_id = u.id LEFT JOIN programs p ON p.id = st.program_id LEFT JOIN tracking_sheet_details tsd ON tsd.tracking_sheet_id = st.id WHERE user_id = '.$this->session->userdata('user_id').' GROUP BY st.id, first_name, last_name, p.description ORDER by st.id DESC LIMIT '.$start.', '.$length.';');

		return $query;
	}	

	public function get_travel_logs_supervisor($start, $length, $sort, $startDate, $endDate)
	{		
		$query = $this->db->query('SELECT st.id AS tracking_sheet_id, CONCAT(first_name, " ", last_name) AS employee_name, date_submitted, tracking_sheet_status, SUM(meals) + SUM(lodging) + SUM(mileage)*0.40 + SUM(other_trans_amount) AS amount, (SELECT count(*) FROM tracking_sheet WHERE st.tracking_sheet_status IN ("Submitted", "Approved") AND CAST(date_submitted AS DATE) >= \''.$startDate.'\' AND CAST(date_submitted AS DATE) <= \''.$endDate.'\') as v_count FROM tracking_sheet st JOIN users u ON st.user_id = u.id JOIN programs p ON p.id = st.program_id LEFT JOIN tracking_sheet_details tsd ON tsd.tracking_sheet_id = st.id WHERE st.tracking_sheet_status IN ("Submitted", "Approved") AND CAST(date_submitted AS DATE) >= \''.$startDate.'\' AND CAST(date_submitted AS DATE) <= \''.$endDate.'\' GROUP BY st.id, first_name, last_name, p.description ORDER by '.$sort.' LIMIT '.$start.', '.$length.';');

		return $query;
	}	

	public function get_travel_log_report($start, $length, $sort, $startDate, $endDate)
	{		
		$query = $this->db->query('SELECT ts.id AS tracking_sheet_id, CONCAT(first_name, \' \', last_name) as employee_name, employee_no, \'9650\' AS gl_num, program_code, fund, \'100%\' AS allocation, SUM(meals) + SUM(lodging) + SUM(mileage)*0.40 + SUM(other_trans_amount) AS amount, min(travel_date) AS date_from, max(travel_date) AS date_to, (SELECT count(*) FROM tracking_sheet WHERE tracking_sheet_status = \'Approved\' AND CAST(date_submitted AS DATE) >= \''.$startDate.'\' AND CAST(date_submitted AS DATE) <= \''.$endDate.'\') as v_count FROM `users` u JOIN tracking_sheet ts ON ts.user_id = u.id JOIN tracking_sheet_details tsd ON tsd.tracking_sheet_id = ts.id JOIN programs p ON p.id = tsd.program_id WHERE tracking_sheet_status = \'Approved\' AND CAST(date_submitted AS DATE) >= \''.$startDate.'\' AND CAST(date_submitted AS DATE) <= \''.$endDate.'\' GROUP BY employee_name, employee_no, program_code ORDER by '.$sort.' LIMIT '.$start.', '.$length.';');

		return $query;
	}

	public function get_travel_log_report_finance($start, $length, $sort, $startDate, $endDate)
	{		
		$query = $this->db->query('SELECT tracking_sheet_id, travel_date, CONCAT(first_name, \' \', last_name) as employee_name, origin, destination, purpose, description, meals, lodging, mileage, other_trans_amount, incidental_type, (SELECT count(*) FROM tracking_sheet_details tsd JOIN programs p ON p.id = tsd.program_id JOIN tracking_sheet ts ON ts.id = tsd.tracking_sheet_id JOIN users u ON u.id = ts.user_id WHERE tracking_sheet_status in ("Approved", "Paid")) AS v_count FROM tracking_sheet_details tsd JOIN programs p ON p.id = tsd.program_id JOIN tracking_sheet ts ON ts.id = tsd.tracking_sheet_id JOIN users u ON u.id = ts.user_id WHERE tracking_sheet_status IN ("Approved", "Paid") AND travel_date >= \''.$startDate.'\' AND travel_date <= \''.$endDate.'\' ORDER by '.$sort.' LIMIT '.$start.', '.$length.';');

		return $query;
	}	

	public function get_travel_log_report_export($startDate, $endDate, $export_type)
	{		
		$query = $this->db->query('SELECT ts.id AS tracking_sheet_id, CONCAT(first_name, \' \', last_name) as employee_name, employee_no, \'9650\' AS gl_num, program_code, fund, \'100%\' AS allocation, SUM(meals) + SUM(lodging) + SUM(mileage)*0.40 + SUM(other_trans_amount) AS amount, min(travel_date) AS date_from, max(travel_date) AS date_to, (SELECT count(*) FROM tracking_sheet WHERE tracking_sheet_status = \'Approved\') as v_count FROM `users` u JOIN tracking_sheet ts ON ts.user_id = u.id JOIN programs p ON p.id = ts.program_id JOIN tracking_sheet_details tsd ON tsd.tracking_sheet_id = ts.id WHERE tracking_sheet_status = \'Approved\' AND CAST(date_submitted AS DATE) >= \''.$startDate.'\' AND CAST(date_submitted AS DATE) <= \''.$endDate.'\' GROUP BY employee_name, employee_no, program_code;');

		if ($export_type == 1){
			foreach($query->result_array() as $r) {
				$this->db->set('tracking_sheet_status', 'Paid');
				$this->db->where('id', $r['tracking_sheet_id']);
				$this->db->update('tracking_sheet');

				$data = array(
					'tracking_sheet_id' => $r['tracking_sheet_id'],
					'user_id' => $this->session->userdata('user_id'),
					'action' => 'Paid',
					'comments' => 'No comments'
				);
				 
				$this->db->insert('audit_logs', $data);
			}
		}

		return $query;
	}	

	public function get_travel_log_report_finance_export($startDate, $endDate)
	{		
		$query = $this->db->query('SELECT tracking_sheet_id, travel_date, CONCAT(first_name, \' \', last_name) as employee_name, origin, destination, purpose, description, meals, lodging, mileage, other_trans_amount, incidental_type, (SELECT count(*) FROM tracking_sheet_details tsd JOIN programs p ON p.id = tsd.program_id JOIN tracking_sheet ts ON ts.id = tsd.tracking_sheet_id JOIN users u ON u.id = ts.user_id WHERE tracking_sheet_status in ("Approved", "Paid")) AS v_count FROM tracking_sheet_details tsd JOIN programs p ON p.id = tsd.program_id JOIN tracking_sheet ts ON ts.id = tsd.tracking_sheet_id JOIN users u ON u.id = ts.user_id WHERE tracking_sheet_status IN ("Approved", "Paid") AND travel_date >= \''.$startDate.'\' AND travel_date <= \''.$endDate.'\';');

		return $query;
	}	
	
	public function get_details($tracking_sheet_id)
	{		
		$sql = 'SELECT *, (SELECT count(*) FROM tracking_sheet_details WHERE tracking_sheet_id = '.$tracking_sheet_id.') as v_count FROM tracking_sheet_details WHERE tracking_sheet_id = '.$tracking_sheet_id.';';

		log_message('error', $sql);

		$query = $this->db->query('SELECT *, (SELECT count(*) FROM tracking_sheet_details WHERE tracking_sheet_id = '.$tracking_sheet_id.') as v_count FROM tracking_sheet_details tsd JOIN programs p on p.id = tsd.program_id WHERE tracking_sheet_id = '.$tracking_sheet_id.';');

		return $query;
	}

	public function get_totals($tracking_sheet_id)
	{		
		$sql = 'SELECT SUM(meals) AS meals_total, SUM(lodging) AS lodging_total, SUM(mileage)*0.40 AS mileage_total, SUM(other_trans_amount) AS other_total, SUM(meals) + SUM(lodging) + SUM(mileage)*0.40 + SUM(other_trans_amount) AS grand_total FROM tracking_sheet_details WHERE tracking_sheet_id = '.$tracking_sheet_id.';';

		log_message('error', $sql);

		$query = $this->db->query('SELECT SUM(meals) AS meals_total, SUM(lodging) AS lodging_total, SUM(mileage)*0.40 AS mileage_total, SUM(other_trans_amount) AS other_total, SUM(meals) + SUM(lodging) + SUM(mileage)*0.40 + SUM(other_trans_amount) AS grand_total FROM tracking_sheet_details WHERE tracking_sheet_id = '.$tracking_sheet_id.';');

		return $query->result_array();
	}

	public function add_details($tracking_sheet_id, $travel_date, $origin, $destination, $purpose, $program_id, $meals, $lodging, $mileage, $other_trans_amount, $incidental_type)
	{
		$data = array(
			'tracking_sheet_id' => $tracking_sheet_id,
			'travel_date' => $travel_date,
			'origin' => $origin,
			'destination' => $destination,
			'purpose' => $purpose,
			'program_id' => $program_id,
			'meals' => $meals,
			'lodging' => $lodging,
			'mileage' => $mileage,
			'other_trans_amount' => $other_trans_amount,
			'incidental_type' => $incidental_type
		);
		 
		$this->db->insert('tracking_sheet_details', $data);
	}

	public function update_details($id, $tracking_sheet_id, $travel_date, $origin, $destination, $purpose, $program_id, $meals, $lodging, $mileage, $other_trans_amount, $incidental_type)
	{
		$this->db->set('tracking_sheet_id', $tracking_sheet_id);
		$this->db->set('travel_date', $travel_date);
		$this->db->set('origin', $origin);
		$this->db->set('destination', $destination);
		$this->db->set('purpose', $purpose);
		$this->db->set('program_id', $program_id);
		$this->db->set('meals', $meals);
		$this->db->set('lodging', $lodging);
		$this->db->set('mileage', $mileage);
		$this->db->set('other_trans_amount', $other_trans_amount);
		$this->db->set('incidental_type', $incidental_type);
		$this->db->where('id', $id);
		$this->db->update('tracking_sheet_details');
	}

	public function delete_detail($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tracking_sheet_details');
	}

	public function add_tracking_sheet()
	{
		$data = array(
			'user_id' => $this->session->userdata('user_id')
		);
		 
		$this->db->insert('tracking_sheet', $data);
		$insert_id = $this->db->insert_id();

		return  $insert_id; 
	}

	public function update_tracking_sheet($tracking_sheet_id, $program_id)
	{
		$this->db->set('program_id', $program_id);
		$this->db->where('id', $tracking_sheet_id);
		$this->db->update('tracking_sheet');
	}	

	public function update_tracking_sheet_report($id, $column, $value) {
		$this->db->set($column, $value);
		$this->db->where('id', $id);		
		$this->db->update('tracking_sheet');
	}

	public function submit_for_approval($tracking_sheet_id)
	{
		$this->db->set('tracking_sheet_status', 'Submitted');
		$this->db->set('date_submitted', date('Y-m-d h:m:s'));
		$this->db->where('id', $tracking_sheet_id);
		$this->db->update('tracking_sheet');

		$this->audit($tracking_sheet_id, 'Submitted', 'No comments');

	}	

	public function approve_tracking_sheet($tracking_sheet_id)
	{
		$this->db->set('tracking_sheet_status', 'Approved');
		$this->db->set('date_approved', date('Y-m-d h:m:s'));
		$this->db->where('id', $tracking_sheet_id);
		$this->db->update('tracking_sheet');

		$this->audit($tracking_sheet_id, 'Approved', 'No comments');
	}	

	public function reject_tracking_sheet($tracking_sheet_id, $comments)
	{
		$this->db->set('tracking_sheet_status', 'In Progress');
		$this->db->set('date_submitted', null);
		$this->db->where('id', $tracking_sheet_id);
		$this->db->update('tracking_sheet');


		$this->audit($tracking_sheet_id, 'Rejected', $comments);
	}

	public function delete_tracking_sheet($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tracking_sheet');
	}

	public function audit($id, $action, $comments)
	{
		$data = array(
			'tracking_sheet_id' => $id,
			'user_id' => $this->session->userdata('user_id'),
			'action' => $action,
			'comments' => $comments
		);

		$this->db->insert('audit_logs', $data);
	}
	

}


?>
