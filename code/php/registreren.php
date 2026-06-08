<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Haal de gegevens op uit de POST data
    $user  = $_POST['username'];
    $email = $_POST['email'];
    $name  = $_POST['name'];
    $lastname = $_POST['lastname']; // Sla dit op in een eigen variabele
    
    // 2. Veiligheid: Gebruik ALTIJD password_hash!
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    // 3. Bereid de query voor
    $stmt = $conn->prepare("INSERT INTO registreren (username, password, email, name, lastname) VALUES (?, ?, ?, ?, ?)");
    
    try {
        // 4. Geef de variabelen in de juiste volgorde mee
        $stmt->execute([$user, $pass, $email, $name, $lastname]);
      $message = "<div class='alert success'>Account aangemaakt! <a href='index.html'>Log hier in</a></div>";
      
      
    } catch (Exception $e) {
        // Tip: Controleer of de foutmelding echt over een bestaande gebruiker gaat
        echo "Er is een fout opgetreden. Mogelijk bestaat de gebruikersnaam of het e-mailadres al.";
        // echo "Foutmelding voor debuggen: " . $e->getMessage(); 
    }
    
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/registreren.css?v=1">
    <title>Registreren | Skillsphere</title>
</head>
<body>

    <div class="registeer-container">
        <div class="login-box">
            <h2>Registreren</h2>
            <form method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Gebruikersnaam" required>
                </div>
                <div class="input-group password-container">
                    <input type="password" id="password" name="password" placeholder="Wachtwoord" required>
                    <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePassword()"></i>
                </div>
                <div class="input-group">
                    <input type="text" name="name" placeholder="Voornaam" required>
                </div>
                <div class="input-group">
                    <input type="text" name="lastname" placeholder="Achternaam" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>

                <button type="submit" class="login-button">Registreren</button>
            </form>
            
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