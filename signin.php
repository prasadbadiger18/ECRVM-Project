<?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Assuming you have already established a database connection
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

            // Retrieve the RFID number from the form submission
            $rfid_no = $_POST['rfid_no'];

            // Prepare SQL statement to check if the RFID number exists in the database
            $sql = "SELECT FirstName, RFID_No, Points FROM RVM WHERE RFID_No = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $rfid_no);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                // User found, print their details
                while($row = $result->fetch_assoc()) {
                    echo "<div class='user-details'>";
                    echo "<p><strong>Name:</strong> " . $row["FirstName"]. "</p>";
                    echo "<p><strong>RFID Number:</strong> " . $row["RFID_No"]. "</p>";
                    echo "<p><strong>Points:</strong> " . $row["Points"]. "</p>";
                    echo "</div>";

                }
            } else {
                // User not found
                echo "User not found.";
            }

            // Close database connection
            $stmt->close();
            $conn->close();
        }
?>