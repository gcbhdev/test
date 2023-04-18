<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facility_inspection extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation'));
		$this->load->model('facility_inspection_model');

		if (!$this->session->userdata('user_id'))
		{
			// redirect them to the login page
			redirect('/auth/login', 'refresh');
		}		
	}
	
	public function index()
	{
		$this->load->view('facility_inspection');
	}
	
	public function get_facility_inspections()
	{
        // initilize all variable
        $params = $columns = $query = $tenants = $data = array();

        $params = $_REQUEST;

        //define index of column
        $columns = array(
            0 => 'event_date',
            1 => 'facility',
            2 => 'location',
            3 => 'quarter',
            4 => 'shift'
        );
        //$column_no = $params['order'][0]['column'];
        $sort = $columns[($params['order'][0]['column'] == null ? 0 : $params['order'][0]['column'])];
        $where = $sqlTot = $sqlRec = "";

        $query = $this->facility_inspection_model->get_facility_inspections($params['start'],$params['length'], $sort .' '. $params['order'][0]['dir'], $params['startDate'], $params['endDate']);

        $logs = $query->result_array();
        $totalRecords = 0;

        foreach ($logs as $r) {
            //$no++;
            $row = array();
            
            $date = date_create($r['event_date']);

            $row[] = '<b>'.date_format($date, 'm/d/Y').'<b>';
            $row[] = $r['facility'];
            $row[] = $r['location'];
            $row[] = $r['quarter'];
            $row[] = $r['shift'];
            /*$row[] = ($r['inspection_type'] == 'Pre-trip Inspection' ? '<div class="badge badge-primary badge-pill">Pre-Trip Inspection</div>' : '<div class="badge badge-primary badge-pill">Post-Trip Inspection</div>');
            $row[] = ($r['status'] == 1 ? '<div class="badge badge-success badge-pill">Passed</div>' : '<div class="badge badge-danger badge-pill">Failed</div>');
            $row[] = ($r['manager_name'] == null ? '' : $r['manager_name']);
            $row[] = ($r['manager_signature_date'] == null ? '' : $r['manager_signature_date']);*/
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
    
	public function get_facility_inspection()
	{
        $id = $_POST['id'];

        $query = $this->facility_inspection_model->get_facility_inspection($id);

        $data = $query->result_array();

        echo json_encode($data);
    }    

    public function export_facility_inspections()
	{
        $start = $_POST['startDate'];
        $end = $_POST['endDate'];

        $query = $this->facility_inspection_model->export_facility_inspections($start, $end);
        $inspections = $query->result_array();

        echo json_encode($inspections);  // send data as json format
    }

    public function sign_facility_inspection()
	{

        $id = $_POST['id'];
        $password = $_POST['password'];
        $corrective_action = $_POST['corrective_action'];

        if($this->facility_inspection_model->sign_facility_inspection($id, $password, $corrective_action)){
            echo "true";  
        } else {
            echo "false"; 
        }

        

	}
	
}

?>

