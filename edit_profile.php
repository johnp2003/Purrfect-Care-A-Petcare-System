<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
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
        .form-group select {
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
        .form-group input[type="back"] {
            width: 96%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            background-color: red;
            color: #ffffff;
            border: none;
            cursor: pointer;
            text-align: center;
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

    // Update profile if form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $customerEmail = $_POST['customerEmail'];
        $customerPass = $_POST['customerPass'];
        $customerFullname = $_POST['customerFullname'];
        $customerIC = $_POST['customerIC'];
        $customerPhoneNumber = $_POST['customerPhoneNumber'];
        $customerAddress = $_POST['customerAddress'];
        $customerGender = $_POST['customerGender'];

        $sql = "UPDATE customer_record SET
                customerPass = '$customerPass',
                customerFullname = '$customerFullname',
                customerIC = '$customerIC',
                customerPhoneNumber = '$customerPhoneNumber',
                customerAddress = '$customerAddress',
                customerGender = '$customerGender'
                WHERE customerEmail = '$customerEmail'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Profile updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating profile: " . mysqli_error($conn) . "');</script>";
        }
    }

    // Get user profile data
    $customerID = $_SESSION["customerID"];
    $sql = "SELECT * FROM customer_record WHERE customerID = $customerID";
    $result = mysqli_query($conn, $sql);


    $profileData = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $profileData['customerEmail'] = $row['customerEmail'];
        $profileData['customerPass'] = $row['customerPass'];
        $profileData['customerFullname'] = $row['customerFullname'];
        $profileData['customerIC'] = $row['customerIC'];
        $profileData['customerPhoneNumber'] = $row['customerPhoneNumber'];
        $profileData['customerAddress'] = $row['customerAddress'];
        $profileData['customerGender'] = $row['customerGender'];
    }

    mysqli_close($conn);
    ?>

    <div class="container">
        <h2>Edit Profile</h2>
        <form id="editProfileForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="customerEmail">Email</label>
                <input type="email" id="customerEmail" name="customerEmail" value="<?php echo $profileData['customerEmail']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="customerPass">Password</label>
                <input type="password" id="customerPass" name="customerPass" value="<?php echo $profileData['customerPass']; ?>" required>
            </div>
            <div class="form-group">
                <label for="customerFullname">Full Name</label>
                <input type="text" id="customerFullname" name="customerFullname" value="<?php echo $profileData['customerFullname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="customerIC">IC</label>
                <input type="text" id="customerIC" name="customerIC" value="<?php echo $profileData['customerIC']; ?>" required>
            </div>
            <div class="form-group">
                <label for="customerPhoneNumber">Phone Number</label>
                <input type="text" id="customerPhoneNumber" name="customerPhoneNumber" value="<?php echo $profileData['customerPhoneNumber']; ?>" required>
            </div>
            <div class="form-group">
                <label for="customerAddress">Address</label>
                <input type="text" id="customerAddress" name="customerAddress" value="<?php echo $profileData['customerAddress']; ?>" required>
            </div>
            <div class="form-group">
                <label for="customerGender">Gender</label>
                <select id="customerGender" name="customerGender" required>
                    <option value="Male" <?php if ($profileData['customerGender'] === 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($profileData['customerGender'] === 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($profileData['customerGender'] === 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Save Changes">
            </div>
            <div class="form-group">
                <a href="customer_homepage.php"><input type="back" value="Back to homepage"></a>
            </div>
        </form>
    </div>
    <script>
    // Form validation
        document.getElementById("editProfileForm").addEventListener("submit", function(event) {
            var passInput = document.getElementById("customerPass");
            var passConfirmInput = document.getElementById("customerPassConfirm");

            // Check if password and confirm password match
            if (passInput.value !== passConfirmInput.value) {
                alert("Password and Confirm Password do not match.");
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
</body>
</html>