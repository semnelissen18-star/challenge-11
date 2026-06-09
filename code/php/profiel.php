<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Niet ingelogd");
}

$conn = new mysqli("localhost", "root", "root", "skillsphere-ch11");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM registreren WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillsphere</title>
    <link rel="stylesheet" href="../css/profiel.css?v=3">
</head>

<body>

    <div class="header">

        <div id="logo">
            <img src="../../image/skillshere-official-logo.png" alt="Logo" width="80" height="80">
        </div>

        <div class="search-box">
            <input type="text" placeholder="Zoeken...">
            <span class="icon">🔍</span>
        </div>

        <div class="nav">
            <a href="home.php">Home</a>
            <a href="profile.php">Skills</a>
            <a href="settings.php">Challenges</a>
            <a href="logout.php">Profiel</a>
            <a href="inloggen.php">Login</a>
            <a href="inloggen.php">Logout</a>
        </div>

    </div>

    <div class="box2">
          <div class="usericon">
            <img src="../../image/User-Icon-Grey.webp" alt="User Icon" width="150" height="150">
        </div>
          <h1>Welkom, <?php echo $user['username']; ?> 👋<br> Opleiding: <?php echo $user['opleiding']; ?></h1>
          </div>


    


</body>
</html>    

    