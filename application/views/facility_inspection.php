<?php $this->view('components/header_start'); ?>

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

<?php $this->view('components/header_end'); ?>




                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Facility Inspection Report</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" onclick="exportCSV();"><i class="fas fa-download fa-sm text-white-50"></i> Export</button>
                            <div class="form-inline">
                                <div class="input-group mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Start:</div>
                                    </div>
                                    <input class="form-control" name="daterange" type="text" id="daterangestart" autocomplete="off" value="<?php echo date('m/d/Y'); ?>" />
                                </div>

                                <div class="input-group mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">End:</div>
                                    </div>
                                    <input class="form-control" name="daterange" type="text" id="daterangeend" autocomplete="off" value="<?php echo date('m/d/Y'); ?>" />
                                </div>
                                <button type="submit" class="btn btn-primary" onclick="getinspections();">Filter</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Event Date</th>
                                            <th>Facility</th>
                                            <th>Location</th>
                                            <th>Quarter</th>
                                            <th>Shift</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Event Date</th>
                                            <th>Facility</th>
                                            <th>Location</th>
                                            <th>Quarter</th>
                                            <th>Shift</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                <div id="csv-data" class="d-none"></div>

                <!-- View Inspection Modal-->
                <div class="modal fade" id="InspectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pre-trip/Post-trip Inspection Form</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div id="inspection_body" class="modal-body"></div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                <button id="sign_button"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#SignatureModal">Sign</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Signature Modal-->
                <div class="modal fade" id="SignatureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Signature</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div id="" class="modal-body">
                                <span id="password_error_message" style="color:red;"></span>
                                <input type="password" id="password" class="form-control" />
                                <input type="text" id="facility_inspection_id" class="form-control" hidden />
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="button" onclick="sign_facility_inspection();">Sign</a>
                            </div>
                        </div>
                    </div>
                </div>

			
				
