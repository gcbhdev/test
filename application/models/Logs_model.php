<?php
class Logs_model extends CI_model{

    public function __construct() {
        parent::__construct();
		

	}
	
	public function total_logs()
	{		
		$query = $this->db->query('SELECT count(*) as total FROM van_logs;');

		return $query->row()->total;
	}
	
	public function get_logs($start, $length, $sort, $startDate, $endDate)
	{		
		$sql = 'SELECT id, trip_date, trip_code, van_number, driver_name, program, no_of_patients, (SELECT count(*) FROM van_logs WHERE CAST(trip_date as date) >= "'.$startDate.'" AND CAST(trip_date as date) <= "'.$endDate.'") as v_count FROM van_logs WHERE CAST(trip_date as date) >= "'.$startDate.'" AND CAST(trip_date as date) <= "'.$endDate.'" ORDER by '.$sort.' LIMIT '.$start.', '.$length.';';

		log_message('error', $sql);

		$query = $this->db->query('SELECT id, trip_date, trip_code, van_number, driver_name, program, no_of_patients, (SELECT count(*) FROM van_logs WHERE CAST(trip_date as date) >= "'.$startDate.'" AND CAST(trip_date as date) <= "'.$endDate.'") as v_count FROM van_logs WHERE CAST(trip_date as date) >= "'.$startDate.'" AND CAST(trip_date as date) <= "'.$endDate.'" ORDER by '.$sort.' LIMIT '.$start.', '.$length.';');

		return $query;
	}

	public function export_logs($start, $end)
	{		
		$query = $this->db->query('SELECT id, trip_date, trip_code, van_number, driver_name, program, no_of_patients FROM van_logs WHERE CAST(trip_date as date) >= "'.$start.'" AND CAST(trip_date as date) <= "'.$end.'";');

		return $query;
	}
	

}


?>
