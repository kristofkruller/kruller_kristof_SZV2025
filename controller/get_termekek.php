<?php
require_once(__DIR__ . "/../model/db.php");

$db = new Database();
$conn = $db->getConnection();

$sql = '
  WITH termekek AS (
    SELECT
      t.szeria_szam,
      t.gyarto,
      t.tipus,
      t.leadas,
      t.statusz,
      t.modositas,
      t.kapcsolattarto_id as kid
    FROM szerviz_db.termek t
    WHERE t.statusz != \'Kész\'
      OR (t.statusz = \'Kész\' AND DATE(t.modositas) = CURRENT_DATE)
  )
  SELECT  
    tk.szeria_szam,
    tk.gyarto,
    tk.tipus,
    tk.leadas,
    tk.statusz,
    tk.modositas,
    tk.kid
  FROM szerviz_db.kapcsolattarto k 
  LEFT JOIN termekek tk ON k.id = tk.kid
  ORDER BY tk.statusz ASC
';

$stmt = $conn->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
