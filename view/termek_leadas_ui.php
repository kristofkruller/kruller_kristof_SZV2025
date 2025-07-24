<?php
require_once(__DIR__ . "/../vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

?>
<h2>Termék regisztráció</h2>
<form action="<?= $_ENV['POST_CALL'] ?>" method="post">
  <input required type="text" name="szeria_szam" placeholder="Szériaszám">
  <input required type="text" name="gyarto" placeholder="Gyártó">
  <input required type="text" name="tipus" placeholder="Típus">
  <input required type="text" name="nev" placeholder="Név">
  <input required type="text" name="telefon" placeholder="Telefon">
  <input required type="email" name="email" placeholder="Email">
  <button type="submit">Rögzít</button>
</form>