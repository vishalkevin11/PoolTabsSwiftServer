<?php
    
    
    
    $conn = mysqli_connect('localhost', 'root', 'root', 'tavantpool');
    
    if (!$conn) {
        echo 'Could not connect to mysql';
        exit;
    }
    
    date_default_timezone_set("Asia/Kolkata");
    $date = date('Y/m/d h:i:s', time());


   $trip_path = isset($_POST['trip_path']) ? "'".$_POST['trip_path']."'" : "\"\"";
       $source_name =  isset($_POST['source_name']) ? "'".$_POST['source_name']."'" : "\"\"";
       $destination_name =  isset($_POST['destination_name']) ? "'".$_POST['destination_name']."'" : "\"\"";


        $source_lat =  isset($_POST['source_lat']) ? "".$_POST['source_lat']."" : 0.0;
        $source_lng =  isset($_POST['source_lng']) ? "".$_POST['source_lng']."" : 0.0;

        $destination_lat =  isset($_POST['destination_lat']) ? "".$_POST['destination_lat']."" : 0.0;
        $destination_lng =  isset($_POST['destination_lng']) ? "".$_POST['destination_lng']."" : 0.0;

        $time_leaving_source =  isset($_POST['time_leaving_source']) ? "'".$_POST['time_leaving_source']."'" : "\"\"";
        $time_leaving_destination =  isset($_POST['time_leaving_destination']) ? "'".$_POST['time_leaving_destination']."'" : "\"\"";
        $number_of_seats =  isset($_POST['number_of_seats']) ? "".$_POST['number_of_seats']."" : 0;
        $traveller_type =  isset($_POST['traveller_type']) ? "".$_POST['traveller_type']."" : 0;
        $trip_type =  isset($_POST['trip_type']) ? "".$_POST['trip_type']."" : 0;
       // $uniqueid_val        = $unixtime

        $total_trip_time            =  isset($_POST['total_trip_time']) ? "'".$_POST['total_trip_time']."'" : "\"\"";
        $total_trip_distance        =  isset($_POST['total_trip_distance']) ? "'".$_POST['total_trip_distance']."'" : "\"\"";
        $trip_via                   =  isset($_POST['trip_via']) ? "'".$_POST['trip_via']."'" : "\"\"";


        $uniqueid_val     = isset($_POST['uniqueid']) ? "".$_POST['uniqueid']."" : 0.0;
        $phonenumber_val     = isset($_POST['phone']) ? "'".$_POST['phone']."'" : "\"\"";
        $email_val           = isset($_POST['email']) ? "'".$_POST['email']."'" : "\"\"";
        $is_trip_live           = isset($_POST['is_trip_live']) ? "".$_POST['is_trip_live']."" : 0;



    
$sql = "UPDATE PoolTrip SET trip_path = ".$trip_path.",
                            source_name =".  $source_name.",
                            destination_name =".  $destination_name.",
                            source_lat =".  $source_lat.",
                            source_lng =".  $source_lng.",
                            destination_lat =".  $destination_lat.",
                            destination_lng =".  $destination_lng.",
                            time_leaving_source =".  $time_leaving_source.",
                            time_leaving_destination =".  $time_leaving_destination.",
                            number_of_seats =".  $number_of_seats.",
                            traveller_type =".  $traveller_type.",
                            trip_type =".  $trip_type.",
                            total_trip_time =".  $total_trip_time.",
                             total_trip_distance =".  $total_trip_distance.",
                              trip_via =".  $trip_via."
                        WHERE    
                            uniqueid_val           =". $uniqueid_val.";";


        
        if (mysqli_query($conn, $sql)) {
            echo "{";
            echo '"status_code" : 7347';
            echo "}";
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            unlink($target_path);
            echo "{";
            echo '"status_code" : 3477';
            echo "}";
            
        }

    mysqli_close($conn);
    ?>