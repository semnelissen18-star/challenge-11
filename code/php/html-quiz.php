<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: inloggen.php?error=niet_ingelogd");
    exit();
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
    <link rel="stylesheet" href="../css/html-quiz.css?v=1">
    <title>Quiz | Skillsphere</title>
</head>
<body>
    
</body>
</html> 

<div class="header">

        <div id="logo">
            <img src="../../image/skillshere-official-logo.png" alt="Logo" width="80" height="80">
        </div>
       <div class="user-name">
        <h1>
            Gebruiker:  
        
            <?php echo $user['username']; ?>!
        
        </h1>
       </div>

        <div class="back-button">
        <a href="home.php">Terug naar Home</a>
    </div>
</div>

<div class="quiz-box">
    <h1>Quiz</h1>