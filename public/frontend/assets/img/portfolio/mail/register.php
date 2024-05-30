<?php
// PHP script for handling form submission

header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); // Set to your timezone

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are set
    if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])) {
        // Your existing PHP code for handling the form data
        $Name = $_POST['name'];
        $Phone = (int)$_POST['phone']; // Cast phone number to integer
        $Email = $_POST['email'];
        $Password = md5($_POST['password']);
        $DateTime = date('Y-m-d H:i:s'); // Current date and time in MySQL format

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'contact');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        } else {
            // Prepare and execute the query with parameterized statements
            $stmt = $conn->prepare("INSERT INTO register (Name, Phone, Email, Password, DateTime) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sisss", $Name, $Phone, $Email, $Password, $DateTime); // "siss" indicates two strings and two integers

            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: Registration failed.";
            }

            $stmt->close();
            $conn->close();
        }
    } else {
        // Handle missing fields by outputting a generic error message
        echo "Error: Registration failed. Please try again later.";
    }
} else {
    // Handle other HTTP methods or show an error
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}
?>