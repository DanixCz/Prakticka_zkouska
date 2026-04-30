<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test_formular";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['Name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $game = trim($_POST['game'] ?? '');
    $rating = trim($_POST['rating'] ?? '');

    if ($name === '' || $address === '' || $email === '' || $game === '' || $rating === '') {
        header('Location: index.php?saved=0');
        exit;
    }

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
        $id = mysqli_insert_id($conn);
        header('Location: index.php?saved=1&id=' . $id);
        exit;
    }

    header('Location: index.php?saved=0');
    exit;
}
?>

<section id="reviews-section" class="section-panel reviews-section">
    <h2>Recenze a zpětná vazba</h2>
    <div class="reviews-layout">
        <form id="mainForm" action="" method="POST">
            <div class="field-row">
                <div class="field-group">
                    <label for="nameInput">Jméno:</label>
                    <input id="nameInput" name="Name" required type="text" />
                </div>
                <div class="field-group">
                    <label for="emailInput">Email:</label>
                    <input id="emailInput" name="email" required type="email" />
                </div>
            </div>

            <div class="field-group">
                <label for="gameInput">typ produktu:</label>
                <input id="gameInput" name="game" required type="text" />
            </div>

            <div class="field-group">
                <span class="rating-label">Hodnocení:</span>
                <div class="rating-group" role="radiogroup" aria-label="Hodnocení">
                    <input type="radio" id="rating5" name="rating" value="5" />
                    <label for="rating5" aria-label="5 bodů"></label>
                    <input type="radio" id="rating4" name="rating" value="4" />
                    <label for="rating4" aria-label="4 body"></label>
                    <input type="radio" id="rating3" name="rating" value="3" />
                    <label for="rating3" aria-label="3 body"></label>
                    <input type="radio" id="rating2" name="rating" value="2" />
                    <label for="rating2" aria-label="2 body"></label>
                    <input type="radio" id="rating1" name="rating" value="1" required />
                    <label for="rating1" aria-label="1 bod"></label>
                </div>
            </div>

            <div class="field-group">
                <label for="addressInput">Text recenze:</label>
                <textarea id="addressInput" name="address" required></textarea>
            </div>

            <div class="actions">
                <button type="button" id="resetBtn">Vymazat</button>
                <input type="submit" value="Odeslat" />
            </div>
        </form>
    </div>

    <div class="slider-panel">
        <h2>Poslední recenze</h2>
        <div id="submissions" aria-live="polite">
            <?php
            $res = mysqli_query($conn, "SELECT id,name,address,email,game,rating,created_at FROM submissions ORDER BY created_at DESC");
            if ($res && mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<div class="submitted">';
                    echo '<div class="cloned-form">';
                    echo '<label>Jméno:</label>';
                    echo '<input type="text" value="' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '" disabled />';
                    echo '<label>Email:</label>';
                    echo '<input type="text" value="' . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . '" disabled />';
                    echo '<label>typ produktu:</label>';
                    echo '<input type="text" value="' . htmlspecialchars($row['game'], ENT_QUOTES, 'UTF-8') . '" disabled />';
                    echo '<label>Hodnocení:</label>';
                    echo '<div class="rating-display">';
                    for ($i = 5; $i >= 1; $i--) {
                        $filled = $row['rating'] >= $i ? ' filled' : '';
                        echo '<span class="rating-dot' . $filled . '"></span>';
                    }
                    echo '</div>';
                    echo '<label>Text recenze:</label>';
                    echo '<textarea disabled>' . htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8') . '</textarea>';
                    echo '</div>';
                    echo '<div class="saved-meta">Saved at ' . htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8') . '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="submitted">Žádné záznamy k zobrazení.</div>';
            }
            ?>
        </div>
    </div>
</section>
