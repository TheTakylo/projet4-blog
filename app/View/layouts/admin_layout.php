<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?> | Administration - Billet simple pour l'Alaska</title>

    <link rel="stylesheet" href="<?= Assets::css('bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= Assets::css('admin/bootstrap.admin.css') ?>">
</head>
<body>
<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="<?= Urls::route('admin@index'); ?>">
              Accueil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= Urls::route('admin@chapters'); ?>">
              Chapitres
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= Urls::route('admin@comments'); ?>">
              Commentaires
            </a>
          </li>
          <li class="nav-item mt-4">
            <a class="nav-link" href="<?= Urls::route('pages@index'); ?>">
              Retour au site
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= Urls::route('security@logout'); ?>">
              Déconnexion
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Administration</h1>
      </div>
      <?php foreach(Flash::all() as $k): ?>
        <div class="alert alert-<?= $k['type']; ?>"><?= $k['message']; ?></div>
      <?php endforeach; ?>
      <?= $content ?>
    </main>
  </div>
</div>

  <?= $script_container ?? ''; ?>
</body>
</html>