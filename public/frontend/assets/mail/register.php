<!-- <?php
// header("Access-Control-Allow-Origin: *");
// session_start();

// // Database connection parameters
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "contact";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);


// // Handle registration request
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
//     // Sanitize user inputs
//     $name = mysqli_real_escape_string($conn, $_POST['name']);
//     $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
//     $email = mysqli_real_escape_string($conn, $_POST['email']);
//     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//     // Insert user data into the database
//     $sql = "INSERT INTO register (Name, Phone, Email, Password) VALUES ('$name', '$phone_no', '$email', '$password')";

//     if ($conn->query($sql) === TRUE) {
//         echo "Registration successful!";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }
// }
// // Close connection
// $conn->close();
// else{
//     // Handle other HTTP methods or show an error
//     http_response_code(405); // Method Not Allowed
//     echo "Method Not Allowed";
// }
?> -->
<?php
// PHP script for handling form submission
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "PHP script executed."; // Debug statement

header("Access-Control-Allow-Origin: *");

var_dump($_POST); // Debug statement

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are set
    if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])) {
        // Your existing PHP code for handling the form data
        $Name = $_POST['name'];
        $Phone = (int)$_POST['phone']; // Cast phone number to integer
        $Email = $_POST['email'];
        $Password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'contact');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        } else {
            // Prepare and execute the query with parameterized statements
            $stmt = $conn->prepare("INSERT INTO `register` (`Name`, `Phone`, `Email`, `Password`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siss", $Name, $Phone, $Email, $Password); // "siss" indicates two strings and two integers

            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    } else {
        // Handle missing fields by outputting the field names
        $missingFields = array();
        if (!isset($_POST['name'])) $missingFields[] = 'name';
        if (!isset($_POST['phone'])) $missingFields[] = 'phone';
        if (!isset($_POST['email'])) $missingFields[] = 'email';
        if (!isset($_POST['password'])) $missingFields[] = 'password';

        echo "Error: All fields are required. Missing fields: " . implode(', ', $missingFields);
    }
} else {
    // Handle other HTTP methods or show an error
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}
?>