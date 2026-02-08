<?php
session_start();
if(!isset($_SESSION['email'])){ header('Location:index.php'); exit(); }

$msg = ""; // Initialize message variable

if(isset($_POST['send'])){
    // 1. Collect and Sanitize Data
    $email = htmlspecialchars($_POST['email']); // Receiver's email
    $car = htmlspecialchars($_POST['car']);
    $total = intval($_POST['total']);

    // 2. Prepare Email Details
    $to = $email;
    $subject = "Car Quotation for " . $car;
    
    // 3. Create the Email Body
    $message = "Hello,\n\n";
    $message .= "Thank you for visiting Car Customization - Mayur.\n";
    $message .= "Here is the quotation you requested:\n\n";
    $message .= "Car Model: " . $car . "\n";
    $message .= "Total Price: ₹ " . number_format($total) . "\n\n";
    $message .= "We hope to see you soon!\n";
    
    // 4. Set Headers (Important for not going to spam)
    // Change 'admin@example.com' to your actual website email
    $headers = "From: no-reply@carcustomization.com" . "\r\n" .
               "Reply-To: no-reply@carcustomization.com" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // 5. Send the Email
    // The @ symbol suppresses warnings if the server isn't configured
    if(@mail($to, $subject, $message, $headers)){
        $msg = "Quotation sent successfully to $email";
    } else {
        $msg = "Quotation generated, but email failed to send (Server configuration required).";
    }

} else {
    // If accessed directly without submitting the form
    header('Location:home.php'); 
    exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thank you</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="page-center">
  <div class="card small">
    <h2><?php echo $msg; ?></h2>
    
    <p>Thank you for using Car Customization — Mayur</p>
    <p><a href="home.php" class="btn">Back to Home</a></p>
  </div>
</div>
</body>
</html>