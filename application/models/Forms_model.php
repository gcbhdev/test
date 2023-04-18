<?php
class Forms_model extends CI_model{

    public function __construct() {
        parent::__construct();
		

	}
	
	public function add($tablename, $data){
	
		$this->db->insert($tablename, $data);	
	
	}

	public function get_programs()
	{		
		$query = $this->db->query('SELECT id, `description` FROM programs where active = 1;');

		return $query->result_array();
	}	
	

}


?>
