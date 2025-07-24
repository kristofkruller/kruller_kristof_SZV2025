<?php
require_once(__DIR__ . "/../vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Csatlakozás adatbázis nélkül (csak a szerverre)
$pdo = new PDO('mysql:host=127.0.0.1;port=' . $_ENV['SEED_PORT'], 'root', '', [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// 1. Adatbázis létrehozása
$pdo->exec("DROP DATABASE IF EXISTS szerviz_db");
$pdo->exec("CREATE DATABASE szerviz_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

// 2. Csatlakozás az új DB-hez
$pdo->exec("USE szerviz_db");

// 3. Táblák létrehozása
$pdo->exec("
CREATE TABLE kapcsolattarto (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nev VARCHAR(255) NOT NULL,
  telefon VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL
)");

$pdo->exec("
CREATE TABLE termek (
  id INT AUTO_INCREMENT PRIMARY KEY,
  szeria_szam VARCHAR(100) NOT NULL,
  gyarto VARCHAR(100) NOT NULL,
  tipus VARCHAR(100) NOT NULL,
  leadas DATETIME NOT NULL,
  statusz ENUM('Beérkezett', 'Hibafeltárás', 'Alkatrész beszerzés alatt', 'Javítás', 'Kész') NOT NULL DEFAULT 'Beérkezett',
  modositas DATETIME NOT NULL,
  kapcsolattarto_id INT,
  FOREIGN KEY (kapcsolattarto_id) REFERENCES kapcsolattarto(id) ON DELETE SET NULL
)");

// 4. Seedelés
$pdo->exec("
INSERT INTO kapcsolattarto (nev, telefon, email) VALUES
  ('Kiss Anna', '06301234567', 'anna.kiss@example.com'),
  ('Nagy Béla', '06201239876', 'bela.nagy@example.com'),
  ('Tóth Csaba', '06305556666', 'csaba.toth@example.com'),
  ('Farkas Júlia', '06307778888', 'julia.farkas@example.com'),
  ('Szabó Péter', '06309994444', 'peter.szabo@example.com');
");

$pdo->exec("
INSERT INTO termek (szeria_szam, gyarto, tipus, leadas, statusz, modositas, kapcsolattarto_id) VALUES
  ('S12345', 'Dell', 'Inspiron 15', NOW(), 'Beérkezett', NOW(), 1),
  ('H67890', 'HP', 'EliteBook 840', NOW(), 'Javítás', NOW(), 2),
  ('L11223', 'Lenovo', 'ThinkPad X1', NOW(), 'Hibafeltárás', NOW(), 3),
  ('A33445', 'Asus', 'ZenBook UX425', NOW(), 'Alkatrész beszerzés alatt', NOW(), 4),
  ('M55667', 'Microsoft', 'Surface Laptop 5', NOW(), 'Kész', NOW(), 5);
");

echo "✅ Seed sikeresen lefutott!";
