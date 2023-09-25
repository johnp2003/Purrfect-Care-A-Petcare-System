<!DOCTYPE html>
<html>
    <head>
        <title>Customer Feedback</title>
        <link rel="icon" href="images/Dog_Cat_Logo.png" type="image/jpg" sizes="50x50">
        <style>
            /* CSS styling */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f1f1f1;
            }

            .container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h2 {
                text-align: center;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                padding: 10px;
                text-align: left;
            }

            th {
                background-color: #f5f5f5;
            }

            .rating {
                display: inline-block;
                vertical-align: middle;
            }

            .rating span {
                font-size: 20px;
                color: #ff9800;
                cursor: pointer;
            }

            .rating span:hover,
            .rating span:hover ~ span {
                color: #ffc107;
            }

            .rating span.active,
            .rating span.active ~ span {
                color: #ff9800;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Customer Feedback</h2>
            <table>
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Rating</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    session_start();   
                    include("conn.php");
                    $conn = mysqli_connect("localhost","root","","purrfect_care");
                    $staffID = $_SESSION["staffID"];

                    // Retrieve feedback records
                    $sql = "SELECT fr.appointmentID, fr.rating, fr.comment FROM feedback_record fr INNER JOIN appointment_record ar ON fr.appointmentID = ar.appointmentID INNER JOIN service_record sr ON ar.serviceID = sr.serviceID WHERE sr.mainServiceID IN (SELECT mainServiceID FROM staff_record WHERE staffID = $staffID)";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $appointmentID = $row['appointmentID'];
                            $rating = $row['rating'];
                            $comment = $row['comment'];
                            ?>
                            <tr>
                                <td><?php echo $appointmentID; ?></td>
                                <td>
                                    <div class="rating">
                                    <?php echo $rating; ?>
                                    </div>
                                </td>
                                <td><?php echo $comment; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='3'>No feedback records found.</td></tr>";
                    }

                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
        <script>
            // Add event listener to the rating stars
            document.querySelectorAll(".rating").forEach(function(ratingContainer) {
                ratingContainer.addEventListener("click", function(event) {
                    if (event.target.tagName === "SPAN") {
                        // Get the selected rating value
                        var ratingValue = parseInt(event.target.dataset.value);

                        // Highlight the selected stars
                        event.target.parentElement.querySelectorAll("span").forEach(function(star) {
                            star.classList.remove("active");
                        });
                        event.target.classList.add("active");

                        // Perform any additional actions based on the selected rating value
                        console.log("Selected rating: " + ratingValue);
                    }
                });
            });
        </script>
</body>
</html>