<?php $this->view('components/footer_start'); ?>

    <!-- Page level plugins -->
    <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

    <script src="<?php echo base_url('assets/vendor/jspdf/jspdf.umd.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/jspdf/jspdf.plugin.autotable.min.js') ?>"></script>    



    <script type="text/javascript">
			var GlobalVariables = {
				'csrfToken'               	: <?php echo json_encode($this->security->get_csrf_hash()); ?>,
				'baseurl'					: '<?php echo base_url(); ?>',
                'dataTable' 				: '',
                'startDate'                 : '',
                'endDate'                   : ''
			};
			

		$(document).ready(function() {

            
            
            $('input[name="daterange"]').datepicker({

            });

            getinspections();
				
        });   

        function getinspections(){
            var start = $('#daterangestart').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
            var end = $('#daterangeend').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

            if(GlobalVariables.dataTable != ''){
                GlobalVariables.dataTable.destroy();
            }

			GlobalVariables.dataTable = $('#dataTable').DataTable({		
                "bProcessing": true,
				 "serverSide": true,
				 "stateSave": true,
				 "responsive": true,
				 "searching": false,
                 "columns":[
                    { "data": 0, "width": "75px" },
                    { "data": 1 },
                    { "data": 2 },
                    { "data": 3 },
                    { "data": 4 },
                    { "data": 5, "width": "150px" }
                 ],
				 "language": {
				   "emptyTable": "You have no facility inspections within the selected date range."
				 },
				 "ajax":{
					url : "<?php echo base_url('/facility_inspection/get_facility_inspections') ?>", // json datasource
					type: "post",  // type of method  ,GET/POST/DELETE
					data: {
                        'startDate': start,
                        'endDate': end
                    },
					complete: function () {
			
						
					},
					error: function(){
					  $("#employee_grid_processing").css("display","none");
					}
				  }
            });
        }

        function view_inspection(id, signature){
            //add confirm dialog here
            var postUrl = '<?php echo base_url('/facility_inspection/get_facility_inspection') ?>';
    
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'id': id
            };
            if(signature == 1){
                $('#sign_button').prop('disabled', true);
            } else{
                $('#sign_button').prop('disabled', false);
            }

            $('#facility_inspection_id').val(id);

            
    
            $.ajax({
                url: postUrl,
                type: 'POST',
                data: postData,
                datatype: 'json',
                success: function(response, textStatus, jqXHR) {
                    //////////////////////////////////////////////////////
                    console.log('Ajax Remove Card Response:', response);
                    //////////////////////////////////////////////////////

                    var data = JSON.parse(response);
                    var html = '';

                    for (i = 0; i < data.length; i++){

                    html += '<strong>Facility: </strong><u>' + data[i].facility + '</u><br>';
                    html += '<strong>Location: </strong><u>' + data[i].location + '</u><br>';
                    html += '<strong>Quarter: </strong><u>' + data[i].quarter + '</u><br>';
                    html += '<strong>Date of Inspection: </strong><u>' + data[i].event_date + '</u><br>';
                    html += '<strong>Shift: </strong><u>' + data[i].shift + '</u><br><br>';

                    html += '<hr>';
                    html += '<strong>Instructions:</strong> Check each item below as “Yes”, “No” or “NA” (not applicable). For each item that is checked as “NO”, please provide details and submit recommendations to correct the condition or unsafe practice.';
                    html += '<hr>';

                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>General Office Areas</th>' +
                                        '<th style="width: 120px;">Responses</th>' +
                                    '</tr>' +
                                    '</thead>';

                    
                        html +='<tr><td>Fire</td><td>' + data[i].exit_door_clear + '</td></tr>';
                        html +='<tr><td>Exit Signs Visible and Light Working Properly</td><td>' + data[i].exit_signs_visible + '</td></tr>';
                        html +='<tr><td>Fire Extinguishers Accessible and In Proper Working Order</td><td>' + data[i].fire_ext_access + '</td></tr>';
                        html +='<tr><td>Fire/Emergency Evacuation Procedures Prominently Posted</td><td>' + data[i].procedures_posted + '</td></tr>';
                        html +='<tr><td>Smoke Alarms in Good Working Condition</td><td>' + data[i].smoke_alarms + '</td></tr>';
                        html +='<tr><td>Building Interior Generally Clean and Neat</td><td>' + data[i].building_interior_clean + '</td></tr>';
                        html +='<tr><td>Floors Dry</td><td>' + data[i].building_floors_dry + '</td></tr>';
                        html +='<tr><td>Aisles have 3-Foot Clearance</td><td>' + data[i].aisles_clear + '</td></tr>';
                        html +='<tr><td>Carpet Even and Undamaged</td><td>' + data[i].building_carpet + '</td></tr>';
                        html +='<tr><td>Electrical Outlets appropriately covered and in Good Condition, Not overloaded, and prongs in place</td><td>' + data[i].outlets + '</td></tr>';
                        html +='<tr><td>Walkways are Free of Electrical Cords</td><td>' + data[i].walkways + '</td></tr>';
                        html +='<tr><td>No Regular Extension Cords Being Used</td><td>' + data[i].extension_cords + '</td></tr>';
                        html +='<tr><td>Back Entrance Doors Locked</td><td>' + data[i].back_entrance_locked + '</td></tr>';
                        html +='<tr><td>Door Mats/Non-Slip Mats Properly Placed</td><td>' + data[i].door_mats + '</td></tr>';
                        html +='<tr><td>Stairwells Clear and Free Of Debris</td><td>' + data[i].stairwells + '</td></tr>';
                        html +='<tr><td>Stair/Step Treads Not Slippery/Non Slippery Coverings</td><td>' + data[i].stairs_steps_nonslip + '</td></tr>';
                        html +='<tr><td>Spill Kit Adequately Supplied</td><td>' + data[i].spill_kit_supplied + '</td></tr>';
                        html +='<tr><td>Spill Kit Accessible to Employees</td><td>' + data[i].spill_kit_accessible + '</td></tr>';
                        html +='<tr><td>First Aid Kit Adequately Supplied</td><td>' + data[i].first_aid_kit_supplied + '</td></tr>';
                        html +='<tr><td>First Aid Kit Accessible to Employees</td><td>' + data[i].first_aid_kit_accessible + '</td></tr>';
                        html +='<tr><td>First Aid Procedures Posted</td><td>' + data[i].first_aid_procedures_posted + '</td></tr>';
                        html +='<tr><td>Vent Areas Clear and Free of Obstructions</td><td>' + data[i].vents_clear + '</td></tr>';
                        html +='<tr><td>Air Vent Filters Properly Cleaned and/or Replaced</td><td>' + data[i].vent_filters_clean + '</td></tr>';
                        html +='<tr><td>Conference Room Furniture in Good Working Condition</td><td>' + data[i].conf_room_furn_good + '</td></tr>';
                        html +='<tr><td>Conference Areas Walkways Are Free of Chairs</td><td>' + data[i].conf_area_walkways_free + '</td></tr>';
                        html +='<tr><td>Temperature Logs on Medication Refrigerators Completed Daily</td><td>' + data[i].temperature_logs_completed + '</td></tr>';
                        html +='<tr><td>Furniture is Clean and In Good Repair</td><td>' + data[i].furniture_clean + '</td></tr>';
                    

                    html += '</table>';

                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>Restroom</th>' +
                                        '<th style="width: 120px;">Responses</th>' +
                                    '</tr>' +
                                    '</thead>';

                    
                        html +='<tr><td>Shower Curtains (where applicable) present/working</td><td>' + data[i].shower_curtains + '</td></tr>';
                        html +='<tr><td>Generally Clean and Free of Graffiti</td><td>' + data[i].clean_and_graffiti_free + '</td></tr>';
                        html +='<tr><td>Appropriate Hand Washing Supplies Available</td><td>' + data[i].hand_wash_supplies + '</td></tr>';
                        html +='<tr><td>Adequately Stocked with Paper Products (Hand Towels, Toilet Paper, Etc.)</td><td>' + data[i].paper_products_stocked + '</td></tr>';
                        html +='<tr><td>Plumbing in Proper Working Condition (check for leaks, broken handles, etc)</td><td>' + data[i].plumbing + '</td></tr>';
                    

                    html += '</table>';

                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>Storage Areas</th>' +
                                        '<th style="width: 120px;">Responses</th>' +
                                    '</tr>' +
                                    '</thead>';

                    
                        html +='<tr><td>No Boxes Stacked to Unstable Level</td><td>' + data[i].boxes_not_stacked + '</td></tr>';
                        html +='<tr><td>File Drawers Closed when Not in Use</td><td>' + data[i].file_draws_closed + '</td></tr>';
                        html +='<tr><td>Closets Uncluttered</td><td>' + data[i].closet_uncluttered + '</td></tr>';
                        html +='<tr><td>Cabinet Tops Free of Loose Material that Could Fall</td><td>' + data[i].cabinet_tops_free + '</td></tr>';
                        html +='<tr><td>Storage Level 18” Below Ceiling</td><td>' + data[i].storage_level + '</td></tr>';
                    

                    html += '</table>';

                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>Individual Work Areas/Offices</th>' +
                                        '<th style="width: 120px;">Responses</th>' +
                                    '</tr>' +
                                    '</thead>';

                    
                        html +='<tr><td>Office Interiors Generally Neat and Clean</td><td>' + data[i].office_interior_clean + '</td></tr>';
                        html +='<tr><td>Office Floors Clear of Paper Clips, Staples, Small Objects</td><td>' + data[i].floors_clear + '</td></tr>';
                        html +='<tr><td>Office Furniture in Good Working Condition</td><td>' + data[i].office_furniture_good + '</td></tr>';
                        html +='<tr><td>Desk and Chair Mats Free of Upturned Edges</td><td>' + data[i].desk_and_chair_mats + '</td></tr>';
                        html +='<tr><td>Shelves Not Overloaded</td><td>' + data[i].shelved_not_overloaded + '</td></tr>';
                        html +='<tr><td>Floors are Dry</td><td>' + data[i].office_floors_dry + '</td></tr>';
                        html +='<tr><td>Carpet Even and Undamaged </td><td>' + data[i].office_carpet + '</td></tr>';
                        html +='<tr><td>No Unstable Stacks of Boxes/ Books/ Manuals, Etc.</td><td>' + data[i].office_boxes_not_stacked + '</td></tr>';
                        html +='<tr><td>Cabinet Tops Free of Materials That Could Fall</td><td>' + data[i].office_cabinet_tops_free + '</td></tr>';
                        html +='<tr><td>File/Desk Drawers Closed When Not in Use</td><td>' + data[i].office_file_draws_closed + '</td></tr>';
                        html +='<tr><td>Electrical Outlets Appropriately Covered and in Good Condition and not overloaded (no prongs broken off in outlet)</td><td>' + data[i].office_outlets + '</td></tr>';
                        html +='<tr><td>Walkways are Free of Electrical Cords</td><td>' + data[i].office_walkways + '</td></tr>';
                        html +='<tr><td>No Regular Extension Cords Being Used</td><td>' + data[i].office_extension_cords + '</td></tr>';
                        html +='<tr><td>No Personal Space Heaters in Offices</td><td>' + data[i].no_personal_heaters + '</td></tr>';
                    

                    html += '</table>';

                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>Security</th>' +
                                        '<th style="width: 120px;">Responses</th>' +
                                    '</tr>' +
                                    '</thead>';

                    
                        html +='<tr><td>Monitor/Screen Cannot be Read from Short Distance</td><td>' + data[i].monitor_not_visible + '</td></tr>';
                        html +='<tr><td>Computer Screen Locked when Staff not at Computer</td><td>' + data[i].screen_locked + '</td></tr>';
                    

                    html += '</table>';

                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>Food Preparation Areas/Break rooms</th>' +
                                        '<th style="width: 120px;">Responses</th>' +
                                    '</tr>' +
                                    '</thead>';

                    
                        html +='<tr><td>Countertops and Floors are Generally Clean and Free of Grease and Water</td><td>' + data[i].countertops + '</td></tr>';
                        html +='<tr><td>All Equipment Properly Maintained</td><td>' + data[i].equipment_maintained + '</td></tr>';
                        html +='<tr><td>Refrigerator Clean and in Proper Working Condition</td><td>' + data[i].refrigerator + '</td></tr>';
                        html +='<tr><td>Temperature Logs on Client Food Refrigerators Completed Daily</td><td>' + data[i].client_food + '</td></tr>';
                        html +='<tr><td>Cupboard Doors Closed After Each Use</td><td>' + data[i].cupboards_closed + '</td></tr>';
                        html +='<tr><td>Coffee Maker Clean and in Proper Working Condition</td><td>' + data[i].coffee_maker + '</td></tr>';
                        html +='<tr><td>Microwave/Toaster Oven Clean and in Proper Working Condition</td><td>' + data[i].microwave + '</td></tr>';
                    

                    html += '</table>';

                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>Outdoor Areas</th>' +
                                        '<th style="width: 120px;">Responses</th>' +
                                    '</tr>' +
                                    '</thead>';

                    
                        html +='<tr><td>Free of Litter/Debris/Hazardous Waste Materials</td><td>' + data[i].free_of_litter + '</td></tr>';
                        html +='<tr><td>Walkways, Steps and Patios in Good Condition</td><td>' + data[i].walkways_steps_patios + '</td></tr>';
                        html +='<tr><td>Adequate Outdoor Lighting in Parking and Entrance Areas</td><td>' + data[i].adequate_outdoor_lighting + '</td></tr>';
                        html +='<tr><td>Parking Lots in Good Condition</td><td>' + data[i].parking_lot + '</td></tr>';
                        html +='<tr><td>No Downed or Exposed Wires/Power Lines</td><td>' + data[i].no_downed_power_lines + '</td></tr>';
                        html +='<tr><td>No Broken or Burned Out Light Bulbs/Fixtures</td><td>' + data[i].no_broken_bulbs + '</td></tr>';
                    

                    html += '</table>';

                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>Dorm Areas</th>' +
                                        '<th style="width: 120px;">Responses</th>' +
                                    '</tr>' +
                                    '</thead>';

                    
                        html +='<tr><td>Dorms are Clean</td><td>' + data[i].dorms_clean + '</td></tr>';
                        html +='<tr><td>Dorms are Neat</td><td>' + data[i].dorms_neat + '</td></tr>';
                        html +='<tr><td>Personal Belongings are contained within Available Storage</td><td>' + data[i].personal_belongings + '</td></tr>';
                        html +='<tr><td>No Sign of Contraband in Dorm Areas (Food, Cleaning Supplies, etc)</td><td>' + data[i].no_contraband + '</td></tr>';
                    

                    html += '</table>';

                    html += '<strong>Please explain and give details for any area rated as “No”. </strong><br><u>' + data[i].details1 + '</u><br><br>';
                    html += '<strong>Describe any other unsatisfactory conditions or unsafe practices you observed that were not covered in the Checklist.</strong><br><u>' + data[i].details2 + '</u><br><br>';

                    html += '<strong>Contents of Spill Kits <small>(Comes in a plastic kit box that measures 10"W x 7"H x 3 1/2"D)</small></strong>';
                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>Item</th>' +
                                        '<th>Min Quantity</th>' +
                                        '<th>Current Quantity</th>' +
                                    '</tr>' +
                                    '</thead>';

                    
                        html +='<tr><td>Control Gown (Size Large)</td><td>1</td><td>' + data[i].control_gown + '</td></tr>';
                        html +='<tr><td>Fluid-Resistant Mask with Eye/Face Shield</td><td>1</td><td>' + data[i].fluid_resistant_mask + '</td></tr>';
                        html +='<tr><td>Nitrile Exam Gloves</td><td>2 pairs</td><td>' + data[i].nitrile_exam_gloves + '</td></tr>';
                        html +='<tr><td>Antimicrobial Hand Wipes</td><td>8</td><td>' + data[i].antimicrobial_hand_wipes + '</td></tr>';
                        html +='<tr><td>Red Biohazard Bag with Tie</td><td>2</td><td>' + data[i].biohazard_bag + '</td></tr>';
                        html +='<tr><td>Bouffant Cap</td><td>1</td><td>' + data[i].bouffant_cap + '</td></tr>';
                        html +='<tr><td>Fluid Solidifier Packet (2 oz.)</td><td>1</td><td>' + data[i].fluid_solidifier_packet + '</td></tr>';
                        html +='<tr><td>Disinfectant Spray (2 oz.)</td><td>1</td><td>' + data[i].disinfectant_spray + '</td></tr>';
                        html +='<tr><td>Pick-Up Scoop with Scraper</td><td>1</td><td>' + data[i].scoop_with_scraper + '</td></tr>';
                        html +='<tr><td>Paper Towels</td><td>10</td><td>' + data[i].paper_towel + '</td></tr>';
                        html +='<tr><td>Disposal Bag with Tie (for Non-Infectious Waste)</td><td>1</td><td>' + data[i].disposal_bag + '</td></tr>';
                    

                    html += '</table>';

                    html += '<strong>Contents of First Air Kits</strong>';
                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>Item</th>' +
                                        '<th>Min Quantity</th>' +
                                        '<th>Current Quantity</th>' +
                                    '</tr>' +
                                    '</thead>';

                    
                        html +='<tr><td>Absorbent compress with no side smaller than 4 inches</td><td>1</td><td>' + data[i].absorbent_compress + '</td></tr>';
                        html +='<tr><td>Adhesive Bandages - 1 in x 3 in</td><td>16</td><td>' + data[i].adhesive_bandages + '</td></tr>';
                        html +='<tr><td>Adhesive Tape 3/8 in x 2.5 yds</td><td>1</td><td>' + data[i].adhesive_tape + '</td></tr>';
                        html +='<tr><td>Antibiotic Treatment = 0.14 oz</td><td>6</td><td>' + data[i].antibiotic_treatment + '</td></tr>';
                        html +='<tr><td>Antiseptic swabs, wipes, or towelettes (spray containers 0.14 oz)</td><td>10</td><td>' + data[i].antiseptic_swabs + '</td></tr>';
                        html +='<tr><td>Bandage Compress 2 in x  2 in</td><td>1</td><td>' + data[i].bandage_compress_2 + '</td></tr>';
                        html +='<tr><td>Bandage Compress 3 in x  3 in</td><td>1</td><td>' + data[i].bandage_compress_3 + '</td></tr>';
                        html +='<tr><td>Bandage Compress 4 in x  4 in</td><td>1</td><td>' + data[i].bandage_compress_4 + '</td></tr>';
                        html +='<tr><td>Breathing Barrier for CPR</td><td>1</td><td>' + data[i].breathing_barrier + '</td></tr>';
                        html +='<tr><td>Burn Treatment 1/32 oz application</td><td>6</td><td>' + data[i].burn_treatment + '</td></tr>';
                        html +='<tr><td>First Aid Guide</td><td>1</td><td>' + data[i].first_aid_guide + '</td></tr>';
                        html +='<tr><td>Medical Exam Gloves</td><td>2 pairs</td><td>' + data[i].medical_exam_glove + '</td></tr>';
                        html +='<tr><td>Roller Bandage at least 2 in wide x 4 yd long</td><td>1</td><td>' + data[i].roller_bandage + '</td></tr>';
                        html +='<tr><td>Sterile Pads 3 in x 3 in</td><td>4</td><td>' + data[i].sterile_pads + '</td></tr>';
                        html +='<tr><td>Triangular bandage 40 in x 40 in x 56 in</td><td>1</td><td>' + data[i].triangular_bandage + '</td></tr>';
                    

                        html += '</table><br>';
                        html += 'Completed By: ' + data[i].completed_by + '<br>';
                        html += '<img src="' + data[i].signature + '" width="200" height="104" /><br>';
                        html += '<br><hr>';
                        
                        if(signature == 1){
                            html += '<strong>CORRECTIVE ACTION</strong><br>';
                            html += '<strong>Please describe any corrective action(s) taken to address the areas rated as “No” on the Facility Inspection Report Checklist. Please forward a copy of the Checklist and Corrective Action form to the Facilities Maintenance department. </strong><br><u>' + data[i].corrective_action + '</u><br><br>';                     
                            html += 'Electronically signed by ' + data[i].manager_name + ' on ' + data[i].manager_signature_date;
                        } else {
                            html += '<strong>CORRECTIVE ACTION</strong><br>';
                            html += '<div class="mb-3"><label class="form-label">Please describe any corrective action(s) taken to address the areas rated as “No” on the Facility Inspection Report Checklist. Please forward a copy of the Checklist and Corrective Action form to the Facilities Maintenance department. </label><textarea id="corrective_action" class="form-control" rows="10"></textarea></div>';
                        }  
                    }



                    $('#inspection_body').html(html); 
    
                },
    
            });
        } 

        function sign_facility_inspection(){
            //add confirm dialog here
            var postUrl = '<?php echo base_url('/facility_inspection/sign_facility_inspection') ?>';

            var id = $('#facility_inspection_id').val();
    
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'id': id,
                'password': $('#password').val(),
                'corrective_action': $('#corrective_action').val()
            };		
    
            $.ajax({
                url: postUrl,
                type: 'POST',
                data: postData,
                datatype: 'json',
                success: function(response, textStatus, jqXHR) {
                    //////////////////////////////////////////////////////
                    console.log('Ajax Remove Card Response:', response);
                    //////////////////////////////////////////////////////

                    var data = JSON.parse(response);

                    if (data == true) {
                        view_inspection(id, 1);
                        
                        $('#password_error_message').html('');
                        $('#password').val('');
                        $('#SignatureModal').modal('toggle');
                        //$('#sign_button').prop('disabled', true);
                        getinspections();
                    } else {
                        $('#password_error_message').html('Incorrect Password');
                    }

                    

                },
    
            });
        } 
        
        function generate_pdf(id){
		 
            //add confirm dialog here
            var postUrl = '<?php echo base_url('/facility_inspection/get_facility_inspection') ?>';
    
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'id': id
            };		
    
            $.ajax({
                url: postUrl,
                type: 'POST',
                data: postData,
                datatype: 'json',
                success: function(response, textStatus, jqXHR) {
                    //////////////////////////////////////////////////////
                    console.log('Ajax Remove Card Response:', response);
                    //////////////////////////////////////////////////////

                    var data = JSON.parse(response);

					/*var columns = [
						{title: "Vehicle Components", dataKey: "name"},
						{title: "Condition", dataKey: "status"},
						{title: "Comment", dataKey: "comment"}
                    ]; 

                    var columns2 = [
						{title: "Vehicle Components (If Equipped)", dataKey: "name"},
						{title: "Condition", dataKey: "status"},
						{title: "Comment", dataKey: "comment"}
                    ]; */
                                    
					// Only pt supported (not mm or in)
					//var doc = new jsPDF('p', 'pt');
                    var doc = new jspdf.jsPDF('p', 'pt');
                    doc.setFontSize(12);
                    doc.text(230, 40, 'Cove Facility Inspection Report');
                    doc.setFontSize(10);

                    for (i = 0; i < data.length; i++){
                        doc.text(40, 75, 'Facility: '+data[i].facility);
                        doc.line(83,76,275,76);
                        doc.text(300, 75, 'Location: '+data[i].location);
                        doc.line(343,76,525,76);

                        //if(data[i].quarter == "Qtr I (July - Sept)") {
                            //doc.rect(40, 82, 10, 10, "F");
                            //doc.text(55, 90, 'Qtr I (July - Sept)');

                            //doc.rect(170, 82, 10, 10);
                            //doc.text(185, 90, 'Qtr II (Oct - Dec)');

                            //doc.rect(300, 82, 10, 10);
                            //doc.text(315, 90, 'Qtr III (Jan - Mar)');

                            //doc.rect(430, 82, 10, 10);
                            //doc.text(445, 90, 'Qtr IV (Apr - Jun)');
                        //}

                        if(data[i].quarter == "Qtr I (July - Sept)") {
                            doc.rect(40, 82, 10, 10, "F");
                            doc.text(55, 90, 'Qtr I (July - Sept)');

                            doc.rect(170, 82, 10, 10);
                            doc.text(185, 90, 'Qtr II (Oct - Dec)');

                            doc.rect(300, 82, 10, 10);
                            doc.text(315, 90, 'Qtr III (Jan - Mar)');

                            doc.rect(430, 82, 10, 10);
                            doc.text(445, 90, 'Qtr IV (Apr - Jun)');
                        }

                        if(data[i].quarter == "Qtr II (Oct - Dec)") {
                            doc.rect(40, 82, 10, 10);
                            doc.text(55, 90, 'Qtr I (July - Sept)');

                            doc.rect(170, 82, 10, 10, "F");
                            doc.text(185, 90, 'Qtr II (Oct - Dec)');

                            doc.rect(300, 82, 10, 10);
                            doc.text(315, 90, 'Qtr III (Jan - Mar)');

                            doc.rect(430, 82, 10, 10);
                            doc.text(445, 90, 'Qtr IV (Apr - Jun)');
                        }

                        if(data[i].quarter == "Qtr III (Jan - Mar)") {
                            doc.rect(40, 82, 10, 10);
                            doc.text(55, 90, 'Qtr I (July - Sept)');

                            doc.rect(170, 82, 10, 10);
                            doc.text(185, 90, 'Qtr II (Oct - Dec)');

                            doc.rect(300, 82, 10, 10, "F");
                            doc.text(315, 90, 'Qtr III (Jan - Mar)');

                            doc.rect(430, 82, 10, 10);
                            doc.text(445, 90, 'Qtr IV (Apr - Jun)');
                        }

                        if(data[i].quarter == "Qtr IV (Apr - Jun)") {
                            doc.rect(40, 82, 10, 10);
                            doc.text(55, 90, 'Qtr I (July - Sept)');

                            doc.rect(170, 82, 10, 10);
                            doc.text(185, 90, 'Qtr II (Oct - Dec)');

                            doc.rect(300, 82, 10, 10);
                            doc.text(315, 90, 'Qtr III (Jan - Mar)');

                            doc.rect(430, 82, 10, 10, "F");
                            doc.text(445, 90, 'Qtr IV (Apr - Jun)');
                        }

                        doc.text(40, 105, 'Date: '+data[i].event_date);
                        doc.line(65,106,275,106);

                        //doc.rect(40, 112, 10, 10);
                        //doc.text(55, 120, '1st Shift(6a-2p)');

                        //doc.rect(170, 112, 10, 10);
                        //doc.text(185, 120, '2nd Shift(2p-10p)');

                        //doc.rect(300, 112, 10, 10);
                        //doc.text(315, 120, '3rd Shift(10p-6a)');

                        if(data[i].shift == "1st Shift (6a-2p)") {
                            doc.rect(40, 112, 10, 10, "F");
                            doc.text(55, 120, '1st Shift (6a-2p)');
                        } else {
                            doc.rect(40, 112, 10, 10);
                            doc.text(55, 120, '1st Shift (6a-2p)'); 
                        }

                        if(data[i].shift == "2nd Shift (2p-10p)") {
                            doc.rect(170, 112, 10, 10, "F");
                            doc.text(185, 120, '2nd Shift (2p-10p)');
                        } else {
                            doc.rect(170, 112, 10, 10);
                            doc.text(185, 120, '2nd Shift (2p-10p)');                    
                        }

                        if(data[i].shift == "3rd Shift (10p-6a)") {
                            doc.rect(300, 112, 10, 10, "F");
                            doc.text(315, 120, '3rd Shift (10p-6a)');
                        } else {
                            doc.rect(300, 112, 10, 10);
                            doc.text(315, 120, '3rd Shift (10p-6a)');                   
                        }

                        doc.line(35,140,560,140);
                        doc.text(40, 155, 'Instructions: Check each item below as "Yes", "No" or "NA" (not applicable). For each item that is checked as "NO",');
                        doc.text(40, 170, 'please provide details and submit recommendations to correct the condition or unsafe practice.');
                        doc.line(35,180,560,180);

                        doc.text(40, 200, 'General Office Areas:');
                        doc.line(40,201,140,201);

                        doc.text(40, 215, 'Fire Exit Door Clear');
                        doc.text(550, 215, data[i].exit_door_clear, {align:'right'});
                        doc.text(40, 230, 'Exit Signs Visible and Light Working Properly');
                        doc.text(550, 230, data[i].exit_signs_visible, {align:'right'});
                        doc.text(40, 245, 'Fire Extinguishers Accessible and In Proper Working Order');
                        doc.text(550, 245, data[i].fire_ext_access, {align:'right'});
                        doc.text(40, 260, 'Fire/Emergency Evacuation Procedures Prominently Posted');
                        doc.text(550, 260, data[i].procedures_posted, {align:'right'});
                        doc.text(40, 275, 'Smoke Alarms in Good Working Condition');
                        doc.text(550, 275, data[i].smoke_alarms, {align:'right'});
                        doc.text(40, 290, 'Building Interior Generally Clean and Neat');
                        doc.text(550, 290, data[i].building_interior_clean, {align:'right'});
                        doc.text(40, 305, 'Floors Dry');
                        doc.text(550, 305, data[i].building_floors_dry, {align:'right'});
                        doc.text(40, 320, 'Aisles have 3-Foot Clearance');
                        doc.text(550, 320, data[i].aisles_clear, {align:'right'});
                        doc.text(40, 335, 'Carpet Even and Undamaged');
                        doc.text(550, 335, data[i].building_carpet, {align:'right'});
                        doc.text(40, 350, 'Electrical Outlets appropriately covered and in Good Condition, Not overloaded, and prongs in place');
                        doc.text(550, 350, data[i].outlets, {align:'right'});
                        doc.text(40, 365, 'Walkways are Free of Electrical Cords');
                        doc.text(550, 365, data[i].walkways, {align:'right'});
                        doc.text(40, 380, 'No Regular Extension Cords Being Used');
                        doc.text(550, 380, data[i].extension_cords, {align:'right'});
                        doc.text(40, 395, 'Back Entrance Doors Locked');
                        doc.text(550, 395, data[i].back_entrance_locked, {align:'right'});
                        doc.text(40, 410, 'Door Mats/Non-Slip Mats Properly Placed ');
                        doc.text(550, 410, data[i].door_mats, {align:'right'});
                        doc.text(40, 425, 'Stairwells Clear and Free Of Debris');
                        doc.text(550, 425, data[i].stairwells, {align:'right'});
                        doc.text(40, 440, 'Stair/Step Treads Not Slippery/Non Slippery Coverings ');
                        doc.text(550, 440, data[i].stairs_steps_nonslip, {align:'right'});
                        doc.text(40, 455, 'Spill Kit Adequately Supplied (see page 4 for kit contents)');
                        doc.text(550, 455, data[i].spill_kit_supplied, {align:'right'});
                        doc.text(40, 470, 'Spill Kit Accessible to Employees');
                        doc.text(550, 470, data[i].spill_kit_accessible, {align:'right'});
                        doc.text(40, 485, 'First Aid Kit Adequately Supplied (see page 4 for kit contents)');
                        doc.text(550, 485, data[i].first_aid_kit_supplied, {align:'right'});
                        doc.text(40, 500, 'First Aid Kit Accessible to Employees');
                        doc.text(550, 500, data[i].first_aid_kit_accessible, {align:'right'});
                        doc.text(40, 515, 'First Aid Procedures Posted');
                        doc.text(550, 515, data[i].first_aid_procedures_posted, {align:'right'});
                        doc.text(40, 530, 'Vent Areas Clear and Free of Obstructions');
                        doc.text(550, 530, data[i].vents_clear, {align:'right'});
                        doc.text(40, 545, 'Air Vent Filters Properly Cleaned and/or Replaced');
                        doc.text(550, 545, data[i].vent_filters_clean, {align:'right'});
                        doc.text(40, 560, 'Conference Room Furniture in Good Working Condition');
                        doc.text(550, 560, data[i].conf_room_furn_good, {align:'right'});
                        doc.text(40, 575, 'Conference Areas Walkways Are Free of Chairs');
                        doc.text(550, 575, data[i].conf_area_walkways_free, {align:'right'});
                        doc.text(40, 590, 'Temperature Logs on Medication Refrigerators Completed Daily');
                        doc.text(550, 590, data[i].temperature_logs_completed, {align:'right'});
                        doc.text(40, 605, 'Furniture is Clean and In Good Repair');
                        doc.text(550, 605, data[i].furniture_clean, {align:'right'});
                        
                        doc.text(40, 635, 'Restrooms');
                        doc.line(40,636,90,636);

                        doc.text(40, 650, 'Shower Curtains (where applicable) present/working');
                        doc.text(550, 650, data[i].shower_curtains, {align:'right'});
                        doc.text(40, 665, 'Generally Clean and Free of Graffiti');
                        doc.text(550, 665, data[i].clean_and_graffiti_free, {align:'right'});
                        doc.text(40, 680, 'Appropriate Hand Washing Supplies Available');
                        doc.text(550, 680, data[i].hand_wash_supplies, {align:'right'});
                        doc.text(40, 695, 'Adequately Stocked with Paper Products (Hand Towels, Toilet Paper, Etc.)');
                        doc.text(550, 695, data[i].paper_products_stocked, {align:'right'});
                        doc.text(40, 710, 'Plumbing in Proper Working Condition (check for leaks, broken handles, etc)');
                        doc.text(550, 710, data[i].plumbing, {align:'right'});

                        doc.text(40, 740, 'Storage Areas');
                        doc.line(40,741,105,741);

                        doc.text(40, 755, 'No Boxes Stacked to Unstable Level');
                        doc.text(550, 755, data[i].boxes_not_stacked, {align:'right'});
                        doc.text(40, 770, 'File Drawers Closed when Not in Use');
                        doc.text(550, 770, data[i].file_draws_closed, {align:'right'});
                        doc.text(40, 785, 'Closets Uncluttered');
                        doc.text(550, 785, data[i].closet_uncluttered, {align:'right'});
                        doc.addPage();
                        doc.text(40, 40, 'Cabinet Tops Free of Loose Material that Could Fall');
                        doc.text(550, 40, data[i].cabinet_tops_free, {align:'right'});
                        doc.text(40, 55, 'Storage Level 18" Below Ceiling');
                        doc.text(550, 55, data[i].storage_level, {align:'right'});


                        doc.text(40, 85, 'Individual Work Areas/Offices');
                        doc.line(40,86,170,86);

                        doc.text(40, 100, 'Office Interiors Generally Neat and Clean');
                        doc.text(550, 100, data[i].office_interior_clean, {align:'right'});
                        doc.text(40, 115, 'Office Floors Clear of Paper Clips, Staples, Small Objects');
                        doc.text(550, 115, data[i].floors_clear, {align:'right'});
                        doc.text(40, 130, 'Office Furniture in Good Working Condition');
                        doc.text(550, 130, data[i].office_furniture_good, {align:'right'});
                        doc.text(40, 145, 'Desk and Chair Mats Free of Upturned Edges');
                        doc.text(550, 145, data[i].desk_and_chair_mats, {align:'right'});
                        doc.text(40, 160, 'Shelves Not Overloaded');
                        doc.text(550, 160, data[i].shelved_not_overloaded, {align:'right'});
                        doc.text(40, 175, 'Floors are Dry');
                        doc.text(550, 175, data[i].office_floors_dry, {align:'right'});
                        doc.text(40, 190, 'Carpet Even and Undamaged');
                        doc.text(550, 190, data[i].office_carpet, {align:'right'});
                        doc.text(40, 205, 'No Unstable Stacks of Boxes/ Books/ Manuals, Etc.');
                        doc.text(550, 205, data[i].office_boxes_not_stacked, {align:'right'});
                        doc.text(40, 220, 'Cabinet Tops Free of Materials That Could Fall');
                        doc.text(550, 220, data[i].office_cabinet_tops_free, {align:'right'});
                        doc.text(40, 235, 'File/Desk Drawers Closed When Not in Use');
                        doc.text(550, 235, data[i].office_file_draws_closed, {align:'right'});
                        doc.text(40, 250, 'Electrical Outlets Appropriately Covered and in Good Condition and not overloaded ');
                        doc.text(550, 250, data[i].office_outlets, {align:'right'});
                        doc.text(40, 265, '(no prongs broken off in outlet)');
                        doc.text(40, 280, 'Walkways are Free of Electrical Cords');
                        doc.text(550, 280, data[i].office_walkways, {align:'right'});
                        doc.text(40, 295, 'No Regular Extension Cords Being Used');
                        doc.text(550, 295, data[i].office_extension_cords, {align:'right'});
                        doc.text(40, 310, 'No Personal Space Heaters in Offices');
                        doc.text(550, 310, data[i].no_personal_heaters, {align:'right'});
                        
                        doc.text(40, 340, 'Security');
                        doc.line(40,341,80,341);

                        doc.text(40, 355, 'Monitor/Screen Cannot be Read from Short Distance');
                        doc.text(550, 355, data[i].monitor_not_visible, {align:'right'});
                        doc.text(40, 370, 'Computer Screen Locked when Staff not at Computer');
                        doc.text(550, 370, data[i].screen_locked, {align:'right'});

                        doc.text(40, 400, 'Food Preparation Area/Break rooms');
                        doc.line(40,401,190,401);

                        doc.text(40, 415, 'Countertops and Floors are Generally Clean and Free of Grease and Water');
                        doc.text(550, 415, data[i].countertops, {align:'right'});
                        doc.text(40, 430, 'All Equipment Properly Maintained');
                        doc.text(550, 430, data[i].equipment_maintained, {align:'right'});
                        doc.text(40, 445, 'Refrigerator Clean and in Proper Working Condition');
                        doc.text(550, 445, data[i].refrigerator, {align:'right'});
                        doc.text(40, 460, 'Temperature Logs on Client Food Refrigerators Completed Daily');
                        doc.text(550, 460, data[i].client_food, {align:'right'});
                        doc.text(40, 475, 'Cupboard Doors Closed After Each Use');
                        doc.text(550, 475, data[i].cupboards_closed, {align:'right'});
                        doc.text(40, 490, 'Coffee Maker Clean and in Proper Working Condition');
                        doc.text(550, 490, data[i].coffee_maker, {align:'right'});
                        doc.text(40, 505, 'Microwave/Toaster Oven Clean and in Proper Working Condition');
                        doc.text(550, 505, data[i].microwave, {align:'right'});
                        
                        doc.text(40, 535, 'Outdoor Areas ');
                        doc.line(40,536,100,536);

                        doc.text(40, 550, 'Free of Litter/Debris/Hazardous Waste Materials ');
                        doc.text(550, 550, data[i].free_of_litter, {align:'right'});
                        doc.text(40, 565, 'Walkways, Steps and Patios in Good Condition');
                        doc.text(550, 565, data[i].walkways_steps_patios, {align:'right'});
                        doc.text(40, 580, 'Adequate Outdoor Lighting in Parking and Entrance Areas');
                        doc.text(550, 580, data[i].adequate_outdoor_lighting, {align:'right'});
                        doc.text(40, 595, 'Parking Lots in Good Condition');
                        doc.text(550, 595, data[i].parking_lot, {align:'right'});
                        doc.text(40, 610, 'No Downed or Exposed Wires/Power Lines');
                        doc.text(550, 610, data[i].no_downed_power_lines, {align:'right'});
                        doc.text(40, 625, 'No Broken or Burned Out Light Bulbs/Fixtures');
                        doc.text(550, 625, data[i].no_broken_bulbs, {align:'right'});

                        doc.text(40, 655, 'Dorm Areas');
                        doc.line(40,656,90,656);

                        doc.text(40, 670, 'Dorms are Clean');
                        doc.text(550, 670, data[i].dorms_clean, {align:'right'});
                        doc.text(40, 685, 'Dorms are Neat');
                        doc.text(550, 685, data[i].dorms_neat, {align:'right'});
                        doc.text(40, 700, 'Personal Belongings are contained within Available Storage');
                        doc.text(550, 700, data[i].personal_belongings, {align:'right'});
                        doc.text(40, 715, 'No Sign of Contraband in Dorm Areas (Food, Cleaning Supplies, etc)');
                        doc.text(550, 715, data[i].no_contraband, {align:'right'});

                        doc.addPage();
                        doc.text(40, 40, 'Please explain and give details for any area rated as "No".'); 

                        /*var pageSize = doc.internal.pageSize;
                        var pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                        var text = doc.splitTextToSize(data[i].details, pageWidth - 165, {});
                        doc.text(40, 55, text);*/

                        doc.text(40, 65, 'Describe any other unsatisfactory conditions or unsafe practices you observed that were not covered in the Checklist.'); 

                        var head = [['Item', 'Min Quantity', 'Current Quantity']];
                        var body = [
                        ['Control Gown (Size Large)', '1', data[i].control_gown],
                        ['Fluid-Resistant Mask with Eye/Face Shield', '1', data[i].fluid_resistant_mask],
                        ['Nitrile Exam Gloves', '2 pair', data[i].nitrile_exam_gloves],
                        ['Antimicrobial Hand Wipes', '8', data[i].antimicrobial_hand_wipes],
                        ['Red Biohazard Bag with Tie', '2', data[i].biohazard_bag],
                        ['Bouffant Cap', '1', data[i].bouffant_cap],
                        ['Fluid Solidifier Packet (2 oz.)', '1', data[i].fluid_solidifier_packet],
                        ['Disinfectant Spray (2 oz.)', '1', data[i].disinfectant_spray],
                        ['Pick-Up Scoop with Scraper', '1', data[i].scoop_with_scraper],
                        ['Paper Towels', '10', data[i].	paper_towel],
                        ['Disposal Bag with Tie (for Non-Infectious Waste)', '1', data[i].disposal_bag],
                        ];
                        doc.addPage();
                        doc.autoTable({ head: head, body: body });

                        var head2 = [['Item', 'Min Quantity', 'Current Quantity']];
                        var body2 = [
                        ['Absorbent compress with no side smaller than 4 inches', '1', data[i].absorbent_compress],
                        ['Adhesive Bandages - 1 in x 3 in', '16', data[i].adhesive_bandages],
                        ['Adhesive Tape 3/8 in x 2.5 yds', '1', data[i].adhesive_tape],
                        ['Antibiotic Treatment = 0.14 oz', '6', data[i].antibiotic_treatment],
                        ['Antiseptic swabs, wipes, or towelettes (spray containers 0.14 oz)', '10', data[i].antiseptic_swabs],
                        ['Bandage Compress 2 in x  2 in', '1', data[i].bandage_compress_2],
                        ['Bandage Compress 3 in x  3 in', '1', data[i].bandage_compress_3],
                        ['Bandage Compress 4 in x  4 in', '1', data[i].bandage_compress_4],
                        ['Breathing Barrier for CPR', '1', data[i].breathing_barrier],
                        ['Burn Treatment 1/32 oz application', '6', data[i].burn_treatment],
                        ['First Aid Guide', '1', data[i].first_aid_guide],
                        ['Medical Exam Gloves', '2 pairs', data[i].medical_exam_glove],
                        ['Roller Bandage at least 2 in wide x 4 yd long', '1', data[i].roller_bandage],
                        ['Sterile Pads 3 in x 3 in', '4', data[i].sterile_pads],
                        ['Triangular bandage 40 in x 40 in x 56 in', '1', data[i].triangular_bandage],
                        ];
                        doc.autoTable({ head: head2, body: body2 });
                        /*let first = doc.autoTable.previous;
					    doc.autoTable(head2, body2, {
                        startY: first.finalY + 10,
                        styles: { cellPadding: 1, fontSize: 10 },
                        theme: 'grid'
                    }); */

                        let second = doc.autoTable.previous;
                        if(data[i].signature != null){
                            doc.text(40,second.finalY+30, 'Risk Management and Safety Committee Member: '+data[i].manager_name);
                            //var imgData = data[i].signature;
                            doc.addImage(data[i].signature, 'JPEG', 40,second.finalY+40,200,104);
                        }

                        if(data[i].manager_signature_date != null){
                            doc.addPage();
                            doc.text(40, 40, 'CORRECTIVE ACTION');
                            doc.text(40, 80, 'Question: Please describe any corrective action(s) taken to address the areas rated as "No" on the Facility');
                            doc.text(40, 95, 'Inspection Report Checklist. Please forward a copy of the Checklist and Corrective Action form to the');
                            doc.text(40, 110, 'Facilities Maintenance department.');
                            var pageSize = doc.internal.pageSize;
                            var pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                            var text = doc.splitTextToSize('Answer: '+data[i].corrective_action, pageWidth - 90, {});
                            doc.text(40, 125, text);
                            var last = (text.length * doc.internal.getFontSize()) + 110;
                            doc.text(40,last+30, 'Electronically sign by '+data[i].manager_name+' on '+data[i].manager_signature_date);
                        }
                    }


                    /*doc.text(40, 55, 'Agency:');
                    doc.text(100, 55, 'DACCO Behavioral Health');
                    doc.line(95,58,240,58);

                    doc.text(40, 70, 'Unit ID #:');
                    doc.text(100, 70, data['unit_id']);
                    doc.line(95,73,240,73);

                    if(data['inspection_type'] == 1){
                        doc.setFillColor(255, 0, 0);
                        doc.rect(300, 73, 30, -10, 'FD');
                        doc.text(350, 70, 'Pre-trip Inspection');
                    } else {
                        doc.rect(300, 73, 30, -10);
                        doc.text(350, 70, 'Pre-trip Inspection');                        
                    }

                    doc.text(40, 85, 'Date:');
                    doc.text(100, 85, data['inspection_date']);
                    doc.line(95,88,240,88);

                    if(data['inspection_type'] == 0){
                        doc.setFillColor(255, 0, 0);
                        doc.rect(300, 88, 30, -10, 'FD');
                        doc.text(350, 85, 'Post-trip Inspection');
                    } else {
                        doc.rect(300, 88, 30, -10);
                        doc.text(350, 85, 'Post-trip Inspection');                        
                    }

                    doc.text(40, 100, 'Mileage:');
                    doc.text(100, 100, data['mileage']);
                    doc.line(95,103,240,103);

					doc.autoTable(columns, data['inspection1'], {
                        margin: {top: 120},
						columnStyles: {
							name: {columnWidth: 175},
							status: {columnWidth: 75}
                        },
                        styles: { cellPadding: 1, fontSize: 10 },                     
                        didDrawCell: function (data) {
                            if (
                                data.column.dataKey === 'status') {
                                    doc.addImage(
                                    coinBase64Img,
                                    'PNG',
                                    data.cell.x + 5,
                                    data.cell.y + 2,
                                    5,
                                    5
                                )
                            }
                        },
                        theme: 'grid'
                    });
                    
                    let first = doc.autoTable.previous;
					doc.autoTable(columns2, data['inspection2'], {
                        startY: first.finalY + 10,
						columnStyles: {
							name: {columnWidth: 175},
							status: {columnWidth: 75}
                        },
                        styles: { cellPadding: 1, fontSize: 10 },
                        theme: 'grid'
                    });                  
                    
                    let second = doc.autoTable.previous;
                    if(data['signature'] != null){
                        doc.text(40,second.finalY+30, 'Driver Name: '+data['driver_name']);
                        var imgData = 'data:image/jpeg;base64,' + data['signature'];
                        doc.addImage(imgData, 'JPEG', 40,second.finalY+40,200,104);
                    }

                    if(data['manager_signature_date'] != null){
                        doc.text(40,second.finalY+154, 'Electronically sign by '+data['manager_name']+' on '+data['manager_signature_date']);
                    }*/  


					doc.save('Cove Facility Inspection Report.pdf');    
    
                },
    
            });
        } 

        function exportCSV(){
            var start = $('#daterangestart').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
            var end = $('#daterangeend').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

            $.ajax({
                url: '<?php echo base_url('/facility_inspection/export_facility_inspections') ?>',
                type: 'POST',
                data: {
                    'startDate': start,
                    'endDate': end
                },
                datatype: 'json',
                success: function(response, textStatus, jqXHR) {
                    //////////////////////////////////////////////////////
                    console.log('Ajax Remove Card Response:', response);
                    //////////////////////////////////////////////////////

                    var data = JSON.parse(response);
                    var html = '';

                    html +=	'<table id="export_data">' +
								'<tr>' +
									'<th>Event Date</th>' +
									'<th>Facility</th>' +
									'<th>Location</th>' +
									'<th>Quarter</th>' +
									'<th>Shift</th>'
                                '</tr>';

                    for (i = 0; i < data.length; i++){

                        html +=	'<tr>' +
                                    '<td>' + data[i].event_date + '</td>' +
                                    '<td>' + data[i].facility + '</td>' +
                                    '<td>' + data[i].location + '</td>' +
                                    '<td>' + data[i].quarter + '</td>' +
                                    '<td>' + data[i].shift + '</td>'
                                '</tr>';
                    }

                    html +=	'</table>';

					$('#csv-data').html(html);

                    exportTableToCSV('facility_inspection.csv');

                },

            });
        }

        function downloadCSV(csv, filename) {
            var csvFile;
            var downloadLink;

            // CSV file
            csvFile = new Blob([csv], {type: "text/csv"});

            // Download link
            downloadLink = document.createElement("a");

            // File name
            downloadLink.download = filename;

            // Create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);

            // Hide download link
            downloadLink.style.display = "none";

            // Add the link to DOM
            document.body.appendChild(downloadLink);

            // Click download link
            downloadLink.click();
        }       

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.getElementById("csv-data").querySelectorAll("table tr");
            
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");
                
                for (var j = 0; j < cols.length; j++) 
                    row.push(cols[j].innerText);
                
                csv.push(row.join(","));        
            }

            // Download CSV file
            downloadCSV(csv.join("\n"), filename);
        }       

    </script>

<?php $this->view('components/footer_end'); ?>