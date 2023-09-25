<!DOCTYPE html>
<html>
    <head>
        <title>Registration Page</title>
        <style>
            /* CSS styling */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f1f1f1;
            }

            .container {
                width: 500px;
                margin: 0 auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h2 {
                text-align: center;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }

            .form-group input[type="text"],
            .form-group input[type="email"],
            .form-group input[type="password"] {
                width: 95%;
                padding: 10px;
                font-size: 16px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            .form-group input[type="submit"] {
                width: 100%;
                padding: 10px;
                font-size: 16px;
                border-radius: 5px;
                background-color: #4CAF50;
                color: #ffffff;
                border: none;
                cursor: pointer;
            }

            .form-group input[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
    <?php
    session_start();
    
        $conn = mysqli_connect("localhost","root","","purrfect_care");
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if(isset($_POST["submit"])){
        // Retrieve form values
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $ic = $_POST['ic'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $status = 'Active';

        // Perform server-side validation or additional checks if needed

        // Insert the data into the database
        $sql = "INSERT INTO customer_record (customerEmail, customerPass, customerFullname, customerIC, customerPhoneNumber, customerAddress, customerGender, customer_status) 
                VALUES ('$email', '$password', '$fullName', '$ic', '$phoneNumber', '$address', '$gender', '$status')";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Registration successful!");window.location.href="CustomerLogin.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>
        <div class="container">
            <h2>Registration</h2>
            <form id="registrationForm" method="post" action="">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="fullName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="ic">IC</label>
                    <input type="text" id="ic" name="ic" required>
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Register">
                </div>
            </form>
        </div>
        <script>
            document.getElementById("registrationForm").addEventListener("submit", function(event) {

            // Get form values
            var fullName = document.getElementById("fullName").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var ic = document.getElementById("ic").value;
            var phoneNumber = document.getElementById("phoneNumber").value;
            var address = document.getElementById("address").value;
            var gender = document.getElementById("gender").value;

            // Perform client-side validation
            if (fullName === "" || email === "" || password === "" || ic === "" || phoneNumber === "" || address === "" || gender === "") {
                alert("All fields are required!");
            } else {
                // Submit the form if validation passes
                document.getElementById("registrationForm").submit();
            }
            });
        </script>
    </body>
</html>