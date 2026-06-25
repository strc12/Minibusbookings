<?php

session_start();


if (!isset($_SESSION["Licensetodrive"])) {

    header("Location: login.php");
    exit();

}

//page does not work (came from job.php)

include_once("connection.php");



if (isset($_GET['id']) && isset($_SESSION["StaffID"])) {


    $bookingID = $_GET['id'];

    $driverID = $_SESSION["StaffID"];


    
    /*
    |--------------------------------------------------------------------------
    | Check vehicle has been allocated
    |--------------------------------------------------------------------------
    */


    $check = $conn->prepare("

        SELECT VehicleID

        FROM TblBookings

        WHERE BookingID = :BookingID

    ");



    $check->execute([

        ":BookingID" => $bookingID

    ]);



    $booking = $check->fetch(PDO::FETCH_ASSOC);



    if (!$booking || $booking['VehicleID'] == NULL) {


        echo "

        <script>

            alert('You cannot accept this job until a vehicle has been allocated.');

            window.location='jobs.php';

        </script>

        ";


        exit();

    }




    /*
    |--------------------------------------------------------------------------
    | Accept job
    |--------------------------------------------------------------------------
    */


    $stmt = $conn->prepare("
        
        INSERT INTO tbldriverjobs (BookingID, DriverID, AllocatedDriver)VALUES(:BookingID,:DriverID,NULL)
    ");



    $stmt->execute([


        ":DriverID" => $driverID,


        ":BookingID" => $bookingID


    ]);



}



header("Location: myjobs.php");

exit();


?>