<?php
$conn = new mysqli("localhost", "root", "", "testdb");

$message = "";

// LOGIN (SQLi)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    echo "<pre>SQL: $sql</pre>";
    $debug = $sql;

    try {
        $result = $conn->query($sql);

       if ($result && $result->num_rows > 0) {
    $message = "✅ Logged in!<br><br>";

    while ($row = $result->fetch_assoc()) {
        $message .= "User: " . $row['username'] . " | Password: " . $row['password'] . "<br>";
    }
} else {
    $message = "❌ Login failed";
}
    } catch (mysqli_sql_exception $e) {
        $message = "❌ SQL Error: " . $e->getMessage();
    }
}

// SAVE COMMENT (Stored XSS)
if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];

    // ❌ VULNERABLE
    $conn->query("INSERT INTO comments (comment) VALUES ('$comment')");
}

// LOAD COMMENTS
$comments = $conn->query("SELECT * FROM comments");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable Lab</title>
</head>
<body>

<h1>🧪 Pen Testing Practice Lab</h1>

<hr>

<h2>Login (SQL Injection)</h2>

<form method="POST">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="text" name="password"><br><br>
    <input type="submit" value="Login">
</form>

<p><?php echo $message; ?></p>

<p><strong>Debug Query:</strong></p>
<pre><?php if (isset($debug)) echo $debug; ?></pre>

<hr>

<h2>Leave a Comment (Stored XSS)</h2>

<form method="POST">
    <input type="text" name="comment">
    <input type="submit" value="Submit">
</form>

<h3>Comments:</h3>

<?php
while ($row = $comments->fetch_assoc()) {
    // ❌ VULNERABLE OUTPUT
    echo $row['comment'] . "<br>";
}
?>

<hr>

<h3>Stolen Data Log:</h3>
<div id="log"></div>

</body>
</html>