<?php $this->view('components/header_start'); ?>

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

<?php $this->view('components/header_end'); ?>




                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Van Inspections</h1>

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
                                            <th>Inspection Date</th>
                                            <th>Unit ID</th>
                                            <th>Driver Name</th>
                                            <th>Mileage</th>
                                            <th>Inspection Type</th>
                                            <th>Status</th>
                                            <th>Manager</th>
                                            <th>Signature Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Inspection Date</th>
                                            <th>Unit ID</th>
                                            <th>Driver Name</th>
                                            <th>Mileage</th>
                                            <th>Inspection Type</th>
                                            <th>Status</th>
                                            <th>Manager</th>
                                            <th>Signature Date</th>
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
                                <input type="text" id="inspection_id" class="form-control" hidden />
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="button" onclick="sign_inspection();">Sign</a>
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
                    { "data": 0},
                    { "data": 1 },
                    { "data": 2 },
                    { "data": 3 },
                    { "data": 4 },
                    { "data": 5 },
                    { "data": 6 },
                    { "data": 7 },
                    { "data": 8, "width": "150px" }
                 ],
				 "language": {
				   "emptyTable": "You have no inspections within the selected date range."
				 },
				 "ajax":{
					url : "<?php echo base_url('/inspections/get_inspections') ?>", // json datasource
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

        function view_inspection(id, signtature){
            //add confirm dialog here
            var postUrl = '<?php echo base_url('/inspections/get_inspection') ?>';
    
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'id': id
            };
            if(signtature == 1){
                $('#sign_button').prop('disabled', true);
            } else{
                $('#sign_button').prop('disabled', false);
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

                    if(data['inspection_type'] == 1){
                        inspection_type = 'Pre-trip Inspection';
                    } else {
                        inspection_type = 'Post-trip Inspection';                        
                    }


                    html += '<strong>Agency: </strong><u>DACCO Behavioral Health</u><br>';
                    html += '<strong>Unit ID #: </strong><u>' + data['unit_id'] + '</u><br>';
                    html += '<strong>Date: </strong><u>' + data['inspection_date'] + '</u><br>';
                    html += '<strong>Mileage: </strong><u>' + data['mileage'] + '</u><br>';
                    html += '<strong>Inspection Type: </strong><u>' + inspection_type + '</u><br><br>';

                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th style="width: 300px;">Vehicle Components</th>' +
                                        '<th style="width: 100px;">Condition</th>' +
                                        '<th>Comment</th>' +
                                    '</tr>' +
                                    '</thead>';

                    for (i = 0; i < data['inspection1'].length; i++){
                        html +='<tr>' +
                                    '<td>' + data['inspection1'][i].name + '</td>' +
                                    '<td>' + data['inspection1'][i].status + '</td>' +
                                    '<td>' + data['inspection1'][i].comment + '</td>' +
                                '</tr>';
                    }

                    html += '</table>';

                    html += '<table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">' +
								   '<thead>' +
                                   '<tr>' +
                                        '<th style="width: 300px;">Vehicle Components</th>' +
                                        '<th style="width: 100px;">Condition</th>' +
                                        '<th>Comment</th>' +
                                    '</tr>' +
                                    '</thead>';

                    for (i = 0; i < data['inspection2'].length; i++){
                        html +='<tr>' +
                                    '<td>' + data['inspection2'][i].name + '</td>' +
                                    '<td>' + data['inspection2'][i].status + '</td>' +
                                    '<td>' + data['inspection2'][i].comment + '</td>' +
                                '</tr>';
                    }

                    html += '</table><br>';

                    html += 'Driver Name: ' + data['driver_name'] + '<br>';

                    html += '<img src="data:image/jpeg;base64,' + data['signature'] + '" width="200" height="104" /><br><br>';

                    if (data['manager_signature_date'] != null) {
                        html += 'Electronically signed by ' + data['manager_name'] + ' on ' + data['manager_signature_date'];
                    }

                    $('#inspection_body').html(html);
             
                    
                    /*let second = doc.autoTable.previous;
                    if(data['signature'] != null){
                        doc.text(40,second.finalY+30, 'Driver Name: '+data['driver_name'])
                        var imgData = 'data:image/jpeg;base64,' + data['signature'];
                        doc.addImage(imgData, 'JPEG', 40,second.finalY+40,200,104);
                    }

					doc.save('Inspection.pdf');*/    
    
                },
    
            });
        } 

        function sign_inspection(){
            //add confirm dialog here
            var postUrl = '<?php echo base_url('/inspections/sign_inspection') ?>';

            var id = $('#inspection_id').val();
    
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'id': id,
                'password': $('#password').val()
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
            var postUrl = '<?php echo base_url('/inspections/get_inspection') ?>';
    
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

					var columns = [
						{title: "Vehicle Components", dataKey: "name"},
						{title: "Condition", dataKey: "status"},
						{title: "Comment", dataKey: "comment"}
                    ]; 

                    var columns2 = [
						{title: "Vehicle Components (If Equipped)", dataKey: "name"},
						{title: "Condition", dataKey: "status"},
						{title: "Comment", dataKey: "comment"}
                    ]; 
                                    
					// Only pt supported (not mm or in)
					var doc = new jsPDF('p', 'pt');
                    doc.setFontSize(12);
                    doc.text(230, 40, 'Pre-trip/Post-trip Inspection Form');
                    doc.setFontSize(10);

                    doc.text(40, 55, 'Agency:');
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
                        /*didDrawCell: function (data) {
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
                        },*/
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
                    }


					doc.save('Inspection.pdf');    
    
                },
    
            });
        } 

        function exportCSV(){
            var start = $('#daterangestart').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
            var end = $('#daterangeend').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

            $.ajax({
                url: '<?php echo base_url('/inspections/export_inspections') ?>',
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
									'<th>Inspection Date</th>' +
									'<th>Unit ID</th>' +
									'<th>Driver Name</th>' +
									'<th>Mileage</th>' +
									'<th>Inspection Type</th>' +
									'<th>Status</th>' +
                                    '<th>Manager</th>' +
                                    '<th>Manager Signature Date</th>' +
                                '</tr>';

                    for (i = 0; i < data.length; i++){

                        html +=	'<tr>' +
                                    '<td>' + data[i].inspection_date + '</td>' +
                                    '<td>' + data[i].unit_id + '</td>' +
                                    '<td>' + data[i].driver_name + '</td>' +
                                    '<td>' + data[i].mileage + '</td>' +
                                    '<td>' + data[i].inspection_type + '</td>' +
                                    '<td>' + data[i].status + '</td>' +
                                    '<td>' + data[i].manager_name + '</td>' +
                                    '<td>' + data[i].manager_signature_date + '</td>' +
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