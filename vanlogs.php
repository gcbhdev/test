<?php
    header("Access-Control-Allow-Origin: *");

    header("Access-Control-Allow-Methods: POST");

    header("Access-Control-Allow-Headers: X-Requested-With");

    $user_name = "app_vanlogs";
    $password = "fo7E}g.S@wr+x6?x=p8y2GxSjAj2.DO}";
    $server = "localhost";
    $db_name = "app_vanlogs";
    $response = array();
    $con = mysqli_connect($server, $user_name, $password, $db_name);
    if($con)
    {
        $id = $_POST['id'];
        $trip_date = $_POST['trip_date'];
        $trip_code = $_POST['trip_code'];
        $van_code = $_POST['van_number'];
        $driver_name = $_POST['driver_name'];
        $program = $_POST['program'];
        $no_of_patients = $_POST['no_of_patients'];

        $query = 'INSERT INTO van_logs VALUES('.$id.', "'.$trip_date.'", '.$trip_code.', '.$van_code.', "'.$driver_name.'", '.$program.', '.$no_of_patients.');';
        $results = mysqli_query($con, $query);
        $responce = array();

        if($results)
        {
            $status = 'OK';
        } else 
        {
            $status = 'FAILED';
        }
    } else
    {
        $status = 'FAILED';
    }

    echo json_encode(array("response"=>$status));

    mysqli_close($con);
?>