<?php
session_start();


$conn = new mysqli("localhost", "root", "root", "skillsphere-ch11");

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillsphere</title>
    <link rel="stylesheet" href="../css/profiel.css?v=2">
    <script src="../js/profiel.js"></script>
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

        <div class="box2">
            <div class="usericon">
                <img src="../../image/User-Icon-Grey.webp" alt="usericon" width="100" height="100">
            </div>
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

</body>
</html>    

    