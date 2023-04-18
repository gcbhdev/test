<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="JaVaun Joseph">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Facility Inspection Report</title>

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
    </style>

    
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <!--<img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
      <h2>FACILITY INSPECTION REPORT</h2>
      <!--<p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>-->
    </div>


        <form class="needs-validation" novalidate>
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <label class="form-label">Facility</label>
                  <select class="form-select" name="facility" required>
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
                    Please select a valid facility.
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
              <label class="form-label">Date</label>
              <input type="text" id="datepicker" name="event_date" class="form-control">
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
              <p><strong>Instructions:</strong> Check each item below as "Yes", "No" or "NA" (not applicable). For each item that is checked as "No", please provide details and submit recommdations to correct the condition or unsafe practice.</p>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">General Office Area</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Exit Door Clear</th>
                    <td><input class="form-check-input" type="radio" name="exit_door_clear" id="exit_door_clear1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="exit_door_clear" id="exit_door_clear2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="exit_door_clear" id="exit_door_clear3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Exit Signs Visible and Light Working Properly</th>
                    <td><input class="form-check-input" type="radio" name="exit_signs_visible" id="exit_signs_visible1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="exit_signs_visible" id="exit_signs_visible2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="exit_signs_visible" id="exit_signs_visible3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Fire Extinguishers Accessible and In Proper Working Order </th>
                    <td><input class="form-check-input" type="radio" name="fire_ext_access" id="fire_ext_access1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="fire_ext_access" id="fire_ext_access2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="fire_ext_access" id="fire_ext_access3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Fire/Emergency Evacuation Procedures Prominently Posted	</th>
                    <td><input class="form-check-input" type="radio" name="procedures_posted" id="procedures_posted1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="procedures_posted" id="procedures_posted2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="procedures_posted" id="procedures_posted3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Smoke Alarms in Good Working Condition</th>
                    <td><input class="form-check-input" type="radio" name="smoke_alarms" id="smoke_alarms1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="smoke_alarms" id="smoke_alarms2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="smoke_alarms" id="smoke_alarms3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Building Interior Generally Clean and Neat	</th>
                    <td><input class="form-check-input" type="radio" name="building_interior_clean" id="building_interior_clean1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="building_interior_clean" id="building_interior_clean2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="building_interior_clean" id="building_interior_clean3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Floors Dry</th>
                    <td><input class="form-check-input" type="radio" name="building_floors_dry" id="building_floors_dry1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="building_floors_dry" id="building_floors_dry2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="building_floors_dry" id="building_floors_dry3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Aisles have 3-Foot Clearance </th>
                    <td><input class="form-check-input" type="radio" name="aisles_clear" id="aisles_clear1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="aisles_clear" id="aisles_clear2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="aisles_clear" id="aisles_clear3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Carpet Even and Undamaged</th>
                    <td><input class="form-check-input" type="radio" name="building_carpet" id="building_carpet1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="building_carpet" id="building_carpet2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="building_carpet" id="building_carpet3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Electrical Outlets appropriately covered and in Good Condition, Not overloaded, and prongs in place</th>
                    <td><input class="form-check-input" type="radio" name="outlets" id="outlets" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="outlets" id="outlets" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="outlets" id="outlets" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Walkways are Free of Electrical Cords</th>
                    <td><input class="form-check-input" type="radio" name="walkways" id="walkways1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="walkways" id="walkways2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="walkways" id="walkways3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">No Regular Extension Cords Being Used</th>
                    <td><input class="form-check-input" type="radio" name="extension_cords" id="extension_cords1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="extension_cords" id="extension_cords2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="extension_cords" id="extension_cords3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Back Entrance Doors Locked</th>
                    <td><input class="form-check-input" type="radio" name="back_entrance_locked" id="back_entrance_locked1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="back_entrance_locked" id="back_entrance_locked2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="back_entrance_locked" id="back_entrance_locked3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Door Mats/Non-Slip Mats Properly Placed </th>
                    <td><input class="form-check-input" type="radio" name="door_mats" id="door_mats1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="door_mats" id="door_mats2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="door_mats" id="door_mats3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Stairwells Clear and Free Of Debris</th>
                    <td><input class="form-check-input" type="radio" name="stairwells" id="stairwells1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="stairwells" id="stairwells2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="stairwells" id="stairwells3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Stair/Step Treads Not Slippery/Non Slippery Coverings </th>
                    <td><input class="form-check-input" type="radio" name="stairs_steps_nonslip" id="stairs_steps_nonslip1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="stairs_steps_nonslip" id="stairs_steps_nonslip2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="stairs_steps_nonslip" id="stairs_steps_nonslip3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Spill Kit Adequately Supplied (see page 4 for kit contents)</th>
                    <td><input class="form-check-input" type="radio" name="spill_kit_supplied" id="spill_kit_supplied1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="spill_kit_supplied" id="spill_kit_supplied2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="spill_kit_supplied" id="spill_kit_supplied3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Spill Kit Accessible to Employees</th>
                    <td><input class="form-check-input" type="radio" name="spill_kit_accessible" id="spill_kit_accessible1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="spill_kit_accessible" id="spill_kit_accessible2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="spill_kit_accessible" id="spill_kit_accessible3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">First Aid Kit Adequately Supplied (see page 4 for kit contents)</th>
                    <td><input class="form-check-input" type="radio" name="first_aid_kit_supplied" id="first_aid_kit_supplied1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="first_aid_kit_supplied" id="first_aid_kit_supplied2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="first_aid_kit_supplied" id="first_aid_kit_supplied3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">First Aid Kit Accessible to Employees</th>
                    <td><input class="form-check-input" type="radio" name="first_aid_kit_accessible" id="first_aid_kit_accessible1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="first_aid_kit_accessible" id="first_aid_kit_accessible2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="first_aid_kit_accessible" id="first_aid_kit_accessible3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">First Aid Procedures Posted</th>
                    <td><input class="form-check-input" type="radio" name="first_aid_procedures_posted" id="first_aid_procedures_posted1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="first_aid_procedures_posted" id="first_aid_procedures_posted2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="first_aid_procedures_posted" id="first_aid_procedures_posted3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Vent Areas Clear and Free of Obstructions</th>
                    <td><input class="form-check-input" type="radio" name="vents_clear" id="vents_clear1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="vents_clear" id="vents_clear2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="vents_clear" id="vents_clear3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Air Vent Filters Properly Cleaned and/or Replaced </th>
                    <td><input class="form-check-input" type="radio" name="vent_filters_clean" id="vent_filters_clean1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="vent_filters_clean" id="vent_filters_clean2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="vent_filters_clean" id="vent_filters_clean3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Conference Room Furniture in Good Working Condition</th>
                    <td><input class="form-check-input" type="radio" name="conf_room_furn_good" id="conf_room_furn_good1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="conf_room_furn_good" id="conf_room_furn_good2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="conf_room_furn_good" id="conf_room_furn_good3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Conference Areas Walkways Are Free of Chairs</th>
                    <td><input class="form-check-input" type="radio" name="conf_area_walkways_free" id="conf_area_walkways_free1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="conf_area_walkways_free" id="conf_area_walkways_free2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="conf_area_walkways_free" id="conf_area_walkways_free3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Temperature Logs on Medication Refrigerators Completed Daily</th>
                    <td><input class="form-check-input" type="radio" name="temperature_logs_completed" id="temperature_logs_completed1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="temperature_logs_completed" id="temperature_logs_completed2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="temperature_logs_completed" id="temperature_logs_completed3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Furniture is Clean and In Good Repair</th>
                    <td><input class="form-check-input" type="radio" name="furniture_clean" id="furniture_clean1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="furniture_clean" id="furniture_clean2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="furniture_clean" id="furniture_clean3" value="NA"></td>
                  </tr>
                </tbody>

                <thead>
                  <tr>
                    <th scope="col">Restrooms</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Shower Curtains (where applicable) present/working</th>
                    <td><input class="form-check-input" type="radio" name="shower_curtains" id="shower_curtains1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="shower_curtains" id="shower_curtains2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="shower_curtains" id="shower_curtains3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Generally Clean and Free of Graffiti</th>
                    <td><input class="form-check-input" type="radio" name="clean_and_graffiti_free" id="clean_and_graffiti_free1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="clean_and_graffiti_free" id="clean_and_graffiti_free2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="clean_and_graffiti_free" id="clean_and_graffiti_free3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Appropriate Hand Washing Supplies Available</th>
                    <td><input class="form-check-input" type="radio" name="hand_wash_supplies" id="hand_wash_supplies1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="hand_wash_supplies" id="hand_wash_supplies2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="hand_wash_supplies" id="hand_wash_supplies3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Adequately Stocked with Paper Products (Hand Towels, Toilet Paper, Etc.) </th>
                    <td><input class="form-check-input" type="radio" name="paper_products_stocked" id="paper_products_stocked1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="paper_products_stocked" id="paper_products_stocked2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="paper_products_stocked" id="paper_products_stocked3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Plumbing in Proper Working Condition (check for leaks, broken handles, etc)</th>
                    <td><input class="form-check-input" type="radio" name="plumbing" id="plumbing1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="plumbing" id="plumbing2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="plumbing" id="plumbing3" value="NA"></td>
                  </tr>
                </tbody>

                <thead>
                  <tr>
                    <th scope="col">Storage Areas</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">No Boxes Stacked to Unstable Level</th>
                    <td><input class="form-check-input" type="radio" name="boxes_not_stacked" id="boxes_not_stacked1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="boxes_not_stacked" id="boxes_not_stacked2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="boxes_not_stacked" id="boxes_not_stacked3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">File Drawers Closed when Not in Use </th>
                    <td><input class="form-check-input" type="radio" name="file_draws_closed" id="file_draws_closed1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="file_draws_closed" id="file_draws_closed2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="file_draws_closed" id="file_draws_closed3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Closets Uncluttered </th>
                    <td><input class="form-check-input" type="radio" name="closet_uncluttered" id="closet_uncluttered1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="closet_uncluttered" id="closet_uncluttered2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="closet_uncluttered" id="closet_uncluttered3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Cabinet Tops Free of Loose Material that Could Fall </th>
                    <td><input class="form-check-input" type="radio" name="cabinet_tops_free" id="cabinet_tops_free1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="cabinet_tops_free" id="cabinet_tops_free2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="cabinet_tops_free" id="cabinet_tops_free3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Storage Level 18” Below Ceiling</th>
                    <td><input class="form-check-input" type="radio" name="storage_level" id="storage_level1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="storage_level" id="storage_level2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="storage_level" id="storage_level3" value="NA"></td>
                  </tr>
                </tbody>

                <thead>
                  <tr>
                    <th scope="col">Individual Work Areas/Offices </th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Office Interiors Generally Neat and Clean</th>
                    <td><input class="form-check-input" type="radio" name="office_interior_clean" id="office_interior_clean1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="office_interior_clean" id="office_interior_clean2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="office_interior_clean" id="office_interior_clean3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Office Floors Clear of Paper Clips, Staples, Small Objects </th>
                    <td><input class="form-check-input" type="radio" name="floors_clear" id="floors_clear1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="floors_clear" id="floors_clear2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="floors_clear" id="floors_clear3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Office Furniture in Good Working Condition</th>
                    <td><input class="form-check-input" type="radio" name="office_furniture_good" id="office_furniture_good1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="office_furniture_good" id="office_furniture_good2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="office_furniture_good" id="office_furniture_good3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Desk and Chair Mats Free of Upturned Edges</th>
                    <td><input class="form-check-input" type="radio" name="desk_and_chair_mats" id="desk_and_chair_mats1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="desk_and_chair_mats" id="desk_and_chair_mats2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="desk_and_chair_mats" id="desk_and_chair_mats3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Shelves Not Overloaded</th>
                    <td><input class="form-check-input" type="radio" name="shelved_not_overloaded" id="shelved_not_overloaded1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="shelved_not_overloaded" id="shelved_not_overloaded2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="shelved_not_overloaded" id="shelved_not_overloaded3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Floors are Dry </th>
                    <td><input class="form-check-input" type="radio" name="office_floors_dry" id="office_floors_dry1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="office_floors_dry" id="office_floors_dry2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="office_floors_dry" id="office_floors_dry3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Carpet Even and Undamaged </th>
                    <td><input class="form-check-input" type="radio" name="office_carpet" id="office_carpet1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="office_carpet" id="office_carpet2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="office_carpet" id="office_carpet3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">No Unstable Stacks of Boxes/ Books/ Manuals, Etc.	</th>
                    <td><input class="form-check-input" type="radio" name="office_boxes_not_stacked" id="office_boxes_not_stacked1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="office_boxes_not_stacked" id="office_boxes_not_stacked2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="office_boxes_not_stacked" id="office_boxes_not_stacked3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Cabinet Tops Free of Materials That Could Fall</th>
                    <td><input class="form-check-input" type="radio" name="office_cabinet_tops_free" id="office_cabinet_tops_free1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="office_cabinet_tops_free" id="office_cabinet_tops_free2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="office_cabinet_tops_free" id="office_cabinet_tops_free3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">File/Desk Drawers Closed When Not in Use	</th>
                    <td><input class="form-check-input" type="radio" name="office_file_draws_closed" id="office_file_draws_closed1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="office_file_draws_closed" id="office_file_draws_closed2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="office_file_draws_closed" id="office_file_draws_closed3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Electrical Outlets Appropriately Covered and in Good Condition and not overloaded (no prongs broken off in outlet)</th>
                    <td><input class="form-check-input" type="radio" name="office_outlets" id="office_outlets1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="office_outlets" id="office_outlets2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="office_outlets" id="office_outlets3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Walkways are Free of Electrical Cords</th>
                    <td><input class="form-check-input" type="radio" name="office_walkways" id="office_walkways1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="office_walkways" id="office_walkways2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="office_walkways" id="office_walkways3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">No Regular Extension Cords Being Used</th>
                    <td><input class="form-check-input" type="radio" name="office_extension_cords" id="office_extension_cords1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="office_extension_cords" id="office_extension_cords2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="office_extension_cords" id="office_extension_cords3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">No Personal Space Heaters in Offices</th>
                    <td><input class="form-check-input" type="radio" name="no_personal_heaters" id="no_personal_heaters1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="no_personal_heaters" id="no_personal_heaters2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="no_personal_heaters" id="no_personal_heaters3" value="NA"></td>
                  </tr>
                </tbody>

                <thead>
                  <tr>
                    <th scope="col">Security</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Monitor/Screen Cannot be Read from Short Distance</th>
                    <td><input class="form-check-input" type="radio" name="monitor_not_visible" id="monitor_not_visible1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="monitor_not_visible" id="monitor_not_visible2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="monitor_not_visible" id="monitor_not_visible3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Computer Screen Locked when Staff not at Computer</th>
                    <td><input class="form-check-input" type="radio" name="screen_locked" id="screen_locked1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="screen_locked" id="screen_locked2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="screen_locked" id="screen_locked3" value="NA"></td>
                  </tr>
                </tbody>

                <thead>
                  <tr>
                    <th scope="col">Food Preparation Areas/Break rooms</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Countertops and Floors are Generally Clean and Free of Grease and Water</th>
                    <td><input class="form-check-input" type="radio" name="countertops" id="countertops1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="countertops" id="countertops2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="countertops" id="countertops3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">All Equipment Properly Maintained </th>
                    <td><input class="form-check-input" type="radio" name="equipment_maintained" id="equipment_maintained1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="equipment_maintained" id="equipment_maintained2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="equipment_maintained" id="equipment_maintained3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Refrigerator Clean and in Proper Working Condition</th>
                    <td><input class="form-check-input" type="radio" name="refrigerator" id="refrigerator1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="refrigerator" id="refrigerator2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="refrigerator" id="refrigerator3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Temperature Logs on Client Food Refrigerators Completed Daily</th>
                    <td><input class="form-check-input" type="radio" name="client_food" id="client_food1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="client_food" id="client_food2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="client_food" id="client_food3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Cupboard Doors Closed After Each Use</th>
                    <td><input class="form-check-input" type="radio" name="cupboards_closed" id="cupboards_closed1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="cupboards_closed" id="cupboards_closed2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="cupboards_closed" id="cupboards_closed3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Coffee Maker Clean and in Proper Working Condition</th>
                    <td><input class="form-check-input" type="radio" name="coffee_maker" id="coffee_maker1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="coffee_maker" id="coffee_maker2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="coffee_maker" id="coffee_maker3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Microwave/Toaster Oven Clean and in Proper Working Condition</th>
                    <td><input class="form-check-input" type="radio" name="microwave" id="microwave1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="microwave" id="microwave2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="microwave" id="microwave3" value="NA"></td>
                  </tr>
                </tbody>

                <thead>
                  <tr>
                    <th scope="col">Outdoor Areas</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Free of Litter/Debris/Hazardous Waste Materials </th>
                    <td><input class="form-check-input" type="radio" name="free_of_litter" id="free_of_litter1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="free_of_litter" id="free_of_litter2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="free_of_litter" id="free_of_litter3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Walkways, Steps and Patios in Good Condition</th>
                    <td><input class="form-check-input" type="radio" name="walkways_steps_patios" id="walkways_steps_patios1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="walkways_steps_patios" id="walkways_steps_patios2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="walkways_steps_patios" id="walkways_steps_patios3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Adequate Outdoor Lighting in Parking and Entrance Areas</th>
                    <td><input class="form-check-input" type="radio" name="adequate_outdoor_lighting" id="adequate_outdoor_lighting1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="adequate_outdoor_lighting" id="adequate_outdoor_lighting2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="adequate_outdoor_lighting" id="adequate_outdoor_lighting3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Parking Lots in Good Condition</th>
                    <td><input class="form-check-input" type="radio" name="parking_lot" id="parking_lot1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="parking_lot" id="parking_lot2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="parking_lot" id="parking_lot3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">No Downed or Exposed Wires/Power Lines</th>
                    <td><input class="form-check-input" type="radio" name="no_downed_power_lines" id="no_downed_power_lines1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="no_downed_power_lines" id="no_downed_power_lines2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="no_downed_power_lines" id="no_downed_power_lines3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">No Broken or Burned Out Light Bulbs/Fixtures</th>
                    <td><input class="form-check-input" type="radio" name="no_broken_bulbs" id="no_broken_bulbs1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="no_broken_bulbs" id="no_broken_bulbs2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="no_broken_bulbs" id="no_broken_bulbs3" value="NA"></td>
                  </tr>
                </tbody>

                <thead>
                  <tr>
                    <th scope="col">Dorm Areas</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Dorms are Clean</th>
                    <td><input class="form-check-input" type="radio" name="dorms_clean" id="dorms_clean1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="dorms_clean" id="dorms_clean2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="dorms_clean" id="dorms_clean3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Dorms are Neat</th>
                    <td><input class="form-check-input" type="radio" name="dorms_neat" id="dorms_neat1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="dorms_neat" id="dorms_neat2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="dorms_neat" id="dorms_neat3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">Personal Belongings are contained within Available Storage</th>
                    <td><input class="form-check-input" type="radio" name="personal_belongings" id="personal_belongings1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="personal_belongings" id="personal_belongings2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="personal_belongings" id="personal_belongings3" value="NA"></td>
                  </tr>
                  <tr>
                    <th scope="row">No Sign of Contraband in Dorm Areas (Food, Cleaning Supplies, etc)</th>
                    <td><input class="form-check-input" type="radio" name="no_contraband" id="no_contraband1" value="Yes" checked></td>
                    <td><input class="form-check-input" type="radio" name="no_contraband" id="no_contraband2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="no_contraband" id="no_contraband3" value="NA"></td>
                  </tr>
                </tbody>
              </table>           
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-body">   
              <label class="form-label">Please explain and give details for any area rated as “No”. </label>
              <textarea class="form-control not-required" name="details1"></textarea>  
              <hr>
              <label class="form-label">Describe any other unsatisfactory conditions or unsafe practices you observed that were not covered in the Checklist.</label>
              <textarea class="form-control not-required" name="details2"></textarea>           
            </div>
          </div> 
          
          <div class="card mb-3">
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Min Quantity</th>
                    <th scope="col">Current Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Control Gown (Size Large)</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="control_gown"></td>
                  </tr>
                  <tr>
                    <th scope="row">Fluid-Resistant Mask with Eye/Face Shield</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="fluid_resistant_mask"></td>
                  </tr>
                  <tr>
                    <th scope="row">Nitrile Exam Gloves</th>
                    <td>2 pairs</td>
                    <td><input class="form-control" type="number" name="nitrile_exam_gloves"></td>
                  </tr>
                  <tr>
                    <th scope="row">Antimicrobial Hand Wipes</th>
                    <td>8</td>
                    <td><input class="form-control" type="number" name="antimicrobial_hand_wipes"></td>
                  </tr>
                  <tr>
                    <th scope="row">Red Biohazard Bag with Tie</th>
                    <td>2</td>
                    <td><input class="form-control" type="number" name="biohazard_bag"></td>
                  </tr>
                  <tr>
                    <th scope="row">Bouffant Cap</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="bouffant_cap"></td>
                  </tr>
                  <tr>
                    <th scope="row">Fluid Solidifier Packet (2 oz.)</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="fluid_solidifier_packet"></td>
                  </tr>
                  <tr>
                    <th scope="row">Disinfectant Spray (2 oz.)</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="disinfectant_spray"></td>
                  </tr>
                  <tr>
                    <th scope="row">Pick-Up Scoop with Scraper</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="scoop_with_scraper"></td>
                  </tr>
                  <tr>
                    <th scope="row">Paper Towels</th>
                    <td>10</td>
                    <td><input class="form-control" type="number" name="paper_towel"></td>
                  </tr>
                  <tr>
                    <th scope="row">Disposal Bag with Tie (for Non-Infectious Waste)</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="disposal_bag"></td>
                  </tr>
                </tbody>
              </table>         
            </div>
          </div>    
          
          <div class="card mb-3">
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Min Quantity</th>
                    <th scope="col">Current Quantity</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Absorbent compress with no side smaller than 4 inches</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="absorbent_compress"></td>
                  </tr>
                  <tr>
                    <th scope="row">Adhesive Bandages - 1 in x 3 in</th>
                    <td>16</td>
                    <td><input class="form-control" type="number" name="adhesive_bandages"></td>
                  </tr>
                  <tr>
                    <th scope="row">Adhesive Tape 3/8 in x 2.5 yds</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="adhesive_tape"></td>
                  </tr>
                  <tr>
                    <th scope="row">Antibiotic Treatment = 0.14 oz</th>
                    <td>6</td>
                    <td><input class="form-control" type="number" name="antibiotic_treatment"></td>
                  </tr>
                  <tr>
                    <th scope="row">Antiseptic swabs, wipes, or towelettes (spray containers 0.14 oz)</th>
                    <td>10</td>
                    <td><input class="form-control" type="number" name="antiseptic_swabs"></td>
                  </tr>
                  <tr>
                    <th scope="row">Bandage Compress 2 in x  2 in</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="bandage_compress_2"></td>
                  </tr>
                  <tr>
                    <th scope="row">Bandage Compress 3 in x  3 in</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="bandage_compress_3"></td>
                  </tr>
                  <tr>
                    <th scope="row">Bandage Compress 4 in x  4 in</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="bandage_compress_4"></td>
                  </tr>
                  <tr>
                    <th scope="row">Breathing Barrier for CPR</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="breathing_barrier"></td>
                  </tr>
                  <tr>
                    <th scope="row">Burn Treatment 1/32 oz application</th>
                    <td>6</td>
                    <td><input class="form-control" type="number" name="burn_treatment"></td>
                  </tr>
                  <tr>
                    <th scope="row">First Aid Guide</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="first_aid_guide"></td>
                  </tr>
                  <tr>
                    <th scope="row">Medical Exam Gloves</th>
                    <td>2 pairs</td>
                    <td><input class="form-control" type="number" name="medical_exam_glove"></td>
                  </tr>
                  <tr>
                    <th scope="row">Roller Bandage at least 2 in wide x 4 yd long</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="roller_bandage"></td>
                  </tr>
                  <tr>
                    <th scope="row">Sterile Pads 3 in x 3 in</th>
                    <td>4</td>
                    <td><input class="form-control" type="number" name="sterile_pads"></td>
                  </tr>
                  <tr>
                    <th scope="row">Triangular bandage 40 in x 40 in x 56 in</th>
                    <td>1</td>
                    <td><input class="form-control" type="number" name="triangular_bandage"></td>
                  </tr>
                </tbody>
              </table>         
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

          <button class="w-100 btn btn-dark btn-lg" type="button" onclick="submit_form();">Submit</button>
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
var countNo = 0;

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

      $(document).on('focusin', '.custom-control-input, .custom-control-label, input', function() {
        var name_ = $(this).attr("name");
        $("input[name='" + name_ + "']").removeClass("is-invalid");
        $("textarea[name='" + name_ + "']").removeClass("is-invalid");
        if($(this).is(":radio"))
          $(this).parent().parent().siblings(":first").removeClass("is-invalid");
      });
	

});

