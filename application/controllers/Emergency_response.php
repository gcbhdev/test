<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emergency_response extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation'));
		$this->load->model('emergency_response_model');

		if (!$this->session->userdata('user_id'))
		{
			// redirect them to the login page
			redirect('/auth/login', 'refresh');
		}		
	}
	
	public function index()
	{
		$this->load->view('emergency_response');
	}
	
	public function get_emergency_responses()
	{
        // initilize all variable
        $params = $columns = $query = $tenants = $data = array();

        $params = $_REQUEST;

        //define index of column
        $columns = array(
            0 => 'event_date',
            1 => 'quarter',
            2 => 'program',
            3 => 'location',
            4 => 'shift',
            5 => 'actual_or_event'
        );
        //$column_no = $params['order'][0]['column'];
        $sort = $columns[($params['order'][0]['column'] == null ? 0 : $params['order'][0]['column'])];
        $where = $sqlTot = $sqlRec = "";

        $query = $this->emergency_response_model->get_emergency_responses($params['start'],$params['length'], $sort .' '. $params['order'][0]['dir'], $params['startDate'], $params['endDate']);

        $logs = $query->result_array();
        $totalRecords = 0;

        foreach ($logs as $r) {
            //$no++;
            $row = array();
            
            $date = date_create($r['event_date']);

            $row[] = '<b>'.date_format($date, 'm/d/Y').'<b>';
            $row[] = $r['quarter'];
            $row[] = $r['program'];
            $row[] = $r['location'];
            $row[] = $r['shift'];
            $row[] = '<div class="badge badge-primary badge-pill">'.$r['actual_or_drill'].'</div>';
            $row[] = '<button class="btn btn-danger btn-sm btn-icon-split" data-toggle="modal" data-target="#InspectionModal" onclick="view_emergency_response('.$r['id'].', '.($r['manager_signature_date'] == null ? 0 : 1).');"><span class="icon text-white-50"><i class="fas fa-eye"></i></span><span class="text">View</span></button> <button class="btn btn-primary btn-sm btn-icon-split" onclick="generate_pdf('.$r['id'].');"><span class="icon text-white-50"><i class="fas fa-file-pdf"></i></span><span class="text">PDF</span></button>';
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
    
	public function get_emergency_response()
	{
        $id = $_POST['id'];

        $query = $this->emergency_response_model->get_emergency_response($id);

        $data = $query->result_array();

        echo json_encode($data);
    }    

    public function export_emergency_responses()
	{
        $start = $_POST['startDate'];
        $end = $_POST['endDate'];

        $query = $this->emergency_response_model->export_emergency_responses($start, $end);
        $emergency_responses = $query->result_array();

        echo json_encode($emergency_responses);  // send data as json format
    }

    public function sign_emergency_response()
	{

        $id = $_POST['id'];
        $password = $_POST['password'];
        $improvements = $_POST['improvements'];
        $formal_debriefing = $_POST['formal_debriefing'];
        $formal_debriefing_details = $_POST['formal_debriefing_details'];

        if($this->emergency_response_model->sign_emergency_response($id, $password, $improvements, $formal_debriefing, $formal_debriefing_details)){
            echo "true";  
        } else {
            echo "false"; 
        }

        

	}
	
}

?>

