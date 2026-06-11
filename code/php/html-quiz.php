<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: inloggen.php?error=niet_ingelogd");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "skillsphere-ch11");

if ($conn->connect_error) {
    die("Database fout: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM registreren WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!isset($_SESSION['vraagnummer'])) {
    $_SESSION['vraagnummer'] = 0;
    $_SESSION['score'] = 0;
}

$vragen = [

    [
        "vraag" => "Waar staat HTML voor?",
        "antwoorden" => [
            "HyperText Markup Language",
            "HighText Machine Language",
            "Home Tool Markup Language"
        ],
        "correct" => 0
    ],

    [
        "vraag" => "Welke tag maakt een kop?",
        "antwoorden" => [
            "head",
            "h1",
            "title"
        ],
        "correct" => 1
    ],

    [
        "vraag" => "Welke tag maakt een paragraaf?",
        "antwoorden" => [
            "p",
            "div",
            "span"
        ],
        "correct" => 0
    ],

     [
        "vraag" => "Wat is het verschil tussen div en span?",
        "antwoorden" => [
            "div is inline, span is block",
            "div is block-level, span is inline",
            "Ze zijn precies hetzelfde"
        ],
        "correct" => 1
    ],

    [
        "vraag" => "Welke tag wordt gebruikt voor belangrijke navigatie?",
        "antwoorden" => [
            "nav",
            "navigation",
            "menuitem"
        ],
        "correct" => 0
    ],

     [
        "vraag" => "Welke uitspraak over “void elements” in HTML is correct?",
        "antwoorden" => [
            "Ze moeten altijd binnen body staan en hebben een sluittag nodig",
            "Ze hebben geen afsluitende tag en kunnen geen kind-elementen bevatten",
            "Ze mogen nooit attributen hebben"
        ],
        "correct" => 2
    ],

       [
        "vraag" => "Wat gebeurt er als je een form zonder action attribuut submit?",
        "antwoorden" => [
            "De browser doet niets",
            "De pagina wordt opnieuw geladen op dezelfde URL",
            "De data wordt automatisch naar een standaard server gestuurd"
        ],
        "correct" => 1
    ],


];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $gekozen = $_POST['antwoord'];
    $huidigeVraag = $_SESSION['vraagnummer'];

    if ($gekozen == $vragen[$huidigeVraag]['correct']) {
        $_SESSION['score']++;
    }

    $_SESSION['vraagnummer']++;
}

if ($_SESSION['vraagnummer'] >= count($vragen)) {
    ?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Quiz Resultaat</title>
</head>
<body>

    <h1>Quiz klaar!</h1>

    <p>
        Je hebt  
        <?php echo $_SESSION['score']; ?>
        van de
        <?php echo count($vragen); ?>
        vragen goed.
    </p>

    <a href="home.php">Terug naar Home</a>

</body>
</html>

<?php

session_destroy();
exit();


}

$nummer = $_SESSION['vraagnummer'];
$vraag = $vragen[$nummer];
?>

<!DOCTYPE html>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Quiz | Skillsphere</title>


<link rel="stylesheet" href="../css/html-quiz.css?v=3">


</head>
<body>

<body>

<div class="header">

<div id="logo">
    <img src="../../image/skillshere-official-logo.png"
         alt="Logo"
         width="80"
         height="80">
</div>

<div class="user-name">
    <h1>
        Gebruiker:
        <?php echo htmlspecialchars($user['username']); ?>
    </h1>
</div>

<div class="back-button">
    <a href="home.php">Terug naar Home</a>
</div>


</div>

<main class="quiz-container">


<div class="quiz-box">

    <div class="question-counter">
        Vraag <?php echo $nummer + 1; ?>
        van
        <?php echo count($vragen); ?>
    </div>

    <div class="progress-bar">
        <div class="progress-fill"
             style="width: <?php echo (($nummer + 1) / count($vragen)) * 100; ?>%">
        </div>
    </div>

    <h2 class="question-title">
        <?php echo $vraag['vraag']; ?>
    </h2>

    <form method="POST" class="quiz-form">

        <button class="answer-btn"
                type="submit"
                name="antwoord"
                value="0">
            <?php echo $vraag['antwoorden'][0]; ?>
        </button>

        <button class="answer-btn"
                type="submit"
                name="antwoord"
                value="1">
            <?php echo $vraag['antwoorden'][1]; ?>
        </button>

        <button class="answer-btn"
                type="submit"
                name="antwoord"
                value="2">
            <?php echo $vraag['antwoorden'][2]; ?>
        </button>

    </form>

    <div class="score-box">
        Score: <?php echo $_SESSION['score']; ?>
    </div>

</div>


</main>

</body>
</html>


</body>
</html>
