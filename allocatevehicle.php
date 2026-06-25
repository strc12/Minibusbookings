<?php

session_start();
if ($_SESSION["Role"] != "Manager") {
    header("Location: index.php");
}


include_once("connection.php");



if (!isset($_GET['id'])) {

    header("Location: jobs.php");
    exit();

}



$bookingID = $_GET['id'];



/*
|--------------------------------------------------------------------------
| Get booking details
|--------------------------------------------------------------------------
*/


$stmt = $conn->prepare("

    SELECT *

    FROM TblBookings

    WHERE BookingID = :BookingID

");



$stmt->execute([

    ":BookingID" => $bookingID

]);



$booking = $stmt->fetch(PDO::FETCH_ASSOC);



if (!$booking) {

    header("Location: jobs.php");
    exit();

}



/*
|--------------------------------------------------------------------------
| Find available vehicles
|--------------------------------------------------------------------------
*/


$stmt2 = $conn->prepare("

    SELECT *

    FROM TblVehicles v



    WHERE v.Status = 'Available'


    AND v.Capacity >= :CapacityRequired



    AND v.VehicleID NOT IN (


        SELECT b.VehicleID

        FROM TblBookings b



        WHERE b.VehicleID IS NOT NULL



        AND b.BookingID <> :BookingID



        AND b.Status IN ('Pending','Accepted')



        AND CONCAT(

            b.Bookingstartdate,

            ' ',

            b.StartTime

        )

        <

        CONCAT(

            :BookingEndDate,

            ' ',

            ADDTIME(:EndTime,'02:00:00')

        )



        AND CONCAT(

            b.Bookingenddate,

            ' ',

            b.EndTime

        )

        >

        CONCAT(

            :BookingStartDate,

            ' ',

            SUBTIME(:StartTime,'02:00:00')

        )


    )



    ORDER BY v.Capacity ASC

");



$stmt2->execute([


    ":CapacityRequired" => $booking['Capacityrequired'],

    ":BookingID" => $booking['BookingID'],

    ":BookingStartDate" => $booking['Bookingstartdate'],

    ":BookingEndDate" => $booking['Bookingenddate'],

    ":StartTime" => $booking['StartTime'],

    ":EndTime" => $booking['EndTime']


]);



$vehicles = $stmt2->fetchAll(PDO::FETCH_ASSOC);



?>



<!DOCTYPE html>

<html lang="en">


<head>


    <title>Allocate Vehicle</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/site.css" rel="stylesheet">


</head>



<body>



    <?php include_once("includes/navbar.php"); ?>




    <div class="container mt-5">


        <div class="row justify-content-center">


            <div class="col-md-8 col-lg-6">


                <div class="card booking-card shadow-sm">



                    <div class="card-header card-header-custom">

                        Allocate Vehicle

                    </div>



                    <div class="card-body">



                        <p>

                            <strong>Destination:</strong>

                            <?php echo htmlspecialchars($booking['Destination']); ?>

                        </p>



                        <p>

                            <strong>Date:</strong>

                            <?php echo htmlspecialchars($booking['Bookingstartdate']); ?>

                            -

                            <?php echo htmlspecialchars($booking['Bookingenddate']); ?>

                        </p>



                        <p>

                            <strong>Time:</strong>

                            <?php echo htmlspecialchars($booking['StartTime']); ?>

                            -

                            <?php echo htmlspecialchars($booking['EndTime']); ?>

                        </p>



                        <p>

                            <strong>Capacity Required:</strong>

                            <?php echo htmlspecialchars($booking['Capacityrequired']); ?>

                        </p>




                        <p class="text-muted">

                            Vehicle availability includes a 2 hour buffer before and after bookings.

                        </p>




                        <?php if (count($vehicles) == 0): ?>


                            <div class="alert alert-danger">

                                No vehicles available for this booking period.

                            </div>



                            <div class="text-end">


                                <a href="jobs.php" class="btn btn-secondary">

                                    Back

                                </a>


                            </div>



                        <?php else: ?>




                            <form action="savevehicleallocation.php" method="POST">



                                <input type="hidden" name="bookingid" value="<?php echo $booking['BookingID']; ?>">




                                <div class="mb-3">


                                    <label class="form-label">

                                        Choose Vehicle

                                    </label>




                                    <select name="vehicleid" class="form-select" required>



                                        <option value="">

                                            -- Select Vehicle --

                                        </option>




                                        <?php foreach ($vehicles as $vehicle): ?>



                                            <option value="<?php echo $vehicle['VehicleID']; ?>">


                                                <?php echo htmlspecialchars($vehicle['Make']); ?>

                                                <?php echo htmlspecialchars($vehicle['Model']); ?>

                                                -

                                                <?php echo htmlspecialchars($vehicle['Registration']); ?>

                                                -

                                                <?php echo htmlspecialchars($vehicle['Capacity']); ?>

                                                seats



                                            </option>



                                        <?php endforeach; ?>



                                    </select>


                                </div>


                                <div class="mb-3">

                                    <label class="form-label">
                                        Key Location
                                    </label>

                                <select name="keylocation" class="form-select" required>

                                    <option value="">
                                        TBD
                                    </option>

                                    <option value="Staff Pigeon Hole">Staff Pigeon Hole</option>
                                    <option value="Porter Pigeon Hole">Porter Pigeon Hole</option>
                                    <option value="Armoury">Armoury</option>

    </select>

</div>


                                <div class="text-end">



                                    <a href="jobs.php" class="btn btn-secondary">

                                        Cancel

                                    </a>




                                    <button type="submit" class="btn btn-success">

                                        Allocate Vehicle

                                    </button>



                                </div>




                            </form>



                        <?php endif; ?>




                    </div>



                </div>



            </div>



        </div>



    </div>



</body>


</html>