<?php $this->view('components/header_start'); ?>

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

<?php $this->view('components/header_end'); ?>




                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Van Logs</h1>

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
                                <button type="submit" class="btn btn-primary" onclick="getlogs();">Filter</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Trip Date</th>
                                            <th>Trip Code</th>
                                            <th>Van Number</th>
                                            <th>Driver Name</th>
                                            <th>Program</th>
                                            <th>Number of Patients</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Trip Date</th>
                                            <th>Trip Code</th>
                                            <th>Van Number</th>
                                            <th>Driver Name</th>
                                            <th>Program</th>
                                            <th>Number of Patients</th>
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
					url : "<?php echo base_url('/logs/get_logs') ?>", // json datasource
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