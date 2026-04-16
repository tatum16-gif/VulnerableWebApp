<?php
// Check database connection and table

$conn = new mysqli("localhost", "root", "", "testdb");

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
echo "✅ Connected to database 'testdb'<br><br>";

// Check if users table exists
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result->num_rows > 0) {
    echo "✅ Table 'users' exists<br><br>";
    
    // Show table structure
    echo "<strong>Table Structure:</strong><br>";
    $columns = $conn->query("DESCRIBE users");
    echo "<pre>";
    while ($row = $columns->fetch_assoc()) {
        echo $row['Field'] . " - " . $row['Type'] . "\n";
    }
    echo "</pre><br>";
    
    // Show all users
    echo "<strong>Users in database:</strong><br>";
    $users = $conn->query("SELECT * FROM users");
    if ($users->num_rows > 0) {
        echo "<pre>";
        while ($row = $users->fetch_assoc()) {
            echo "ID: " . $row['id'] . " | Username: " . $row['username'] . " | Password: " . $row['password'] . "\n";
        }
        echo "</pre>";
    } else {
        echo "⚠️ Table is empty<br>";
    }
} else {
    echo "❌ Table 'users' does NOT exist<br>";
    echo "You need to create it!<br>";
}

$conn->close();
?>
