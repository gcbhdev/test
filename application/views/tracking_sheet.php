<?php $this->view('components/header_start'); ?>

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Sweet Alert css -->
    <link href="<?php echo base_url('assets/plugins/sweet-alert/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
    
    <style>
        @media screen {
        #printSection {
            display: none;
        }
        }

        @media print {
        body * {
            visibility: hidden;
        }
        #printSection,
        #printSection * {
            visibility: visible;
        }
        #printSection {
            position: absolute;
            left: 0;
            top: 0;
        }
        }
    </style>

<?php $this->view('components/header_end'); ?>




                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Travel Tracking Sheets</h1>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url('tracking_sheet') ?>">My Tracking Sheets</a>
                        </li>
                        <?php if($this->ion_auth->is_admin() || $this->ion_auth_model->in_group('managers')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('tracking_sheet/supervisors') ?>">My Team's Tracking Sheets</a>
                        </li>
                        <?php endif; ?>	
                    </ul>
                
                    <!-- Page Heading 
                    <h1 class="h3 mb-2 text-gray-800">Travel Tracking Sheets</h1>-->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">                            
                            <a href="<?php echo base_url('tracking_sheet/edit') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-plus fa-sm text-white-50"></i> New Tracking Sheet</a>
                            <!--<div class="form-inline">
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
                                <button type="submit" class="btn btn-primary" onclick="getlogs();">Filter</button>
                            </div>-->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th style="width:175px;"></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Status</th>
                                            <th>Amount</th>
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



                <!-- View Tracking Sheet Modal-->
                <div id="printThis">
                <div class="modal fade" id="TrackingSheetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Travel Reimbursment Form</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div id="tracking_sheet_body" class="modal-body"></div>
                            <div class="modal-footer">
                                <button id="btnPrint" type="button" class="btn btn-info" onclick="printElement(document.getElementById('tracking_sheet_body'));">Print</a>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary sign_button" onclick="approve_tracking_sheet();">Approve</a>
                                <button type="button" class="btn btn-danger sign_button" onclick="reject_tracking_sheet();">Reject</a>
                            </div>
                        </div>
                    </div>
                </div>			
                </div>			
				
<?php $this->view('components/footer_start'); ?>

    <!-- Page level plugins -->
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>-->
    <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url('/assets/vendor/notifications/notify.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/vendor/notifications/notify-metro.js') ?>"></script>
        <!-- Sweet Alert Js  -->
	<script src="<?php echo base_url('assets/plugins/sweet-alert/sweetalert2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/pages/jquery.sweet-alert.init.js') ?>"></script>



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

            getlogs();

				
        }); 
        
        function printElement(elem) {
                var domClone = elem.cloneNode(true);
                
                var $printSection = document.getElementById("printSection");
                
                if (!$printSection) {
                    var $printSection = document.createElement("div");
                    $printSection.id = "printSection";
                    document.body.appendChild($printSection);
                }
                
                $printSection.innerHTML = "";
                $printSection.appendChild(domClone);
                window.print();
            }

        function getlogs(){
            //var start = $('#daterangestart').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
            //var end = $('#daterangeend').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

            if(GlobalVariables.dataTable != ''){
                GlobalVariables.dataTable.destroy();
            }

			GlobalVariables.dataTable = $('#dataTable').DataTable({		
                "bProcessing": true,
				 "serverSide": true,
				 "stateSave": true,
				 "responsive": true,
                 "searching": false,
                 "ordering": false,
				 "language": {
				   "emptyTable": "You have no logs within the selected date range."
				 },
				 "ajax":{
					url : "<?php echo base_url('/tracking_sheet/get_travel_logs') ?>", // json datasource
					type: "post",  // type of method  ,GET/POST/DELETE
					data: {},
					complete: function () {
			
						
					},
					error: function(){
					  $("#employee_grid_processing").css("display","none");
					}
				  }
            });
        }


        function delete_tracking_sheet(id){

            var postUrl = '<?php echo base_url('/tracking_sheet/delete_tracking_sheet') ?>';

            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'id': id
            };

            swal({
                title: 'Are you sure you want delete this Tracking Sheet?',
                text: "This progress cannot be reversed.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-confirm mt-2',
                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                confirmButtonText: 'Yes!'
            }).then(function () {

            $.ajax({
                url: postUrl,
                type: 'POST',
                data: postData,
                datatype: 'json',
                success: function(response, textStatus, jqXHR) {
                    //////////////////////////////////////////////////////
                    console.log('Ajax Remove Card Response:', response);
                    //////////////////////////////////////////////////////

                    $.notify("Tracking Sheet has been deleted", "success");
                    getlogs();

                },

            });
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal({
                        title: 'Cancelled',
                        text: "Your Tracking Sheet is safe :)",
                        type: 'error',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    })
                }
            })
        } 

        function view_tracking_sheet(id, status){
            //add confirm dialog here
            var postUrl = '<?php echo base_url('/tracking_sheet/view_tracking_sheet') ?>';
    
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'id': id
            };
            if(status == 1){
                $('.sign_button').prop('hidden', true);
            } else{
                $('.sign_button').prop('hidden', false);
            }

            $('#inspection_id').val(id);

            
    
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
                    var inspection_type = '';

                    for (i = 0; i < data['info'].length; i++){
                        html += '<input id="supervisor_tracking_sheet_id" type="text" value="' + data['info'][i].tracking_sheet_id + '" hidden />';
                        html += '<strong>Employee Name: </strong><u>' + data['info'][i].employee_name + '</u><br>';
                        html += '<strong>Employee #: </strong><u>' + data['info'][i].employee_no + '</u><br>';
                        html += '<strong>Program: </strong><u>' + data['info'][i].description + '</u><br><br>';
                    }

                    html += '<table class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th>Date</th>' +
                                        '<th>Origin</th>' +
                                        '<th>Destination</th>' +
                                        '<th>Purpose or Reason</th>' +
                                        '<th>Program</th>' +
                                        '<th>Meals</th>' +
                                        '<th>Lodging</th>' +
                                        '<th>Personal Mileage</th>' +
                                        '<th>Other Trans Amount</th>' +
                                        '<th>Incidental Type</th>' +
                                    '</tr>' +
                                    '</thead>';

                    for (i = 0; i < data['travel_logs'].length; i++){
                        html +='<tr>' +
                                    '<td>' + data['travel_logs'][i].travel_date + '</td>' +
                                    '<td>' + data['travel_logs'][i].origin + '</td>' +
                                    '<td>' + data['travel_logs'][i].destination + '</td>' +
                                    '<td>' + data['travel_logs'][i].purpose + '</td>' +
                                    '<td>' + data['travel_logs'][i].description + '</td>' +
                                    '<td>' + data['travel_logs'][i].meals + '</td>' +
                                    '<td>' + data['travel_logs'][i].lodging + '</td>' +
                                    '<td>' + data['travel_logs'][i].mileage + '</td>' +
                                    '<td>' + data['travel_logs'][i].other_trans_amount + '</td>' +
                                    '<td>' + data['travel_logs'][i].incidental_type + '</td>' +
                                '</tr>';
                    }

                    html += '</table><br>';





                    var formatter = new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'USD',

                        // These options are needed to round to whole numbers if that's what you want.
                        //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
                        //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
                    });

                    for (i = 0; i < data['totals'].length; i++){

                        html += '<strong>Total Meals: </strong><u>' + formatter.format(data['totals'][i].meals_total) + '</u><br>';
                        html += '<strong>Total Lodging: </strong><u>' + formatter.format(data['totals'][i].lodging_total) + '</u><br>';
                        html += '<strong>Total Mileage: </strong><u>' + formatter.format(data['totals'][i].mileage_total) + '</u><br>';
                        html += '<strong>Total Other Transactions: </strong><u>' + formatter.format(data['totals'][i].other_total) + '</u><br>';
                        html += '<strong>Grand Total: </strong><u>' + formatter.format(data['totals'][i].grand_total) + '</u><br><br>';                            

                    }

                    for (i = 0; i < data['audit'].length; i++){

                        html += '<small>' + data['audit'][i].created_on + ' - ' + data['audit'][i].action + ' by ' + data['audit'][i].employee_name + ' - ' + data['audit'][i].comments + '</small><br>';                        

                    }

                    $('#tracking_sheet_body').html(html);
    
                },
    
            });
        }         


        function exportCSV(){
            var start = $('#daterangestart').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
            var end = $('#daterangeend').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

            $.ajax({
                url: '<?php echo base_url('/logs/export_logs') ?>',
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
									'<th>Trip Date</th>' +
									'<th>Trip Code</th>' +
									'<th>Van Number</th>' +
									'<th>Driver Name</th>' +
									'<th>Program</th>' +
									'<th>Number of Patients</th>' +
                                '</tr>';

                    for (i = 0; i < data.length; i++){

                        html +=	'<tr>' +
                                    '<td>' + data[i].trip_date + '</td>' +
                                    '<td>' + data[i].trip_code + '</td>' +
                                    '<td>' + data[i].van_number + '</td>' +
                                    '<td>' + data[i].driver_name + '</td>' +
                                    '<td>' + data[i].program + '</td>' +
                                    '<td>' + data[i].no_of_patients + '</td>' +
                                '</tr>';
                    }

                    html +=	'</table>';

					$('#csv-data').html(html);

                    exportTableToCSV('logs.csv');

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