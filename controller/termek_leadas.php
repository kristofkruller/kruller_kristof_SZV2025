<?php
$errors = [];

// DATA
$szeriaSzam = trim($_POST['szeriaSzam'] ?? '');
$gyarto = trim($_POST['gyarto'] ?? '');
$tipus = trim($_POST['tipus'] ?? '');
$nev = trim($_POST['nev'] ?? '');
$telefon = trim($_POST['telefon'] ?? '');
$email = trim($_POST['email'] ?? '');

// VALIDATOR
if (empty($szeriaSzam) || empty($gyarto) || empty($tipus) || empty($nev) || empty($telefon) || empty($email)) return "A form mezőinek kitöltése kötelező";
// Név (csak betűk, szóköz, ékezetek, kötőjel)
if (!preg_match("/^[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ \-']+$/u", $nev)) {
    $errors['nev'] = "A név csak betűket, szóközt és kötőjelet tartalmazhat.";
}
// Telefon (számok, +, szóköz, kötőjel, zárójel)
if (!preg_match("/^\+?[0-9 \-\(\)]{7,20}$/", $telefon)) {
    $errors['telefon'] = "Érvénytelen telefonszám formátum.";
}
// Email (beépített filter)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Érvénytelen email formátum.";
}

if (!empty($errors)) {
    foreach ($errors as $field => $message) {
        echo "<p><strong>$field</strong>: $message</p>";
    }
    exit;
} else {

    // QUERY DB
    require_once(BASE_PATH . "/model/termek.php");
    require_once(BASE_PATH . "/model/kapcsolattarto.php");
    require_once(BASE_PATH . "/model/db.php");

    $db = new Database();
    $conn = $db->getConnection();

    try {
        $conn->beginTransaction();

        // 1. Kapcsolattartó mentése és ID lekérdezése
        $stmtKapcsolatTarto = $conn->prepare("INSERT INTO kapcsolattarto (nev, telefon, email) VALUES (?, ?, ?)");
        $stmtKapcsolatTarto->execute([
            $kapcsolatTarto->getNev(),
            $kapcsolatTarto->getTelefon(),
            $kapcsolatTarto->getEmail()
        ]);
        $kapcsolattartoId = (int)$conn->lastInsertId();

        // 2. Termék példányosítása kapcsolattartó ID-val
        $termek = new Termek($szeriaSzam, $gyarto, $tipus, $kapcsolattartoId);

        // 3. Termék mentése
        $stmtTermek = $conn->prepare("INSERT INTO termek (szeriaSzam, gyarto, tipus, leadas, statusz, modositas, kapcsolattarto_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtTermek->execute([
            $termek->getSzeriaSzam(),
            $termek->getGyarto(),
            $termek->getTipus(),
            $termek->getLeadas()->format('Y-m-d H:i:s'),
            $termek->getStatusz()->value,
            $termek->getModositas()->format('Y-m-d H:i:s'),
            $termek->getKapcsolattartoId()
        ]);

        $conn->commit();
        echo "<p>Adatok sikeresen rögzítve az adatbázisba!</p>";
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "<p>Hiba történt az adatok rögzítése során: " . $e->getMessage() . "</p>";
    }
}
