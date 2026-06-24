<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    if($_SESSION["Role"] != "Manager" or $_SESSION["Role"] != "Staff"){
        header("Location: index.php");
    }
    #
?>

<head>

    <title>Booking Request</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/site.css" rel="stylesheet">

</head>

<body>


    <?php

    session_start();
    #fdg
    include_once("includes/navbar.php");
    include_once("connection.php");



    try {

        $stmt = $conn->prepare("SELECT * FROM tblcostcodes");
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor();


    } catch (PDOException $e) {

        echo "Error: " . $e->getMessage();

    }





    // DEBUG CHECK
    
    // echo "<pre>";
    
    // echo "Session Licensetodrive value:\n";
    
    // var_dump($_SESSION["Licensetodrive"] ?? "NOT FOUND");
    

    // echo "\n\nAll Session Data:\n";
    
    //print_r($_SESSION);
    

    //  echo "</pre>";
    





    // GET VEHICLE CAPACITY
    
    $maxcapacity = 0;


    $licence = trim(strtolower($_SESSION["Licensetodrive"] ?? ""));



    switch ($licence) {


        case "coach":

            $maxcapacity = 200;

            break;



        case "17 minibus":

            $maxcapacity = 17;

            break;



        case "9 seater":

            $maxcapacity = 9;

            break;

        case "None":
            $maxcapacity = 0;

            break;


    }




    // echo "<pre>";
    
    //  echo "Cleaned licence:\n";
    
    //  var_dump($licence);
    

    //  echo "\nMax capacity:\n";
    
    // var_dump($maxcapacity);
    

    // echo "</pre>";
    


    ?>





    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-7">



                <div class="card booking-card shadow-sm">



                    <div class="card-header card-header-custom">

                        New Booking Request

                    </div>





                    <div class="card-body">


                        <form action="insertbooking.php" method="POST">





                            <div class="mb-3">

                                <label class="form-label">
                                    Booking Start Date
                                </label>


                                <input type="date" name="bookingstartdate" class="form-control" required>


                            </div>





                            <div class="mb-3">

                                <label class="form-label">
                                    Booking End Date
                                </label>


                                <input type="date" name="bookingenddate" class="form-control" required>


                            </div>





                            <div class="mb-3">

                                <label class="form-label">
                                    Start Time
                                </label>


                                <input type="time" name="starttime" class="form-control" required>


                            </div>





                            <div class="mb-3">

                                <label class="form-label">
                                    End Time
                                </label>


                                <input type="time" name="endtime" class="form-control" required>


                            </div>





                            <div class="mb-3">

                                <label class="form-label">
                                    Capacity Required
                                </label>


                                <input type="number" name="capacityrequired" id="capacityrequired" class="form-control"
                                    min="1" required>


                            </div>





                            <div class="mb-3">

                                <label class="form-label">
                                    Destination
                                </label>


                                <input type="text" name="destination" class="form-control" required>


                            </div>






                            <div class="mb-4">

                                <label class="form-label">
                                    Cost Code
                                </label>



                                <select name="costcodeid" class="form-select" required>



                                    <?php foreach ($rows as $row): ?>


                                        <option value="<?php echo $row['Costcode']; ?>">


                                            <?php echo $row['Description'] . " - " . $row['Costcode']; ?>


                                        </option>



                                    <?php endforeach; ?>



                                </select>


                            </div>







                            <div class="mb-4">


                                <label class="form-label">
                                    Driver Required?
                                </label>



                                <div class="d-flex gap-3">



                                    <input type="radio" class="btn-check" name="driverrequired" id="driverYes"
                                        value="Yes" required>


                                    <label class="btn btn-outline-primary" for="driverYes">

                                        Yes - Driver Required

                                    </label>






                                    <input type="radio" class="btn-check" name="driverrequired" id="driverNo" value="No"
                                        required>



                                    <label class="btn btn-outline-success" for="driverNo" id="driverNoLabel">

                                        No - I will drive myself

                                    </label>



                                </div>




                                <small id="driveMessage" class="text-danger">
                                </small>



                            </div>







                            <div class="text-end">


                                <a href="index.php" class="btn btn-secondary">

                                    Cancel

                                </a>




                                <button type="submit" class="btn btn-success">

                                    Submit Booking Request

                                </button>



                            </div>





                        </form>



                    </div>


                </div>



            </div>


        </div>


    </div>

</body>

</html>