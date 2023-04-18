<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_orders extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('form_validation'));
		$this->load->model('service_orders_model');

		if (!$this->session->userdata('user_id'))
		{
			// redirect them to the login page
			redirect('/auth/login', 'refresh');
		}		
	}
	
	public function index()
	{
        $data['technicians'] = $this->service_orders_model->get_technicians();

		$this->load->view('service_orders', $data);
	}
	
	public function get_service_orders()
	{
        // initilize all variable
        $params = $columns = $query = $tenants = $data = array();

        $params = $_REQUEST;

        //define index of column
        $columns = array(
            0 => 'ticket_date',
            1 => 'van_number',
            2 => 'vehicle_location',
            3 => 'category',
            4 => 'assigned_to',
            5 => 'signature',
            6 => 'signature',
            7 => 'id',
        );
        //$column_no = $params['order'][0]['column'];
        $sort = $columns[($params['order'][0]['column'] == null ? 0 : $params['order'][0]['column'])];
        $where = $sqlTot = $sqlRec = "";

        $query = $this->service_orders_model->get_service_orders($params['start'],$params['length'], $sort .' '. $params['order'][0]['dir'], $params['startDate'], $params['endDate']);

        $logs = $query->result_array();
        $totalRecords = 0;

        foreach ($logs as $r) {
            //$no++;
            $row = array();
            
            $date = date_create($r['ticket_date']);

            $row[] = '<b>'.date_format($date, 'm/d/Y').'<b>';
            $row[] = $r['van_number'];
            $row[] = $r['vehicle_location'];
            $row[] = '<div class="badge badge-primary badge-pill">'.$r['category'].'</div>';
            $row[] = $r['assigned_to'];
            $row[] = ($r['signature'] != null ? '<div class="badge badge-success badge-pill">Completed</div>' : '<div class="badge badge-danger badge-pill">Incomplete</div>');
            $row[] = ($r['signature'] != null ? '<button class="btn btn-primary btn-sm btn-icon-split" onclick="generate_pdf('.$r['id'].');"><span class="icon text-white-50"><i class="fas fa-file-pdf"></i></span><span class="text">PDF</span></button>' : '<button class="btn btn-primary btn-sm btn-icon-split" onclick="generate_pdf('.$r['id'].');"><span class="icon text-white-50"><i class="fas fa-file-pdf"></i></span><span class="text">PDF</span></button>');
            $row[] = $r['id'];
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
    
    public function get_service_order()
	{
        $id = $_POST['id'];

        $query = $this->service_orders_model->get_service_order($id);

        $ticket = $query->result_array();

        foreach ($ticket as $r) { 

            $data['ticket_date'] = $r['ticket_date'];
            $data['van_number'] = $r['van_number'];
            $data['vehicle_location'] = $r['vehicle_location'];
            $data['category'] = $r['category'];
            $data['description'] = $r['description'];
            $data['tech_notes'] = $r['tech_notes'];
            $data['tech_name'] = $r['tech_name'];
            $data['signature_date'] = $r['signature_date'];
            $data['signature'] = $r['signature'];
        }

        echo json_encode($data);
    } 

    public function export_service_orders()
	{
        $start = $_POST['startDate'];
        $end = $_POST['endDate'];

        $query = $this->service_orders_model->export_service_orders($start, $end);
        $service_orders = $query->result_array();

        echo json_encode($service_orders);  // send data as json format
    }

    public function update_technician()
	{
        $id = $_POST['id'];
        $technician_id = $_POST['technician_id'];

        $this->service_orders_model->update_technician($id, $technician_id);

    } 
	
}

?>