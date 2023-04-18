<?php $this->view('components/header_start'); ?>

    <!-- Custom styles for this page -->
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/colreorder/1.5.3/css/colReorder.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

<?php $this->view('components/header_end'); ?>




                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Service Orders</h1>

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
                                <button type="submit" class="btn btn-primary" onclick="getserviceorders();">Filter</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Ticket Date</th>
                                            <th>Van Number</th>
                                            <th>Vehicle Location</th>
                                            <th>Category</th>
                                            <th>Assigned To</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th class="never">ID</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Ticket Date</th>
                                            <th>Van Number</th>
                                            <th>Vehicle Location</th>
                                            <th>Category</th>
                                            <th>Assigned To</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th>ID</th>
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
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

    <script src="<?php echo base_url('assets/vendor/jspdf/jspdf.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/jspdf/jspdf.plugin.autotable.js') ?>"></script> 

    <script type="text/javascript">
			var GlobalVariables = {
				'csrfToken'               	: <?php echo json_encode($this->security->get_csrf_hash()); ?>,
				'baseurl'					: '<?php echo base_url(); ?>',
                'dataTable' 				: '',
                'technicians'               : <?php echo json_encode($technicians); ?>,
                'startDate'                 : '<?php echo date('m/d/Y'); ?>',
                'endDate'                   : '<?php echo date('m/d/Y'); ?>'
			};
			

        $(document).ready(function() {

            
            $('input[name="daterange"]').datepicker({

            });

            getserviceorders();
                
        });   

        function getserviceorders(){
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
                    { "data": 0, "width": "100px" },
                    { "data": 1, "width": "100px" },
                    { "data": 2 },
                    { "data": 3 },
                    { 
                        "render": function(d,t,r){
                            <?php if($this->ion_auth->is_admin() || $this->ion_auth_model->in_group('tech')): ?>
                                var $select = $("<select></select>", {
                                    "id": "result-"+r[7],
                                    "class": "form-control input-sm",
                                    "onchange": "update_technician("+r[7]+")",
                                    "value": r[4]
                                });

                                var results = '<option value="">Unassigned</option>';
                                for (i = 0; i < GlobalVariables.technicians.length; i++){
                                    //results += '<option value="' + GlobalVariables.results[i].id + '">' + GlobalVariables.results[i].name + '</option>';
                                    results += '<option value="' + GlobalVariables.technicians[i].id + '"' + (GlobalVariables.technicians[i].id == r[4] ? "selected='selected'" : "") + '>' + GlobalVariables.technicians[i].tech_name + '</option>';
                                }

                                $select.append(results);

                                return $select.prop("outerHTML");
                            <?php endif; ?>	
                            <?php if($this->ion_auth_model->in_group('members')): ?>
                                var results = '';
                                for (i = 0; i < GlobalVariables.technicians.length; i++){
                                    if(GlobalVariables.technicians[i].id == r[4]) {
                                        results = GlobalVariables.technicians[i].tech_name;
                                    }
                                }

                                if(results == ''){
                                    results = "Unassigned";
                                }

                                return results;
                            <?php endif; ?>	
                        },
                    },
                    { "data": 5 },
                    { "data": 6 },
                    { "visible": false },
                ],

                "language": {
                "emptyTable": "You have no tickets within the selected date range."
                },
                "ajax":{
                    url : "<?php echo base_url('/service_orders/get_service_orders') ?>", // json datasource
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

        function update_technician(id){

            var postUrl = '<?php echo base_url('/service_orders/update_technician') ?>';
    
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'id': id,
                'technician_id': $('#result-'+id).val(),
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

                },
    
            });
        }

        function generate_pdf(id){
		 
            //add confirm dialog here
            var postUrl = '<?php echo base_url('/service_orders/get_service_order') ?>';
    
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
                    doc.setFontSize(16);
                    var title = 'Service Ticket';
                    var xOffset = (doc.internal.pageSize.width || doc.internal.pageSize.getWidth() / 2) - (doc.getStringUnitWidth(title) * doc.internal.getFontSize() / 2);
                    doc.text(xOffset, 40, title);
                    doc.setFontSize(10);

                    doc.text(40, 80, 'Date/Time:');
                    doc.text(130, 80, data['ticket_date']);
                    doc.line(125,83,270,83);

                    doc.text(40, 110, 'Van Number:');
                    doc.text(130, 110, data['van_number']);
                    doc.line(125,113,270,113);

                    doc.text(40, 140, 'Vehicle Location:');
                    doc.text(130, 140, data['vehicle_location']);
                    doc.line(125,143,270,143);

                    doc.text(40, 170, 'Category:');
                    doc.text(130, 170, data['category']);
                    doc.line(125,173,270,173);

                    doc.text(40, 200, 'Description of Issue:');

                    var pageSize = doc.internal.pageSize;
                    var pageWidth = pageSize.width ? pageSize.width : pageSize.getWidth();
                    var text = doc.splitTextToSize(data['description'], pageWidth - 165, {});
                    doc.text(130, 220, text);

                    var last = (text.length * doc.internal.getFontSize()) + 220;

                    if(data['signature']){
                        doc.text(40, last+30, 'Technician Notes:');

                        var pageSize2 = doc.internal.pageSize;
                        var pageWidth2 = pageSize.width ? pageSize.width : pageSize.getWidth();
                        var text2 = doc.splitTextToSize(data['tech_notes'], pageWidth2 - 165, {});
                        doc.text(130, last+60, text2);

                        var last2 = (text2.length * doc.internal.getFontSize()) + last+60;

                        doc.text(40,last2+30, 'Technician Name: '+data['tech_name'])
                        var imgData = 'data:image/jpeg;base64,' + data['signature'];
                        doc.addImage(imgData, 'JPEG', 40,last2+60,200,104);
                        doc.text(40,last2+164, 'Signature Date: '+data['signature_date'])
                    }

                    doc.save('Service_Ticket.pdf');    
    
                },
    
            });
        }    

        function exportCSV(){
            var start = $('#daterangestart').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
            var end = $('#daterangeend').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

            $.ajax({
                url: '<?php echo base_url('/service_orders/export_service_orders') ?>',
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
									'<th>Ticket Date</th>' +
									'<th>Van Number</th>' +
									'<th>Vehicle Location</th>' +
									'<th>Category</th>' +
									'<th>Assigned To</th>' +
									'<th>Status</th>' +
                                '</tr>';

                    for (i = 0; i < data.length; i++){

                        html +=	'<tr>' +
                                    '<td>' + data[i].ticket_date + '</td>' +
                                    '<td>' + data[i].van_number + '</td>' +
                                    '<td>' + data[i].vehicle_location + '</td>' +
                                    '<td>' + data[i].category + '</td>' +
                                    '<td>' + data[i].tech_name + '</td>' +
                                    '<td>' + data[i].status + '</td>' +
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