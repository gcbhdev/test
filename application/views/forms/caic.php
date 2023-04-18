
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="JaVaun Joseph">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Complete Apartment Inspection Checklist</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="https://covebh-portal.ascendwds.com/assets/vendor/signature/jquery.signaturepad.css?v=1" rel="stylesheet">
    <link href="https://covebh-portal.ascendwds.com/assets/vendor/notifications/notification.css" rel="stylesheet">

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
      <h2>Complete Apartment Inspection Checklist</h2>
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
                    <option value="1">Women's Residential</option><option value="2">Men's Residential</option><option value="3">Community Housing</option><option value="4">Adult Outpatient</option><option value="5">Court Services</option><option value="6">Youth Services/Prevention</option><option value="7">Tampa MAT</option><option value="8">Lakeland</option><option value="9">Daycare</option><option value="10">Head Start</option><option value="11">Duplex</option><option value="12">Assessment & Referral</option><option value="13">Health Services</option><option value="14">Administration</option><option value="15">Medical Services</option><option value="16">Child Welfare</option>                  </select>
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
                    <th scope="col">Exterior</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Doors are undamaged</th>
                    <td><input class="form-check-input" type="radio" name="undmg_door" id="undmg_door_clear1" value="Yes"  ></td>
                    <td><input class="form-check-input" type="radio" name="undmg_door" id="undmg_door_clear2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="undmg_door" id="undmg_door_clear3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Doors can open and close with ease</th>
                    <td><input class="form-check-input" type="radio" name="door_open" id="door_open1" value="Yes"></td>
                    <td><input class="form-check-input" type="radio" name="door_open" id="door_open2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="door_open" id="door_open3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Windows are not cracked or torn</th>
                    <td><input class="form-check-input" type="radio" name="window_cracked" id="window_cracked1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="window_cracked" id="window_cracked2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="window_cracked" id="window_cracked3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Windows open and close with ease</th>
                    <td><input class="form-check-input" type="radio" name="window_open" id="window_open1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="window_open" id="window_open2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="window_open" id="window_open3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Locks all function and have proper keys</th>
                    <td><input class="form-check-input" type="radio" name="locks_have_keys" id="locks_have_keys1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="locks_have_keys" id="locks_have_keys2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="locks_have_keys" id="locks_have_keys3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Locks are present on all windows and doors</th>
                    <td><input class="form-check-input" type="radio" name="locks_present" id="locks_present1" value="Yes"></td>
                    <td><input class="form-check-input" type="radio" name="locks_present" id="locks_present2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="locks_present" id="locks_present3" value="NA" checked></td>
                  </tr>
                  <thead>
                  <tr>
                    <th scope="col">Interior:</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Check all outlets</th>
                    <td><input class="form-check-input" type="radio" name="check_all_outlets" id="check_all_outlets1" value="Yes"></td>
                    <td><input class="form-check-input" type="radio" name="check_all_outlets" id="check_all_outlets2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="check_all_outlets" id="check_all_outlets3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Run all faucets</th>
                    <td><input class="form-check-input" type="radio" name="run_faucets" id="run_faucets1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="run_faucets" id="run_faucets2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="run_faucets" id="run_faucets3" value="NA" checked></td>
                  </tr><tr>
                    <th scope="row">Flush all toilets</th>
                    <td><input class="form-check-input" type="radio" name="flush_toilets" id="flush_toilets1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="flush_toilets" id="flush_toilets2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="flush_toilets" id="flush_toilets3" value="NA" checked></td>
                  </tr><tr>
                    <th scope="row">Turn all appliances on and off</th>
                    <td><input class="form-check-input" type="radio" name="appliance_check" id="appliance_check1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="appliance_check" id="appliance_check2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="appliance_check" id="appliance_check3" value="NA" checked></td>
                  </tr><tr>
                    <th scope="row">Make sure fridge is cold</th>
                    <td><input class="form-check-input" type="radio" name="cold_fridge" id="cold_fridge1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="cold_fridge" id="cold_fridge2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="cold_fridge" id="cold_fridge3" value="NA" checked></td>
                  </tr><tr>
                    <th scope="row">Run A/C and heat</th>
                    <td><input class="form-check-input" type="radio" name="run_heat" id="run_heat1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="run_heat" id="run_heat2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="run_heat" id="run_heat3" value="NA" checked></td>
                  </tr><tr>
                    <th scope="row">Check filters on the HVAC unit(s)</th>
                    <td><input class="form-check-input" type="radio" name="check_filter" id="check_filter1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="check_filter" id="check_filter2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="check_filter" id="check_filter3" value="NA" checked></td>
                  </tr><tr>
                    <th scope="row">Check blinds for damage</th>
                    <td><input class="form-check-input" type="radio" name="check_blinds" id="check_blinds1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="check_blinds" id="check_blinds2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="check_blinds" id="check_blinds3" value="NA" checked></td>
                  </tr><tr>
                    <th scope="row">Check floors for scratches and carpet for
                        tears or bald spots</th>
                    <td><input class="form-check-input" type="radio" name="floor_scratches" id="floor_scratches1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="floor_scratches" id="floor_scratches2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="floor_scratches" id="floor_scratches3" value="NA" checked></td>
                  </tr><tr>
                    <th scope="row">Test washer and dryer</th>
                    <td><input class="form-check-input" type="radio" name="test_washer" id="test_washer1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="test_washer" id="test_washer2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="test_washer" id="test_washer3" value="NA" checked></td>
                  </tr>
                </tbody>

                <thead>
                  <tr>
                    <th scope="col">Safety + security</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Test the smoke detectors</th>
                    <td><input class="form-check-input" type="radio" name="test_smoke_detectors" id="test_smoke_detectors1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="test_smoke_detectors" id="test_smoke_detectors2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="test_smoke_detectors" id="test_smoke_detectors3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Test the carbon monoxide detector</th>
                    <td><input class="form-check-input" type="radio" name="test_co" id="test_co1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="test_co" id="test_co2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="test_co" id="test_co3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Make sure the security system is operational</th>
                    <td><input class="form-check-input" type="radio" name="test_operation" id="test_operation1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="test_operation" id="test_operation2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="test_operation" id="test_operation3" value="NA" checked></td>
                  </tr>
                </tbody>

                <thead>
                  <tr>
                    <th scope="col">Cleanliness</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Check bathrooms and kitchen for mold</th>
                    <td><input class="form-check-input" type="radio" name="bathroom_clean" id="bathroom_clean1" value="Yes"  ></td>
                    <td><input class="form-check-input" type="radio" name="bathroom_clean" id="bathroom_clean2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="bathroom_clean" id="bathroom_clean3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Look for cracks in walls or ceiling</th>
                    <td><input class="form-check-input" type="radio" name="ceiling_cracks" id="ceiling_cracks1" value="Yes"  ></td>
                    <td><input class="form-check-input" type="radio" name="ceiling_cracks" id="ceiling_cracks2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="ceiling_cracks" id="ceiling_cracks3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Check ceiling for water damage</th>
                    <td><input class="form-check-input" type="radio" name="ceiling_water_damage" id="ceiling_water_damage1" value="Yes"></td>
                    <td><input class="form-check-input" type="radio" name="ceiling_water_damage" id="ceiling_water_damage2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="ceiling_water_damage" id="ceiling_water_damage3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Check for weird smells</th>
                    <td><input class="form-check-input" type="radio" name="weird_smell" id="weird_smell1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="weird_smell" id="weird_smell2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="weird_smell" id="weird_smell3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Look for evidence of mice or bugs, but
                        understand that if you’re occupying a long-vacant
                        unit, a few bugs here and there are expected</th>
                    <td><input class="form-check-input" type="radio" name="mice_or_bugs" id="mice_or_bugs" value="Yes"  ></td>
                    <td><input class="form-check-input" type="radio" name="mice_or_bugs" id="mice_or_bugs" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="mice_or_bugs" id="mice_or_bugs" value="NA" checked></td>
                  </tr>
                 
                </tbody>
            <thead>
                  <tr>
                    <th scope="col">Common areas</th>
                    <th scope="col">Yes</th>
                    <th scope="col">No</th>
                    <th scope="col">NA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Check the building laundry room for defunct
                        machines</th>
                    <td><input class="form-check-input" type="radio" name="defunct_machines" id="defunct_machines1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="defunct_machines" id="defunct_machines2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="defunct_machines" id="defunct_machines3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">If assigned a parking space, make sure you
                        can access it and the pavement is in good
                        shape </th>
                    <td><input class="form-check-input" type="radio" name="parking_space" id="parking_spaced1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="parking_space" id="parking_space2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="parking_space" id="parking_space3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Examine the sidewalk for cracks</th>
                    <td><input class="form-check-input" type="radio" name="sidewalk_cracks" id="sidewalk_cracks1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="sidewalk_cracks" id="sidewalk_cracks2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="sidewalk_cracks" id="sidewalk_cracks3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">Make sure you can access your mailbox and
                        that your key works in your assigned box</th>
                    <td><input class="form-check-input" type="radio" name="mail_box_key" id="mail_box_key1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="mail_box_key" id="mail_box_key2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="mail_box_key" id="mail_box_key3" value="NA" checked></td>
                  </tr>
                  <tr>
                    <th scope="row">If your apartment requires entering through
                        a shared front door, make sure your key, fob,
                        or keycard works for that door.</th>
                    <td><input class="form-check-input" type="radio" name="door_fob" id="door_fob1" value="Yes" ></td>
                    <td><input class="form-check-input" type="radio" name="door_fob" id="door_fob2" value="No"></td>
                    <td><input class="form-check-input" type="radio" name="door_fob" id="door_fob3" value="NA" checked></td>
                  </tr>
                 
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
      <script src="https://covebh-portal.ascendwds.com/assets/vendor/signature/jquery.signaturepad.min.js"></script>
      <script src="https://covebh-portal.ascendwds.com/assets/vendor/signature/json2.min.js"></script>
      <script src="https://covebh-portal.ascendwds.com/assets/vendor/notifications/notify.min.js"></script>
      <script src="https://covebh-portal.ascendwds.com/assets/vendor/notifications/notify-metro.js"></script>
      
      
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
				var postUrl = 'https://covebh-portal.ascendwds.com/forms/add_ficr';

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
