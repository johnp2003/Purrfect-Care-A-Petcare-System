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
if(isset($_SESSION["staffID"])){
    include("conn.php");
    $id = intval($_GET["appointmentID"]);
    $sql = "UPDATE appointment_record SET status='Cancelled' WHERE appointmentID=".$id;
    if (mysqli_query($con, $sql)) {
        // Retrieve appointment and customer information
        $appointmentQuery = "SELECT cr.customerFullName, cr.customerEmail FROM appointment_record ar INNER JOIN customer_record cr ON ar.customerID = cr.customerID WHERE ar.appointmentID = $id";
        $appointmentResult = mysqli_query($con, $appointmentQuery);
        $appointmentRow = mysqli_fetch_assoc($appointmentResult);
        $customerFullName = $appointmentRow['customerFullName'];
        $customerEmail = $appointmentRow['customerEmail'];

        mysqli_close($con);

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
            We regret to inform you that your appointment with us, <strong>Appointment ID: $id</strong>, has been cancelled. We apologize for any inconvenience caused.<br><br>
                
            Thank you for considering Purrfect Care. If you have any questions or need further assistance, please feel free to contact us.<br><br>
                
            Best regards,<br>
            Purrfect Care Team";

            // Send email
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        echo '<script>alert("Appointment '.$id.' cancelled.");window.location.href="pet_manage_appointment.php";</script>';
    }
}else {
    echo "<script>alert('Please Login!');window.location.href='staffLogin.php';</script>";
}
?>
