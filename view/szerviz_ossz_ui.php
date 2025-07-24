<h2 class="h3 mb-3 fw-normal">Termék összesítő</h2>
<?php
require_once(__DIR__ . "/../controller/get_termekek.php");
require_once(__DIR__ . "/../model/termek.php");
require_once(__DIR__ . "/../components/assets.php");


foreach ($result as $row) {
    if ($row['szeria_szam'] === null) continue; // kapcsolattartóhoz nincs termék

    $termekek[] = new Termek(
        $row['szeria_szam'],
        $row['gyarto'],
        $row['tipus'],
        (int)$row['kid'],
        Statusz::from($row['statusz']),
        new DateTime($row['leadas']),
        new DateTime($row['modositas'])
    );
}


if (!empty($termekek)) {
    echo '<div class="table-responsive">';
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead class='table-dark'><tr>
            <th>Szériaszám</th>
            <th>Gyártó</th>
            <th>Típus</th>
            <th>Leadás dátuma</th>
            <th>Státusz</th>
            <th>Utolsó módosítás</th>
          </tr></thead>";
    echo "<tbody>";
    foreach ($termekek as $termek) {
        $statusz = $termek->getStatusz()->value;
        $rowClass = statuszSzinClass($statusz);

        echo "<tr class='{$rowClass}'>";
        echo "<td>" . htmlspecialchars($termek->getSzeriaSzam()) . "</td>";
        echo "<td>" . htmlspecialchars($termek->getGyarto()) . "</td>";
        echo "<td>" . htmlspecialchars($termek->getTipus()) . "</td>";
        echo "<td>" . htmlspecialchars($termek->getLeadas()->format('Y-m-d H:i:s')) . "</td>";
        echo "<td>" . htmlspecialchars($statusz) . "</td>";
        echo "<td>" . htmlspecialchars($termek->getModositas()->format('Y-m-d H:i:s')) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table></div>";
} else {
    echo "<p>Nincsenek rögzített termékek.</p>";
}


?>