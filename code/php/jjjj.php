<?php
session_start();

// check of user is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "jouw_database");

// pak user id uit session
$user_id = $_SESSION['user_id'];

// haal username op uit database
$sql = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();
?>

<h1>Welkom, <?php echo $user['username']; ?> 👋</h1>