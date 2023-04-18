<?php
class Facility_inspection_model extends CI_model{

    public function __construct() {
        parent::__construct();
		

	}
	
	public function total_facility_inspections()
	{		
		$query = $this->db->query('SELECT count(*) as total FROM facility_inspection;');

		return $query->row()->total;
	}
	
	public function get_facility_inspections($start, $length, $sort, $startDate, $endDate)
	{		
		$query = $this->db->query('SELECT f.id, `description` AS facility, `location`, quarter, event_date, shift, manager_signature_date, (SELECT count(*) FROM facility_inspection WHERE CAST(event_date as date) >= "'.$startDate.'" AND CAST(event_date as date) <= "'.$endDate.'") as v_count FROM facility_inspection f JOIN programs p ON f.facility = p.id WHERE CAST(event_date as date) >= "'.$startDate.'" AND CAST(event_date as date) <= "'.$endDate.'" ORDER by event_date DESC LIMIT '.$start.', '.$length.';');

		return $query;
	}

	public function get_facility_inspection($id)
	{		
		$query = $this->db->query('SELECT  f.id, `description` AS facility, `location`, `quarter`, `event_date`, `shift`, `exit_door_clear`, `exit_signs_visible`, `fire_ext_access`, `procedures_posted`, `smoke_alarms`, `building_interior_clean`, `building_floors_dry`, `aisles_clear`, `building_carpet`, `outlets`, `walkways`, `extension_cords`, `back_entrance_locked`, `door_mats`, `stairwells`, `stairs_steps_nonslip`, `spill_kit_supplied`, `spill_kit_accessible`, `first_aid_kit_supplied`, `first_aid_kit_accessible`, `first_aid_procedures_posted`, `vents_clear`, `vent_filters_clean`, `conf_room_furn_good`, `conf_area_walkways_free`, `temperature_logs_completed`, `furniture_clean`, `shower_curtains`, `clean_and_graffiti_free`, `hand_wash_supplies`, `paper_products_stocked`, `plumbing`, `boxes_not_stacked`, `file_draws_closed`, `closet_uncluttered`, `cabinet_tops_free`, `storage_level`, `office_interior_clean`, `floors_clear`, `office_furniture_good`, `desk_and_chair_mats`, `shelved_not_overloaded`, `office_floors_dry`, `office_carpet`, `office_boxes_not_stacked`, `office_cabinet_tops_free`, `office_file_draws_closed`, `office_outlets`, `office_walkways`, `office_extension_cords`, `no_personal_heaters`, `monitor_not_visible`, `screen_locked`, `countertops`, `equipment_maintained`, `refrigerator`, `client_food`, `cupboards_closed`, `coffee_maker`, `microwave`, `free_of_litter`, `walkways_steps_patios`, `adequate_outdoor_lighting`, `parking_lot`, `no_downed_power_lines`, `no_broken_bulbs`, `dorms_clean`, `dorms_neat`, `personal_belongings`, `no_contraband`, `details1`, `details2`, `control_gown`, `fluid_resistant_mask`, `nitrile_exam_gloves`, `antimicrobial_hand_wipes`, `biohazard_bag`, `bouffant_cap`, `fluid_solidifier_packet`, `disinfectant_spray`, `scoop_with_scraper`, `paper_towel`, `disposal_bag`, `absorbent_compress`, `adhesive_bandages`, `adhesive_tape`, `antibiotic_treatment`, `antiseptic_swabs`, `bandage_compress_2`, `bandage_compress_3`, `bandage_compress_4`, `breathing_barrier`, `burn_treatment`, `first_aid_guide`, `medical_exam_glove`, `roller_bandage`, `sterile_pads`, `triangular_bandage`, `corrective_action`, `completed_by`, `signature`, `manager_name`, `manager_signature_date` FROM facility_inspection f JOIN programs p ON f.facility = p.id WHERE f.id = '. $id .';');

		return $query;
	}	

	public function export_facility_inspections($start, $end)
	{		
		$query = $this->db->query('SELECT f.id, `description` AS facility, `location`, quarter, event_date, shift FROM facility_inspection f JOIN programs p ON f.facility = p.id WHERE CAST(event_date as date) >= "'.$start.'" AND CAST(event_date as date) <= "'.$end.'";');

		return $query;
	}

	public function sign_facility_inspection($id, $password, $corrective_action)
	{

		if (empty($password))
		{

			return FALSE;
		}

		$query = $this->db->query('SELECT id, password, active FROM users where id = '.$this->session->userdata('user_id').';');
		
						/*$this->identity_column . ', email, id, first_name, last_name, password, active, last_login')
						  ->where($this->identity_column, $this->session->userdata('user_id'))
						  ->limit(1)
						  ->order_by('id', 'desc')
						  ->get($this->tables['users']);*/


		if ($query->num_rows() === 1)
		{
			$user = $query->row();

			if ($this->verify_password($password, $user->password, $this->session->userdata('user_id')))
			{
				if ($user->active == 0)
				{
					return FALSE;
				}

				$data = array(
					'corrective_action' => $corrective_action,
					'manager_name' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'),
					'manager_signature_date' => date("Y-m-d h:m:s")
				);

				$this->db->set($data);
				$this->db->where('id', $id);		
				$results = $this->db->update('facility_inspection');

				return TRUE;
			}
		}

		return FALSE;
	}

	public function verify_password($password, $hash_password_db, $identity = NULL)
	{
		// Check for empty id or password, or password containing null char, or password above limit
		// Null char may pose issue: http://php.net/manual/en/function.password-hash.php#118603
		// Long password may pose DOS issue (note: strlen gives size in bytes and not in multibyte symbol)
		if (empty($password) || empty($hash_password_db))
		{
			return FALSE;
		}

		// password_hash always starts with $
		if (strpos($hash_password_db, '$') === 0)
		{
			return password_verify($password, $hash_password_db);
		}
		else
		{
			// Handle legacy SHA1 @TODO to delete in later revision
			return $this->_password_verify_sha1_legacy($identity, $password, $hash_password_db);
		}
	}

}


?>
