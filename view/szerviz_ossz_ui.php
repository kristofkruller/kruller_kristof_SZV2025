<?php
$getPath = BASE_PATH."/controller/get_termekek.php";
?>
<h2>Termék összesítő</h2>
<?php
require_once($getPath);

if (!empty($termekek)) {
    echo "<table>";
    echo "<thead><tr><th>Szériaszám</th><th>Gyártó</th><th>Típus</th><th>Leadás dátuma</th><th>Státusz</th><th>Utolsó módosítás</th></tr></thead>";
    echo "<tbody>";
    foreach ($termekek as $termek) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($termek->getSzeriaSzam()) . "</td>";
        echo "<td>" . htmlspecialchars($termek->getGyarto()) . "</td>";
        echo "<td>" . htmlspecialchars($termek->getTipus()) . "</td>";
        echo "<td>" . htmlspecialchars($termek->getLeadas()->format('Y-m-d H:i:s')) . "</td>";
        echo "<td>" . htmlspecialchars($termek->getStatusz()->value) . "</td>";
        echo "<td>" . htmlspecialchars($termek->getModositas()->format('Y-m-d H:i:s')) . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>Nincsenek rögzített termékek.</p>";
}


?>