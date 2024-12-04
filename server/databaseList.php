<?php

require_once './env.php';

loadEnv(__DIR__, '../.env');

$servername = getenv('DB_SERVER');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h1>Connection established successfully!</h1>";

try {
    // Get all databases
    $sql = "SHOW DATABASES";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Error retrieving databases: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        echo "<h1>Databases:</h1>";
        while ($row = $result->fetch_assoc()) {
            $database = $row['Database'];
            echo "<h2>$database</h2>";

            // Connect to each database
            if (!$conn->select_db($database)) {
                throw new Exception("Error selecting database $database: " . $conn->error);
            }

            // Get all tables
            $tablesResult = $conn->query("SHOW TABLES");
            if (!$tablesResult) {
                throw new Exception("Error retrieving tables in database $database: " . $conn->error);
            }

            if ($tablesResult->num_rows > 0) {
                while ($tableRow = $tablesResult->fetch_row()) {
                    $table = $tableRow[0];
                    echo "<h3>Table: $table</h3>";

                    // Get table contents
                    $contentResult = $conn->query("SELECT * FROM $table");
                    if (!$contentResult) {
                        throw new Exception("Error retrieving data from table $table in database $database: " . $conn->error);
                    }

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
                echo "No tables found in database $database.<br>";
            }
        }
    } else {
        echo "No databases found.";
    }
} catch (Exception $e) {
    echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
}

// Close the connection
$conn->close();
?>