<?php
$message = "";

if (isset($_FILES['file'])) {

    $fileName = $_FILES['file']['name'];
    $tmpName = $_FILES['file']['tmp_name'];

    // ❌ VULNERABLE: no validation
    move_uploaded_file($tmpName, "uploads/" . $fileName);

    $message = "File uploaded successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload Lab</title>
</head>
<body>

<h2>📁 File Upload (Vulnerable)</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Upload">
</form>

<p><?php echo $message; ?></p>

</body>
</html>