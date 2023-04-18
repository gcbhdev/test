<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="JaVaun Joseph">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Report of Emergency Response Plans</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/signature/jquery.signaturepad.css?v=1') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/notifications/notification.css') ?>" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      #sig-canvas {
        border: 2px dotted #CCCCCC;
        border-radius: 15px;
        cursor: crosshair;
      }

      .form-check {
        padding-left: 0!important;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <!--<img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
      <h2>REPORT OF EMERGENCY RESPONSE PLANS</h2>
      <!--<p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>-->
    </div>


        <form class="needs-validation" novalidate>
          <div class="card mb-3">
            <div class="card-body">
            <div class="row">
                <div class="btn-group col-md-12">
                  <input id="quarter1" name="quarter" type="radio" class="btn-check" value="Qtr I (July - Sept)" checked>
                  <label class="btn btn-outline-dark" for="quarter1">Qtr I (July - Sept)</label>

                  <input id="quarter2" name="quarter" type="radio" class="btn-check" value="Qtr II (Oct - Dec)">
                  <label class="btn btn-outline-dark" for="quarter2">Qtr II (Oct - Dec)</label>

                  <input id="quarter3" name="quarter" type="radio" class="btn-check" value="Qtr III (Jan - Mar)">
                  <label class="btn btn-outline-dark" for="quarter3">Qtr III (Jan - Mar)</label>

                  <input id="quarter4" name="quarter" type="radio" class="btn-check" value="Qtr IV (Apr - Jun)">
                  <label class="btn btn-outline-dark" for="quarter4">Qtr IV (Apr - Jun)</label>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <label class="form-label">Program</label>
                  <select class="form-select" name="program" required>
                    <option value="">Choose...</option>
                    <!--<option value="Women’s Residential">Women’s Residential</option>
                    <option value="Men’s Residential">Men’s Residential</option>
                    <option value="Community Housing">Community Housing</option>
                    <option value="Adult Outpatient">Adult Outpatient</option>
                    <option value="Court Services">Court Services</option>
                    <option value="Youth Services/Prevention">Youth Services/Prevention</option>
                    <option value="Tampa MAT">Tampa MAT</option>
                    <option value="Lakeland">Lakeland</option>
                    <option value="Daycare">Daycare</option>
                    <option value="Head Start">Head Start</option>
                    <option value="Duplex">Duplex</option>
                    <option value="Assessment & Referral">Assessment & Referral</option>
                    <option value="Health Services">Health Services</option>
                    <option value="Administration">Administration</option>
                    <option value="Medical Services">Medical Services</option>
                    <option value="Child Welfare">Child Welfare</option>-->
                    <?php
                      for($i = 0; $i < count($programs); $i++)
                      {
                        echo '<option value="'.$programs[$i]["id"].'">'.$programs[$i]["description"].'</option>';
                      }
                    ?>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid program.
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Location</label>
                  <select class="form-select" name="location" required>
                    <option value="">Choose...</option>
                    <option value="4422 E Columbus Drive, Tampa, Florida 33605">4422 E Columbus Drive, Tampa, Florida 33605</option>
                    <option value="3107 N 50th Street, Tampa, Florida 33619">3107 N 50th Street, Tampa, Florida 33619</option>
                    <option value="3630 N 50th Street, Tampa, Florida 33619">3630 N 50th Street, Tampa, Florida 33619</option>
                    <option value="348 W Highland Drive, Lakeland, Florida 33813">348 W Highland Drive, Lakeland, Florida 33813</option>
                  </select>
                  <div class="invalid-feedback">
                    Please provide a valid location.
                  </div>
                </div>
              </div>
              <hr>
              <fieldset class="row">
                <legend class="col-form-label col-md-12">Day of the week</legend>
                <div class="btn-group">
                  <input id="d1" name="day_of_week" type="radio" class="btn-check" value="Sunday" checked>
                  <label class="btn btn-outline-dark" for="d1">S</label>

                  <input id="d2" name="day_of_week" type="radio" class="btn-check" value="Monday">
                  <label class="btn btn-outline-dark" for="d2">M</label>

                  <input id="d3" name="day_of_week" type="radio" class="btn-check" value="Tuesday">
                  <label class="btn btn-outline-dark" for="d3">T</label>

                  <input id="d4" name="day_of_week" type="radio" class="btn-check" value="Wednesday">
                  <label class="btn btn-outline-dark" for="d4">W</label>

                  <input id="d5" name="day_of_week" type="radio" class="btn-check" value="Thursday">
                  <label class="btn btn-outline-dark" for="d5">T</label>

                  <input id="d6" name="day_of_week" type="radio" class="btn-check" value="Friday">
                  <label class="btn btn-outline-dark" for="d6">F</label>

                  <input id="d7" name="day_of_week" type="radio" class="btn-check" value="Saturday">
                  <label class="btn btn-outline-dark" for="d7">S</label>
                </div>                  
              </fieldset>
              <hr>
              <label class="form-label">Date</label>
              <input type="text" id="datepicker" name="event_date" class="form-control">
              <hr>
              <label class="form-label">Exact Time (am/pm)</label>
              <input type="time" name="event_time" class="form-control">
              <hr>
              <div class="row">
                  <div class="btn-group col-md-12">
                    <input id="shift1" name="shift" type="radio" class="btn-check" value="1st Shift (6a-2p)" checked>
                    <label class="btn btn-outline-dark" for="shift1">1st Shift (6a-2p)</label>

                    <input id="shift2" name="shift" type="radio" class="btn-check" value="2nd Shift (2p-10p)">
                    <label class="btn btn-outline-dark" for="shift2">2nd Shift (2p-10p)</label>

                    <input id="shift3" name="shift" type="radio" class="btn-check" value="3rd Shift (10p-6a)">
                    <label class="btn btn-outline-dark" for="shift3">3rd Shift (10p-6a)</label>
                  </div>
              </div>
            </div>
          </div>



          <div class="card mb-3">
            <div class="card-body">
              <fieldset class="row">
                <legend class="col-form-label col-md-12">It was a(n)</legend>
                <div class="btn-group">
                  <input id="actual_or_drill1" name="actual_or_drill" type="radio" class="btn-check" value="Actual Emergency">
                  <label class="btn btn-outline-dark" for="actual_or_drill1">Actual Emergency</label>

                  <input id="actual_or_drill2" name="actual_or_drill" type="radio" class="btn-check" value="Drill Only">
                  <label class="btn btn-outline-dark" for="actual_or_drill2">Drill Only</label>
                </div>                  
              </fieldset>
              <hr>
              <fieldset class="row">
                <legend class="col-form-label col-md-12">Type of Emergency</legend>
                <div class="btn-group-vertical">
                  <div class="form-check">
                    <input id="e1" name="type_of_emergency" type="radio" class="btn-check" value="Workplace Threat &/or Violence">
                    <label class="btn btn-outline-dark" for="e1">Workplace Threat &/or Violence</label>

                    <input id="e2" name="type_of_emergency" type="radio" class="btn-check" value="Natural Disaster">
                    <label class="btn btn-outline-dark" for="e2">Natural Disaster</label>

                    <input id="e3" name="type_of_emergency" type="radio" class="btn-check" value="Power Failure">
                    <label class="btn btn-outline-dark" for="e3">Power Failure</label>

                    <input id="e4" name="type_of_emergency" type="radio" class="btn-check" value="Medical Emergency">
                    <label class="btn btn-outline-dark" for="e4">Medical Emergency</label>

                    <input id="e5" name="type_of_emergency" type="radio" class="btn-check" value="Fire">
                    <label class="btn btn-outline-dark" for="e5">Fire</label>

                    <input id="e6" name="type_of_emergency" type="radio" class="btn-check" value="Bomb Threat">
                    <label class="btn btn-outline-dark" for="e6">Bomb Threat</label>
                    <div class="invalid-feedback">
                      Please select a type of emergency.
                    </div> 
                  </div>
                </div>  
               
              </fieldset>             
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-body">
              <fieldset class="row">
                <legend class="col-form-label col-md-12">How were employees/patients notified of the situation?</legend>
                <div class="btn-group">
                  <div class="form-check">
                    <input id="n1" name="notified_how[]" type="checkbox" class="btn-check" value="Alarm Pull Station">
                    <label class="btn btn-outline-dark" for="n1">Alarm Pull Station</label>

                    <input id="n2" name="notified_how[]" type="checkbox" class="btn-check" value="PA System">
                    <label class="btn btn-outline-dark" for="n2">PA System</label>

                    <input id="n3" name="notified_how[]" type="checkbox" class="btn-check" value="Telephone">
                    <label class="btn btn-outline-dark" for="n3">Telephone</label>

                    <input id="n4" name="notified_how[]" type="checkbox" class="btn-check" value="Word of Mouth">
                    <label class="btn btn-outline-dark" for="n4">Word of Mouth</label>       
                    
                    <input id="n5" name="notified_how[]" type="checkbox" class="btn-check" value="Other">
                    <label class="btn btn-outline-dark" for="n5">Other</label>      
                    
                    <div class="invalid-feedback">
                      Please select an option.
                    </div> 
                  </div>                  
                </div>                  
              </fieldset>
              <hr>    
              <label class="form-label">If Other is selected, Please type details here.</label>
              <input type="text" name="other" class="form-control not-required">  
              <hr>
              <fieldset class="row">
                <legend class="col-form-label col-md-12">Was everyone notified of the situation?</legend>
                <div class="btn-group">
                  <input id="nn1" name="all_notified" type="radio" class="btn-check" value="Yes" checked>
                  <label class="btn btn-outline-dark" for="nn1">Yes</label>

                  <input id="nn2" name="all_notified" type="radio" class="btn-check" value="No">
                  <label class="btn btn-outline-dark" for="nn2">No</label>
                </div>                  
              </fieldset>
              <hr>    
              <label class="form-label">If No, why?</label>
              <input type="text" name="not_all_notified_why" class="form-control not-required">          
              <hr>              
              <fieldset class="row">
                <legend class="col-form-label col-md-12">Did an employee call the Fire/Police Department?</legend>
                <div class="btn-group">
                  <input id="nnn1" name="fd_pf_called" type="radio" class="btn-check" value="Yes" checked>
                  <label class="btn btn-outline-dark" for="nnn1">Yes</label>

                  <input id="nnn2" name="fd_pf_called" type="radio" class="btn-check" value="No">
                  <label class="btn btn-outline-dark" for="nnn2">No</label>
                </div>                  
              </fieldset>  
              <hr>    
              <label class="form-label">If No, why?</label>
              <input type="text" name="no_fd_pf_called_why" class="form-control not-required">           
            </div>
          </div> 
          
          <div class="card mb-3">
            <div class="card-body">
              <fieldset class="row">
                <legend class="col-form-label col-md-12">Were all employees and/or patients at the designated safe area and accounted for?</legend>
                <div class="btn-group">
                  <input id="safe_accounted1" name="safe_accounted" type="radio" class="btn-check" value="Yes" checked>
                  <label class="btn btn-outline-dark" for="safe_accounted1">Yes</label>

                  <input id="safe_accounted2" name="safe_accounted" type="radio" class="btn-check" value="No">
                  <label class="btn btn-outline-dark" for="safe_accounted2">No</label>
                </div>                  
              </fieldset>
              <hr>    
              <label class="form-label">If No, explain.</label>
              <input type="text" name="not_safe_accounted_explain" class="form-control not-required">          
              <hr>    
              <label class="form-label">How many minutes?</label>
              <input type="text" name="how_many_minutes" class="form-control">          
              <hr>         
              <fieldset class="row">
                <legend class="col-form-label col-md-12">Were all office doors closed?</legend>
                <div class="btn-group">
                  <input id="doors_closed1" name="doors_closed" type="radio" class="btn-check" value="Yes" checked>
                  <label class="btn btn-outline-dark" for="doors_closed1">Yes</label>

                  <input id="doors_closed2" name="doors_closed" type="radio" class="btn-check" value="No">
                  <label class="btn btn-outline-dark" for="doors_closed2">No</label>
                </div>                  
              </fieldset>  
              <hr>    
              <label class="form-label">If No, why?</label>
              <input type="text" name="doors_not_closed_why" class="form-control not-required">           
            </div>
          </div>    
          
          <div class="card mb-3">
            <div class="card-body">
              <fieldset class="row">
                <legend class="col-form-label col-md-12">Any problems during the incident?</legend>
                <div class="btn-group">
                  <input id="problems1" name="problems" type="radio" class="btn-check" value="Yes" checked>
                  <label class="btn btn-outline-dark" for="problems1">Yes</label>

                  <input id="problems2" name="problems" type="radio" class="btn-check" value="No">
                  <label class="btn btn-outline-dark" for="problems2">No</label>
                </div>                  
              </fieldset>
              <hr>    
              <label class="form-label">If Yes, explain.</label>
              <input type="text" name="yes_problems_explain" class="form-control not-required">          
              <hr>    
              <label class="form-label">Explain other details or suggestions if appropriate (such as dollar loss, clean-up cost, etc.) Attach all support documentation.</label>
              <textarea class="form-control not-required" name="details"></textarea>          
            </div>
          </div>   

          <!-- Signature -->
          <div class="card mb-3">
            <div class="card-body p-2">
              <div class="row">
                <div class="col-md-12 sigPad">
                  <label for="completed_by">Type your name</label>
                  <input type="text" name="completed_by" id="completed_by" class="form-control">
                  <p class="drawItDesc">Draw your signature</p>
                  <ul class="sigNav">
                    <li class="drawIt"><a href="#draw-it" >Draw It</a></li>
                    <li class="clearButton"><a href="#clear">Clear</a></li>
                  </ul>
                  <div class="sig sigWrapper">
                    <div class="typed"></div>
                    <canvas class="pad" width="300" height="200"></canvas>
                    <input type="hidden" name="signature" class="output">
                  </div>
                </div>
              </div>
            </div>
          </div> 

          <button id="sig-submitBtn" class="w-100 btn btn-dark btn-lg" type="button" onclick="submit_form();">Submit</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2021 Cove Behavioral Health</p>
  </footer>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url('/assets/vendor/signature/jquery.signaturepad.min.js') ?>"></script>
  <script src="<?php echo base_url('/assets/vendor/signature/json2.min.js') ?>"></script>
  <script src="<?php echo base_url('/assets/vendor/notifications/notify.min.js') ?>"></script>
  <script src="<?php echo base_url('/assets/vendor/notifications/notify-metro.js') ?>"></script>
      
      
      <script>
var pData = {};
var pdfData = [];
var pdfData2 = [];
var pdfData3 = [];
var signature;
var count;

$(document).ready(function(){
	
      jQuery('#datepicker').datepicker();
      jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
      });

      jQuery('#datepicker2').datepicker();
      jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
      });	
        
      signature = $('.sigPad').signaturePad({drawOnly:true,lineTop : 130,name:completed_by,});

      $(document).on('focusin', '.custom-control-input, .custom-control-label, input, select', function() {
        var name_ = $(this).attr("name");
        $("input[name='" + name_ + "']").removeClass("is-invalid");
        $("textarea[name='" + name_ + "']").removeClass("is-invalid");
        $("select[name='" + name_ + "']").removeClass("is-invalid");
        if($(this).is(":radio"))
          $(this).parent().parent().siblings(":first").removeClass("is-invalid");

      });	

});

