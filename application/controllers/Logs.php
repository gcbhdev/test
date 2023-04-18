<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation'));
		$this->load->model('logs_model');

		if (!$this->session->userdata('user_id'))
		{
			// redirect them to the login page
			redirect('/auth/login', 'refresh');
		}		
	}
	
	public function index()
	{
		$this->load->view('van_logs');
	}
	
	public function get_logs()
	{
        // initilize all variable
        $params = $columns = $query = $logs = $data = array();

        $params = $_REQUEST;

        //define index of column
        $columns = array(
            0 => 'trip_date',
            1 => 'trip_code',
            2 => 'van_number',
            3 => 'driver_name',
            4 => 'program',
            5 => 'no_of_patients'
        );
        //$column_no = $params['order'][0]['column'];
        $sort = $columns[($params['order'][0]['column'] == null ? 0 : $params['order'][0]['column'])];
        $where = $sqlTot = $sqlRec = "";

        $query = $this->logs_model->get_logs($params['start'],$params['length'], $sort .' '. $params['order'][0]['dir'], $params['startDate'], $params['endDate']);

        $logs = $query->result_array();
        $totalRecords = '';

        foreach ($logs as $r) {
            //$no++;
            $row = array();
            
            $date = date_create($r['trip_date']);

            $row[] = '<b>'.date_format($date, 'm/d/Y').'<b>';
            $row[] = $r['trip_code'];
            $row[] = $r['van_number'];
            $row[] = $r['driver_name'];
            $row[] = $r['program'];
            $row[] = $r['no_of_patients'];
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
    
    public function export_logs()
	{
        $start = $_POST['startDate'];
        $end = $_POST['endDate'];

        $query = $this->logs_model->export_logs($start, $end);
        $logs = $query->result_array();

        echo json_encode($logs);  // send data as json format
    }
	
}

?>