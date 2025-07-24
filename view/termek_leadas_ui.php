<?php
require_once(__DIR__ . "/../vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

?>
<h2 class="h3 mb-3 fw-normal">Termék regisztráció</h2>
<form id="post_form" action="<?= $_ENV['POST_CALL'] ?>" method="post">
  <input class="mb-3 form-control" required type="text" name="szeria_szam" placeholder="Szériaszám">
  <input class="mb-3 form-control" required type="text" name="gyarto" placeholder="Gyártó">
  <input class="mb-3 form-control" required type="text" name="tipus" placeholder="Típus">
  <input class="mb-3 form-control" required type="text" name="nev" placeholder="Név">
  <input class="mb-3 form-control" required type="text" name="telefon" placeholder="Telefon">
  <input class="mb-3 form-control" required type="email" name="email" placeholder="Email">
  <button class="btn btn-primary" type="submit">Rögzít</button>
</form>