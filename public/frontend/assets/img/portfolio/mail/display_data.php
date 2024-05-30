<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Data</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"
        integrity="sha512-GIvZyN/F4h8kzJ5DZ1WZqXJWu9PRbBU2XGjm0Sw33y8ovn8EoW/gW/2L7h3EYp4c43v0qW0Zn5c/7/E2i4lQig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
    /* Add any additional styles here */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: #333;
        color: #fff;
    }

    .navbar a {
        color: #fff;
        text-decoration: none;
        margin: 0 10px;
    }

    #search-bar {
        position: relative;
    }

    #search-bar input[type="text"] {
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    /* Style for the sidebar */
    #game-list-sidebar {
        width: 200px;
        height: 100vh;
        background-color: #222;
        position: fixed;
        top: 0;
        left: -200px;
        transition: left 0.3s ease;
        padding-top: 60px;
    }

    #game-list-sidebar ul {
        list-style: none;
        padding: 0;
    }

    #game-list-sidebar li {
        padding: 10px;
    }

    #game-list-sidebar a {
        color: #fff;
        text-decoration: none;
    }

    /* Style for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #333;
        color: white;
    }

    .highlighted {
        background-color: lightgreen;
    }

    ul li {
        text-decoration: "underline;"

    }
    </style>
</head>

<body>

    <div class="navbar">
        <!-- Left side -->
        <button id="game-list-toggle" class="navbar-toggler navbar-toggler-right" type="button"
            onclick="toggleSidebar()">
            Game List <i class="fas fa-bars ml-1"></i>
        </button>
        <div>
            <h2>
                WELCOME To DASHBOARD
            </h2>
        </div>

        <!-- Right side -->
        <div id="search-bar">
            <input id="search-input" type="text" placeholder="Search..."> <!-- added id="search-input" here -->
            <button onclick="search()">Search</button>
        </div>
    </div>

    <!-- <script>
    function search() {
        // Get the value of the input field
        var searchTerm = document.getElementById("search-input").value;

        // Perform your search logic here, for example:
        alert("You searched for: " + searchTerm);
    }
    </script> -->

    <!-- Sidebar for game list -->
    <aside id="game-list-sidebar">
        <!-- Icon to toggle the sidebar -->
        <button class="navbar-toggler navbar-toggler-right" type="button" onclick="toggleSidebar()" style="color:blue
            ,margin-top:30px;">
            Close
            <i class=" fas fa-bars"></i>
        </button>

        <ul>
            <li> <a href="#">BGMI</a></li>
            <br><br>
            <li><a href="#">VELORANT</a></li>
            <!-- <li><a href=" #">Game 3</a></li> -->
            <!-- Add more game links as needed -->
        </ul>
    </aside>



    <?php
    // Database connection
    date_default_timezone_set('Asia/Kolkata'); // Set to your timezone
    $conn = new mysqli('localhost', 'root', '', 'contact');

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT * FROM `players`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display table header
        echo "<table>";
        echo "<tr> <th>SNO.</th><th>Name</th><th>Kills</th><th>Individual_Rank</th><th>Team_Rank</th><th>DateTime</th></tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $dateTime = date("Y-m-d H:i:s", strtotime($row['DateTime']));
            echo "<tr> <td>{$row['SNo.']}</td><td>{$row['Name']}</td><td>{$row['Kills']}</td><td>{$row['Individual_Rank']}</td><td>{$row['Team_Rank']}</td><td>{$dateTime}</td></tr>";
        }
        
        

        echo "</table>";
    } else {
        echo "No data found.";
    }

    $conn->close();
    ?>

    <script>
    // Function to toggle the visibility of the game list sidebar
    function toggleSidebar() {
        var sidebar = document.getElementById("game-list-sidebar");
        if (sidebar.style.left === "-200px") {
            sidebar.style.left = "0";
        } else {
            sidebar.style.left = "-200px";
        }
    }

    function search() {
        // Get the value of the input field
        var searchTerm = document.getElementById("search-input").value.toLowerCase();

        // Get all table rows
        var rows = document.querySelectorAll("table tr");

        // Loop through each row
        for (var i = 1; i < rows.length; i++) { // Start from 1 to skip header row
            var cells = rows[i].querySelectorAll("td"); // Get all cells in the current row

            // Check if any cell in the row contains the search term
            var found = false;
            for (var j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().includes(searchTerm)) {
                    found = true;
                    break;
                }
            }

            // If the search term was found in the row, highlight it, otherwise remove highlight
            if (found) {
                rows[i].classList.add("highlighted");
            } else {
                rows[i].classList.remove("highlighted");
            }
        }
    }
    </script>
</body>

</html>