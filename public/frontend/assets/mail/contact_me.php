<!-- <?php
// Check for empty fields
// if(empty($_POST['name'])      ||
//    empty($_POST['email'])     ||
//    empty($_POST['phone'])     ||
//    empty($_POST['message'])   ||
//    !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
//    {
//    echo "No arguments Provided!";
//    return false;
//    }
   
// $name = strip_tags(htmlspecialchars($_POST['name']));
// $email_address = strip_tags(htmlspecialchars($_POST['email']));
// $phone = strip_tags(htmlspecialchars($_POST['phone']));
// $message = strip_tags(htmlspecialchars($_POST['message']));



   
// Create the email and send the message
// $to = 'krishjain2902@gmail.com'; // Add your email address in between the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
// $email_subject = "Website Contact Form:  $name";
// $email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
// $headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
// $headers .= "Reply-To: $email_address";   
// mail($to,$email_subject,$email_body,$headers);
// return true;         
 ?> -->
<!-- <?php
// $Name = $_POST['name'];
// $Email = $_POST['email'];
// $Phone = $_POST['phone'];
// $Message = $_POST['message'];

// // Database connection
// $conn = new mysqli('localhost', 'root', '', 'contact');
// if ($conn->connect_error) {
//     die('Connection failed: ' . $conn->connect_error);
// } else {
//     $stmt = $conn->prepare("INSERT INTO `contact-table` (`Name`, `Email`, `Phone`, `Message`) VALUES (?, ?, ?, ?)");
//     $stmt->bind_param("ssis", $Name, $Email, $Phone, $Message);

//     if ($stmt->execute()) {
//         echo "Data sent successfully...";
//     } else {
//         echo "Error: " . $stmt->error;
//     }

//     $stmt->close();
//     $conn->close();
// }
// ?>
<?php
header("Access-Control-Allow-Origin: *");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Your existing PHP code for handling the form data
    $Name = $_POST['name'];
    $Email = $_POST['email'];
    $Phone = $_POST['phone'];
    $Message = $_POST['message'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'contact');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        // Prepare and execute the query with parameterized statements
        $stmt = $conn->prepare("INSERT INTO `contact-table` (`Name`, `Email`, `Phone`, `Message`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $Name, $Email, $Phone, $Message);


        if ($stmt->execute()) {
            echo "Data sent successfully...";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    // Handle other HTTP methods or show an error
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}
?>