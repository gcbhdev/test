<?php $this->view('components/header_start'); ?>

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

<?php $this->view('components/header_end'); ?>




                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Report of Emergency Response Plan</h1>

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
                                            <th>Quarter</th>
                                            <th>Program</th>
                                            <th>Location</th>
                                            <th>Shift</th>
                                            <th>Emergency or Drill</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Event Date</th>
                                            <th>Quarter</th>
                                            <th>Program</th>
                                            <th>Location</th>
                                            <th>Shift</th>
                                            <th>Emergency or Drill</th>
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
                                <h5 class="modal-title" id="exampleModalLabel">Report of Emergency Response Plan</h5>
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
                                <input type="text" id="emergency_response_id" class="form-control" hidden />
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="button" onclick="sign_emergency_response();">Sign</a>
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

    <script src="<?php echo base_url('assets/vendor/jspdf/jspdf.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/jspdf/jspdf.plugin.autotable.js') ?>"></script>    



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
                    { "data": 5 },
                    { "data": 6, "width": "150px" }
                 ],
				 "language": {
				   "emptyTable": "You have no emergency response plans within the selected date range."
				 },
				 "ajax":{
					url : "<?php echo base_url('/emergency_response/get_emergency_responses') ?>", // json datasource
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

        function view_emergency_response(id, signature){
            //add confirm dialog here
            var postUrl = '<?php echo base_url('/emergency_response/get_emergency_response') ?>';
    
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'id': id
            };
            if(signature == 1){
                $('#sign_button').prop('disabled', true);
            } else{
                $('#sign_button').prop('disabled', false);
            }

            $('#emergency_response_id').val(id);

            
    
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
                        html += '<strong>Quarter: </strong><u>' + data[i].quarter + '</u><br>';
                        html += '<strong>Program: </strong><u>' + data[i].program + '</u><br>';
                        html += '<strong>Location: </strong><u>' + data[i].location + '</u><br>';
                        html += '<strong>Day of Week: </strong><u>' + data[i].day_of_week + '</u><br>';
                        html += '<strong>Date: </strong><u>' + data[i].event_date + '</u><br>';
                        html += '<strong>Exact Time: </strong><u>' + data[i].event_time + '</u><br>';
                        html += '<strong>Shift: </strong><u>' + data[i].shift + '</u><br><br>';

                        html += '<strong>It was a(n) </strong><u>' + data[i].actual_or_drill + '</u><br>';
                        html += '<strong>Type of Emergency: </strong><u>' + data[i].type_of_emergency + '</u><br><br>';

                        html += '<strong>How were employees/patients notified of the situation?? </strong><u>' + data[i].notified_how + '</u><br>';
                        html += '<strong>Was everyone notified of the situation? </strong><u>' + data[i].all_notified + '</u><br>';
                        html += '<strong>If No, why? </strong><u>' + data[i].all_not_notified_why + '</u><br><br>';

                        html += '<strong>Did an employee call the Fire/Police Department? </strong><u>' + data[i].pd_fd_called + '</u><br>';
                        html += '<strong>If No, why? </strong><u>' + data[i].no_fd_pd_called_why + '</u><br><br>';

                        html += '<strong>Were all employees and/or patients at the designated safe area and accounted for? </strong><u>' + data[i].safe_accounted + '</u><br>';
                        html += '<strong>If No, explain? </strong><u>' + data[i].not_safe_accounted_explain + '</u><br>';
                        html += '<strong>How many minutes? </strong><u>' + data[i].how_many_minutes + '</u><br>';
                        html += '<strong>Were all office doors closed? </strong><u>' + data[i].doors_closed + '</u><br>';
                        html += '<strong>If No, why? </strong><u>' + data[i].doors_not_closed_why + '</u><br><br>';

                        html += '<strong>Any problems during the incident? </strong><u>' + data[i].problems + '</u><br>';
                        html += '<strong>If Yes, explain? </strong><u>' + data[i].yes_problems_explain + '</u><br>';
                        html += '<strong>Explain other details or suggestions if appropriate (such as dollar loss, clean-up costs, etc.) Attach all supporting documentation. </strong><u>' + data[i].details + '</u><br><br>';
                        html += '<br>Completed By: ' + data[i].completed_by + '<br>';
                        html += '<img src="' + data[i].signature + '" width="200" height="104" /><br><br>';
                        html += '<hr><br>';

                        html += '<strong class="text-center">TO BE COMPLETED BY THE PROGRAM WHERE THE DRILL/EMERGENCY OCCURED</strong><br>';

                        if(signature == 1){
                            html += '<strong>What was learned from this event / what could be improved upon? </strong><u>' + data[i].improvements + '</u><br>';
                            html += '<strong>A formal debriefing has been held with the respective employees/patients following this incident or emergency situation. </strong><u>' + data[i].formal_debriefing + '</u><br>';
                            html += '<strong>If Yes, please provide details. </strong><u>' + data[i].formal_debriefing_details + '</u><br><br>';


                            if (data[i].manager_signature_date != null) {
                                html += 'Electronically signed by ' + data[i].manager_name + ' on ' + data[i].manager_signature_date;
                            }
                        } else{                

                            html += '<div class="mb-3"><label class="form-label">What was learned from this event / what could be improved upon?</label><textarea id="improvements" class="form-control" rows="6"></textarea></div>';
                            html += '<hr>';
                            html += 'A formal debriefing has been held with the respective employees/patients following this incident or emergency situation.<br>' +
                                    '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="formal_debriefing" id="formal_debriefing1" value="Yes"><label class="form-check-label" for="formal_defriefing1">Yes</label></div>' +
                                    '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="formal_debriefing" id="formal_debriefing2" value="No"><label class="form-check-label" for="formal_defriefing2">No</label></div>' +
                                    '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="formal_debriefing" id="formal_debriefing3" value="NA"><label class="form-check-label" for="formal_defriefing3">Not Applicable</label></div>';
                            html += '<hr>';
                            html += '<div class="mb-3"><label class="form-label">If Yes, please provide details.</label><textarea id="formal_debriefing_details" class="form-control" rows="6"></textarea></div>';
                        }

                    }




                    /*if (data['manager_signature_date'] != null) {
                        html += 'Electronically signed by ' + data['manager_name'] + ' on ' + data['manager_signature_date'];
                    }*/

                    $('#inspection_body').html(html);  
    
                },
    
            });
        } 

        function sign_emergency_response(){
            //add confirm dialog here
            var postUrl = '<?php echo base_url('/emergency_response/sign_emergency_response') ?>';

            var id = $('#emergency_response_id').val();
    
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'id': id,
                'password': $('#password').val(),
                'improvements': $('#improvements').val(),
                'formal_debriefing': $("input[name='formal_debriefing']:checked").val(),
                'formal_debriefing_details': $('#formal_debriefing_details').val()
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
                        view_emergency_response(id, 1);
                        
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
            var postUrl = '<?php echo base_url('/emergency_response/get_emergency_response') ?>';
    
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


					// Only pt supported (not mm or in)
					var doc = new jsPDF('p', 'pt');
                    doc.setFontSize(12);
                    doc.text(200, 40, 'Report of Emergency Response Plans');
                    doc.setFontSize(10);
                    doc.rect(35, 60, 525, 85);

                    for (i = 0; i < data.length; i++){
                        if(data[i].quarter == "Qtr I (July - Sept)") {
                            doc.rect(40, 67, 10, 10, "F");
                            doc.text(55, 75, 'Qtr I (July - Sept)');

                            doc.rect(170, 67, 10, 10);
                            doc.text(185, 75, 'Qtr II (Oct - Dec)');

                            doc.rect(300, 67, 10, 10);
                            doc.text(315, 75, 'Qtr III (Jan - Mar)');

                            doc.rect(430, 67, 10, 10);
                            doc.text(445, 75, 'Qtr IV (Apr - Jun)');
                        }

                        if(data[i].quarter == "Qtr II (Oct - Dec)") {
                            doc.rect(40, 67, 10, 10);
                            doc.text(55, 75, 'Qtr I (July - Sept)');

                            doc.rect(170, 67, 10, 10, "F");
                            doc.text(185, 75, 'Qtr II (Oct - Dec)');

                            doc.rect(300, 67, 10, 10);
                            doc.text(315, 75, 'Qtr III (Jan - Mar)');

                            doc.rect(430, 67, 10, 10);
                            doc.text(445, 75, 'Qtr IV (Apr - Jun)');
                        }

                        if(data[i].quarter == "Qtr III (Jan - Mar)") {
                            doc.rect(40, 67, 10, 10);
                            doc.text(55, 75, 'Qtr I (July - Sept)');

                            doc.rect(170, 67, 10, 10);
                            doc.text(185, 75, 'Qtr II (Oct - Dec)');

                            doc.rect(300, 67, 10, 10, "F");
                            doc.text(315, 75, 'Qtr III (Jan - Mar)');

                            doc.rect(430, 67, 10, 10);
                            doc.text(445, 75, 'Qtr IV (Apr - Jun)');
                        }

                        if(data[i].quarter == "Qtr IV (Apr - Jun)") {
                            doc.rect(40, 67, 10, 10);
                            doc.text(55, 75, 'Qtr I (July - Sept)');

                            doc.rect(170, 67, 10, 10);
                            doc.text(185, 75, 'Qtr II (Oct - Dec)');

                            doc.rect(300, 67, 10, 10);
                            doc.text(315, 75, 'Qtr III (Jan - Mar)');

                            doc.rect(430, 67, 10, 10, "F");
                            doc.text(445, 75, 'Qtr IV (Apr - Jun)');
                        }
                        

                        doc.text(40, 90, 'Program: '+data[i].program);
                        doc.line(83,91,275,91);
                        doc.text(300, 90, 'Location: '+data[i].location);
                        doc.line(343,91,545,91);

                        doc.text(40, 105, 'Day of Week: ');
                        if(data[i].day_of_week == "Sunday") {
                            doc.rect(105, 97, 10, 10, "F");
                            doc.text(118, 105, 'S');
                        } else {
                            doc.rect(105, 97, 10, 10);
                            doc.text(118, 105, 'S');                           
                        }

                        if(data[i].day_of_week == "Monday") {
                            doc.rect(130, 97, 10, 10, "F");
                            doc.text(143, 105, 'M');
                        } else {
                            doc.rect(130, 97, 10, 10);
                            doc.text(143, 105, 'M');                          
                        }


                        if(data[i].day_of_week == "Tuesday") {
                            doc.rect(155, 97, 10, 10, "F");
                            doc.text(168, 105, 'T');
                        } else {
                            doc.rect(155, 97, 10, 10);
                            doc.text(168, 105, 'T');                          
                        }

                        if(data[i].day_of_week == "Wednesday") {
                            doc.rect(180, 97, 10, 10, "F");
                            doc.text(193, 105, 'W');
                        } else {
                            doc.rect(180, 97, 10, 10);
                            doc.text(193, 105, 'W');                         
                        }

                        if(data[i].day_of_week == "Thursday") {
                            doc.rect(205, 97, 10, 10, "F");
                            doc.text(218, 105, 'T');
                        } else {
                            doc.rect(205, 97, 10, 10);
                            doc.text(218, 105, 'T');                          
                        }

                        if(data[i].day_of_week == "Friday") {
                            doc.rect(230, 97, 10, 10, "F");
                            doc.text(243, 105, 'F');
                        } else {
                            doc.rect(230, 97, 10, 10);
                            doc.text(243, 105, 'F');                           
                        }

                        if(data[i].day_of_week == "Saturday") {
                            doc.rect(255, 97, 10, 10, "F");
                            doc.text(268, 105, 'S');
                        } else {
                            doc.rect(255, 97, 10, 10);
                            doc.text(268, 105, 'S');                           
                        }


                        doc.text(40, 120, 'Date: '+data[i].event_date);
                        doc.line(65,121,275,121);
                        doc.text(300, 120, 'Exact Time: '+data[i].event_time);
                        doc.line(355,121,545,121);

                        if(data[i].shift == "1st Shift (6a-2p)") {
                            doc.rect(40, 127, 10, 10, "F");
                            doc.text(55, 135, '1st Shift (6a-2p)');
                        } else {
                            doc.rect(40, 127, 10, 10);
                            doc.text(55, 135, '1st Shift (6a-2p)'); 
                        }

                        if(data[i].shift == "2nd Shift (2p-10p)") {
                            doc.rect(170, 127, 10, 10, "F");
                            doc.text(185, 135, '2nd Shift (2p-10p)');
                        } else {
                            doc.rect(170, 127, 10, 10);
                            doc.text(185, 135, '2nd Shift (2p-10p)');                    
                        }

                        if(data[i].shift == "3rd Shift (10p-6a)") {
                            doc.rect(300, 127, 10, 10, "F");
                            doc.text(315, 135, '3rd Shift (10p-6a)');
                        } else {
                            doc.rect(300, 127, 10, 10);
                            doc.text(315, 135, '3rd Shift (10p-6a)');                   
                        }
                        doc.rect(300, 127, 10, 10);
                        doc.text(315, 135, '3rd Shift (10p-6a)');


                        doc.rect(35, 160, 525, 199);
                        doc.text(40, 175, 'It was a(n): '+data[i].actual_or_drill);
                        doc.line(90,176,275,176);
                        
                        doc.text(300, 175, 'Type of Emergency: '+data[i].type_of_emergency);
                        doc.line(390,176,545,176);

                        doc.text(40, 190, 'How were employees/patients notified of the situation?');
                        doc.text(40, 205, data[i].notified_how);
                        doc.line(40,206,545,206);
                        doc.text(40, 220, 'Other: '+data[i].other);
                        doc.line(70,221,545,221);

                        //doc.rect(35, 215, 525, 144);
                        //doc.text(40, 230, 'How were employees/patients notified of the situation? '+data[i].notified_how);
                        //doc.line(278,231,545,231);

                        doc.text(40, 245, 'Was everyone notified of the situation? '+data[i].all_notified);
                        doc.line(210,246,545,246);
                        
                        doc.text(40, 260, 'If No, why?');                        

                        var pageSize = doc.internal.pageSize;
                        var pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                        var text = doc.splitTextToSize(data[i].not_all_notified_why, pageWidth - 90, {});
                        doc.text(40, 275, text);
                        doc.line(40,276,545,276);
                        doc.line(40,288,545,288);

                        doc.text(40, 305, 'Did an employee call the fire/Police Department? '+data[i].fd_pf_called);
                        doc.line(258,306,545,306);

                        doc.text(40, 320, 'If No, why?'); 

                        var pageSize = doc.internal.pageSize;
                        var pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                        var text = doc.splitTextToSize(data[i].no_fd_pf_called_why, pageWidth - 90, {});
                        doc.text(40, 335, text);
                        doc.line(40,336,545,336);
                        doc.line(40,348,545,348);

                        doc.rect(35, 375, 525, 144);
                        doc.text(40, 390, 'Were all employees and/or patients at the designated safe area and accounted for?  '+data[i].safe_accounted);
                        doc.line(415,391,545,391);

                        doc.text(40, 405, 'If No, why?'); 

                        var pageSize = doc.internal.pageSize;
                        var pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                        var text = doc.splitTextToSize(data[i].not_safe_accounted_explain, pageWidth - 90, {});
                        doc.text(40, 420, text);
                        doc.line(40,421,545,421);
                        doc.line(40,433,545,433);

                        doc.text(40, 450, 'How many minutes? ' +data[i].how_many_minutes);
                        doc.line(130,451,315,451);

                        doc.text(40, 465, 'Were all office doors closed? '+data[i].doors_closed);
                        doc.line(175,466,315,466);

                        doc.text(40, 480, 'If No, why?'); 

                        var pageSize = doc.internal.pageSize;
                        var pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                        var text = doc.splitTextToSize(data[i].doors_not_closed_why, pageWidth - 90, {});
                        doc.text(40, 495, text);
                        doc.line(40,496,545,496);
                        doc.line(40,508,545,508);

                        doc.rect(35, 535, 525, 270);
                        doc.text(40, 550, 'Any problems during the incident? '+data[i].problems);
                        doc.line(190,551,315,551);

                        doc.text(40, 565, 'If Yes, explain?'); 

                        var pageSize = doc.internal.pageSize;
                        var pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                        var text = doc.splitTextToSize(data[i].yes_problems_explain, pageWidth - 90, {});
                        doc.text(40, 580, text);
                        doc.line(40,581,545,581);
                        doc.line(40,593,545,593);

                        doc.text(40, 610, 'Explain other details or suggestions if appropriate (such as dollar loss, clean-up costs, etc.) Attach all supporting');
                        doc.text(40, 625, 'documentation.');

                        var pageSize = doc.internal.pageSize;
                        var pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                        var text = doc.splitTextToSize(data[i].details, pageWidth - 90, {});
                        doc.text(40, 640, text);
                        doc.line(40,641,545,641);
                        doc.line(40,653,545,653);
                        doc.line(40,665,545,665);
                        doc.line(40,677,545,677);

                        if(data[i].signature != null){
                            doc.text(40,677+15, 'Report Complated by: '+data[i].completed_by);
                            doc.line(140,693,315,693);
                            doc.text(40,677+25, 'Employee or Risk Management Member');
                            //var imgData = data[i].signature;
                            doc.addImage(data[i].signature, 'JPEG', 40,677+30,160,80);
                        }


                        if(data[i].manager_signature_date != null){
                            doc.addPage();
                            doc.text(40, 40, 'TO BE COMPLETED BY THE PROGRAM WHERE THE DRILL/EMERGENCY OCCURED');
                            doc.text(40, 80, 'Question: What was learned from this event / what could be improved upon?');
                            var pageSize = doc.internal.pageSize;
                            var pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                            var text = doc.splitTextToSize('Answer: '+data[i].improvements, pageWidth - 90, {});
                            doc.text(40, 95, text);
                            var last = (text.length * doc.internal.getFontSize()) + 95;

                            doc.text(40, last+15, 'Question: A formal debriefing has been held with the respective employees/patients following this incident or');
                            doc.text(40, last+30, ' emergency situation.');
                            doc.text(40, last+45, 'Answer: '+data[i].formal_debriefing);

                            doc.text(40, last+75, 'Question: If Yes, please provide details.');
                            var pageSize2 = doc.internal.pageSize;
                            var pageWidth2 = pageSize2.width ? pageSize2.width : pageSize2.getWidth();
                            var text2 = doc.splitTextToSize('Answer: '+data[i].formal_debriefing_details, pageWidth2 - 90, {});
                            doc.text(40, last+90, text2);
                            var last2 = (text2.length * doc.internal.getFontSize()) + last;
                            doc.text(40,last+last2+30, 'Electronically sign by '+data[i].manager_name+' on '+data[i].manager_signature_date);
                        }
                        

                        //doc.text(40, 260, 'Did an employee call the fire/Police Department? '+data[i].fd_pd_called);
                        //doc.line(130,261,315,261);

                        //doc.text(40, 260, 'If No, why? '+data[i].no_fd_pd_called_why);
                        //doc.line(130,261,315,261);

                        //var last = (text.length * doc.internal.getFontSize()) + 220;

                        /*doc.rect(120, 177, 10, 10);
                        doc.text(133, 185, 'Actual Emergency');

                        doc.rect(260, 177, 10, 10);
                        doc.text(273, 185, 'Drill Only');

                        doc.text(40, 200, 'Type of Emergency: ');
                        doc.rect(125, 197, 10, 10);
                        doc.text(138, 200, 'Workplace Threat &/or Violence');

                        doc.rect(260, 197, 10, 10);
                        doc.text(273, 200, 'Natural Disaster');

                        doc.rect(260, 197, 10, 10);
                        doc.text(273, 200, 'Power Failure');

                        doc.rect(260, 197, 10, 10);
                        doc.text(273, 200, 'Medical Emergency');

                        doc.rect(260, 197, 10, 10);
                        doc.text(273, 200, 'Fire');

                        doc.rect(260, 197, 10, 10);
                        doc.text(273, 200, 'Bomb Threat');*/


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


					doc.save('Emergency Response Plan.pdf');    

                    /*var string = doc.output('datauristring');
                    var embed = "<embed width='100%' height='100%' src='" + string + "'/>";
                    var x = window.open();
                    x.document.open();
                    x.document.write(embed);
                    x.document.close();*/
    
                },
    
            });
        } 

        function exportCSV(){
            var start = $('#daterangestart').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
            var end = $('#daterangeend').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

            $.ajax({
                url: '<?php echo base_url('/emergency_response/export_emergency_responses') ?>',
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
									'<th>Quarter</th>' +
									'<th>Program</th>' +
									'<th>Location</th>' +
									'<th>Shift</th>' +
									'<th>Emergency or Drill</th>' +
                                '</tr>';

                    for (i = 0; i < data.length; i++){

                        html +=	'<tr>' +
                                    '<td>' + data[i].event_date + '</td>' +
                                    '<td>' + data[i].quarter + '</td>' +
                                    '<td>' + data[i].program + '</td>' +
                                    '<td>"' + data[i].location + '"</td>' +
                                    '<td>' + data[i].shift + '</td>' +
                                    '<td>' + data[i].actual_or_drill + '</td>' +
                                '</tr>';
                    }

                    html +=	'</table>';

					$('#csv-data').html(html);

                    exportTableToCSV('emergency_responses.csv');

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