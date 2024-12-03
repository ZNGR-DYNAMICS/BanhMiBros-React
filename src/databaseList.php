<?php
$servername = "localhost"; // Replace with your database server
$username = "dev_banhmibros"; // Replace with your database username
$password = "your_password"; // Replace with your database password

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all databases
$sql = "SHOW DATABASES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Databases:</h1>";
    while ($row = $result->fetch_assoc()) {
        $database = $row['Database'];
        echo "<h2>$database</h2>";

        // Connect to each database
        $conn->select_db($database);

        // Get all tables
        $tablesResult = $conn->query("SHOW TABLES");
        if ($tablesResult->num_rows > 0) {
            while ($tableRow = $tablesResult->fetch_row()) {
                $table = $tableRow[0];
                echo "<h3>Table: $table</h3>";

                // Get table contents
                $contentResult = $conn->query("SELECT * FROM $table");
                if ($contentResult->num_rows > 0) {
                    echo "<table border='1'>";
                    echo "<tr>";

                    // Print column headers
                    $columns = $contentResult->fetch_fields();
                    foreach ($columns as $column) {
                        echo "<th>{$column->name}</th>";
                    }
                    echo "</tr>";

                    // Print rows
                    while ($contentRow = $contentResult->fetch_assoc()) {
                        echo "<tr>";
                        foreach ($contentRow as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No data in table.<br>";
                }
            }
        } else {
            echo "No tables found.<br>";
        }
    }
} else {
    echo "No databases found.";
}

$conn->close();
?>