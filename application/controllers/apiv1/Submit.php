<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

defined('BASEPATH') OR exit('No direct script access allowed');

class Submit extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation', 'notifications'));
		$this->load->model('logs_model');
		$this->load->model('inspection_model');
		$this->load->model('service_orders_model');
		
	}
	
	public function index()
	{
		$this->load->view('van_logs');
	}
	
	public function logs()
	{


			$id = $_POST['id'];
			$trip_date = $_POST['trip_date'];
			$trip_code = $_POST['trip_code'];
			$van_number = $_POST['van_number'];
			$driver_name = $_POST['driver_name'];
			$program = $_POST['program'];
			$no_of_patients = $_POST['no_of_patients'];
			$status = '';

			$data = array(
				'trip_date' => $trip_date,
				'trip_code' => $trip_code,
				'van_number' => $van_number,
				'driver_name' => $driver_name,
				'program' => $program,
				'no_of_patients' => $no_of_patients
			);
			
			//$results = $this->db->insert('van_logs', $data);

			if($this->db->insert('van_logs', $data))
			{
				$status = 'OK';
			} else 
			{
				$status = 'FAILED';
			}		
		
			echo json_encode(array("status"=>$status));


	}
	
	public function inspection()
	{


			$data = array(
				'driver_name' => $_POST['driver_name'],
				'unit_id' => $_POST['van_number'],
				'vehicle_location' => $_POST['vehicle_location'],
				'mileage' => $_POST['mileage'],
				'status' => ($_POST['headlights'] == 'OK' && $_POST['tail_lights'] == 'OK' && $_POST['backup_lights'] == 'OK' && $_POST['backup_alarm'] == 'OK' && $_POST['turn_signals'] == 'OK' && $_POST['clearance_lights'] == 'OK' && $_POST['wipers'] == 'OK' && $_POST['interior_lights'] == 'OK' && $_POST['interior_gauges'] == 'OK' && $_POST['climate_control'] == 'OK' && $_POST['mirrors'] == 'OK' && $_POST['parking_brakes'] == 'OK' && $_POST['service_brakes'] == 'OK' && $_POST['steering'] == 'OK' && $_POST['horn'] == 'OK' && $_POST['extinguisher'] == 'OK' && $_POST['emergency'] == 'OK' && $_POST['passenger_doors'] == 'OK' && $_POST['cleanliness'] == 'OK' && $_POST['body_damage'] == 'OK' && $_POST['tire_wheels'] == 'OK' && $_POST['exhaust'] == 'OK' && ($_POST['interlock_system'] == 'OK' || $_POST['interlock_system'] == 'N/A') && ($_POST['wheelchair'] == 'OK' || $_POST['wheelchair'] == 'N/A') && $_POST['belts'] == 'OK' && $_POST['first_aid'] == 'OK' && $_POST['flares_triangles'] == 'OK' && $_POST['fire_suppression_system'] == 'OK' ? 1 : 0),
				'inspection_date' => $_POST['inspection_date'],
				'inspection_type' => $_POST['inspection_type'],
				'headlights' => ($_POST['headlights'] == 'OK' ? 1 : 0),
				'headlights_comment' => $_POST['headlights_comment'],
				'tail_lights' => ($_POST['tail_lights'] == 'OK' ? 1 : 0),
				'tail_lights_comment' => $_POST['tail_lights_comment'],
				'backup_lights' => ($_POST['backup_lights'] == 'OK' ? 1 : 0),
				'backup_lights_comment' => $_POST['backup_lights_comment'],
				'backup_alarm' => ($_POST['backup_alarm'] == 'OK' ? 1 : 0),
				'backup_alarm_comment' => $_POST['backup_alarm_comment'],
				'turn_signals' => ($_POST['turn_signals'] == 'OK' ? 1 : 0),
				'turn_signals_comment' => $_POST['turn_signals_comment'],
				'clearance_lights' => ($_POST['clearance_lights'] == 'OK' ? 1 : 0),
				'clearance_lights_comment' => $_POST['clearance_lights_comment'],
				'wipers' => ($_POST['wipers'] == 'OK' ? 1 : 0),
				'wipers_comment' => $_POST['wipers_comment'],
				'interior_lights' => ($_POST['interior_lights'] == 'OK' ? 1 : 0),
				'interior_lights_comment' => $_POST['interior_lights_comment'],
				'interior_gauges' => ($_POST['interior_gauges'] == 'OK' ? 1 : 0),
				'interior_gauges_comment' => $_POST['interior_gauges_comment'],
				'climate_control' => ($_POST['climate_control'] == 'OK' ? 1 : 0),
				'climate_control_comment' => $_POST['climate_control_comment'],
				'mirrors' => ($_POST['mirrors'] == 'OK' ? 1 : 0),
				'mirrors_comment' => $_POST['mirrors_comment'],
				'parking_brakes' => ($_POST['parking_brakes'] == 'OK' ? 1 : 0),
				'parking_brakes_comment' => $_POST['parking_brakes_comment'],
				'service_brakes' => ($_POST['service_brakes'] == 'OK' ? 1 : 0),
				'service_brakes_comment' => $_POST['service_brakes_comment'],
				'steering' => ($_POST['steering'] == 'OK' ? 1 : 0),
				'steering_comment' => $_POST['steering_comment'],
				'horn' => ($_POST['horn'] == 'OK' ? 1 : 0),
				'horn_comment' => $_POST['horn_comment'],
				'extinguisher' => ($_POST['extinguisher'] == 'OK' ? 1 : 0),
				'extinguisher_comment' => $_POST['extinguisher_comment'],
				'emergency' => ($_POST['emergency'] == 'OK' ? 1 : 0),
				'emergency_comment' => $_POST['emergency_comment'],
				'passenger_doors' => ($_POST['passenger_doors'] == 'OK' ? 1 : 0),
				'passenger_doors_comment' => $_POST['passenger_doors_comment'],
				'cleanliness' => ($_POST['cleanliness'] == 'OK' ? 1 : 0),
				'cleanliness_comment' => $_POST['cleanliness_comment'],
				'body_damage' => ($_POST['body_damage'] == 'OK' ? 1 : 0),
				'body_damage_comment' => $_POST['body_damage_comment'],
				'tire_wheels' => ($_POST['tire_wheels'] == 'OK' ? 1 : 0),
				'tire_wheels_comment' => $_POST['tire_wheels_comment'],
				'exhaust' => ($_POST['exhaust'] == 'OK' ? 1 : 0),
				'exhaust_comment' => $_POST['exhaust_comment'],
				'interlock_system' => ($_POST['interlock_system'] == 'OK' ? 1 : $_POST['interlock_system'] == 'N/A' ? 3 : 0),
				'interlock_system_comment' => $_POST['interlock_system_comment'],
				'wheelchair' => ($_POST['wheelchair'] == 'OK' ? 1 : $_POST['wheelchair'] == 'N/A' ? 3 : 0),
				'wheelchair_comment' => $_POST['wheelchair_comment'],
				'belts' => ($_POST['belts'] == 'OK' ? 1 : 0),
				'belts_comment' => $_POST['belts_comment'],
				'first_aid' => ($_POST['first_aid'] == 'OK' ? 1 : 0),
				'first_aid_comment' => $_POST['first_aid_comment'],
				'flares_triangles' => ($_POST['flares_triangles'] == 'OK' ? 1 : 0),
				'flares_triangles_comment' => $_POST['flares_triangles_comment'],
				'fire_suppression_system' => ($_POST['fire_suppression_system'] == 'OK' ? 1 : 0),
				'fire_suppression_system_comment' => $_POST['fire_suppression_system_comment'],
				'signature' => $_POST['signature']
			);

			$result = $this->db->insert('inspection_logs', $data);

						
			if($result)
			{
				$status = 'OK';
			} else 
			{
				$status = 'FAILED';
			}
		
			echo json_encode(array("status"=>$status));	

			$ticket_category = '';
			$ticket_description = '';

			if($_POST['headlights'] == 'Defective') {
				$ticket_category = 'Headlights';

				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['headlights_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['headlights_comment']);
			} 
			if($_POST['tail_lights'] == 'Defective') {
				$ticket_category = 'Tail/Brake lights';

				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['tail_lights_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['tail_lights_comment']);
			} 
			if($_POST['backup_lights'] == 'Defective') {
				$ticket_category = 'Back up Lights';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['backup_lights_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['backup_lights_comment']);
			} 
			if($_POST['backup_alarm'] == 'Defective') {
				$ticket_category = 'Back up Alarm';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['backup_alarm_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['backup_alarm_comment']);
			} 
			if($_POST['turn_signals'] == 'Defective') {
				$ticket_category = 'Turn Signals';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['turn_signals_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['turn_signals_comment']);
			} 
			if($_POST['clearance_lights'] == 'Defective') {
				$ticket_category = 'Clearance Lights';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['clearance_lights_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['clearance_lights_comment']);
			} 
			if($_POST['wipers'] == 'Defective') {
				$ticket_category = 'Windshield Wipers';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['wipers_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['wipers_comment']);
			} 
			if($_POST['interior_lights'] == 'Defective') {
				$ticket_category = 'Interior Lights';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['interior_lights_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['interior_lights_comment']);
			} 
			if($_POST['interior_gauges'] == 'Defective') {
				$ticket_category = 'Interior Gauges and Warning System';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['interior_gauges_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['interior_gauges_comment']);
			} 
			if($_POST['climate_control'] == 'Defective') {
				$ticket_category = 'Climate Control';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['climate_control_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['climate_control_comment']);
			}
			if($_POST['mirrors'] == 'Defective') {
				$ticket_category = 'Mirrors';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['mirrors_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['mirrors_comment']);
			} 
			if($_POST['parking_brakes'] == 'Defective') {
				$ticket_category = 'Parking brakes';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['parking_brakes_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['parking_brakes_comment']);
			} 
			if($_POST['service_brakes'] == 'Defective') {
				$ticket_category = 'Service brakes';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['service_brakes_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['service_brakes_comment']);
			} 
			if($_POST['steering'] == 'Defective') {
				$ticket_category = 'Steering';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['steering_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['steering_comment']);
			} 
			if($_POST['horn'] == 'Defective') {
				$ticket_category = 'Horn';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['horn_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['horn_comment']);
			} 
			if($_POST['extinguisher'] == 'Defective') {
				$ticket_category = 'Fire extinguisher';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['extinguisher_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['extinguisher_comment']);
			} 
			if($_POST['emergency'] == 'Defective') {
				$ticket_category = 'Emergency Exit Windows and Door';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['emergency_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['emergency_comment']);
			} 
			if($_POST['passenger_doors'] == 'Defective') {
				$ticket_category = 'Passenger Doors';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['passenger_doors_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['passenger_doors_comment']);
			} 
			if($_POST['cleanliness'] == 'Defective') {
				$ticket_category = 'Overall cleanliness';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['cleanliness_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['cleanliness_comment']);
			} 
			if($_POST['body_damage'] == 'Defective') {
				$ticket_category = 'Fresh body damage';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['body_damage_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['body_damage_comment']);
			} 
			if($_POST['tire_wheels'] == 'Defective') {
				$ticket_category = 'Tires and Wheels';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['tire_wheels_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['tire_wheels_comment']);
			} 
			if($_POST['exhaust'] == 'Defective') {
				$ticket_category = 'Exhaust System';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['exhaust_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['exhaust_comment']);
			} 
			if($_POST['interlock_system'] == 'Defective') {
				$ticket_category = 'Interlock System';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['interlock_system_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['interlock_system_comment']);
			} 
			if($_POST['wheelchair'] == 'Defective') {
				$ticket_category = 'Wheelchair lift and ramp';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['wheelchair_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['wheelchair_comment']);
			} 
			if($_POST['belts'] == 'Defective') {
				$ticket_category = 'Belts and Securement Devices';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['belts_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['belts_comment']);
			} 
			if($_POST['first_aid'] == 'Defective') {
				$ticket_category = 'First Aid Kit';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['first_aid_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['first_aid_comment']);
			} 
			if($_POST['flares_triangles'] == 'Defective') {
				$ticket_category = 'Flares and Triangles';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['flares_triangles_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['flares_triangles_comment']);
			} 
			if($_POST['fire_suppression_system'] == 'Defective') {
				$ticket_category = 'Fire Suppression System';
				
				$data = array(
					'ticket_date' => $_POST['inspection_date'],
					'van_number' => $_POST['van_number'],
					'vehicle_location' => $_POST['vehicle_location'],
					'category' => $ticket_category,
					'description' => $_POST['fire_suppression_system_comment']
				);
				
				$results = $this->db->insert('service_orders', $data);

				$this->notify($_POST['inspection_date'], $_POST['van_number'], $_POST['vehicle_location'], $ticket_category, $_POST['fire_suppression_system_comment']);
			} 
			
	

	}

	public function service_tickets()
	{


			$id = $_POST['id'];
			$ticket_date = $_POST['ticket_date'];
			$van_number = $_POST['van_number'];
			$vehicle_location = $_POST['vehicle_location'];
			$category = $_POST['category'];
			$description = $_POST['description'];

			$data = array(
				'ticket_date' => $ticket_date,
				'van_number' => $van_number,
				'vehicle_location' => $vehicle_location,
				'category' => $category,
				'description' => $description
			);
			
			$results = $this->db->insert('service_orders', $data);
			

			if($results)
			{			
				$status = 'OK';
			} else 
			{
				$status = 'FAILED';
			}
		
			echo json_encode(array("status"=>$status));
			
			$this->notify($ticket_date, $van_number, $vehicle_location, $category, $description);


	}

	public function work_orders()
	{
		$query = $this->service_orders_model->get_work_orders();

		$results = $query->result_array();
    
        echo json_encode($results);

	}

	public function work_order_signatures()
	{

        $id = $_POST['id'];
        $tech_notes = $_POST['tech_notes'];
        $tech_name = $_POST['tech_name'];
        $signature_date = $_POST['signature_date'];
        $signature = $_POST['signature'];

        $data = array(
			'tech_notes' => $tech_notes,
			'tech_name' => $tech_name,
			'signature_date' => $signature_date,
			'signature' => $signature
		);

		$this->db->set($data);
		$this->db->where('id', $id);		
		$results = $this->db->update('service_orders');

        if($results)
        {
            $status = 'OK';
        } else 
        {
            $status = 'FAILED';
        }
    
        echo json_encode(array("status"=>$status));

	}

	public function test()
	{
		$this->notify('2021-03-08 10:34:33', '19', 'Quest House', 'Air Conditioning/Heat', 'oidj oijw doij dowijd owidj wodij wdoij wdoij wdoaij wdoij wdoij wdoij wdoijw doijw doijw doijw doijw doijw diojw doiwjd oiwjd oiwjd wodij wdoij wdoij wdoij dwoij wdoij wdoij wdoij wdoij wdoijw doijw doijw dowijd owidj wodij wodij wodij wijw odij doijw doiwjd owijd owidj owidj owidj woidj woidj wodij wodij wodij wodij wodij woidj wodijw doijw odijw odj');
	}

	private function notify($ticket_date, $van_number, $vehicle_location, $category, $description)
	{
		$data_array = array(
			'$ticket_date' => $ticket_date,
			'$van_number' => $van_number,
			'$vehicle_location' => $vehicle_location,
			'$category' => $category,
			'$description' => $description
		);

		$query = $this->db->query('SELECT email FROM users WHERE service_order_notifications = 1;');

		foreach($query->result_array() as $r) {
			$emails[] = $r['email'];
		}

		$mail = new Notifications();
		$mail->send_mail($emails, 'noreply@dacco.org', 'New Service Ticket', [], [], '', [], 'new_ticket', '', $data_array);
	}
	
}

?>