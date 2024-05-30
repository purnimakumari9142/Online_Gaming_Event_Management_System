<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

    <?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'contact');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM `contact-table`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display table header
    echo "<table>";
    echo "<tr><th>Name</th><th>Email</th><th>Phone</th><th>Message</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['Name']}</td><td>{$row['Email']}</td><td>{$row['Phone']}</td><td>{$row['Message']}</td></tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}

$conn->close();
?>

</body>

</html>