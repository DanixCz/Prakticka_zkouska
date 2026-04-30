<?php
// Připojení k databázi
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test_formular";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Zpracování odeslaného formuláře
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['Name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $game = trim($_POST['game'] ?? '');
    $rating = trim($_POST['rating'] ?? '');

    // Kontrola, že všechna pole jsou vyplněná
    if ($name === '' || $address === '' || $email === '' || $game === '' || $rating === '') {
        header('Location: index.php?saved=0');
        exit;
    }

    // Kontrola správného hodnocení
    if (!in_array($rating, ['1', '2', '3', '4', '5'], true)) {
        header('Location: index.php?saved=0');
        exit;
    }

    $n = mysqli_real_escape_string($conn, $name);
    $a = mysqli_real_escape_string($conn, $address);
    $b = mysqli_real_escape_string($conn, $email);
    $c = mysqli_real_escape_string($conn, $game);
    $r = mysqli_real_escape_string($conn, $rating);

    $sql = "INSERT INTO submissions (name,address,game,email,rating) VALUES ('$n','$a','$b','$c','$r')";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?saved=1');
        exit;
    }

    header('Location: index.php?saved=0');
    exit;
}

// Načíst recenze z databáze
$reviews = [];
$result = mysqli_query($conn, "SELECT id,name,address,email,game,rating,created_at FROM submissions ORDER BY created_at DESC");
if ($result) {
    $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Komponenty pro maturitu</title>
</head>
<body>
    <header>
    <div class="wrapper">
        <div class="wrapper-logo">
            <div class="logo-mark">M</div>
            <div class="logo-text">
                <strong>Maturita</strong>
                <span>Komponenty</span>
            </div>
        </div>
        <div class="wrapper-hamburger" aria-label="Otevřít menu" role="button" tabindex="0">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- Navigační odkazy pro rychlý přesun na jednotlivé sekce stránky -->
    <nav>
        <a href="#hero-section">Domů</a>
        <a href="#gallery-section">Galerie</a>
        <a href="#grid-section">Grid</a>
        <a href="#reviews-section">Recenze</a>
    </nav>
</header>
<section class="hero-section" id="hero-section">
    <div class="hero-content">
        <h1>Kovářství Černý</h1>
        <p>Tato stránka obsahuje samostatné bloky, které lze snadno použít pro maturitní prezentaci.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quod vitae dolores.</p>
        <div class="hero-actions">
            <a href="#" class="button button-primary">Galerie</a>
            <a href="#" class="button button-secondary">Grid</a>
        </div>
    </div>

</section>
    <main>
        <div class="center">
            <?php include __DIR__ . '/partials/grid.php'; ?>
            <?php include __DIR__ . '/partials/gallery.php'; ?>
            <?php include __DIR__ . '/partials/reviews.php'; ?>
        </div>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>

    <script src="scripts/gallery.js"></script>
    <script src="scripts/menu.js"></script>
    <script src="scripts/form.js"></script>
</body>
</html>
