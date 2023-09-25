<?php
    session_start();
    if(isset($_SESSION["staffID"])){
        include("conn.php");
    }else {
        echo "<script>alert('Please Login!');window.location.href='StaffLogin.php';</script>";
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Manage Appointment</title>
        <link rel="icon" href="images/Dog_Cat_Logo.png" type="image/jpg" sizes="50x50">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">

        <style>
            nav{
                box-shadow: 0 0.4rem 1.4rem rgb(0 0 0 / 11%);
            }
            .d-flex{
                width: 300px;
            }
            .nav-item{
                padding: 5px;
            }
            .flex-center{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .navbar-brand{
                margin-left: 20px;
                padding: 0%;
                padding-bottom: 0%;
                margin-right: 0%;
            }
            .navbar-nav {
                margin-left: auto;
            }
            form[role="search"] {
                margin-right: auto;
            }
            .container{
                width: 80px;
            }

            body {
                margin: auto;
                background-image: url(images/background.png);
            }

            p{
                text-align: center;
                margin-top: 40px;
                font-family: 'Play', sans-serif;
                font-size: 24px;
            }

            table{
                border: solid;
            }

            table,th,td {
                border-collapse: collapse;
                margin: auto;
                font-size: 20px;
                text-align: left;
                padding: 15px;
                font-family:'Play', sans-serif;
                
            }
            th {
                background-color: #876445;
                color: white;
                border-bottom: solid black;
            }
            
            td{
                border-bottom: 1px solid;
            }
            tbody tr:nth-child(odd) {
                background: #EDDFB3;
            }
            tbody tr:nth-child(even) {
                background: #CA955C;
            }
            
            a,a:hover{
                text-decoration: none;
            }
            .text {
                color: transparent;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                <img src="images/Dog_Cat_Logo.png" alt="logo" width="50" height="50">
                </a>
            </div>
            <span class="navbar-brand mb-0 h1">Purrfect Care</span>
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link" href="provider_view_appointment.php">View Appointment List</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="pet_manage_appointment.php">Manage Appointment</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="view_feedback.php">Feedbacks</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="managerLogout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <p>Appointment List</p>
        
        <div>
            <table style="width: 90%;">
                <tr>
                    <th width="9%">APP ID</th>
                    <th width="13%">Date&Time</th>
                    <th>Pet Species, Gender</th>
                    <th>Address</th>
                    <th>Notes</th>
                    <th class="text">Approve</th>
                    <th class="text">Decline</th>
                </tr>
                <?php
                    include("conn.php");
                    $staffID = $_SESSION["staffID"];
                    $serviceQuery = "SELECT serviceID, mainServiceID FROM service_record WHERE mainServiceID IN (SELECT mainServiceID FROM staff_record WHERE staffID = $staffID) LIMIT 1";
                    $serviceResult = mysqli_query($con, $serviceQuery);
        
                    if (mysqli_num_rows($serviceResult) > 0) {
                        while ($serviceRow = mysqli_fetch_assoc($serviceResult)) {
                            $serviceID = $serviceRow['serviceID'];
                            $mainServiceID = $serviceRow['mainServiceID'];
                
                            // Fetch the appointment records related to the mainServiceID and serviceID
                            $appointmentsQuery = "SELECT * FROM appointment_record INNER JOIN service_record ON appointment_record.serviceID = service_record.serviceID WHERE service_record.mainServiceID = $mainServiceID AND appointment_record.status ='Pending'";
                            $appointmentsResult = mysqli_query($con, $appointmentsQuery);
                        
                            while ($row = mysqli_fetch_array($appointmentsResult)) {
                                echo "<tr>";
                                echo "<td>".$row['appointmentID']."</td>";
                                echo "<td>".$row['appointmentDate']."<br>".$row['appointmentTime']."</td>";
                                echo "<td>".$row['petSpecies'].", ".$row['petGender']."</td>";
                                echo "<td>".$row['customerAddress']."</td>";
                                echo "<td>".$row['notes']."</td>";
                                echo '<td class="link"><a href="approve_appointment.php?appointmentID='.$row['appointmentID'].'" id="Approve">Approve</a></td>';
                                echo '<td class="link"><a href="decline_appointment.php?appointmentID='.$row['appointmentID'].'"onclick="return confirm(\'Decline appointment '.$row['appointmentID'].'?\');">Decline</a></td>';
                                echo "</tr>";
                            }
                        }
                        if (mysqli_num_rows($appointmentsResult) <= 0) {
                            echo "<script>alert('No Pending Appointments')</script>";
                        }

                    }else{
                        echo "<script>alert('No Main Service ID found for the staff')</script>";
                    }
                    mysqli_close($con);
                ?>
            </table>
        </div>

    </body>
</html>