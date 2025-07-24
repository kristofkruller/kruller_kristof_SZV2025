<?php
require_once(__DIR__ . '/../components/msg.php');

$errors = [];

// DATA
$szeriaSzam = trim($_POST['szeria_szam'] ?? '');
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
    $msg = '';
    foreach ($errors as $field => $message) {
        $msg = $msg . "<p><strong>$field</strong>: $message</p>";
    }
    msgWithRedirect($msg);
    exit;
} else {

    // QUERY DB
    require_once(__DIR__ . "/../model/termek.php");
    require_once(__DIR__ . "/../model/kapcsolat_tarto.php");
    require_once(__DIR__ . "/../model/db.php");

    $db = new Database();
    $conn = $db->getConnection();

    try {
        $conn->beginTransaction();

        // 1. Kapcsolattartó mentése és ID lekérdezése
        $stmtKapcsolatTarto = $conn->prepare("INSERT INTO kapcsolattarto (nev, telefon, email) VALUES (?, ?, ?)");
        $stmtKapcsolatTarto->execute([
            $nev,
            $telefon,
            $email
        ]);
        $kapcsolattartoId = (int)$conn->lastInsertId();

        // 2. Termék példányosítása kapcsolattartó ID-val
        $termek = new Termek($szeriaSzam, $gyarto, $tipus, $kapcsolattartoId);

        // 3. Termék mentése
        $stmtTermek = $conn->prepare("INSERT INTO termek (szeria_szam, gyarto, tipus, leadas, statusz, modositas, kapcsolattarto_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
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
        msgWithRedirect('Sikeres rögzítés!');
        exit;
    } catch (PDOException $e) {
        $roll = $conn->rollBack();
        if (!$roll) {
            msgWithRedirect("Hiba történt az adatok rögzítése során és a Rollback is meghíusult!" . $e->getMessage());
            exit;
        }
        
        msgWithRedirect("Rollback végrehajtva. Hiba történt az adatok rögzítése során: " . $e->getMessage());
        exit;
    }
}
