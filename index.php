<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="view/styles.css" rel="stylesheet">
  <title>kruller_kristof_SZV2025</title>
</head>

<body class="bg-light">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="index.php">SZV2025</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link<?= ($_GET['page'] ?? '') === 'reg' ? ' active' : '' ?>" href="?page=reg">Termék regisztráció</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?= ($_GET['page'] ?? '') === 'ossz' ? ' active' : '' ?>" href="?page=ossz">Termék összesítő</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- CONTENT -->
  <div id="content_field" class="container">

    <?php
    $page = $_GET['page'] ?? null;

    switch ($page) {
      case 'reg':
        require_once(__DIR__ . "/view/termek_leadas_ui.php");
        break;

      case 'ossz':
        require_once(__DIR__ . "/view/szerviz_ossz_ui.php");
        break;

      default:
        echo '<div class="text-center py-5">';
        echo '<h2 class="mb-3">Üdvözlünk a Szerviz rendszerben!</h2>';
        echo '<p>Használd a felső menüt a navigáláshoz.</p>';
        echo '</div>';
    }
    ?>
  </div>

  <footer>
    <div class="card">
      <div class="card-header">
        Készítette
      </div>
      <div class="card-body footer">
        <a href="https://github.com/kristofkruller" class="link-offset-2 link-underline link-underline-opacity-25">Github</a>
        <p><?php echo date("Y-M-D") ?></p>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>