function checkRequired(){
    
  var ret = true;
	var currentName = "";
	pData = {};
  pdfData = [];
  count = 0;
	
	$("textarea").each(function(){
		var name_ = $(this).attr("name");
		if(!$(this).hasClass("not-required") && $.trim($(this).val()) == "" )
        {
            ret = false;
            //ADD ERROR MESSAGE TO FORCE TEXT
			$(this).addClass("is-invalid");
			           
        }
		pData[name_] = $(this).val();
		
		pdfData3.push({"question" : $(this).val()});	
	});		
	
	$("select").each(function(){
		var name_ = $(this).attr("name");
		if(!$(this).hasClass("not-required") && $.trim($(this).val()) == "" )
        {
            ret = false;
            //ADD ERROR MESSAGE TO FORCE TEXT
			$(this).addClass("is-invalid");

           
        }
		pData[name_] = $("select[name='" + name_ + "'] option:selected").val();
	
		pdfData2.push({"question" : $(this).siblings(":first").html() + " - " + $("select[name='" + name_ + "'] option:selected").val()});		
	});
	
	$("input:text").each(function(){
		var name_ = $(this).attr("name");
		
		
        if(!$(this).hasClass("not-required") && $.trim($(this).val()) == "" )
        {
            ret = false;
            //ADD ERROR MESSAGE TO FORCE TEXT
			$(this).addClass("is-invalid");
           
        }
    if (name_ == 'event_date' || name_ == 'event_date') {
			pData[name_] = moment($(this).val(), "MM/DD/YYYY").format("YYYY-MM-DD");
		} else if (name_ == 'signature') {
      pData[name_] = signature.getSignatureImage();
    } else {
			pData[name_] = $(this).val();
		}
		
		pdfData2.push({"question" : $(this).siblings(":first").html() + " - " + $(this).val()});
		
		
        
    });
	
	$("input[type=time]").each(function(){
		var name_ = $(this).attr("name");
		
		
        if(!$(this).hasClass("not-required") && $.trim($(this).val()) == "" )
        {
            ret = false;
            //ADD ERROR MESSAGE TO FORCE TEXT
			$(this).addClass("is-invalid");
           
        }
    if (name_ == 'event_date' || name_ == 'event_date') {
			pData[name_] = moment($(this).val(), "MM/DD/YYYY").format("YYYY-MM-DD");
		} else if (name_ == 'signature') {
      pData[name_] = signature.getSignatureImage();
    } else {
			pData[name_] = $(this).val();
		}
		
		pdfData2.push({"question" : $(this).siblings(":first").html() + " - " + $(this).val()});
		
		
        
    });

    $("input[type=hidden]").each(function(){
		var name_ = $(this).attr("name");
		
		
        if(!$(this).hasClass("not-required") && $.trim($(this).val()) == "" )
        {
            ret = false;
            //ADD ERROR MESSAGE TO FORCE TEXT
			$(this).addClass("is-invalid");
           
        }
		if (name_ == 'event_date' || name_ == 'event_date') {
			pData[name_] = moment($(this).val(), "MM/DD/YYYY").format("YYYY-MM-DD");
		} else if (name_ == 'signature') {
      pData[name_] = signature.getSignatureImage();
    } else {
			pData[name_] = $(this).val();
		}
		
		pdfData2.push({"question" : $(this).siblings(":first").html() + " - " + $(this).val()});
		
		
        
    });    
    
    $("input:radio").each(function(){
        var name_ = $(this).attr("name");
		
        if(!$(this).hasClass("not-required")){
            if($("input[name='" + name_ + "']:checked").length ==  0)
            {
                ret = false;
                //ADD ERROR MESSAGE TO FORCE A SELECTION
				$(this).addClass("is-invalid");
				$(this).parent().parent().siblings(":first").addClass("is-invalid");
                
            }
        }
		pData[name_] = $("input[name='" + name_ + "']:checked").val();
		if(currentName != name_){
			currentName = name_;
			pdfData.push({"question" : $(this).parent().parent().siblings(":first").html().replace("&","and"), "answer" : $("input[name='" + name_ + "']:checked").val()});
		}
		
    });


    $("input[name='program_notifications[]']:checked").each(function(i){
      programs[i] = $(this).val();
    });

    pData['notified_how'] = $("input[name='notified_how[]']:checked").map(function() {
            return $(this).val();
        }).get().join(',');

    /*$("input:checkbox").each(function(){
      var name_ = $(this).attr("name");
      var id_ = $(this).attr("id");
		
      if(!$(this).hasClass("not-required")){
          if($("input[name='" + name_ + "']:checked").length ==  0)
          {
              ret = false;
              //ADD ERROR MESSAGE TO FORCE A SELECTION
      $(this).addClass("is-invalid");
      $(this).parent().parent().siblings(":first").addClass("is-invalid");
              
          }
      }


      if($("input[name='" + name_ + "']:checked")) {
        if (count == 0) {
          pData[name_] = $("input[name='" + name_ + "']:checked").val();
        } else {
          pData[name_] += ', ' + $("input[name='" + name_ + "']:checked").val();
        }
        count++;
      }
      
      if(currentName != name_){
        currentName = name_;
        pdfData.push({"question" : $(this).parent().parent().siblings(":first").html().replace("&","and"), "answer" : $("input[name='" + name_ + "']:checked").val()});
      }
    });*/

    if($("input[name='notified_how[]']:checked").val() == "Other") {
      if($.trim($("input[name='other']").val()) == "" ) {
        ret = false;
        $("input[name='other']").addClass("is-invalid");
				$("input[name='other']").parent().parent().siblings(":first").addClass("is-invalid");
      }
    } else {
      $("input[name='other']").removeClass("is-invalid");
    }
    
    if($("input[name='all_notified']:checked").val() == "No") {
      if($.trim($("input[name='not_all_notified_why']").val()) == "" ) {
        ret = false;
        $("input[name='not_all_notified_why']").addClass("is-invalid");
				$("input[name='not_all_notified_why']").parent().parent().siblings(":first").addClass("is-invalid");
      }
    } else {
      $("input[name='not_all_notified_why']").removeClass("is-invalid");
    }

    if($("input[name='fd_pf_called']:checked").val() == "No") {
      if($.trim($("input[name='no_fd_pf_called_why']").val()) == "" ) {
        ret = false;
        $("input[name='no_fd_pf_called_why']").addClass("is-invalid");
				$("input[name='no_fd_pf_called_why']").parent().parent().siblings(":first").addClass("is-invalid");
      }
    } else {
      $("input[name='no_fd_pf_called_why']").removeClass("is-invalid");
    }

    if($("input[name='safe_accounted']:checked").val() == "No") {
      if($.trim($("input[name='not_safe_accounted_explain']").val()) == "" ) {
        ret = false;
        $("input[name='not_safe_accounted_explain']").addClass("is-invalid");
				$("input[name='not_safe_accounted_explain']").parent().parent().siblings(":first").addClass("is-invalid");
      }
    } else {
      $("input[name='not_safe_accounted_explain']").removeClass("is-invalid");
    }

    if($("input[name='doors_closed']:checked").val() == "No") {
      if($.trim($("input[name='doors_not_closed_why']").val()) == "" ) {
        ret = false;
        $("input[name='doors_not_closed_why']").addClass("is-invalid");
				$("input[name='doors_not_closed_why']").parent().parent().siblings(":first").addClass("is-invalid");
      }
    } else {
      $("input[name='doors_not_closed_why']").removeClass("is-invalid");
    }

    if($("input[name='problems']:checked").val() == "Yes") {
      if($.trim($("input[name='yes_problems_explain']").val()) == "" ) {
        ret = false;
        $("input[name='yes_problems_explain']").addClass("is-invalid");
				$("input[name='yes_problems_explain']").parent().parent().siblings(":first").addClass("is-invalid");
      }
    } else {
      $("input[name='yes_problems_explain']").removeClass("is-invalid");
    }
    
    
    return ret;

}

			function submit_form(){
				
				/*var newDate = moment($('#datepicker').val(), "MM/DD/YYYY").format("YYYY-MM-DD");
				var start_time = convert_time($('#start_time').val());
				var end_time = convert_time($('#end_time').val());*/
				var today = new Date();
				var dd = String(today.getDate()).padStart(2, '0');
				var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
				var yyyy = today.getFullYear();

				today = mm + '/' + dd + '/' + yyyy;			


				//add confirm dialog here
				var postUrl = '<?php echo base_url('/forms/add_rerp') ?>';
        console.log(pData);
				if(checkRequired()){
					
					$.ajax({
						url: postUrl,
						type: 'POST',
						data: {
							"pData" : pData
						},
						datatype: 'json',
						success: function(response, textStatus, jqXHR) {
							//////////////////////////////////////////////////////
							console.log('Ajax Remove Card Response:', response);
							//////////////////////////////////////////////////////
							
              //window.location.href = "http://docaudit.dacco.org/success";
              var success_message = '<div class="container">' +
                '<div class="row justify-content-center">' +
                  '<div class="col-xl-5 col-lg-6 col-md-8">' +
                    '<div class="card o-hidden border-0 shadow-lg my-5">' +
                      '<div class="card-body p-0">' +
                        '<div class="row">' +
                          '<div class="col-lg-12">' +
                            '<div class="p-5">' +
                              '<div class="text-center">' +
                                '<h1 class="h4 text-gray-900 mb-4">Successfully Submitted</h1>' +
                                '<a href="https://covebh-portal.ascendwds.com/forms/rerp" class="w-100 btn btn-dark">Fill out another</a>' +
                              '</div>' +
                            '</div>' +
                          '</div>' +
                        '</div>' +
                      '</div>' +
                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>';

              $('body').html(success_message);

						},

					});
				} else {
					$.Notification.autoHideNotify('error', 'top right', 'You are missing some required fields.')
				}
				console.log(pdfData);
			}
			
function test(){
	$("input:radio").each(function(){
		if($(this).attr("value") == "YES")
			$(this).prop("checked", "checked");
	});

}	
</script>      
  </body>
</html>