<?php
require_once(__DIR__ . "/../vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

function msgWithRedirect(string $msg): void {
  $baseMsg = '
    <p>3 másodperc múlva visszairányítunk...</p>
    <script>
      setTimeout(() => {
        window.location.href = ' . $_ENV['XAMPP_ROOT'] . '/index.php;
      }, 3000);
    </script>
  ';
  if ($msg) {
    echo ("<p>$msg</p><br/>" . $baseMsg);
  } else {
    echo $baseMsg;
  }
}

function statuszSzinClass(string $statusz): string {
    return match ($statusz) {
        'Beérkezett' => 'table-primary',
        'Hibafeltárás' => 'table-warning',
        'Alkatrész beszerzés alatt' => 'table-secondary',
        'Javítás' => 'table-danger',
        'Kész' => 'table-success',
        default => 'table-light',
    };
}