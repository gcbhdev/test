<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspections extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation'));
		$this->load->model('inspection_model');

		if (!$this->session->userdata('user_id'))
		{
			// redirect them to the login page
			redirect('/auth/login', 'refresh');
		}		
	}
	
	public function index()
	{
		$this->load->view('inspections');
	}
	
	public function get_inspections()
	{
        // initilize all variable
        $params = $columns = $query = $tenants = $data = array();

        $params = $_REQUEST;

        //define index of column
        $columns = array(
            0 => 'inspection_date',
            1 => 'unit_id',
            2 => 'driver_name',
            3 => 'mileage',
            4 => 'inspection_type',
            5 => 'status'
        );
        //$column_no = $params['order'][0]['column'];
        $sort = $columns[($params['order'][0]['column'] == null ? 0 : $params['order'][0]['column'])];
        $where = $sqlTot = $sqlRec = "";

        $query = $this->inspection_model->get_inspections($params['start'],$params['length'], $sort .' '. $params['order'][0]['dir'], $params['startDate'], $params['endDate']);

        $logs = $query->result_array();
        $totalRecords = 0;

        foreach ($logs as $r) {
            //$no++;
            $row = array();
            
            $date = date_create($r['inspection_date']);

            $row[] = '<b>'.date_format($date, 'm/d/Y').'<b>';
            $row[] = $r['unit_id'];
            $row[] = $r['driver_name'];
            $row[] = $r['mileage'];
            $row[] = ($r['inspection_type'] == 'Pre-trip Inspection' ? '<div class="badge badge-primary badge-pill">Pre-Trip Inspection</div>' : '<div class="badge badge-primary badge-pill">Post-Trip Inspection</div>');
            $row[] = ($r['status'] == 1 ? '<div class="badge badge-success badge-pill">Passed</div>' : '<div class="badge badge-danger badge-pill">Failed</div>');
            $row[] = ($r['manager_name'] == null ? '' : $r['manager_name']);
            $row[] = ($r['manager_signature_date'] == null ? '' : $r['manager_signature_date']);
            $row[] = '<button class="btn btn-danger btn-sm btn-icon-split" data-toggle="modal" data-target="#InspectionModal" onclick="view_inspection('.$r['id'].', '.($r['manager_signature_date'] == null ? 0 : 1).');"><span class="icon text-white-50"><i class="fas fa-eye"></i></span><span class="text">View</span></button> <button class="btn btn-primary btn-sm btn-icon-split" onclick="generate_pdf('.$r['id'].');"><span class="icon text-white-50"><i class="fas fa-file-pdf"></i></span><span class="text">PDF</span></button>';
            $totalRecords = $r['v_count'];
            $data[] = $row;
        }

        $json_data = array(
                "draw"            => intval( $params['draw'] ),
                "recordsTotal"    => intval( $totalRecords ),
                "recordsFiltered" => intval( $totalRecords ),
                "data"            => $data   // total data array
                );

        echo json_encode($json_data);  // send data as json format

    }	
    
	public function get_inspection()
	{
        $id = $_POST['id'];

        $query = $this->inspection_model->get_inspection($id);

        $logs = $query->result_array();

        foreach ($logs as $r) { 

            $data['unit_id'] = $r['unit_id'];
            $data['inspection_date'] = $r['inspection_date'];
            $data['inspection_type'] = ($r['inspection_type'] == 'Pre-trip Inspection' ? 1 : 0);
            $data['mileage'] = $r['mileage'];
            $data['driver_name'] = $r['driver_name'];
            $data['signature'] = $r['signature'];
            $data['manager_name'] = $r['manager_name'];
            $data['manager_signature_date'] = $r['manager_signature_date'];
            
            $data['inspection1'][] = array("name" => "Headlights", "status" => ($r['headlights'] == 1 ? "OK" : "Defective"), "comment" => $r['headlights_comment']);
            $data['inspection1'][] = array("name" => "Tail/Brake lights", "status" => ($r['tail_lights'] == 1 ? "OK" : "Defective"), "comment" => $r['tail_lights_comment']);
            $data['inspection1'][] = array("name" => "Back up Lights", "status" => ($r['backup_lights'] == 1 ? "OK" : "Defective"), "comment" => $r['backup_lights_comment']);
            $data['inspection1'][] = array("name" => "Back up Alarms", "status" => ($r['backup_alarm'] == 1 ? "OK" : "Defective"), "comment" => $r['backup_alarm_comment']);
            $data['inspection1'][] = array("name" => "Turn Signals", "status" => ($r['turn_signals'] == 1 ? "OK" : "Defective"), "comment" => $r['turn_signals_comment']);
            $data['inspection1'][] = array("name" => "Clearance Lights", "status" => ($r['clearance_lights'] == 1 ? "OK" : "Defective"), "comment" => $r['clearance_lights_comment']);
            $data['inspection1'][] = array("name" => "Windshield Wipers", "status" => ($r['wipers'] == 1 ? "OK" : "Defective"), "comment" => $r['wipers_comment']);
            $data['inspection1'][] = array("name" => "Interior Lights", "status" => ($r['interior_lights'] == 1 ? "OK" : "Defective"), "comment" => $r['interior_lights_comment']);
            $data['inspection1'][] = array("name" => "Interior Gauges and Warning System", "status" => ($r['interior_gauges'] == 1 ? "OK" : "Defective"), "comment" => $r['interior_gauges_comment']);
            $data['inspection1'][] = array("name" => "Climate Control", "status" => ($r['climate_control'] == 1 ? "OK" : "Defective"), "comment" => $r['climate_control_comment']);
            $data['inspection1'][] = array("name" => "Mirrors", "status" => ($r['mirrors'] == 1 ? "OK" : "Defective"), "comment" => $r['mirrors_comment']);
            $data['inspection1'][] = array("name" => "Parking brakes", "status" => ($r['parking_brakes'] == 1 ? "OK" : "Defective"), "comment" => $r['parking_brakes_comment']);
            $data['inspection1'][] = array("name" => "Service brakes", "status" => ($r['service_brakes'] == 1 ? "OK" : "Defective"), "comment" => $r['service_brakes_comment']);
            $data['inspection1'][] = array("name" => "Steering", "status" => ($r['steering'] == 1 ? "OK" : "Defective"), "comment" => $r['steering_comment']);
            $data['inspection1'][] = array("name" => "Horn", "status" => ($r['horn'] == 1 ? "OK" : "Defective"), "comment" => $r['horn_comment']);
            $data['inspection1'][] = array("name" => "Fire extinguisher", "status" => ($r['extinguisher'] == 1 ? "OK" : "Defective"), "comment" => $r['extinguisher_comment']);
            $data['inspection1'][] = array("name" => "Emergency Exit Windows and Door", "status" => ($r['emergency'] == 1 ? "OK" : "Defective"), "comment" => $r['emergency_comment']);
            $data['inspection1'][] = array("name" => "Passenger Door", "status" => ($r['passenger_doors'] == 1 ? "OK" : "Defective"), "comment" => $r['passenger_doors_comment']);
            $data['inspection1'][] = array("name" => "Overall cleanliness", "status" => ($r['cleanliness'] == 1 ? "OK" : "Defective"), "comment" => $r['cleanliness_comment']);
            $data['inspection1'][] = array("name" => "Fresh body damage", "status" => ($r['body_damage'] == 1 ? "OK" : "Defective"), "comment" => $r['body_damage_comment']);
            $data['inspection1'][] = array("name" => "Tires and Wheels", "status" => ($r['tire_wheels'] == 1 ? "OK" : "Defective"), "comment" => $r['tire_wheels_comment']);
            $data['inspection1'][] = array("name" => "Exhaust System", "status" => ($r['exhaust'] == 1 ? "OK" : "Defective"), "comment" => $r['exhaust_comment']);

            $data['inspection2'][] = array("name" => "Interlock System", "status" => ($r['interlock_system'] == 1 ? "OK" : $r['interlock_system'] == 3 ? "N/A" : "Defective"), "comment" => $r['interlock_system_comment']);
            $data['inspection2'][] = array("name" => "Wheelchair lift and ramp", "status" => ($r['wheelchair'] == 1 ? "OK" : $r['wheelchair'] == 3 ? "N/A" : "Defective"), "comment" => $r['wheelchair_comment']);
            $data['inspection2'][] = array("name" => "Belts and Securement Devices", "status" => ($r['belts'] == 1 ? "OK" : "Defective"), "comment" => $r['belts_comment']);
            $data['inspection2'][] = array("name" => "First Aid Kit", "status" => ($r['first_aid'] == 1 ? "OK" : "Defective"), "comment" => $r['first_aid_comment']);
            $data['inspection2'][] = array("name" => "Flares and Triangles", "status" => ($r['flares_triangles'] == 1 ? "OK" : "Defective"), "comment" => $r['flares_triangles_comment']);
            $data['inspection2'][] = array("name" => "Fire Suppression System", "status" => ($r['fire_suppression_system'] == 1 ? "OK" : "Defective"), "comment" => $r['fire_suppression_system_comment']);
        }

        echo json_encode($data);
    }    

    public function export_inspections()
	{
        $start = $_POST['startDate'];
        $end = $_POST['endDate'];

        $query = $this->inspection_model->export_inspections($start, $end);
        $inspections = $query->result_array();

        echo json_encode($inspections);  // send data as json format
    }

    public function sign_inspection()
	{

        $id = $_POST['id'];
        $password = $_POST['password'];

        if($this->inspection_model->sign_inspection($id, $password)){
            echo "true";  
        } else {
            echo "false"; 
        }

        

	}
	
}

?>

