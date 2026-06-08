<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM registreren WHERE username = ?");
    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['username'] = $user['username'];

        header("Location: home.php");
        exit();

    } else {
        $error = "Gebruikersnaam of wachtwoord is onjuist.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/inloggen.css?v=1">
    <title>Inloggen | Skillsphere</title>
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <h2>Inloggen</h2>

            <?php if(isset($error)): ?>
            <p><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST" action="inloggen.php">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Gebruikersnaam" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Wachtwoord" required>
                      <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePassword()"></i>
                </div>
                <button type="submit" class="login-button">Inloggen</button>
            </form>
            <p class="register-link">Nog geen account? <a href="registreren.php">Registreer hier</a></p>
            
        </div>
    </div>
    
   
    <div class="back-button">
        <a href="home.php">Terug naar Home</a>
    </div>

    <div class="bottom-image">
            <img src="../../image/Instagram_icon.png" height="60">
            <img src="../../image/Facebook_Logo_2023.png" height="60">
            <img src="../../image/tiktok-icon-free-png.webp" height="60">
           
    </div>

    <div class="logo1">
        <img src="../../image/skillshere-official-logo.png" alt="Logo" width="200" height="200">
    </div>

    <script>
function togglePassword() {
    const passwordField = document.getElementById("password");
    const icon = document.querySelector(".toggle-password");

    if (passwordField.type === "password") {
        passwordField.type = "text";

        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        passwordField.type = "password";

        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}
</script>
 

</body>
</html>