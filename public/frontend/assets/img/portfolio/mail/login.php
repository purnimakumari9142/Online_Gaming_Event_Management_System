<!-- <?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

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
// }

// // Check if form is submitted
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     if (!empty($_POST['email']) && !empty($_POST['password'])) {
//         $email = $conn->real_escape_string($_POST['email']);
//          $username = $conn->real_escape_string($_POST['username']);
//         //$Password = $conn->real_escape_string(password_hash($_POST['password'], PASSWORD_DEFAULT)); // Hash the password


// //echo $Password;
// //exit;


//         $stmt = $conn->prepare("SELECT Name, Password FROM register WHERE Name=? AND email=?");
// $stmt->bind_param("ss", $username,$email);

//         // $stmt->bind_param("s", $email);
//         $stmt->execute();
//         $result = $stmt->get_result();
// // echo $stmt;
// // exit;
//         if ($result->num_rows > 0) {
//             $row = $result->fetch_assoc();
//             // Debugging output
//             //echo "Retrieved Email: " . $row['Email'] . "<br>";
//             //echo "Retrieved Password: " . $row['Password'] . "<br>";
//             //echo "Password Entered: " . $Password . "<br>";
//             // Debugging output end
//             $Password = md5($_POST['password']);
//             // Verify password
//             if($Password==$row['Password']) {
//                 echo "<script>alert('Login successful!');</script>";
                
//                //header("Location: index.html");
//                 //exit(); // Exit script to prevent further execution
//             }
//              else {
//                 echo "<script>alert('Invalid login credentials!');</script>";
//             }
            
//         } else {
//             echo "<script>alert('User not found!');</script>";
//         }
//         $stmt->close();
//     } else {
//         echo "<script>alert('Email and password are required!');</script>";
//     }
// } else {
//     http_response_code(405);
//     echo "Method Not Allowed";
// }

// $conn->close();
?> -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $username = $conn->real_escape_string($_POST['username']);
        $Password = md5($_POST['password']);

        $stmt = $conn->prepare("SELECT Name, Password FROM register WHERE Name=? AND email=?");
        $stmt->bind_param("ss", $username, $email);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            if ($Password == $row['Password']) {
                echo "<script>alert('Login successful!');</script>";
                // Redirect to index.html
                header("Location:display_data.php");
                exit(); // Exit script to prevent further execution
            } else {
                echo "<script>alert('Invalid login credentials!');</script>";
            }
        } else {
            echo "<script>alert('User not found!');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Email and password are required!');</script>";
    }
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}

$conn->close();
?>