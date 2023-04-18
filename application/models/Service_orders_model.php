<?php
class Service_orders_model extends CI_model{

    public function __construct() {
        parent::__construct();
		

	}
	
	public function total_service_orders()
	{		
		$query = $this->db->query('SELECT count(*) as total FROM service_orders;');

		return $query->row()->total;
	}
	
	public function get_service_orders($start, $length, $sort, $startDate, $endDate)
	{		
		$query = $this->db->query('SELECT id, ticket_date, van_number, vehicle_location, category, assigned_to, `description`, signature_date, `signature`, (SELECT count(*) FROM service_orders WHERE CAST(ticket_date as date) >= "'.$startDate.'" AND CAST(ticket_date as date) <= "'.$endDate.'") as v_count FROM service_orders WHERE CAST(ticket_date as date) >= "'.$startDate.'" AND CAST(ticket_date as date) <= "'.$endDate.'" ORDER by '.$sort.' LIMIT '.$start.', '.$length.';');

		return $query;
	}

	public function get_service_order($id)
	{		
		$query = $this->db->query('SELECT * FROM service_orders WHERE id = '. $id .';');

		return $query;
	}

	public function get_work_orders()
	{
		$query = $this->db->query('SELECT * FROM service_orders WHERE `signature` is null;');

		return $query;		
	}

	public function get_work_order_with_signatures()
	{
		$query = $this->db->query('SELECT id FROM service_orders WHERE `signature` is not null;');

		return $query;		
	}

	public function export_service_orders($start, $end)
	{		
		$query = $this->db->query('SELECT s.id, ticket_date, van_number, vehicle_location, category, IFNULL(CONCAT(first_name, " ", last_name), "Unassigned") AS tech_name, CASE WHEN signature is null THEN "Incomplete" ELSE "Completed" END AS `status` FROM service_orders s LEFT JOIN users u ON s.assigned_to = u.id WHERE CAST(ticket_date as date) >= "'.$start.'" AND CAST(ticket_date as date) <= "'.$end.'";');

		return $query;
	}

	public function get_technicians()
	{
		$query = $this->db->query('SELECT u.id, CONCAT(first_name, " ", last_name) as tech_name FROM users u JOIN users_groups ug ON u.id = ug.user_id WHERE group_id = 3;');

		return $query->result_array();	
	}

	public function update_technician($id, $technician_id)
	{
        $data = array(
			'assigned_to' => $technician_id
		);

		$this->db->set($data);
		$this->db->where('id', $id);		
		$results = $this->db->update('service_orders');		
	}
	

}


?>
