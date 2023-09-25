<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include library files
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

session_start();
if (isset($_SESSION["staffID"])) {
    include("conn.php");

    $sql = "SELECT ar.status, cr.customerFullName, cr.customerEmail
        FROM appointment_record ar
        INNER JOIN customer_record cr ON ar.customerID = cr.customerID
        WHERE ar.appointmentID = $_POST[appointmentID];";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $previousStatus = $row['status'];
    $customerFullName = $row['customerFullName'];
    $customerEmail = $row['customerEmail'];

    $sql = "UPDATE appointment_record SET 
        appointmentID='$_POST[appointmentID]', 
        serviceID='$_POST[serviceID]', 
        customerID='$_POST[customerID]', 
        appointmentDate='$_POST[appointmentDate]', 
        appointmentTime='$_POST[appointmentTime]',
        status='$_POST[status]'
        WHERE appointmentID=$_POST[appointmentID];";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);

        // Check if the status has changed
        $newStatus = $_POST['status'];
        if ($previousStatus != $newStatus) {
            // Create an instance of PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'purrfectcaretech@gmail.com';
                $mail->Password = 'nyquxkbwhnzprrbg';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                // Sender info
                $mail->setFrom('purrfectcaretech@gmail.com', 'Purrfect Care');
                $mail->addReplyTo('purrfectcaretech@gmail.com', 'Purrfect Care');

                // Recipient
                $mail->addAddress($customerEmail);

                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'Appointment Status';
                $mail->Body = "Greetings $customerFullName,<br><br>
                We wanted to inform you that the status of your appointment with us, <strong>Appointment ID: $_POST[appointmentID]</strong>, has been changed to <strong>$newStatus</strong>. We kindly request you to log in to our website and check your appointments for more detailed information.<br><br>
                
                Thank you for choosing Purrfect Care! We look forward to serving your purr soon.<br><br>
                
                Best regards,<br>
                Purrfect Care Team";
                // Send email
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        echo '<script>alert("Record updated!");window.location.href="provider_view_appointment.php";</script>';
    } else {
        echo '<script>alert("Invalid Input!");window.location.href="edit_customerappointment.php";</script>';
    }
} else {
    echo "<script>alert('Please Login!');window.location.href='TESTLOGIN.php';</script>";
}
?>

