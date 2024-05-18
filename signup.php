<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection parameters
        $servername = "sql6.freesqldatabase.com";
        $username = "sql12707338"; // Replace with your MySQL username
        $password = "YFE4CyMN8i"; // Replace with your MySQL password
        $database = "sql12707338"; // Replace with your MySQL database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get data from the form
        $firstName = isset($_POST['name']) ? $_POST['name'] : '';
        $rfidNumber = isset($_POST['rfid_no']) ? $_POST['rfid_no'] : '';

        // Define initial points value
        $points = 0;

        // Prepare SQL statement with placeholders for values
        $sql = "INSERT INTO RVM (FirstName, RFID_No, Points) VALUES (?, ?, ?)";

        // Create a prepared statement
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("ssi", $firstName, $rfidNumber, $points);

        if ($stmt->execute()) {
            // Data inserted successfully
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>