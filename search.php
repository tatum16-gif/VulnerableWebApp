<?php
$conn = new mysqli("localhost", "root", "", "testdb");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Users</title>
</head>
<body>

<h2>🔍 Search Users (SQL Injection)</h2>

<form method="GET">
    <input type="text" name="search">
    <input type="submit" value="Search">
</form>

<hr>

<?php
if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // ❌ VULNERABLE QUERY
    $sql = "SELECT * FROM users WHERE username LIKE '%$search%'";

    echo "<p><strong>Query:</strong> $sql</p>";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "User: " . $row['username'] . "<br>";
    }
}
?>

</body>
</html>