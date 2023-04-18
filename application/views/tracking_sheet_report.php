<?php $this->view('components/header_start'); ?>

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

<?php $this->view('components/header_end'); ?>




                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Travel Tracking Report</h1>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url('tracking_sheet/report/hr') ?>">HR Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('tracking_sheet/report/finance') ?>">Finance Report</a>
                        </li>
                    </ul>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">                            
                            <button class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm float-right" onclick="exportCSV(1);"><i class="fas fa-download fa-sm text-white-50"></i> Export and Mark Paid</button>
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right mr-2" onclick="exportCSV(0);"><i class="fas fa-download fa-sm text-white-50"></i> Export</button>
                            <div class="form-inline">
                                <div class="input-group mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Start:</div>
                                    </div>
                                    <input class="form-control" name="daterange" type="text" id="daterangestart" autocomplete="off" value="<?php echo date("m/d/Y", strtotime("-14 day")); ?>" />
                                </div>

                                <div class="input-group mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">End:</div>
                                    </div>
                                    <input class="form-control" name="daterange" type="text" id="daterangeend" autocomplete="off" value="<?php echo date('m/d/Y'); ?>" />
                                </div>
                                <button type="submit" class="btn btn-primary" onclick="getlogs();">Filter</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Employee #</th>
                                            <th>G/L#</th>
                                            <th>Department</th>
                                            <th>Fund</th>
                                            <th>% of Allocation</th>
                                            <th>Amount</th>
                                            <th>From</th>
                                            <th>To</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Employee #</th>
                                            <th>G/L#</th>
                                            <th>Department</th>
                                            <th>Fund</th>
                                            <th>% of Allocation</th>
                                            <th>Amount</th>
                                            <th>From</th>
                                            <th>To</th>
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

			
				
<?php $this->view('components/footer_start'); ?>

    <!-- Page level plugins -->
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>-->
    <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

    <script src="<?php echo base_url('/assets/vendor/notifications/notify.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/vendor/notifications/notify-metro.js') ?>"></script>



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

            $(document).on('blur', '.update', function(){
				var postUrl = '<?php echo base_url('/tracking_sheet/update_tracking_sheet_report') ?>';
				var postData = {
					'id': $(this).data('id'),
					'column_name': $(this).data('column'),
					'value': $(this).text()
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
                        
						$.notify("Fund has been updated", "success");
					},
				});	
			});
				
        });    

        function getlogs(){
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
				 "language": {
				   "emptyTable": "You have no logs within the selected date range."
				 },
				 "ajax":{
					url : "<?php echo base_url('/tracking_sheet/get_report') ?>", // json datasource
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


        function exportCSV(export_type){
            var start = $('#daterangestart').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
            var end = $('#daterangeend').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

            $.ajax({
                url: '<?php echo base_url('/tracking_sheet/export_logs') ?>',
                type: 'POST',
                data: {
                    'startDate': start,
                    'endDate': end,
                    'export_type': export_type
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
                                    '<th>Employee Name</th>' +
                                    '<th>Employee #</th>' +
                                    '<th>G/L#</th>' +
                                    '<th>Department</th>' +
                                    '<th>Fund</th>' +
                                    '<th>% of Allocation</th>' +
                                    '<th>Amount</th>' +
                                    '<th>From</th>' +
                                    '<th>To</th>' +
                                '</tr>';

                    for (i = 0; i < data.length; i++){

                        html +=	'<tr>' +
                                    '<td>' + data[i].employee_name + '</td>' +
                                    '<td>' + data[i].employee_no + '</td>' +
                                    '<td>' + data[i].gl_num + '</td>' +
                                    '<td>' + data[i].program_code + '</td>' +
                                    '<td>' + data[i].fund + '</td>' +
                                    '<td>' + data[i].allocation + '</td>' +
                                    '<td>' + data[i].amount + '</td>' +
                                    '<td>' + data[i].date_from + '</td>' +
                                    '<td>' + data[i].date_to + '</td>' +
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