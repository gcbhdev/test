<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking_sheet extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library(array('form_validation'));
        $this->load->model(array('tracking_sheet_model', 'forms_model'));

		if (!$this->session->userdata('user_id'))
		{
			// redirect them to the login page
			redirect('/auth/login', 'refresh');
		}		
	}
	
	public function index()
	{
        $this->load->view('tracking_sheet');
    }

    public function supervisors()
	{
        $this->load->view('tracking_sheet_supervisors');
    }
    
	public function edit($id = null)
	{
        $data['programs'] = $this->forms_model->get_programs();
        $data['tracking_sheet_id'] = $id;

        if($id){
            $data['audit'] = $this->tracking_sheet_model->get_audit_logs($id);
            $status = $this->tracking_sheet_model->get_tracking_sheet_status($id);
            if($status != 'In Progress'){
                redirect('tracking_sheet', 'refresh');
            }
        } else {
            $data['tracking_sheet'] = null;
        }

		$this->load->view('add_tracking_sheet', $data);
    } 

    public function report($id = null)
	{
        if ($id == null || $id == 'hr'){
            $this->load->view('tracking_sheet_report');
        } elseif ($id == 'finance') {
            $this->load->view('tracking_sheet_report_finance');
        }
    }

	public function get_travel_logs()
	{

        // initilize all variable
        $params = $columns = $query = $logs = $data = array();

        $params = $_REQUEST;

        //define index of column
        $columns = array(
            0 => 'employee_name',
            1 => 'tracking_sheet_status',
            2 => 'amount'
        );
        //$column_no = $params['order'][0]['column'];
        //$sort = $columns[($params['order'][0]['column'] == null ? 0 : $params['order'][0]['column'])];
        $where = $sqlTot = $sqlRec = "";

        $query = $this->tracking_sheet_model->get_travel_logs($params['start'], $params['length']);

        $logs = $query->result_array();
        $totalRecords = '';

        foreach ($logs as $r) {
            //$no++;
            $row = array();
            
            if($r['tracking_sheet_status'] == 'In Progress'){
                $color = 'badge-primary-soft';
            } elseif($r['tracking_sheet_status'] == 'Submitted'){
                $color = 'badge-indigo-soft';
            } elseif($r['tracking_sheet_status'] == 'Approved'){
                $color = 'badge-yellow-soft';
            } elseif($r['tracking_sheet_status'] == 'Paid'){
                $color = 'badge-green-soft';
            }

            $row[] = $r['employee_name'];
            $row[] = '<div class="badge '.$color.' badge-pill">'.$r['tracking_sheet_status'].'</div>';
            $row[] = '$' . number_format($r['amount'], 2, '.', ',');
            $row[] = ($r['tracking_sheet_status'] == "In Progress" ? '<a href="'.base_url().'tracking_sheet/edit/'.$r['tracking_sheet_id'].'" class="btn btn-primary btn-sm btn-icon-split mr-1"><span class="icon text-white-50"><i class="fas fa-edit"></i></span><span class="text">Edit</span></a><a href="javascript:void" class="btn btn-danger btn-sm btn-icon-split" onclick="delete_tracking_sheet('.$r['tracking_sheet_id'].', 1);"><span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Delete</span></a>' : '<a href="javascript:void" class="btn btn-danger btn-sm btn-icon-split" data-toggle="modal" data-target="#TrackingSheetModal" onclick="view_tracking_sheet('.$r['tracking_sheet_id'].', 1);"><span class="icon text-white-50"><i class="fas fa-eye"></i></span><span class="text">View</span></a>');
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

    public function get_travel_logs_supervisor()
	{

        // initilize all variable
        $params = $columns = $query = $logs = $data = array();

        $params = $_REQUEST;

        //define index of column
        $columns = array(
            0 => 'employee_name',
            1 => 'date_submitted',
            2 => 'tracking_sheet_status',
            3 => 'amount'
        );
        //$column_no = $params['order'][0]['column'];
        $sort = $columns[($params['order'][0]['column'] == null ? 0 : $params['order'][0]['column'])];
        $where = $sqlTot = $sqlRec = "";

        $query = $this->tracking_sheet_model->get_travel_logs_supervisor($params['start'],$params['length'], $sort .' '. $params['order'][0]['dir'], $params['startDate'], $params['endDate']);

        $logs = $query->result_array();
        $totalRecords = '';

        foreach ($logs as $r) {
            //$no++;
            $row = array();
            
            if($r['tracking_sheet_status'] == 'In Progress'){
                $color = 'badge-primary-soft';
            } elseif($r['tracking_sheet_status'] == 'Submitted'){
                $color = 'badge-indigo-soft';
            } elseif($r['tracking_sheet_status'] == 'Approved'){
                $color = 'badge-yellow-soft';
            } elseif($r['tracking_sheet_status'] == 'Paid'){
                $color = 'badge-green-soft';
            }

            $date = date_create($r['date_submitted']);

            $row[] = $r['employee_name'];
            $row[] = '<b>'.date_format($date, 'm/d/Y').'<b>';
            $row[] = '<div class="badge '.$color.' badge-pill">'.$r['tracking_sheet_status'].'</div>';
            $row[] = '$' . number_format($r['amount'], 2, '.', ',');
            $row[] = '<a href="javascript:void" class="btn btn-danger btn-sm btn-icon-split" data-toggle="modal" data-target="#TrackingSheetModal" onclick="view_tracking_sheet('.$r['tracking_sheet_id'].', '.($r['tracking_sheet_status'] == "Submitted" ? 0:1).');"><span class="icon text-white-50"><i class="fas fa-eye"></i></span><span class="text">View</span></a>';
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
	
	public function get_details()
	{

        // initilize all variable
        $params = $columns = $query = $logs = $data = array();

        $params = $_REQUEST;

        //define index of column
        $columns = array(
            0 => 'travel_date',
            1 => 'origin',
            2 => 'destination',
            3 => 'purpose',
            4 => 'description',
            5 => 'meals',
            6 => 'lodging',
            7 => 'mileage',
            8 => 'other_trans_amount',
            9 => 'incidental_type'
        );
        //$column_no = $params['order'][0]['column'];
        //$sort = $columns[($params['order'][0]['column'] == null ? 0 : $params['order'][0]['column'])];
        $where = $sqlTot = $sqlRec = "";

        $query = $this->tracking_sheet_model->get_details($params['tracking_sheet_id']);

        $logs = $query->result_array();
        $totalRecords = '';

        foreach ($logs as $r) {
            //$no++;
            $row = array();
            
            $date = date_create($r['travel_date']);

            $row[] = '<b>'.date_format($date, 'm/d/Y').'<b>';
            $row[] = $r['origin'];
            $row[] = $r['destination'];
            $row[] = $r['purpose'];
            $row[] = $r['description'];
            $row[] = '$' . number_format($r['meals'], 2, '.', ',');
            $row[] = '$' . number_format($r['lodging'], 2, '.', ',');
            $row[] = $r['mileage'];
            $row[] = '$' . number_format($r['other_trans_amount'], 2, '.', ',');
            $row[] = $r['incidental_type'];
            $row[] = '<a class="mr-3" href="javascript:void" onclick="edit_details('.$r['id'].',\''.date_format($date, 'm/d/Y').'\','.'\''.$r['origin'].'\','.'\''.$r['destination'].'\','.'\''.$r['purpose'].'\','.'\''.$r['program_id'].'\','.'\''.$r['meals'].'\','.'\''.$r['lodging'].'\','.'\''.$r['mileage'].'\','.'\''.$r['other_trans_amount'].'\','.'\''.$r['incidental_type'].'\''.')"><i class="fas fa-edit"></i></a><a href="javascript:void" onclick="delete_detail('.$r['id'].');"><i class="fas fa-trash"></i></a>';
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
    
    public function add_details()
	{
        $tracking_sheet_id = $_POST['tracking_sheet_id'];
        $travel_date = $_POST['travel_date'];
        $origin = $_POST['origin'];
        $destination = $_POST['destination'];
        $purpose = $_POST['purpose'];
        $program_id = $_POST['program_id'];
        $meals = $_POST['meals'];
        $lodging = $_POST['lodging'];
        $mileage = $_POST['mileage'];
        $other_trans_amount = $_POST['other_trans_amount'];
        $incidental_type = $_POST['incidental_type'];

        $this->tracking_sheet_model->add_details($tracking_sheet_id, $travel_date, $origin, $destination, $purpose, $program_id, $meals, $lodging, $mileage, $other_trans_amount, $incidental_type);
    }

    public function update_details()
	{
        $id = $_POST['id'];
        $tracking_sheet_id = $_POST['tracking_sheet_id'];
        $travel_date = $_POST['travel_date'];
        $origin = $_POST['origin'];
        $destination = $_POST['destination'];
        $purpose = $_POST['purpose'];
        $program_id = $_POST['program_id'];
        $meals = $_POST['meals'];
        $lodging = $_POST['lodging'];
        $mileage = $_POST['mileage'];
        $other_trans_amount = $_POST['other_trans_amount'];
        $incidental_type = $_POST['incidental_type'];

        $this->tracking_sheet_model->update_details($id, $tracking_sheet_id, $travel_date, $origin, $destination, $purpose, $program_id, $meals, $lodging, $mileage, $other_trans_amount, $incidental_type);
    }

    public function delete_detail()
	{
        $id = $_POST['id'];

        $this->tracking_sheet_model->delete_detail($id);
    }

    public function add_tracking_sheet()
	{
        //$program_id = $_POST['program_id'];

        $tracking_sheet_id = $this->tracking_sheet_model->add_tracking_sheet();
        //$tracking_sheet_id = $query->result_array();

        echo json_encode($tracking_sheet_id);  // send data as json format
    }

    public function update_tracking_sheet()
	{
        $tracking_sheet_id = $_POST['tracking_sheet_id'];
        $program_id = $_POST['program_id'];

        $this->tracking_sheet_model->update_tracking_sheet($tracking_sheet_id, $program_id);
        //$tracking_sheet_id = $query->result_array();

        //echo json_encode($tracking_sheet_id);  // send data as json format
    }

    public function get_totals()
	{
        $tracking_sheet_id = $_POST['tracking_sheet_id'];

        $data = $this->tracking_sheet_model->get_totals($tracking_sheet_id);

        echo json_encode($data);  // send data as json format
    }

    public function get_report()
	{

        // initilize all variable
        $params = $columns = $query = $logs = $data = array();

        $params = $_REQUEST;

        //define index of column
        $columns = array(
            0 => 'employee_name',
            1 => 'employee_no',
            2 => 'gl_num',
            3 => 'program_code',
            4 => 'fung',
            5 => 'allocation',
            6 => 'amount',
            7 => 'date_from',
            8 => 'date_to'
        );
        $column_no = $params['order'][0]['column'];
        $sort = $columns[($params['order'][0]['column'] == null ? 0 : $params['order'][0]['column'])];
        $where = $sqlTot = $sqlRec = "";

        $query = $this->tracking_sheet_model->get_travel_log_report($params['start'],$params['length'], $sort .' '. $params['order'][0]['dir'], $params['startDate'], $params['endDate']);

        $logs = $query->result_array();
        $totalRecords = '';

        foreach ($logs as $r) {
            //$no++;
            $row = array();
            
            $date = date_create($r['date_from']);
            $date2 = date_create($r['date_to']);

            $row[] = $r['employee_name'];
            $row[] = $r['employee_no'];
            $row[] = $r['gl_num'];
            $row[] = $r['program_code'];
            $row[] = '<div contenteditable class="update" data-id="' . $r['tracking_sheet_id'] . '" data-column="fund">' . $r['fund'] . '</div>';;
            $row[] = $r['allocation'];
            $row[] = '$' . number_format($r['amount'], 2, '.', ',');
            $row[] = date_format($date, 'm/d/Y');
            $row[] = date_format($date2, 'm/d/Y');
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

    public function get_report_finance()
	{

        // initilize all variable
        $params = $columns = $query = $logs = $data = array();

        $params = $_REQUEST;

        //define index of column
        $columns = array(
            0 => 'travel_date',
            1 => 'employee_name',
            2 => 'origin',
            3 => 'destination',
            4 => 'purpose',
            5 => 'description',
            6 => 'meals',
            7 => 'lodging',
            8 => 'mileage',
            9 => 'other_trans_amount',
            10 => 'incidental_type'
        );
        $column_no = $params['order'][0]['column'];
        $sort = $columns[($params['order'][0]['column'] == null ? 0 : $params['order'][0]['column'])];
        $where = $sqlTot = $sqlRec = "";

        $query = $this->tracking_sheet_model->get_travel_log_report_finance($params['start'],$params['length'], $sort .' '. $params['order'][0]['dir'], $params['startDate'], $params['endDate']);

        $logs = $query->result_array();
        $totalRecords = '';

        foreach ($logs as $r) {
            //$no++;
            $row = array();
            
            $date = date_create($r['travel_date']);

            $row[] = date_format($date, 'm/d/Y');
            $row[] = $r['employee_name'];
            $row[] = $r['origin'];
            $row[] = $r['destination'];
            $row[] = $r['purpose'];
            $row[] = $r['description'];
            $row[] = $r['meals'];
            $row[] = $r['lodging'];
            $row[] = $r['mileage'];
            $row[] = $r['other_trans_amount'];
            $row[] = $r['incidental_type'];
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

    public function view_tracking_sheet()
	{
        $id = $_POST['id'];
        $query = $this->tracking_sheet_model->get_details($id);
        $json_data['travel_logs'] = $query->result_array();

        $query2 = $this->tracking_sheet_model->view_tracking_sheet($id);
        $json_data['info'] = $query2->result_array();

        $json_data['totals'] = $this->tracking_sheet_model->get_totals($id);

        $json_data['audit'] = $this->tracking_sheet_model->get_audit_logs($id);

        echo json_encode($json_data);  // send data as json format
    }

    public function update_tracking_sheet_report()
	{		
        $id = $_POST['id'];
		$column = $_POST['column_name'];
		$value = ($_POST['value'] == '' ? null:$_POST['value']);
		
		$this->tracking_sheet_model->update_tracking_sheet_report($id, $column, $value);
    } 

    public function export_logs()
	{
        $start = $_POST['startDate'];
        $end = $_POST['endDate'];
        $export_type = $_POST['export_type'];

        $query = $this->tracking_sheet_model->get_travel_log_report_export($start, $end, $export_type);
        $logs = $query->result_array();

        echo json_encode($logs);  // send data as json format
    }

    public function export_logs_finance()
	{
        $start = $_POST['startDate'];
        $end = $_POST['endDate'];

        $query = $this->tracking_sheet_model->get_travel_log_report_finance_export($start, $end);
        $logs = $query->result_array();

        echo json_encode($logs);  // send data as json format
    }
    
    public function submit_for_approval()
	{
        $id = $_POST['id'];

        $query = $this->tracking_sheet_model->submit_for_approval($id);

        $this->tracking_sheet_model->audit($id, 'Submitted', 'No comments');

        redirect('tracking_sheet', 'refresh');
    }

    public function approve_tracking_sheet()
	{
        $id = $_POST['id'];

        $query = $this->tracking_sheet_model->approve_tracking_sheet($id);

        //redirect('tracking_sheet', 'refresh');
    }

    public function reject_tracking_sheet()
	{
        $id = $_POST['id'];
        $comments = $_POST['comments'];

        $query = $this->tracking_sheet_model->reject_tracking_sheet($id, $comments);

        //redirect('tracking_sheet', 'refresh');
    }

    public function delete_tracking_sheet()
	{
        $id = $_POST['id'];

        $this->tracking_sheet_model->delete_tracking_sheet($id);
    }
}

?>