<?php
// Database configuration
$host = 'localhost';
$dbname = 'contact_form_db';  // Pastikan nama database benar
$username = 'root';
$password = '';

// Connect to the database
try {
    // Pastikan $dbname digunakan pada DSN dengan benar
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Prepare and execute the SQL statement
        $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        // Redirect to the success page
        header("Location: success.html");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
