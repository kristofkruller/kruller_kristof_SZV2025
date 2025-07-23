<?php
$postPath = BASE_PATH."/controller/termek_leadas.php";
?>
<h2>Termék regisztráció</h2>
<form action="<?= $postPath ?>" method="post">
  <input required type="text" name="szeriaSzam" placeholder="Szériaszám">
  <input required type="text" name="gyarto" placeholder="Gyártó">
  <input required type="text" name="tipus" placeholder="Típus">
  <input required type="text" name="nev" placeholder="Név">
  <input required type="text" name="telefon" placeholder="Telefon">
  <input required type="email" name="email" placeholder="Email">
  <button type="submit">Rögzít</button>
</form>