<!-- <?php
// header("Access-Control-Allow-Origin: *");

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     // Your existing PHP code for handling the form data
//     $Name = $_POST['name'];
//     $Email = $_POST['email'];
//     $Phone = $_POST['phone'];
//     $Message = $_POST['message'];

//     // Database connection
//     $conn = new mysqli('localhost', 'root', '', 'contact');
//     if ($conn->connect_error) {
//         die('Connection failed: ' . $conn->connect_error);
//     } else {
//         // Prepare and execute the query with parameterized statements
//         $stmt = $conn->prepare("INSERT INTO `contact-table` (`Name`, `Email`, `Phone`, `Message`) VALUES (?, ?, ?, ?)");
//         $stmt->bind_param("ssis", $Name, $Email, $Phone, $Message);


//         if ($stmt->execute()) {
//             echo "Data sent successfully...";
//         } else {
//             echo "Error: " . $stmt->error;
//         }

//         $stmt->close();
//         $conn->close();
//     }
// } else {
//     // Handle other HTTP methods or show an error
//     http_response_code(405); // Method Not Allowed
//     echo "Method Not Allowed";
// }
?> -->
<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); // Set to your timezone


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Your existing PHP code for handling the form data
    $Name = $_POST['name'];
    $Email = $_POST['email'];
    $Phone = $_POST['phone'];
    $Message = $_POST['message'];
    $DateTime = date('Y-m-d H:i:s'); // Current date and time in MySQL format

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'contact');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        // Prepare and execute the query with parameterized statements
        $stmt = $conn->prepare("INSERT INTO `contact-table` (`Name`, `Email`, `Phone`, `Message`, `DateTime`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $Name, $Email, $Phone, $Message, $DateTime);

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