function checkRequired(){
    
    var ret = true;
	var currentName = "";
	pData = {};
  pdfData = [];
  countNo = 0;
	
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

    $("input[type=number]").each(function(){
		var name_ = $(this).attr("name");
		
		
        if(!$(this).hasClass("not-required") && $.trim($(this).val()) == "" )
        {
            ret = false;
            //ADD ERROR MESSAGE TO FORCE TEXT
			$(this).addClass("is-invalid");
           
        }
		if (name_ == 'event_date' || name_ == 'event_date') {
			pData[name_] = moment($(this).val(), "MM/DD/YYYY").format("YYYY-MM-DD");
		} else {
			pData[name_] = $("input[name='" + name_ + "']").val();
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
		if($("input[name='" + name_ + "']:checked").val() == "No"){
			countNo += 1;
		}
		
    });
    
    
    if(countNo > 0) {
      if($.trim($("textarea[name='details1']").val()) == "" ) {
        ret = false;
        $("textarea[name='details1']").addClass("is-invalid");
				$("textarea[name='details1']").parent().parent().siblings(":first").addClass("is-invalid");
      }
    } else {
      $("textarea[name='details1']").removeClass("is-invalid");
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
        
        //pData['signature'] = signature.getSignatureImage();


				today = mm + '/' + dd + '/' + yyyy;			


				//add confirm dialog here
				var postUrl = '<?php echo base_url('/forms/add_ficr') ?>';

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
                                '<a href="https://covebh-portal.ascendwds.com/forms/ficr" class="w-100 btn btn-dark">Fill out another</a>' +
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
